<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 11/03/2019
 * Time: 12:26 AM
 */

namespace App\Traits;

use Illuminate\Support\Str;
trait Title
{

    static function getIndexTitle()
    {
        return Str::plural(class_basename(get_called_class()));
    }
    static function getCreateTitle()
    {
        return 'Create ' . class_basename(get_called_class());
    }
    static function getEditTitle()
    {
        return 'Edit ' . class_basename(get_called_class());
    }
}