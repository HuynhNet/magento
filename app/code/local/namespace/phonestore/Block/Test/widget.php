<?php
class Namespace_Phonestore_Block_Test_Widget extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface{

    protected function _toHtml(){
        $searchCollection = Mage::getModel('catalogsearch/query') /*table catalogsearch/query*/
        ->getResourceCollection()
            ->setOrder('popularity', 'desc');
        $searchCollection->getSelect()->limit(3,0);

        $html  = '<div id="widget-topsearches-container">' ;
        $html .= '<div class="widget-topsearches-title">Top Searches</div>';

        foreach($searchCollection as $search){
            $html .= '<div class="widget-topsearches-searchtext">' . $search->query_text . "</div>";
        }
        $html .= "</div>";
        return $html;
    }

}