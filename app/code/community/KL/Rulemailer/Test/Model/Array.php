<?php
class KL_Rulemailer_Test_Model_Array extends KL_Rulemailer_Test_Case
{
    protected $arr;

    protected function setUp()
    {
        $this->arr = Mage::getModel('rulemailer/array', array(1, 2, 3, 4, 5));
    }

    public function testInsert()
    {
        $this->arr->insert(0, 2);

        $this->assertEquals(array(1, 2, 0, 3, 4, 5), $this->arr->toArray());
    }

    /**
     * @expectedException OutOfBoundsException
     */
    public function testInsertWithInvalidPosition()
    {
        $this->arr->insert(0, -1);
    }

    public function testSize()
    {
        $this->assertEquals(5, $this->arr->size());
    }

    public function testToArray()
    {
        $this->assertEquals(array(1, 2, 3, 4, 5), $this->arr->toArray());
    }
}
