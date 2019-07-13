<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 18/03/2019
 * Time: 1:09 AM
 */

namespace App\Traits;
use Illuminate\Support\Str;

trait UUID
{
    public static function bootUUID()
    {
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}