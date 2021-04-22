<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $blog_id
 * @property string $name
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CommentFactory factory(...$parameters)
 */
class Comment extends Model
{
    use HasFactory;

    public const BLOG_ID = 'blog_id';
    public const NAME = 'name';
    public const BODY = 'body';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getBlogId(): int
    {
        return $this->blog_id;
    }

    /**
     * @param int $blog_id
     */
    public function setBlogId(int $blog_id): void
    {
        $this->blog_id = $blog_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getCreatedAt(): \Illuminate\Support\Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): \Illuminate\Support\Carbon
    {
        return $this->updated_at;
    }
}
