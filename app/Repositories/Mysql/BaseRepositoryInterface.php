<?php

namespace App\Repositories\Mysql;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function getAll(array $relations = [], array $conditions = []): Collection;

    public function findOrFail(
        int   $modelId,
        array $relations = [],
    ): ?Model;

    public function create(array $columns): ?Model;

    public function update(Model $model, array $columns): ?Model;

    public function delete(Model $model);

}
