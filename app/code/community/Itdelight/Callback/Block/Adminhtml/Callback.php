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
class Itdelight_Callback_Block_Adminhtml_Callback extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Itdelight_Callback_Block_Adminhtml_Callback constructor.
     */
    public function __construct()
    {
        $this->_blockGroup = 'itdelight_callback';
        $this->_controller = 'adminhtml_callback';
        $this->_headerText = Mage::helper('itdelight_callback')->__('Itdelight - Callbacks');

        parent::__construct();
    }
}