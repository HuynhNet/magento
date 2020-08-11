<?php
class Namespace_Mymodule_HelloController extends Mage_Core_Controller_Front_Action{

    public function helloworldAction(){
        $this->loadLayout(); /* this is a methods of class Class Mage_Core_Controller_Varien_Action */
        $this->renderLayout(); /* this is a methods of class Class Mage_Core_Controller_Varien_Action */
    }

    public function testparameterAction(){
        $tamp = $this->getRequest()->getParam('name','abc');  /*getRequest is a methods of  class Mage_Core_Controller_Varien_Action*/
        var_dump($tamp);die;
    }

    public function testUrlAction(){
        $currentUrl = Mage::helper('core/url')->getCurrentUrl();
        $baseUrl = Mage::getBaseUrl();  /*this is a methods of class Mage_Core_Controller_Request_Http*/
        $actionUrl = Mage::getUrl("mymodule/test/testUrl", [a,b,c]);
        $skinUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
        $mediaUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
        $jsUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_JS);
        $storeUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);

        var_dump('Current Url:'.$currentUrl.'<br>');
        var_dump('Base Url:'.$baseUrl.'<br>');
        var_dump('Action Url:'.$actionUrl.'<br>');
        var_dump('Skin Url:'.$skinUrl.'<br>');
        var_dump('Media Url: '.$mediaUrl.'<br>');
        var_dump('Js Url: '.$jsUrl.'<br>');
        var_dump('Store Url'.$storeUrl.'<br>');
    }

    public function requestdetailAction(){
        $routerName = Mage::app()->getRequest()->getRouteName();
        $moduleName = Mage::app()->getRequest()->getModuleName();
        $controllerName = Mage::app()->getRequest()->getControllerName();
        $actionName = Mage::app()->getRequest()->getActionName();

        var_dump('router name:'.$routerName);
        var_dump('module name:'.$moduleName);
        var_dump('controller name:'.$controllerName);
        var_dump('action name:'.$actionName);
    }

    public function testModelAction(){
        $collection = Mage::getModel('mymodule/mymodel')->getCollection();
        $collection1 = Mage::getModel('mymodule/mymodel')->getCollection();
        $collection2 = Mage::getModel('mymodule/mymodel')->getCollection();
        $queryString = $collection->getSelect()->__toString();

        /*filter is null*/
        $isNull = $collection->addFieldToFilter('title', array('null' => true))->getSelect()->__toString();

        /*filter is notNull*/
        $notNull = $collection1->addFieldToFilter('title', array('notnull' => true))->getSelect()->__toString();

        /*filter A or B*/
        $AorB = $collection2->addFieldToFilter(
            array('id', 'title'),
            array(
                array('null' => true),
                array('lteq' => 100)
            )
        )->getSelect()->__toString();

        var_dump($queryString.'<br>');
        var_dump('Filter is null: '.$isNull.'<br>');
        var_dump('Filter is notNull: '.$notNull.'<br>');
        var_dump('A or B: '.$AorB.'<br>');
    }

    public function filterAnEAVAction(){
        $product = Mage::getModel('catalog/product');

        $eavCollection = $product->getCollection();
        $eavCollection1 = $product->getCollection();
        $eavCollection2 = $product->getCollection();
        $eavCollection3 = $product->getCollection();
        $eavCollection4 = $product->getCollection();
        $eavCollection5 = $product->getCollection();
        $eavCollection6 = $product->getCollection();

        $query = $eavCollection->getSelect()->__toString();

        /*filter null*/
        $isNull = $eavCollection->addAttributeToFilter('entity_id', array('null' => true), "left")->getSelect()->__toString();

        /*filetr for date*/
        $startDate = '2020-07-30 09:36:52';
        $endDate = '2020-08-05 09:36:52';

        $filterDate = $eavCollection1->addAttributeToFilter('created_at', array(
            'or' => array(
                0 => array('date' => true, 'from' => $startDate, 'to' => $endDate),
                1 => array('is' => new Zend_DB_Expr('null'))
            )
        ),'left')->getSelect()->__toString();


        /*filter A or B same field*/
        $AorBSameField = $eavCollection2->addAttributeToFilter('entity_id', array('eq' => '0', 'null' => true), 'left')->getSelect()->__toString();

        /*filter A or B different field*/
        $AorBDiffirentField = $eavCollection3->addAttributeToFilter(
            array(
                array('attribute' => 'entity_id', 'eq' => '1'),
                array('attribute' => 'entity_type_id', 'null' => true)
            )
        )->getSelect()->__toString();

        /*filter A or (B and C)*/
        /*$filter = $eavCollection4->addAttributeToFilter('entity_id', array('like' => '1'));*/

        /*array(
            array('attribute' => 'entity_type_id', 'like' => '1'),
            array('attribute' => 'sku', 'like' => '20')
        )*/

        $filter = $eavCollection4->getSelect()
            ->where("entity_id gt '1' ")
            ->orWhere("entity_id LIKE '2' AND sku LIKE 'b'")->__toString();

//        $filter = $eavCollection4->addAttributeToFilter(
//            array(
//                array('attribute' => 'entity_id', 'like' => '1'),
//                array('attribute' => 'entity_type_id', 'like' => '1')
//            )
//        )->getSelect()->__toString();




        /*flter (A and B) or (C and D)*/
        /*$filter1 = $eavCollection5->addAttributeToFilter(
            array(
                array(
                    array('attribute'=> 'entity_id','like' => '1'),
                    array('attribute'=> 'entity_type_id','like' => '2'),
                ),
                array(
                    array('attribute'=> 'sku','like' => '20'),
                    array('attribute'=> 'type_id','like' => '3'),
                )
            )
        )->getSelect()->__toString();*/
        $filter1 = $eavCollection5->getSelect()
            ->where(" entity_id LIKE '2' AND entity_type_id LIKE '1' ")
            ->orWhere("sku LIKE '20' AND type_id LIKE '10' ")->__toString();

        /*filter A and (B or C)*/
        /*$filter2 = $eavCollection6->addAttributeToFilter('entity_id', array('eq' => 1));
        $filter2 = $eavCollection6->addAttributeToFilter(
                    array(
                        array('entity_type_id'=> 'field_2','like' => '2'),
                        array('attribute'=> 'sku','like' => '20'),
                    )
                );*/

        var_dump('collection: '.$query.'<br>');
        var_dump('filter null: '.$isNull.'<br>');
        var_dump('filter date: '.$filterDate.'<br>');
        var_dump('filter A or B same field: '.$AorBSameField.'<br>');
        var_dump('filter A or B diffirent field: '.$AorBDiffirentField.'<br>');
        var_dump('filter A or (B and C): '.$filter.'<br>');
        var_dump('filter (A and B) or (C and D): '.$filter1.'<br>');
        /*var_dump('filter A and (B or C): '.$filter2.'<br>');*/
    }

    public function createblockACtion(){
        $block = $this->getLayout()->createBlock('mymodule/test_helloworld');
        $block->setTemplate('mymodule/test.phtml');
        $block->setData('data', abc);
        $html = $block->renderView();
        $response = array('status' => 1, 'data' => $html, 'code' => 200, 'message' => '');
        $json = Mage::helper('core')->jsonEncode($response);
        $this->getResponse()->setBody($json);
    }


    public function timezoneAction(){
        /*any custom format*/
        $server_date = '2019-10-10 23:12:13';
        $store_timestamp = Mage::getModel('core/date')->timestamp(strtotime($server_date));
        $store_date = date('Y-m-d H:i:s', $store_timestamp);

        /*Quick (4 types: full, long, medium, short)*/
        $store_date_full = Mage::helper('core')->formatDate($server_date, Mage_Core_Model_Locale::FORMAT_TYPE_FULL);
        $store_date_long = Mage::helper('core')->formatDate($server_date, Mage_Core_Model_Locale::FORMAT_TYPE_LONG);
        $store_date_medium = Mage::helper('core')->formatDate($server_date, Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
        $store_date_short = Mage::helper('core')->formatDate($server_date, Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);

        /*Specific store*/
        $store_date_obj = Mage::app()->getLocale()->storeDate(
            Mage::app()->getStore(),
            $server_date,
            true
        );
        $store_date_specific = $store_date_obj->get('YYYY-MM-d HH:mm:ss');

        /*Store Time to Server Time*/
        $store_date_test = '2019-10-10 23:12:13';
        $server_date_obj = Mage::app()->getLocale()->utcDate(
            Mage::app()->getStore(),
            $store_date_test,
            true
        );
        $server_date_result = $server_date_obj->get('YYYY-MM-d HH:mm:ss');

        var_dump('custom format: '.$store_date.'<p>');
        var_dump('full format: '.$store_date_full.'<br>');
        var_dump('long format: '.$store_date_long.'<br>');
        var_dump('medium format: '.$store_date_medium.'<br>');
        var_dump('short format: '.$store_date_short.'<br>');
        var_dump('specific format: '.$store_date_specific.'<br>');
        var_dump('Store Time to Server Time: '.$server_date_result.'<br>');
    }


}