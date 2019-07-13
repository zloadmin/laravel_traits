<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 09/03/2019
 * Time: 10:43 PM
 */

namespace App\Traits;


trait DateTime
{
    public function createdText()
    {
        return $this->created_at ? $this->created_at->diffForHumans() : '';
    }
}