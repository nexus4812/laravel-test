<?php


namespace App\Models\Queries;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class QueryAbstract
{
    protected const MODEL_CLASS = Model::class;
    private $builder;

    private function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @return static
     */
    public static function newQuery(): self
    {
        if(!method_exists(self::MODEL_CLASS,'query')) {
            throw new \LogicException('query not found');
        }

        $builder = (static::MODEL_CLASS)::query();

        if(!($builder instanceof Builder)) {
            throw new \LogicException('instance not builder');
        }

        return new static($builder);
    }

    public function whereByPrimaryId(int $id): self
    {
        $this->builder()->where(Blog::PRIMARY, $id);
        return $this;
    }

    protected function builder(): Builder
    {
        return $this->builder;
    }

    public function firstOrFail(): Model
    {
        return $this->builder()->firstOrFail();
    }

    public function get(): Collection
    {
        return $this->builder()->get();
    }
}
