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
class Itdelight_Callback_Block_Adminhtml_Callback_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getUrl('*/*/save', array(
                'id'  => $this->getRequest()->getParam('id')
            )),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}