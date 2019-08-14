<?php
class KL_Rulemailer_Test_Model_Api_Lists extends KL_Rulemailer_Test_Case
{
    protected $lists;

    protected function setUp()
    {
        $this->lists = Mage::getSingleton('rulemailer/api_lists');
    }

    /**
     * @loadFixture default
     */
    public function testListsWithSuccess()
    {
        $list = new stdclass();
        $list->id = 4914;
        $list->name = 'Karlsson & Lord AB medlemmar';
        $this->lists->setSoapClient($this->getSoapClientStub(array(
            'lists' => array($list)
        )));

        $lists = $this->lists->get()->get('lists');

        $this->assertEquals(1, count($lists));
        $this->assertEquals(4914, $lists[0]->id);
        $this->assertEquals('Karlsson & Lord AB medlemmar', $lists[0]->name);
    }

    public function testListsWithError()
    {
        $this->lists->setSoapClient($this->getSoapClientStub(array(
            'error_code' => 1
        )));

        $response = $this->lists->get();

        $this->assertTrue($response->isError());
    }
}
