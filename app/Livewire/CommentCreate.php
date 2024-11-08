<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class CommentCreate extends Component
{
    public string $comment = '';

    public Post $post;
    public ?Comment $commentModel = null;

    public function mount(Post $post, $commentModel = null)
    {
        $this->post = $post;
        $this->commentModel = $commentModel;

        if ($commentModel) {
            $this->comment = $commentModel ? $commentModel->comment : '';
        }

    }

    public function render()
    {
        return view('livewire.comment-create');
    }

    public function createComment()
    {
        $user = auth()->user();

        if (!$user) {
            return $this->redirect('/login');
        }

        if ($this->commentModel) {
            if ($this->commentModel->user_id !== $user->id) {
                return response('Unauthorized Action!!!', 403);
            }

            $this->commentModel->comment = $this->comment;
            $this->commentModel->save();

            $this->comment = '';

            $this->dispatch('commentUpdated');
        } else {
            $comment = Comment::create([
                'comment' => $this->comment,
                'post_id' => $this->post->id,
                'user_id' => $user->id,
            ]);

            $this->dispatch('commentCreated', $comment->id);

            $this->comment = '';
        }
    }
}
