<?php
/**
 * Itdelight Callback
 *
 * @author     ItDelight Team
 * @contact    info@itdelight.com
 * @category   module configuration
 * @package    Itdelight_Callback
 * @site       https://itdelight.com/
 * @copyright  Copyright (c) 2016 Itdelight Callback
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Itdelight_Callback_Block_Adminhtml_Callback_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Itdelight_Callback_Block_Adminhtml_Callback_Edit constructor.
     */
    protected function _construct()
    {
        $this->_blockGroup = 'itdelight_callback';
        $this->_controller = 'adminhtml_callback';
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        $helper = Mage::helper('itdelight_callback');
        $model  = Mage::registry('current_callback');

        if ($model->getId()) {
            return $helper->__("Edit Callback item ");
        } else {
            return $helper->__('Add Callback item');
        }
    }

}