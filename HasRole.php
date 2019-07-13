<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait HasRole
{
    public function getRoleText()
    {
        return Str::title($this->role);
    }

    public function isRole($role) : bool
    {
        return $role == $this->role;
    }
}