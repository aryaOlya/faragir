<?php

namespace App\Repositories\Mysql\Price;

use App\Models\Price;
use App\Repositories\Mysql\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class PriceRepository extends BaseRepository
{
    public function __construct(Price $model)
    {
       $this->model = $model;
    }


}
