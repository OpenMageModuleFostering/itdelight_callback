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
class Itdelight_Callback_Block_Adminhtml_Callback_Edit_Tabs_General extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $helper = Mage::helper('itdelight_callback');
        $model  = Mage::registry('current_callback');

        $form     = new Varien_Data_Form();
        $fieldset = $form->addFieldset('callback_form', array('legend' => $helper->__('Callback Information')));

        $fieldset->addField('name', 'text', array(
            'label'    => $helper->__('Name'),
            'required' => true,
            'name'     => 'name',
        ));

        $fieldset->addField('tel_number', 'text', array(
            'label'    => $helper->__('Telephone number'),
            'required' => true,
            'name'     => 'tel_number',
        ));

        $fieldset->addField('status', 'select', array(
            'label'    => $helper->__('Already called'),
            'name'     => 'status',
            'type'     => 'options',
            'options'  => Mage::getModel('adminhtml/System_Config_Source_Yesno')->toArray(),

        ));

        $fieldset->addField('called', 'date', array(
            'format'   => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'label'    => $helper->__('Called'),
            'image'    => $this->getSkinUrl('images/grid-cal.gif'),
            'name'     => 'called',
        ));

        $fieldset->addField('comment', 'textarea', array(
            'label'    => $helper->__('Comment'),
            'required' => false,
            'name'     => 'comment',
        ));

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }
}