<?php

class Learning_Domaine_Model_Resource_Domaine_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Magento class constructor
     */
    protected function _construct()
    {
        $this->_init('learning_domaine/domaine');
    }

    /**
     * Filter collection by status
     *
     * @return Learning_Slider_Model_Resource_Slide_Collection
     */
    public function addIsActiveFilter()
    {
        $this->addFieldToFilter('is_active', 1);

        return $this;
    }

    /**
     * Sort order by position
     *
     * @return Learning_Slider_Model_Resource_Slide_Collection
     */
    public function addOrderByPosition($order = Varien_Data_Collection_Db::SORT_ORDER_ASC)
    {
        $this->setOrder('position', $order);

        return $this;
    }

}
