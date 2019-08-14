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
class Itdelight_Callback_Block_Adminhtml_Callback_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * @return string
     */
    protected function _getCollectionClass()
    {
        return 'itdelight_callback/callback_collection';
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);

        return parent::_prepareCollection();

    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {
        $helper = Mage::helper('itdelight_callback');

        $this->addColumn('callback_id', array(
            'header'  => $helper->__('Callback ID'),
            'index'   => 'callback_id',
        ));

        $this->addColumn('name', array(
            'header'  => $helper->__('Client\'s Name'),
            'index'   => 'name',
            'type'    => 'text',
        ));

        $this->addColumn('tel_number', array(
            'header'  => $helper->__('Telephone'),
            'index'   => 'tel_number',
            'type'    => 'text',
        ));

        $this->addColumn('message', array(
            'header'  => $helper->__('Message'),
            'index'   => 'message',
            'type'    => 'text',
        ));

        $this->addColumn('created', array(
            'header'  => $helper->__('Created'),
            'index'   => 'created',
            'type'    => 'date',
        ));

        $this->addColumn('status', array(
            'header'  => $helper->__('Already called'),
            'index'   => 'status',
            'type'    => 'options',
            'options' => Mage::getModel('adminhtml/System_Config_Source_Yesno')->toArray(),

        ));

        $this->addColumn('called', array(
            'header'  => $helper->__('Called'),
            'index'   => 'called',
            'type'    => 'date',
        ));

        $this->addColumn('comment', array(
            'header'  => $helper->__('Comment'),
            'type'    => 'text',
            'index'   => 'comment',
        ));

        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('itdelight_callback')->__('Action'),
                'width'     => '70',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('itdelight_callback')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'is_system' => true,
            ));

        $this->addExportType('*/*/exportCsv', Mage::helper('customer')->__('CSV'));


        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('callback_id');
        $this->getMassactionBlock()->setFormFieldName('callback');

        $statuses = Mage::getModel('adminhtml/System_Config_Source_Yesno')->toOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));

        $this->getMassactionBlock()
            ->addItem('delete', array(
                'label' => $this->__('Delete'),
                'url' => $this->getUrl('*/*/massDelete'),
            ))
            ->addItem('called', array(
                'label' => $this->__('Called'),
                'url' => $this->getUrl('*/*/massCalled'),
                'additional' => array(
                    'visibility' => array(
                        'name'   => 'status',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => Mage::helper('itdelight_callback')->__('Status'),
                        'values' => $statuses
                    )
                )
            ));

        return $this;
    }

    /**
     * @param $model
     * @return string
     */
    public function getRowUrl($model)
    {
        return $this->getUrl('*/*/edit', array(
            'id' => $model->getId(),
        ));
    }

}