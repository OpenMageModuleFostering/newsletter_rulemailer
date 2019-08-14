<?php
class KL_Rulemailer_Test_Model_Api_Subscriber extends KL_Rulemailer_Test_Case
{
    protected $subscriber;

    protected function setUp()
    {
        $this->subscriber = Mage::getSingleton('rulemailer/api_subscriber');
    }

    /**
     * @loadFixture default
     */
    public function testDeleteWithSuccess()
    {
        $this->subscriber->setSoapClient($this->getSoapClientStub(array(
            'error_code' => 0
        )));

        $response = $this->subscriber->delete('hello@karlssonlord.com');

        $this->assertTrue($response->isSuccess());
    }

    /**
     * @loadFixture default
     */
    public function testDeleteWithError()
    {
        $this->subscriber->setSoapClient($this->getSoapClientStub(array(
            'error_code' => 3
        )));

        $response = $this->subscriber->delete('hello@karlssonlord.com');

        $this->assertTrue($response->isError());
    }

    /**
     * @loadFixture default
     */
    public function testGetWithSuccess()
    {
        $this->subscriber->setSoapClient($this->getSoapClientStub(array(
            'email' => 'hello@karlssonlord.com',
            'subscriber_id' => '2'
        )));

        $response = $this->subscriber->get('hello@karlssonlord.com');

        $this->assertEquals('hello@karlssonlord.com', $response->get('email'));
        $this->assertEquals('2', $response->get('subscriber_id'));
    }

    /**
     * @loadFixture default
     */
    public function testGetWithError()
    {
        $this->subscriber->setSoapClient($this->getSoapClientStub(array(
            'error_code' => 3
        )));

        $response = $this->subscriber->get('hello1@karlssonlord.com');

        $this->assertTrue($response->isError());
    }

    /**
     * @loadFixture default
     */
    public function testSubscribeWithSuccess()
    {
        $this->subscriber->setSoapClient($this->getSoapClientStub(array(
            'error_code' => 0
        )));

        $response = $this->subscriber->subscribe('hello' . time() . '@karlssonlord.com');

        $this->assertTrue($response->isSuccess());
    }

    /**
     * @loadFixture default
     */
    public function testSubscribeWithError()
    {
        $this->subscriber->setSoapClient($this->getSoapClientStub(array(
            'error_code' => 9
        )));

        $response = $this->subscriber->subscribe('hello' . time() . '@karlssonlord.com');

        $this->assertTrue($response->isError());
    }

    /**
     * @loadFixture default
     */
    public function testUnsubscribeWithSuccess()
    {
        $this->subscriber->setSoapClient($this->getSoapClientStub(array(
            'error_code' => 0
        )));

        $response = $this->subscriber->unsubscribe('hello' . time() . '@karlssonlord.com');

        $this->assertTrue($response->isSuccess());
    }

    /**
     * @loadFixture default
     */
    public function testUnsubscribeWithError()
    {
        $this->subscriber->setSoapClient($this->getSoapClientStub(array(
            'error_code' => 3
        )));

        $response = $this->subscriber->unsubscribe('hello-unittest@karlssonlord.com');

        $this->assertTrue($response->isError());
    }

}
