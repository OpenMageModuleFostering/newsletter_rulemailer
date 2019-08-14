<?php
class KL_Rulemailer_Model_Api_Lists extends KL_Rulemailer_Model_Api
{
    public function get()
    {
        return $this->request('listsGet');
    }
}
