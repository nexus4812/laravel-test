<?php


namespace App\Models\Queries;


use App\Models\Blog;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogQuery extends QueryAbstract
{
    protected const MODEL_CLASS = Blog::class;

    public function onlyStatusOpen(): self
    {
        $this->builder()
            ->where(Blog::STATUS, Blog::STATUS_OPEN);
        return $this;
    }

    public function withUser(): self
    {
        $this->builder()->with('user');
        return $this;
    }

    public function withCommentOldest(): self
    {
        $this->builder()->with(['comments' => fn (HasMany $many) => $many->oldest()]);
        return $this;
    }

    public function orderByCommentCountDesc():self
    {
        $this->builder()
            ->withCount('comments')
            ->orderByDesc('comments_count');
        return $this;
    }
}
