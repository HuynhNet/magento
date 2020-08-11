<?php
class Namespace_Mymodule_Model_Resource_Mymodel extends Mage_Core_Model_Resource_Db_Abstract{
    protected function _construct(){
        $this->_init('mymodule/mymodel','id');
    }
}