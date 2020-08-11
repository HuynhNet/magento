<?php
class Namespace_Phonestore_TestController extends Mage_Core_Controller_Front_Action{

    public function helloworldAction(){
//        $store = Mage::app()->getStore();
//        var_dump($store->getCode());die;
        $this->loadLayout(); /* this is a methods of class Class Mage_Core_Controller_Varien_Action */
        $this->renderLayout(); /* this is a methods of class Class Mage_Core_Controller_Varien_Action */
    }

}