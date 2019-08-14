<?php
class KL_Rulemailer_Model_Api
{
    /**
     * API WSDL URL.
     *
     * @var string
     */
    const WSDL = 'http://one.rulemailer.com/api3.6.php?wsdl';

    /**
     * The SOAP adapter.
     *
     * @var SoapClient
     */
    private $soapClient;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->soapClient  = new SoapClient(self::WSDL);
    }

    public function getHelper()
    {
        return Mage::helper('rulemailer');
    }

    public function getSoapClient()
    {
        return $this->soapClient;
    }

    public function setSoapClient($soapClient)
    {
        $this->soapClient = $soapClient;

        return $this;
    }

    protected function getConfig($key)
    {
        return Mage::getSingleton('rulemailer/config')->get($key);
    }

    protected function request()
    {
        $args = func_get_args();    // Function call arguments.
        $func = array_shift($args); // Function to request.

        array_unshift($args, $this->getConfig('key')); // Prepend API key.

        $response = call_user_func_array(
            array($this->soapClient, $func), $args
        );

        return Mage::getModel('rulemailer/api_response', $response);
    }
}
