<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 26/03/2019
 * Time: 9:38 PM
 */

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {
        self::creating(function ($model) {
            $model->slug = self::getSlug($model->name);
        });
    }
    static function getSlug($name, $count = 0)
    {
        $slug_name = $count > 0 ? Str::slug($name) . $count : Str::slug($name);
        $is_slug = self::slug($slug_name)->count();
        return $is_slug ? self::getSlug($name, $count + 1) : $slug_name;
    }
    public function scopeSlug($query, $slug)
    {
        $query->where('slug', $slug);
    }
}