<?php
class KL_Rulemailer_Model_Api_Response extends Varien_Object
{
    /**
     * Class constructor.
     *
     * @param stdClass $obj The SOAP response object.
     */
    public function __construct($obj)
    {
        foreach (get_object_vars($obj) as $key => $val) {
            $this->setData($key, $val);
        }
    }

    /**
     * Get a arbitrary response object value.
     *
     * @return string
     */
    public function get($key)
    {
        return $this->getData($key);
    }

    /**
     * Get the response status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->getData('status');
    }

    /**
     * Returns true if the request failed.
     *
     * @return bool
     */
    public function isError()
    {
        return !$this->isSuccess();
    }

    /**
     * Returns true if the request was successful.
     *
     * @return bool
     */
    public function isSuccess()
    {
        return $this->getData('error_code') == 0;
    }
}
