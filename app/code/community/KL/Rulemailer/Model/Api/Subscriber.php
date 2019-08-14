<?php

class KL_Rulemailer_Model_Api_Subscriber extends KL_Rulemailer_Model_Api
{
    private function prepareCustomFields($fields = array())
    {
        // Don't bother the API if the field list is empty
        if (count($fields) <= 0) {
            return $fields;
        }

        // Fetch Custom Fields API
        $apiFields = Mage::getSingleton('rulemailer/api_list_custom_fields')->get()->getData();

        if (isset($apiFields['custom_fields'])) {
            $apiFields = $apiFields['custom_fields'];
        } else {
            $apiFields = array();
        }

        // Setup return data
        $return = array();

        // Check what data we can add
        foreach ($apiFields as $field) {
            if (isset($fields[$field->name])) {
                $return[] = array(
                    'id' => $field->id,
                    'value' => $fields[$field->name]
                );
            }
        }

        return $return;
    }

    public function delete($email)
    {
        return $this->request('subscriberDelete', $email);
    }

    public function get($email)
    {
        return $this->request('subscriberGet', $email);
    }

    public function subscribe($email, $customFields = array())
    {
        return $this->request('subscriberSubscribe', $email, $this->prepareCustomFields($customFields));
    }

    public function unsubscribe($email)
    {
        return $this->request('subscriberUnsubscribe', $email);
    }

    public function update($email, $fields)
    {
        return $this->request('subscriberUpdate', $email, $this->prepareCustomFields($fields));
    }

    protected function request()
    {
        $func_args = func_get_args();

        $args = Mage::getModel('rulemailer/array', $func_args);

        $args->insert($this->getConfig('list_id'), 1);

        if ($this->getHelper()->isOldPhpVersion()) {
            $parent_class = get_parent_class($this);
            return call_user_func_array(array($parent_class, 'request'), $args->toArray());
        } else {
            return call_user_func_array('parent::request', $args->toArray());
        }
    }
}
