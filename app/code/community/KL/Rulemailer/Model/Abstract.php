<?php
class KL_Rulemailer_Model_Abstract extends Mage_Core_Model_Abstract
{
    protected function getConfig($key)
    {
        return Mage::getSingleton('rulemailer/config')->get($key);
    }
}
