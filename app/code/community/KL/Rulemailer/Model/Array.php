<?php
class KL_Rulemailer_Model_Array extends ArrayObject
{
    private $arr;

    public function __construct($arr)
    {
        $this->arr = $arr;
    }

    public function insert($element, $position = 0)
    {
        if ($position < 0 || $position >= $this->size()) {
            throw new OutOfBoundsException();
        }

        $this->arr = array_merge(
            array_slice($this->arr, 0, $position),
            array($element),
            array_slice($this->arr, $position)
        );
    }

    public function size()
    {
        return count($this->arr);
    }

    public function toArray()
    {
        return $this->arr;
    }
}
