<?php

namespace App\Livewire\ClientInterface;

use App\Models\Comment as CommentModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comment extends Component
{
    public $lesson;
    public $comments;
    public $comment;
    public $replayText;
    public $alerts = [];
    public $replyingTo = null;
    public $replyingForm = false;
    protected $listeners = ['clearAlert'];

    public function mount($lesson)
    {
        $this->lesson = $lesson;
        $this->comments = $lesson->comments()->where('parent_id', null)->with(['user', 'children.user', 'likes'])->get();
    }

    public function render()
    {
        return view('livewire.client-interface.comment');
    }
    
    public function addComment()
    {
        $this->validate([
            'comment' => 'required|string',
        ]);

        CommentModel::create([
            'user_id' => Auth::user()->id,
            'body' => $this->comment,
            'lesson_id' => $this->lesson->id,
        ]);

        $this->comment = '';
        $this->comments = $this->lesson->comments()->where('parent_id', null)->with(['user', 'children.user', 'likes'])->get();
        
        $this->alerts['comment_added'] = [
            'type' => 'success',
            'message' => 'Your comment has been posted successfully.'
        ];
    }
    
    public function deleteComment($commentId)
    {
        $comment = CommentModel::findOrFail($commentId);
        
        if (Auth::id() !== $comment->user_id) {
            return;
        }
        
        $comment->delete();
        
        $this->comments = $this->lesson->comments;
        
        $this->alerts['comment_deleted'] = [
            'type' => 'success',
            'message' => 'Comment deleted successfully.'
        ];
    }
    
    public function clearAlert($alertId)
    {
        if (isset($this->alerts[$alertId])) {
            unset($this->alerts[$alertId]);
        }
    }

    public function reply($commentId)
    {
        $this->validate([
            'replayText' => 'required|string',
        ]);

        CommentModel::create([
            'user_id' => Auth::user()->id,
            'body' => $this->replayText,
            'lesson_id' => $this->lesson->id,
            'parent_id' => $commentId,
        ]);

        $this->replayText = '';
        $this->comments = $this->lesson->comments()->where('parent_id', null)->with(['user', 'children.user'])->get();
        $this->replyingTo = null;
        $this->replyingForm = false;
        
        $this->alerts['reply_added'] = [
            'type' => 'success',
            'message' => 'Your reply has been posted successfully.'
        ];
    }

    public function replyForm($commentId)
    {
        $this->replyingTo = $commentId;
        $this->replyingForm = true;
    }

    public function cancelReply()
    {
        $this->replyingTo = null;
        $this->replyingForm = false;
        $this->replayText = '';
    }

    public function like($commentId)
    {
        $comment = CommentModel::findOrFail($commentId);
        $userId = Auth::id();
        
        if ($comment->likes()->where('user_id', $userId)->exists()) {
            $comment->likes()->detach($userId);
        } else {
            $comment->likes()->attach($userId);
        }
        
        $this->comments = $this->lesson->comments()->where('parent_id', null)->with(['user', 'children.user', 'likes'])->get();
    }
}
