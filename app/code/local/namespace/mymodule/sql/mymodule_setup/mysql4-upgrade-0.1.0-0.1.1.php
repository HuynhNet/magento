<?php

/* @var $setup Mage_Eav_Model_Entity_Setup */

echo 'Running installation for: '.get_class($this)."\n <br /> \n";
//die("Exit for now");

$installer = $this;
$installer->startSetup();

$installer->run("ALTER TABLE `table_example` ADD `description` VARCHAR( 255 ) NOT NULL AFTER `title`");

$installer->endSetup();