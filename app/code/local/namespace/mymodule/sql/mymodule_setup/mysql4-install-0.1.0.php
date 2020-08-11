<?php

/* @var $setup Mage_Eav_Model_Entity_Setup */

echo 'Running installation for: '.get_class($this)."\n <br /> \n";
//die("Exit for now");

$installer = $this;
$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS {$this->getTable('table_example')};
CREATE TABLE {$this->getTable('table_example')} (
	 `id` int(11) unsigned NOT NULL auto_increment,  
	 `title` varchar(255) NOT NULL default '',  	
	 `created_time` datetime default NULL,                         
	 `update_time` datetime default NULL,
	 PRIMARY KEY  (`id`)                             
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

$installer->endSetup();