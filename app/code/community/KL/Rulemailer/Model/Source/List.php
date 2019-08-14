<?php
class KL_Rulemailer_Model_Source_List extends KL_Rulemailer_Model_Abstract
{
    /**
     * Get an option array representation of all lists.
     *
     * @return array
     */
    public function toOptionArray()
    {
        $lists = array();

        try {
            foreach ($this->getLists() as $list) {
                array_push(
                    $lists,
                    array('value' => $list->id, 'label' => $list->name)
                );
            }
        } catch (InvalidArgumentException $e) {}

        return $lists;
    }

    /**
     * Get all lists.
     *
     * @return KL_Rulemailer_Model_Api_Response
     */
    private function getLists()
    {
        return Mage::getSingleton('rulemailer/api_lists')->get()->get('lists');
    }
}
