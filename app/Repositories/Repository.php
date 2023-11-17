<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    protected Model $model;
    protected Builder $builder;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->builder = $model->newQuery();
    }

    public function getById($id, $columns = ['*']): ?Model
    {
        return $this->model->find($id, $columns)->first();
    }

    public function getByIds($ids, $columns = ['*']): Collection
    {
        return $this->model->find($ids, $columns);
    }
}
