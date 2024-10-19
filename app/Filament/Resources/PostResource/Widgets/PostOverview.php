<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\PostView;
use Filament\Widgets\Widget;
use App\Models\UpvoteDownvote;
use Illuminate\Database\Eloquent\Model;

class PostOverview extends Widget
{
    public ?Model $record = null;

    protected string | int | array $columnSpan = 3;

    protected function getViewData(): array
    {
        return [
            'viewCount' => PostView::where('post_id', '=', $this->record->id)->count(),
            'upvotes' => UpvoteDownvote::where('post_id', '=', $this->record->id)->where('is_upvote', '=', true)->count(),
            'downvotes' => UpvoteDownvote::where('post_id', '=', $this->record->id)->where('is_upvote', '=', false)->count(),
        ];
    }

    protected static string $view = 'filament.resources.post-resource.widgets.post-overview';
}
