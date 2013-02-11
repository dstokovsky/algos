<?php

class MedianSort extends AbstractSort{
    
    private function _medianSort( $left, $right ){
        
    }
    
    public function execute( $order = ISort::ORDER_ASC ) {
        $this->_medianSort( 0, count( $this->getList() ) - 1 );
        $this->markListAsSorted();
    }
}
?>
