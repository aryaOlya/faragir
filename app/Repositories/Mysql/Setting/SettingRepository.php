<?php

namespace App\Repositories\Mysql\Setting;

use App\Models\Setting;
use App\Repositories\Mysql\BaseRepository;

class SettingRepository extends BaseRepository
{
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }
}
