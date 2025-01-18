<?php

namespace App\Livewire\News;

use App\Models\ArticleComment;
use Livewire\Component;

class Comment extends Component
{
    public array $comment;

    public string $content;

    public bool $can_delete_comment;
    public bool $can_edit_comment;
    public bool $is_edited;

    public bool $edit_mode = false;

    public function mount()
    {
        $this->content = $this->comment['content'];
        $this->is_edited = $this->comment['updated_at'] != $this->comment['created_at'];

        if (!auth()->check()) {
            $this->can_edit_comment = false;
            $this->can_delete_comment = false;
            return;
        }

        $comment = ArticleComment::find($this->comment['id']);
        $this->can_delete_comment = $comment->user == auth()->user() || auth()->user()->hasRole('news_moderator') || auth()->user->hasRole('users_moderator');
        $this->can_edit_comment = $comment->user == auth()->user() && !$comment->user->banned;
    }

    public function editComment()
    {
        if (!$this->can_edit_comment)
            return;
        $this->edit_mode = true;
    }

    public function deleteComment()
    {
        if (!$this->can_delete_comment)
            return;
        ArticleComment::find($this->comment['id'])->delete();
        $this->dispatch('refreshComments')->to(Comments::class);
    }

    public function saveEditComment()
    {
        if (!$this->can_edit_comment)
            return;

        $validator = $this->validate([
            'content' => 'required|min:3|max:500',
        ]);
        
        ArticleComment::find($this->comment['id'])->update($validator);

        $this->is_edited = true;
        $this->edit_mode = false;
    }

    public function cancelEditComment()
    {
        $this->edit_mode = false;
    }

    public function render()
    {
        return view('livewire.news.comment');
    }
}
