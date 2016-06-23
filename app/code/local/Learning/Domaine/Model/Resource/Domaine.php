<?php

class Learning_Domaine_Model_Resource_Domaine extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * Magento class constructor
     */
    protected function _construct()
    {
        $this->_init('learning_domaine/domaine', 'entity_id');
    }

}
