<?php

namespace App\Repositories\Mysql\Course;

use App\Models\Course;
use App\Repositories\Mysql\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class CourseRepository extends BaseRepository
{
    public function __construct(Course $model)
    {
        $this->model = $model;
    }
}
