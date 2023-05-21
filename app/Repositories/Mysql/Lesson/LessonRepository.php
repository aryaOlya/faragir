<?php

namespace App\Repositories\Mysql\Lesson;

use App\Models\Lesson;
use App\Repositories\Mysql\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class LessonRepository extends BaseRepository
{
    public function __construct(Lesson $model)
    {
        $this->model = $model;
    }
}
