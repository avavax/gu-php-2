<?php

namespace App\Traits;

trait Calc
{
    public function getCount($param)
    {
        return count($param);
    }
}