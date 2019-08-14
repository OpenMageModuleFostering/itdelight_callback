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
class Itdelight_Callback_AjaxController extends Mage_Core_Controller_Front_Action
{
    /**
     * Save form data
     */
    public function indexAction()
    {
        $post = $this->getRequest()->getPost();
        $helper = Mage::helper('itdelight_callback');
        if ($post) {
            try {
                $postObject = new Varien_Object();
                $postObject->setData($post);
                $errorMessageShown = array();
                $response = array();

                $errorMessage = array(
                    'name'       => 'Name',
                    'tel_number' => 'Phone Number',
                );

                $error = false;

                foreach ($post as $key => $item) {
                    if ($key == 'name') {
                        if (!Zend_Validate::is(trim($item), 'NotEmpty')) {
                            $error = true;
                            $errorMessageShown[] = $helper->__('Please fill in ' . $errorMessage[$key] . ' field');
                        }
                    }

                    if ($key == 'tel_number') {
                        $validator = new Zend_Validate_Regex("/^[-0-9 ()]*$/");
                        if (!($validator->isValid($item)) || !Zend_Validate::is(trim($item), 'NotEmpty')) {
                            $error = true;
                            $errorMessageShown[] = 'Please fill in ' . $errorMessage[$key] . ' field properly';
                        }
                    }
                }

                if ($error == true) {
                    throw new Itdelight_Callback_Exception();
                }

                $response['status']  = $helper->__('SUCCESS');
                $response['message'] = $helper->__('Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.');
                $this->getResponse()->clearHeaders()->setHeader('Content-type','application/json',true);
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
                $myFormModel = Mage::getModel('itdelight_callback/callback');
                $myFormModel->setData($post)->save();

                return;

            } catch (Itdelight_Callback_Exception $e) {
                $response['status']  = $helper->__('ERROR');
                $response['message'] = $errorMessageShown;
                $this->getResponse()->clearHeaders()->setHeader('Content-type','application/json',true);
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));

                return;
            }
        }
    }
}