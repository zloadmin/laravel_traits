<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 11/03/2019
 * Time: 12:18 AM
 */

namespace App\Traits;


trait DOMClassName
{

    /**
     * @return string
     */
    public function deleteId()
    {
        return 'delete_' . mb_strtolower(class_basename(get_called_class())) . '_' . $this->id;
    }
}