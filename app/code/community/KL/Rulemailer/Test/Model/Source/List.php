<?php
class KL_Rulemailer_Test_Model_Source_list extends KL_Rulemailer_Test_Case
{
    protected $list;

    protected function setUp()
    {
        $this->list = Mage::getModel('rulemailer/source_list');
    }

    public function testToOptionArrayWithSuccess()
    {
        $list = new stdclass();
        $list->id = 4914;
        $list->name = 'Karlsson & Lord AB';
        $response = $this->getModelMock(
            'rulemailer/api_response',
            array('get'),
            false,
            array(new stdclass())
        );
        $response->expects($this->any())
            ->method('get')
            ->will($this->returnValue(array($list)));
        $apiLists = $this->getModelMock('rulemailer/api_lists', array('get'));
        $apiLists->expects($this->any())
            ->method('get')
            ->will($this->returnValue($response));
        $this->replaceByMock('singleton', 'rulemailer/api_lists', $apiLists);

        $lists = $this->list->toOptionArray();

        $this->assertEquals(
            array(array('value' => 4914, 'label' => 'Karlsson & Lord AB')),
            $lists
        );
    }

    public function testToOptionArrayWithError()
    {
        $apiLists = $this->getModelMock('rulemailer/api_lists', array('get'));
        $apiLists->expects($this->any())
            ->method('get')
            ->will($this->throwException(new InvalidArgumentException()));
        $this->replaceByMock('singleton', 'rulemailer/api_lists', $apiLists);

        $lists = $this->list->toOptionArray();

        $this->assertEquals(0, count($lists));
    }
}
