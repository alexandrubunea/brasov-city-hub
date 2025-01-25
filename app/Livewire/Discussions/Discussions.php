<?php

namespace App\Livewire\Discussions;

use App\Models\Discussion as DiscussionModel;
use Livewire\Component;
use Carbon\Carbon;

use Livewire\Attributes\On;

class Discussions extends Component
{
    public string $sort_by;
    public string $content;
    public array $discussions = [];

    public bool $cultural_event = false;
    public bool $sport_event = false;
    public bool $movie_night = false;
    public bool $party = false;
    public bool $show = false;
    public bool $concert = false;
    public bool $other = false;

    public int $load_from = 0;
    public int $load_factor = 25;

    public function mount()
    {
        $this->sort_by = 'hotness';
        $this->loadDiscussions();
    }

    public function render()
    {
        return view('livewire.discussions.discussions');
    }

    #[On('refreshDiscussions')]
    public function refreshDiscussions()
    {
        $this->loadDiscussions(false);
    }

    public function addDiscussion()
    {
        $validator = $this->validate([
            'content' => 'required|min:3',
            'cultural_event' => 'required',
            'sport_event' => 'required',
            'movie_night' => 'required',
            'party' => 'required',
            'show' => 'required',
            'concert' => 'required',
            'other' => 'required'
        ]);

        auth()->user()->discussions()->create($validator);

        $this->content = '';
        $this->cultural_event = false;
        $this->sport_event = false;
        $this->movie_night = false;
        $this->party = false;
        $this->show = false;
        $this->concert = false;
        $this->other = false;

        $this->loadDiscussions(false);
    }

    #[On('loadMoreDiscussions')]
    public function loadDiscussions($expandDiscussions = true)
    {
        $query = DiscussionModel::query();

        switch ($this->sort_by) {
            case 'hotness':
                $HOT_CONST = 1.0;
                $query->leftJoin('discussion_likes', 'discussion_likes.discussion_id', '=', 'discussions.id')
                    ->selectRaw('discussions.*, 
                               (COUNT(discussion_likes.id) - (EXTRACT(day FROM (CURRENT_DATE - discussions.created_at)) * ?)) AS hotness', [$HOT_CONST])
                    ->groupBy('discussions.id')
                    ->orderBy('hotness', 'desc');
                break;

            case 'most_liked':
                $query->leftJoin('discussion_likes', 'discussion_likes.discussion_id', '=', 'discussions.id')
                    ->selectRaw('discussions.*, COUNT(discussion_likes.id) as likes_count')
                    ->groupBy('discussions.id')
                    ->orderBy('likes_count', 'desc');
                break;

            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
        }

        $elements_to_load = (($this->load_from) ? (int)($this->load_from / $this->load_factor)  : 1) * $this->load_factor;

        $discussions = $query->with(['user', 'likes'])
            ->get()
            ->skip($expandDiscussions ? $this->load_from : 0)
            ->take($expandDiscussions ? $this->load_factor : $elements_to_load)
            ->map(function ($discussion) {
                return [
                    'id' => $discussion->id,
                    'content' => $discussion->content,
                    'author' => $discussion->user->first_name . ' ' . $discussion->user->last_name,
                    'likes' => $discussion->likes->count(),
                    'cultural_event' => $discussion->cultural_event,
                    'sport_event' => $discussion->sport_event,
                    'movie_night' => $discussion->movie_night,
                    'party' => $discussion->party,
                    'show' => $discussion->show,
                    'concert' => $discussion->concert,
                    'other' => $discussion->other,
                    'created_at' => Carbon::parse($discussion->created_at)->format('d F Y H:i'),
                    'updated_at' => Carbon::parse($discussion->updated_at)->format('d F Y H:i'),

                ];
            })
            ->toArray();

        if ($expandDiscussions) {
            $this->discussions = array_merge($this->discussions, $discussions);
            $this->load_from += $this->load_factor;
        } else {
            $this->dispatch(
                'disconnectObserver',
                lastLoadedId: end($this->discussions)['id'],
            )->self();
            $this->discussions = $discussions;
        }

        $this->dispatch(
            'discussionsLoaded',
            lastLoadedId: end($this->discussions)['id'],
            hasMoreDiscussions: count($discussions) > 0
        )->self();
    }

    public function setOrderBy(string $sort_by)
    {
        if (!($sort_by == 'hotness' || $sort_by == 'most_liked' || $sort_by == 'latest'))
            return;

        $this->sort_by = $sort_by;
        $this->discussions = [];
        $this->load_from = 0;
        $this->loadDiscussions();
    }
}
