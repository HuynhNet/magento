<?php
class Namespace_Mymodule_Model_Resource_Mymodel_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract{
    protected function _construct(){
        $this->_init('mymodule/mymodel');
    }
}