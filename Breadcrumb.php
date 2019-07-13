<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 11/03/2019
 * Time: 12:07 AM
 */

namespace App\Traits;
use Illuminate\Support\Str;


trait Breadcrumb
{
    static function getIndexBreadcrumb()
    {
        return self::first_level();
    }

    static function getCreateBreadcrumb()
    {
        return array_merge(self::first_level(), [route(self::route_key() . '.create') => 'Add ' . self::lower_title()]);
    }
    static function getEditBreadcrumb($model)
    {
        return array_merge(self::first_level(), [$model->editPath() => 'Edit ' . self::lower_title()]);
    }

    static function class_name()
    {
        return class_basename(get_called_class());
    }
    static function route_key()
    {
        return mb_strtolower(self::class_name());
    }
    static function plural_title()
    {
        return Str::plural(self::class_name());
    }
    static function lower_title()
    {
        return mb_strtolower(self::class_name());
    }
    static function first_level()
    {
        return [route(self::route_key() . '.index') => self::plural_title()];
    }
}