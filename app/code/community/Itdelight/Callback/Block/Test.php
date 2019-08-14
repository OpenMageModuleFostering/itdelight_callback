<?php

class Itdelight_Callback_Block_Test
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    /**
     * @return string
     */
    protected function _toHtml()
    {
        return parent::_toHtml();
    }

    /**
     * @return mixed
     */
    public function enableModule()
    {
        $configValue = Mage::getStoreConfig('itdelight_callback/options/enable');

        return $configValue;
    }

    /**
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout() {
        if ($head = $this->getLayout()->getBlock('head')) {
            $head->addItem('skin_css', 'css/callback/callback.css');
            $head->addItem('js', 'lib/jquery/jquery-1.10.2.min.js');
            $head->addItem('js', 'lib/jquery/noconflict.js');
            $head->addItem('skin_js', 'js/callback/callback.js');
        }
        return parent::_prepareLayout();
    }

}