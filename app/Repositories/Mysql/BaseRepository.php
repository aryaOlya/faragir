<?php

namespace App\Repositories\Mysql;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    protected function setBuilder(array $relations = [], array $condition = [])
    {
        if ($relations == []){
            return $this->model->query()->where($condition[0], $condition[1], $condition[2]);
        }elseif ($condition == []){
            return $this->model->query()->with($relations);
        }elseif ($relations == [] & $condition == []){
            return $this->model;
        }

    }

    public function getAll(array $relations = [], array $conditions = []): Collection
    {
        return $this->setBuilder($relations, $conditions)->get();
    }

    public function create(array $columns): ?Model
    {
        return $this->model->query()->create($columns);
    }

    public function findOrFail(int $modelId, array $relations = []): ?Model
    {
        return $this->model->with($relations)->findOrFail($modelId);
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }

    public function update(Model $model, array $columns): ?Model
    {
        $model->update($columns);
        return $model;
    }

    public function attach(BelongsToMany $belongsToMany,int $id): void
    {
         $belongsToMany->attach($id);
    }

    public function sync(BelongsToMany $belongsToMany,array $ids)
    {
        $belongsToMany->sync($ids);
    }

    public function deleteMorph(MorphOne $morphOne)
    {
        $morphOne->delete();
    }

    public function first()
    {
        return $this->model->query()->first();
    }


}
