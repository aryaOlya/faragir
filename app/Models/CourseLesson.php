<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseLesson extends Pivot
{
    protected $guarded = ["id"];
}
