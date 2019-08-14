<?php


class Itdelight_Callback_Model_Api2_Callback_Rest_Admin_V1 extends Mage_Api2_Model_Resource
{
    protected function _loadCallbackById($id)
    {
        /** @var $customer Mage_Customer_Model_Customer */
        $callback = Mage::getModel('itdelight_callback/callback')->load($id);
        if (!$callback->getId()) {
            $this->_critical(self::RESOURCE_NOT_FOUND);
        }
        return $callback;
    }

    /**
     * Update 'callback' entity
     * @param array $data
     * @return bool
     */
    protected function _update(array $data)
    {
        $callback = $this->_loadCallbackById($this->getRequest()->getParam('callback_id'));
        $data_status = $data['status'];
        $data_comment = $data['comment'];
        $data_called = $data['called'];
        $callback->addData(array('status'  => $data_status,
            'comment' => $data_comment,
            'called'  => $data_called,
        ));

        try {
            $callback->save();
            return true;
        } catch (Itdelight_Callback_Exception $e) {
            $this->_error($e->getMessage(), Mage_Api2_Model_Server::HTTP_INTERNAL_ERROR);
        }
        catch (Itdelight_Callback_Exception $e) {
            $this->_critical(self::RESOURCE_INTERNAL_ERROR);
        }
    }

    /**
     * Retrieve a callback by ID
     * @return array
     */
    public function _retrieve()
    {
        $callback = Mage::getModel('itdelight_callback/callback')
            ->loadByCallback($this->getRequest()->getParam('callback_id'));
        return $callback->toArray();
    }

    /**
     * Retrieve a list of callbacks
     * @return mixed
     */
    public function _retrieveCollection()
    {
        $collection = Mage::getResourceModel('itdelight_callback/callback_collection');
        $this->_applyCollectionModifiers($collection);
        $data = $collection->load()->toArray();
        return $data['items'];
    }

}