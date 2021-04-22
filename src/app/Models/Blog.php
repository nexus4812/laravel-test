<?php

namespace App\Models;

use App\Models\Interface\ConcreteFactoryInterface;
use Database\Factories\BlogFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Blog
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property int $status
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\BlogFactory factory(...$parameters)
 */
class Blog extends Model implements ConcreteFactoryInterface
{
    use HasFactory;

    public static function concreteFactory(...$parameters): BlogFactory
    {
        /** @var BlogFactory $r */
        $r = self::factory(...$parameters);
        return $r;
    }

    public const PRIMARY = 'id';
    public const USER_ID = 'user_id';
    public const STATUS = 'status';
    public const TITLE = 'title';
    public const BODY = 'body';

    public const STATUS_OPEN = 1;
    public const STATUS_CLOSED = 0;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, self::USER_ID);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'blog_id');
    }

    public static function filterOnlyOpen(Builder $builder): Builder
    {
        return $builder->where(self::STATUS, self::STATUS_OPEN);
    }
}
