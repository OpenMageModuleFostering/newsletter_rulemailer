<?php
class KL_Rulemailer_Test_Model_Config extends KL_Rulemailer_Test_Case
{
    protected $config;

    protected function setUp()
    {
        $this->config = Mage::getModel('rulemailer/config');
    }

    /**
     * @expectedException InvalidArgumentException
     * @loadFixture default
     */
    public function testGetWithInvalidKey()
    {
        $this->config->get('foo');
    }
}
