<?php

class Learning_Domaine_Block_Domaine extends Mage_Core_Block_Template
{
    public function getDomaines()
    {
		$domaines = Mage::getModel('learning_domaine/domaine')
        	->getCollection()
        	->addIsActiveFilter()
        	->addOrderByPosition();
        return $domaines;
    }
}
