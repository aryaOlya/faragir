<?php

namespace App\Repositories\Mysql\User;

use App\Models\User;
use App\Repositories\Mysql\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
