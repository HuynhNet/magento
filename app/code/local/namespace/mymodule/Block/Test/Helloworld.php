<?php
class Namespace_Mymodule_Block_Test_Helloworld extends Mage_Core_Block_Template{
    private $name;
    protected function _prepareLayout(){
        parent::_prepareLayout();
        $this->name = "Huynh Mi Net";
    }

    public function getName(){
        return $this->name;
    }
}