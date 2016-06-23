<?php

class Learning_Domaine_Adminhtml_Domaine_DomaineController extends Mage_Adminhtml_Controller_Action
{

    /**
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        return $this->loadLayout()->_setActiveMenu('learning_domaine');
    }

    /**
     * @return Mage_Core_Controller_Varien_Action
     */
    public function indexAction()
    {
        return $this->_initAction()->renderLayout();
    }

    /**
         * @return $this|Mage_Core_Controller_Varien_Action
         */
        public function editAction()
        {
            $id = $this->getRequest()->getParam('id');
            /** @var Learning_Domaine_Model_Ddomaine $domaine */
            $domaine = Mage::getModel('learning_domaine/domaine')->load($id);

            if ($domaine->getId() || $id == 0) {

                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if (!empty($data)) {
                    $domaine->setData($data);
                }
                Mage::register('domaine_data', $domaine);

                return $this->_initAction()->renderLayout();
            }

            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('learning_domaine')->__('Domaine does not exist'));

            return $this->_redirect('*/*/');
        }

        /**
         * @return $this|Mage_Core_Controller_Varien_Action
         */
        public function saveAction()
        {
            if ($data = $this->getRequest()->getPost()) {

                $delete = (!isset($data['image_url']['delete']) || $data['image_url']['delete'] != '1') ? false : true;
                $data['image_url'] = $this->_saveImage('image_url', $delete);

                /** @var Learning_Domaine_Model_Domaine $domaine */
                $domaine = Mage::getModel('learning_domaine/domaine');

                if ($id = $this->getRequest()->getParam('id')) {
                    $domaine->load($id);
                }

                try {
                    $domaine->addData($data);
                    $domaine->save();

                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_domaine')->__('The domaine has been saved.'));
                    Mage::getSingleton('adminhtml/session')->setFormData(false);

                    if ($this->getRequest()->getParam('back')) {
                        $this->_redirect('*/*/edit', array(
                            'id'       => $domaine->getId(),
                            '_current' => true
                        ));

                        return;
                    }

                    $this->_redirect('*/*/');

                    return;
                } catch (Mage_Core_Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                } catch (Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                    $this->_getSession()->addException($e, Mage::helper('learning_domaine')->__('An error occurred while saving the domaine.'));
                }

                $this->_getSession()->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));

                return;
            }
            $this->_redirect('*/*/');
        }

        /**
         * @return $this|Mage_Core_Controller_Varien_Action
         */
        public function deleteAction()
        {
            if ($id = $this->getRequest()->getParam('id')) {
                try {
                    /** @var Learning_Domaine_Model_Domaine $domaine */
                    $domaine = Mage::getModel('learning_domaine/domaine');
                    $domaine->load($id)->delete();

                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_domaine')->__('Domaine was successfully deleted'));
                    $this->_redirect('*/*/');

                    return;
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

                    return;
                }
            }

            return $this->_redirect('*/*/');
        }

        /**
         * @return $this|Mage_Core_Controller_Varien_Action
         */
        public function massDeleteAction()
        {
            $domaineIds = $this->getRequest()->getParam('domaine');
            if (!is_array($domaineIds)) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('learning_domaine')->__('Please select domaine(s)'));
            } else {
                try {
                    foreach ($domaineIds as $domaine) {
                        Mage::getModel('learning_domaine/domaine')->load($domaine)->delete();
                    }
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_domaine')->__('Total of %d domaine(s) were successfully deleted', count($domaineIds)));
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }
            }

            return $this->_redirect('*/*/index');
        }

        /**
         * @return $this|Mage_Core_Controller_Varien_Action
         */
        public function massStatusAction()
        {
            $domaineIds = $this->getRequest()->getParam('domaine');
            if (!is_array($domaineIds)) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('Please select domaine(s)'));
            } else {
                try {
                    foreach ($domaineIds as $domaine) {
                        Mage::getSingleton('learning_domaine/domaine')->load($domaine)->setIsActive($this->getRequest()->getParam('is_active'))->setIsMassupdate(true)->save();
                    }
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('learning_domaine')->__('Total of %d domaine(s) were successfully updated', count($domaineIds)));
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }
            }

            return $this->_redirect('*/*/index');
        }

        /**
         * @return $this
         */
        public function newAction()
        {
            $this->_forward('edit');

            return $this;
        }

        /**
         *
         */
        protected function _saveImage($imageAttr, $delete)
        {
            if ($delete) {
                $image = '';
            } elseif (isset($_FILES[$imageAttr]['name']) && $_FILES[$imageAttr]['name'] != '') {
                try {
                    $uploader = new Varien_File_Uploader($imageAttr);
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'png'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $path = Mage::getBaseDir('media') . DS . 'domaine' . DS;
                    $uploader->save($path, $_FILES[$imageAttr]['name']);
                    $image = $_FILES[$imageAttr]['name'];
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    return $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                }
            } else {
                $model = Mage::getModel('learning_domaine')->load($this->getRequest()->getParam('id'));
                $image = $model->getData($imageAttr);
            }
            return $image;
        }
}
