<?php
class KL_Rulemailer_Test_Case extends EcomDev_PHPUnit_Test_Case
{
    protected function getResponseObject($vars)
    {
        $obj = new stdClass();

        foreach ($vars as $key => $val) {
            $obj->$key = $val;
        }

        return $obj;
    }

    protected function getSoapClientStub($vars)
    {
        $soapClientStub = $this->getMockBuilder('SoapClient')
            ->disableOriginalConstructor()
            ->getMock();
        $soapClientStub->expects($this->any())
            ->method('__call')
            ->will($this->returnValue($this->getResponseObject($vars)));

        return $soapClientStub;
    }
}
