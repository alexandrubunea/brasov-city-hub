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
    public array $discussions;

    public bool $cultural_event = false;
    public bool $sport_event = false;
    public bool $movie_night = false;
    public bool $party = false;
    public bool $show = false;
    public bool $concert = false;
    public bool $other = false;

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
        $this->loadDiscussions();
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

        $this->loadDiscussions();
    }

    protected function loadDiscussions()
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

        $discussions = $query->with(['user', 'likes'])
            ->get()
            ->take(10)
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

        $this->discussions = $discussions;
    }

    public function setOrderBy(string $sort_by)
    {
        if (!($sort_by == 'hotness' || $sort_by == 'most_liked' || $sort_by == 'latest'))
            return;

        $this->sort_by = $sort_by;
        $this->loadDiscussions();
    }
}
