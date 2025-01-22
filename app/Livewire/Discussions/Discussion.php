<?php

namespace App\Livewire\Discussions;

use App\Models\Discussion as DiscussionModel;
use Livewire\Component;

class Discussion extends Component
{
    public array $discussion; 

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

        if (!auth()->check()) {
            $this->can_edit_discussion = false;
            $this->can_delete_discussion = false;
            return;
        }

        $discussion = DiscussionModel::find($this->discussion['id']);
        $this->can_delete_discussion = $discussion->user == auth()->user() || auth()->user()->hasRole('news_moderator') || auth()->user->hasRole('users_moderator');
        $this->can_edit_discussion = $discussion->user == auth()->user() && !$discussion->user->banned;
 
    }

    public function likeDiscussion()
    {
        
    }

    public function deleteDiscussion()
    {
        if (!$this->can_delete_discussion)
            return;
        DiscussionModel::find($this->discussion['id'])->delete();
        $this->dispatch('refreshDiscussions')->to(Discussions::class); 
    }

    public function editDiscussion()
    {
        if (!$this->can_edit_discussion)
            return;
        $this->edit_mode = true;
    }

    public function saveEditDiscussion()
    {
        if (!$this->can_edit_discussion)
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
