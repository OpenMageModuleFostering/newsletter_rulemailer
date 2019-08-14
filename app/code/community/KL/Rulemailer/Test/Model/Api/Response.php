<?php
class KL_Rulemailer_Test_Model_Api_Response extends KL_Rulemailer_Test_Case
{
    public function testGet()
    {
        $response = $this->getModel(array('foo' => 'bar'));

        $this->assertEquals('bar', $response->get('foo'));
    }

    public function testGetStatus()
    {
        $response = $this->getModel(array('status' => 'Success'));

        $this->assertEquals('Success', $response->getStatus());
    }

    public function testIsErrorWithSuccess()
    {
        $response = $this->getModel(array('error_code' => 0));

        $this->assertFalse($response->isError());
    }

    public function testIsErrorWithError()
    {
        $response = $this->getModel(array('error_code' => 1));

        $this->assertTrue($response->isError());
    }

    public function testIsSuccessWithSuccess()
    {
        $response = $this->getModel(array('error_code' => 0));

        $this->assertTrue($response->isSuccess());
    }

    public function testIsSuccessWithError()
    {
        $response = $this->getModel(array('error_code' => 1));

        $this->assertFalse($response->isSuccess());
    }

    private function getModel($vars)
    {
        return Mage::getModel(
            'rulemailer/api_response', $this->getResponseObject($vars)
        );
    }
}
