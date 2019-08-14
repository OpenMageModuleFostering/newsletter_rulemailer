<?php
class KL_Rulemailer_Model_Api_List_Custom_Fields extends KL_Rulemailer_Model_Api
{
    /**
     * Get all custom fields for the predefined list.
     *
     * @see KL_Rulemailer_Model_Api::request()
     * @return mixed
     */
    public function get()
    {
        return $this->request('listCustomFieldsGet');
    }

    /**
     * Create a new custom field for the predefined list.
     *
     * @see KL_Rulemailer_Model_Api::request()
     * @param string $name The name of the custom field.
     * @param string $type Optional type of the custom field.
     * @param array $presets Presets values for the custom field.
     * @return mixed
     */
    public function create($name, $type = 'Single line', $presets = array())
    {
        return $this->request('listCustomFieldCreate', func_get_args());
    }

    protected function request()
    {
        $args = Mage::getModel('rulemailer/array', func_get_args());

        $args->insert($this->getConfig('list_id'), 1);

        if ($this->getHelper()->isOldPhpVersion()) {
            return call_user_func_array(array($this, 'parent::request'), $args->toArray());
        } else {
            return call_user_func_array('parent::request', $args->toArray());
        }
    }
}
