<?php

namespace App\Helpers\Traits;

use Illuminate\Database\Eloquent\Model;

trait SetPrice
{
    public static function setPrice(Model $model, int $price)
    {
        $model->prices()->create([
            "price"=>$price
        ]);
    }
}
