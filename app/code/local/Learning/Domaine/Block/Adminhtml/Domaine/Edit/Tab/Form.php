<?php

class Learning_Domaine_Block_Adminhtml_Domaine_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('domaine_form', array('legend' => Mage::helper('learning_domaine')->__('Domaine information')));

        $fieldset->addType('image', 'Learning_Domaine_Block_Adminhtml_Form_Renderer_Image');

        $fieldset->addField('name', 'text', array(
            'label'    => Mage::helper('learning_domaine')->__('Name'),
            'name'         => 'name',
            'class'    => 'required-entry',
            'required' => true
        ));

        $fieldset->addField('image_url', 'image', array(
            'label'     => Mage::helper('learning_domaine')->__('Image'),
            'required'  => false,
            'name'      => 'image_url',
            'directory' => 'domaine/'
        ));

        $fieldset->addField('is_active', 'select', array(
            'label'    => Mage::helper('learning_domaine')->__('Status'),
            'name'     => 'is_active',
            'class'    => 'required-entry',
            'values'   => Mage::getSingleton('adminhtml/system_config_source_enabledisable')->toOptionArray(),
            'required' => true
        ));

        $fieldset->addField('position', 'text', array(
            'label'    => Mage::helper('learning_domaine')->__('Position'),
            'class'    => 'validate-number',
            'name'     => 'position',
            'required' => true,
            'value'    => 0
        ));

        if (Mage::getSingleton('adminhtml/session')->getDomaineData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getDomaineData());
            Mage::getSingleton('adminhtml/session')->getDomaineData(null);
        } elseif (Mage::registry('domaine_data')) {
            $form->setValues(Mage::registry('domaine_data')->getData());
        }

        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return Mage::helper('learning_domaine')->__('Domaine Information');
    }

    public function getTabTitle()
    {
        return Mage::helper('learning_domaine')->__('Domaine Information');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}