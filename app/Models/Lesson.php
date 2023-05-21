<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Lesson extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }

    public function prices(): MorphOne
    {
        return $this->MorphOne(Price::class,"priceable");
    }
}
