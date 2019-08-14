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
class Itdelight_Callback_Block_Adminhtml_Callback_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Itdelight_Callback_Block_Adminhtml_Callback_Edit_Tabs constructor.
     */
    public function __construct()
    {
        $helper = Mage::helper('itdelight_callback');

        parent::__construct();
        $this->setId('callback_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($helper->__('Callback information'));
    }

    /**
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
        $helper = Mage::helper('itdelight_callback');

        $this->addTab('general_section', array(
            'label'   => $helper->__('Callback Information'),
            'title'   => $helper->__('Callback Information'),
            'content' => $this->getLayout()->createBlock('itdelight_callback/adminhtml_callback_edit_tabs_general')
                              ->toHtml(),
        ));
        return parent::_prepareLayout();
    }

}