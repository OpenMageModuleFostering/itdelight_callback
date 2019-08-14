<?php
/**
 * @author     ItDelight Team
 * @contact    info@itdelight.com
 * @category   frontend_controller
 * @package    Itdelight_Callback
 * @site       https://itdelight.com/
 * @copyright  Copyright (c) 2016 Itdelight Callback
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * Class       Itdelight_Callback_AjaxController
 */

class Itdelight_Callback_Adminhtml_Callback_CallbackController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('customer/itdelight_callback');

        $contentBlock = $this->getLayout()->createBlock('itdelight_callback/adminhtml_callback');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('id');
        $model = Mage::getModel('itdelight_callback/callback');
//        Mage::register('current_callback', Mage::getModel('testcallback/callback')->load($id));
        if ($data = Mage::getSingleton('adminhtml/session')->getFormData()){
            $model->setData($data)->setId($id);
        } else {
            $model->load($id);
        }
        Mage::register('current_callback', $model);

        $this->loadLayout()->_setActiveMenu('customer/itdelight_callback');
        $this->_addLeft($this->getLayout()->createBlock('itdelight_callback/adminhtml_callback_edit_tabs'));
        $this->_addContent($this->getLayout()->createBlock('itdelight_callback/adminhtml_callback_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('itdelight_callback/callback');
                $model->setData($data)->setId($this->getRequest()->getParam('id'));
//                if(!$model->getCreated()){
//                    $model->setCreated(now());
//                }
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Callback was saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Itdelight_Callback_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('itdelight_callback/callback')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Callback was deleted successfully'));
            } catch (Itdelight_Callback_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('itdelight_callback/adminhtml_callback_grid')->toHtml()
        );
    }

    public function exportCsvAction()
    {
        $fileName = 'callbacks.csv';
        $grid = $this->getLayout()->createBlock('itdelight_callback/adminhtml_callback_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

//    public function exportTestExcelAction()
//    {
//        $fileName = 'callbacks.xml';
//        $grid = $this->getLayout()->createBlock('testcallback/adminhtml_callback_grid');
//        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
//    }

    public function massDeleteAction()
    {
        $callback = $this->getRequest()->getParam('callback', null);

        if (is_array($callback) && sizeof($callback) > 0 ) {
            try {
                foreach ($callback as $id) {
                    Mage::getModel('itdelight_callback/callback')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d callbacks have been deleted', sizeof($callback)));
            } catch (Itdelight_Callback_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select callbacks'));
        }
        $this->_redirect('*/*');
    }

    public function massCalledAction()
    {
        $callback = $this->getRequest()->getParam('callback', null);

        if (is_array($callback) && sizeof($callback) > 0 ) {
            try {
                $model = Mage::getModel('itdelight_callback/callback');
                foreach ($callback as $id) {
                    $model->load($id)
                          ->setStatus($this->getRequest()->getParam('status'))
                          ->setIsMassupdate(true)
                          ->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d callbacks have been updated', sizeof($callback)));
            } catch (Itdelight_Callback_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select callbacks'));
        }
        $this->_redirect('*/*');
    }

}