<?php


class Itdelight_Callback_Model_Callback_Api extends Mage_Api_Model_Resource_Abstract
{

    /**
     * Get items of callbacks' model with filter
     *
     * @param $filters array
     * @return array
     */
    public function items($filters = null)
    {
        $collection = Mage::getModel('itdelight_callback/callback')->getCollection();

        $apiHelper = Mage::helper('api');
        $filters = $apiHelper->parseFilters($filters);

        try {
            foreach ($filters as $field => $value) {
                $collection->addFieldToFilter($field, $value);
            }
        } catch (Itdelight_Callback_Exception $e) {
            $this->_fault('filters_invalid', $e->getMessage());
        }

        $result = array();
        foreach ($collection as $callback) {
            $result[] = $callback->toArray(array());
        }

        return $result;
    }

    /**
     * Get callback entity with id
     *
     * @param $callbackId
     * @return array
     */
    public function info($callbackId)
    {
        $callback = Mage::getModel('itdelight_callback/callback')->load($callbackId);
        if (!$callback->getId()) {
            $this->_fault('not_exists');
        }
        return $callback->toArray();
    }

    /**
     * Update callback's 'status', date when 'called' and 'comment' by id
     *
     * @param $callbackData
     * @return bool
     */
    public function update($callbackId, $callbackData)
    {
        $callback = Mage::getModel('itdelight_callback/callback')->load($callbackId);

        if (!$callback->getId()) {
            $this->_fault('not_exists');
        }

        if (gettype($callbackData) == "object") {
            $callbackData =  (array) $callbackData;
        }

        $data_status = $callbackData['status'];
        $data_comment = $callbackData['comment'];
        $data_called = $callbackData['called'];

         try {
             $callback->addData(array('status'  => $data_status,
                 'comment' => $data_comment,
                 'called'  => $data_called,
             ));
//        $callback->addData($callbackData);
             $callback->save();
         } catch (Itdelight_Callback_Exception $e) {
             $this->_fault('not_saved', $e->getMessage());
         }

         return true;
    }
}