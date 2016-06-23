<?php

class Learning_Domaine_Block_Adminhtml_Domaine extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller     = 'adminhtml_domaine';
        $this->_blockGroup     = 'learning_domaine';
        $this->_headerText     = Mage::helper('learning_domaine')->__('Manage Domaines');
        $this->_addButtonLabel = Mage::helper('learning_domaine')->__('Add Domaine');
        parent::__construct();
    }
}