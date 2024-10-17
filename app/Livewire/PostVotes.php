<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\UpvoteDownvote;

class PostVotes extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $upvotes = UpvoteDownvote::where('post_id', '=', $this->post->id)
            ->where('is_upvote', '=', true)
            ->count();

        $downvotes = UpvoteDownvote::where('post_id', '=', $this->post->id)
            ->where('is_upvote', '=', false)
            ->count();

        // Status whether current user has upvoted the post or not
        // It can be null, true or false
        // null means user has neither upvoted nor downvoted the post
        $hasUpvote = null;

        $user = request()->user();

        if ($user) {
            $model = UpvoteDownvote::where('post_id', '=', $this->post->id)
                ->where('user_id', '=', $user->id)
                ->first();

            if ($model) {
                $hasUpvote = !!$model->is_upvote;
            }
        }

        return view('livewire.post-votes', compact('upvotes', 'downvotes', 'hasUpvote'));
    }

    public function upvoteDownvote($upvote = true)
    {
        $user = request()->user();

        if (!$user) {
            return $this->redirect('login');
        }

        if (!$user->hasVerifiedEmail()) {
            return $this->redirect(route('verification.notice'));
        }

        $model = UpvoteDownvote::where('post_id', '=', $this->post->id)
            ->where('user_id', '=', $user->id)
            ->first();

        if (!$model) {
            UpvoteDownvote::create([
                'user_id' => $user->id,
                'post_id' => $this->post->id,
                'is_upvote' => $upvote,
            ]);

            return;
        }

        if ($upvote && $model->is_upvote || !$upvote && !$model->is_upvote) {
            $model->delete();
        } else {
            $model->is_upvote = $upvote;
            $model->save();
        }
    }
}
