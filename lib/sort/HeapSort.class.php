<?php

class HeapSort extends AbstractSort{
    
    private function _heapify( &$unsorted_list, $idx, $max ){
        $left = 2 * $idx + 1;
        $right = 2 * $idx + 2;
        $largest = ( 
            $this->isLeftLessThenRight( $left, $max ) && 
            $this->isLeftMoreThenRight( $unsorted_list[ $left ], $unsorted_list[ $idx ] ) 
        ) ? $left : $idx;
        
        if( 
            $this->isLeftLessThenRight( $right, $max ) && 
            $this->isLeftMoreThenRight( $unsorted_list[ $right ], $unsorted_list[ $largest ] ) 
        ){
            $largest = $right;
        }
        
        if( $this->isLeftNotEqualsToRight( $largest, $idx ) ){
            list( $unsorted_list[ $idx ], $unsorted_list[ $largest ] ) = 
                array( $unsorted_list[ $largest ], $unsorted_list[ $idx ] );
            $this->_heapify( $unsorted_list, $largest, $max );
        }
    }

    private function _buildHeap(){
        $unsorted_list = $this->getList();
        $unsorted_list_size = count( $unsorted_list );
        for( $index = ( int ) ( $unsorted_list_size / 2 ) - 1; $index >= 0; $index-- ){
            $this->_heapify( $unsorted_list, $index, $unsorted_list_size - 1 );
        }
        $this->updateSortedList( $unsorted_list );
    }

    public function execute() {
        $this->_buildHeap();
        $unsorted_list = $this->getList();
        for( $index = count( $unsorted_list ) - 1; $index >= 1; $index-- ){
            list( $unsorted_list[ 0 ], $unsorted_list[ $index ] ) = 
                array( $unsorted_list[ $index ], $unsorted_list[ 0 ] );
            $this->_heapify( $unsorted_list, 0, $index );
        }
        $this->updateSortedList( $unsorted_list );
        $this->checkListSorting();
    }
}
?>
