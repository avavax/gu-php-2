<?php
class A
{
    static $param = 12;

    public function getParams()
    {
        return static::$param;
    }
}

class B extends A
{
    static $param = 13;
}

$b = new B();
echo $b->getParams();
