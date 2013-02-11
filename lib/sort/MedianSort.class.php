<?php

class MedianSort extends AbstractSort{
    
    private function _partition( $left, $right, $pivot_index ){
        $unsorted_list = $this->getList();
        $pivot_value = $unsorted_list[ $pivot_index ];
        list( $unsorted_list[ $pivot_index ], $unsorted_list[ $right ] ) = 
            array( $unsorted_list[ $right ], $unsorted_list[ $pivot_index ] );
        $store_index = $left;
        for( $index = $left; $index < $right; $index++ ){
            if( $this->isLeftLessOrEqualsToRight( $unsorted_list[ $index ], $pivot_value ) ){
                list( $unsorted_list[ $store_index ], $unsorted_list[ $index ] ) = 
                    array( $unsorted_list[ $index ], $unsorted_list[ $store_index ] );
                $store_index++;
            }
        }
        list( $unsorted_list[ $right ], $unsorted_list[ $store_index ] ) = 
            array( $unsorted_list[ $store_index ], $unsorted_list[ $right ] );
        $this->updateSortedList( $unsorted_list );
        
        return $store_index;
    }
    
    private function _medianSort( $left, $right, $k ){
        if( $this->isLeftMoreOrEqualsToRight( $left, $right ) ){
            return;
        }
        
        $pivot_index = ( int ) ( $right - $left + 1 ) / 2;
        $pivot_new_index = $this->_partition( $left, $right, $pivot_index );
        $pivot_dist = $pivot_new_index - $left + 1;
        $unsorted_list = $this->getList();
        
        switch ( true ){
            case $this->isLeftEqualsToRight( $pivot_dist, $k ):
                return $unsorted_list[ $pivot_new_index ];
            case $this->isLeftLessThenRight( $k, $pivot_dist ):
                return $this->_medianSort( $left, $pivot_new_index - 1, $k );
            default:
                return $this->_medianSort( $pivot_new_index + 1, $right, $k - $pivot_dist );
        }
    }
    
    public function execute( $order = ISort::ORDER_ASC ) {
        $this->_medianSort( 0, count( $this->getList() ) - 1, 0 );
        $this->markListAsSorted();
    }
}
?>
