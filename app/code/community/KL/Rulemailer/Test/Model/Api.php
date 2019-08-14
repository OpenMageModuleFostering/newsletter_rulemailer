<?php
class KL_Rulemailer_Test_Model_Api extends KL_Rulemailer_Test_Case
{
    protected $api;

    protected function setUp()
    {
        $this->api = Mage::getModel('rulemailer/api');
    }

    public function testSetSoapClient()
    {
        $soapClient = $this->getMockBuilder('SoapClient')
            ->disableOriginalConstructor()
            ->getMock();

        $this->api->setSoapClient($soapClient);

        $this->assertEquals($soapClient, $this->api->getSoapClient());
    }
}
