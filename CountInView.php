<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 10/03/2019
 * Time: 11:39 PM
 */

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

trait CountInView
{

    public static function bootCountInView()
    {
        self::created(function () {
            self::clearCache();
        });
        self::deleted(function () {
            self::clearCache();
        });
    }

    static function clearCache()
    {
        Cache::forget(self::keyName());
    }

    static function countForView()
    {
        $count = Cache::rememberForever(self::keyName(), function () {
            return self::count();
        });
        View::share(self::keyName(), $count);
    }

    static function keyName()
    {
        return mb_strtolower(class_basename(get_called_class())) . "_count";
    }

}