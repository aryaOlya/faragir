<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class CacheHelpers
{
    public static function getFromCache(string $name, callable $callable)
    {
        if (!Cache::has($name)) {
            Cache::rememberForever($name, $callable);
        }
        return Cache::get($name);
    }

    public static function clearCache(array $caches)
    {
        for ($i = 0; $i < sizeof($caches); $i++) {
           if (Cache::has($caches[$i])){
               Cache::forget($caches[$i]);
           }
        }
    }
}
