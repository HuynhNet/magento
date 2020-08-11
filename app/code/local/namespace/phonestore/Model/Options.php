<?php
class Namespace_Phonestore_Model_Options{
    public function toOptionArray(){
        return array(
            array('value' => 'print', 'label' => 'Print Button'),
            array('value' => 'email', 'label' => 'Inquiry Email Button')
        );
    }
}