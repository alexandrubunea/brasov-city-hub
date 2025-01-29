<?php

namespace App\Livewire\Discussions;

use App\Models\Discussion as DiscussionModel;
use App\Models\DiscussionLikes as DiscussionLikesModel;
use Livewire\Component;

class Discussion extends Component
{
    public array $discussion;
    public int $likes;

    public string $content;
    public bool $cultural_event;
    public bool $sport_event;
    public bool $movie_night;
    public bool $party;
    public bool $show;
    public bool $concert;
    public bool $other;

    public bool $edit_mode = false;
    public bool $is_edited = false;

    public bool $can_edit_discussion;
    public bool $can_delete_discussion;
    public DiscussionLikesModel|null $liked_discussion = null;

    public bool $logged_in;

    public function mount()
    {
        if ($this->discussion['created_at'] != $this->discussion['updated_at'])
            $this->is_edited = true;

        $this->content = $this->discussion['content'];
        $this->cultural_event = $this->discussion['cultural_event'];
        $this->sport_event = $this->discussion['sport_event'];
        $this->movie_night = $this->discussion['movie_night'];
        $this->party = $this->discussion['party'];
        $this->show = $this->discussion['show'];
        $this->concert = $this->discussion['concert'];
        $this->other = $this->discussion['other'];

        $this->logged_in = auth()->check();

        if (!$this->logged_in) {
            $this->can_edit_discussion = false;
            $this->can_delete_discussion = false;
            return;
        }

        $discussion = DiscussionModel::find($this->discussion['id']);
        $this->can_delete_discussion = $discussion->user == auth()->user() || auth()->user()->hasRole('discussions_moderator') || auth()->user->hasRole('users_moderator');
        $this->can_edit_discussion = $discussion->user == auth()->user() && !$discussion->user->banned;

        $this->liked_discussion = DiscussionLikesModel::where('user_id', auth()->user()->id)
            ->where('discussion_id', $this->discussion['id'])
            ->first();
    }

    public function doesDiscussionStillExists()
    {
        return DiscussionModel::find($this->discussion['id']) != null;
    }

    public function clickHeartButton()
    {
        if (!$this->logged_in)
            return;

        if (!$this->doesDiscussionStillExists())
            return;

        if ($this->liked_discussion == null) {
            $this->liked_discussion = DiscussionLikesModel::create(['user_id' => auth()->user()->id, 'discussion_id' => $this->discussion['id']]);
            $this->discussion['likes'] += 1;
        }
        else {
            $this->liked_discussion->delete();
            $this->liked_discussion = null;
            $this->discussion['likes'] -= 1;
        }
    } 

    public function deleteDiscussion()
    {
        if (!$this->can_delete_discussion)
            return;

        if (!$this->doesDiscussionStillExists())
            return;

        DiscussionModel::find($this->discussion['id'])->delete();
        $this->dispatch('refreshDiscussions')->to(Discussions::class);
    }

    public function editDiscussion()
    {
        if (!$this->can_edit_discussion)
            return;

        if (!$this->doesDiscussionStillExists())
            return;

        $this->edit_mode = true;
    }

    public function saveEditDiscussion()
    {
        if (!$this->can_edit_discussion)
            return;

        if (!$this->doesDiscussionStillExists())
            return;

        $validator = $this->validate([
            'content' => 'required|min:3|max:500',
        ]);

        DiscussionModel::find($this->discussion['id'])->update($validator);

        $this->is_edited = true;
        $this->edit_mode = false;
    }

    public function cancelEditDiscussion()
    {
        $this->edit_mode = false;
    }

    public function render()
    {
        return view('livewire.discussions.discussion');
    }
}
