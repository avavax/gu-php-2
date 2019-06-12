<?php
class Rectangle
{
    /**
     * @var integer
     */
    protected $height;

    /**
     * @var integer
     */
    protected $width;

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }
}

class Square extends Rectangle
{
    public function setHeight(int $height): void
    {
        parent::setHeight($height);
        $this->width = $height;
    }

    public function setWidth(int $width): void
    {
        parent::setWidth($width);
        $this->height = $width;
    }
}

function calculate(Rectangle $object)
{
    return $object->getWidth() * $object->getHeight();
}

$object = new Square();

$object->setWidth(4);
$object->setHeight(5);

var_dump(calculate($object));