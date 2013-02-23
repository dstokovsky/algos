<?php

class QuickSort extends AbstractSort{
    
    private function _partition( $left, $right ){
        $unsorted_list = $this->getList();
        $pivot_index = rand( $left, $right );
//        $pivot_index = ( int ) round( ( $left + $right ) / 2 );
        list( $unsorted_list[ $pivot_index ], $unsorted_list[ $right ] ) = 
            array( $unsorted_list[ $right ], $unsorted_list[ $pivot_index ] );
        $store_index = $left;
        for( $index = $left; $index < $right; $index++ ){
            if( $this->isLeftLessOrEqualsToRight( $unsorted_list[ $index ], $unsorted_list[ $right ] ) ){
                list( $unsorted_list[ $store_index ], $unsorted_list[ $index ] ) = 
                    array( $unsorted_list[ $index ], $unsorted_list[ $store_index ] );
                $store_index++;
            }
        }
        list( $unsorted_list[ $store_index ], $unsorted_list[ $right ] ) = 
            array( $unsorted_list[ $right ], $unsorted_list[ $store_index ] );
        $this->updateSortedList( $unsorted_list );
        
        return $store_index;
    }

    private function _quickSort( $left, $right ){
        if( $this->isLeftMoreOrEqualsToRight( $left, $right ) ){
            return;
        }
        
        $pi = $this->_partition( $left, $right );
        
        $this->_quickSort( $left, $pi - 1 );
        $this->_quickSort( $pi + 1, $right );
    }

    public function execute() {
        $this->_quickSort( 0, count( $this->getList() ) - 1 );
        $this->checkListSorting();
    }
}
?>
