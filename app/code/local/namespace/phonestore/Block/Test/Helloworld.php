<?php
class Namespace_Phonestore_Block_Test_Helloworld extends Mage_Core_Block_Template{

    private $name;
    protected function _prepareLayout(){
        parent::_prepareLayout();
        $this->name = "This is a themes of store view ban dien thoai";
    }


    public function getContent(){
        return $this->name;
    }

    public function getHome(){
        return 'day la trang home';
    }
//    protected function _toHtml(){
//        $searchCollection = Mage::getModel('catalogsearch/query')
//            ->getResourceCollection()
//            ->setOrder('popularity', 'desc');
//        $searchCollection->getSelect()->limit(3,0);
//
//        $html  = '<div id="widget-topsearches-container">' ;
//        $html .= '<div class="widget-topsearches-title">Top Searches</div>';
//
//        foreach($searchCollection as $search){
//            $html .= '<div class="widget-topsearches-searchtext">' . $search->query_text . "</div>";
//        }
//        $html .= "</div>";
//        return $html;
//    }


}