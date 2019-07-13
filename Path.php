<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 11/03/2019
 * Time: 12:13 AM
 */

namespace App\Traits;


trait Path
{
    public function getRoutePrefixName()
    {
        return mb_strtolower(class_basename(get_called_class()));
    }

    public function editPath()
    {
        return route("{$this->getRoutePrefixName()}.edit", $this);
    }
    public function updatePath()
    {
        return route("{$this->getRoutePrefixName()}.update", $this);
    }
    public function deletePath()
    {
        return route("{$this->getRoutePrefixName()}.destroy", $this);
    }
}