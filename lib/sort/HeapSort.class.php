<?php

class HeapSort extends AbstractSort{
    
    private function _heapify( $idx, $max ){
        $left = 2 * $idx + 1;
        $right = 2 * $idx + 2;
        $unsorted_list = $this->getList();
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
            $this->updateSortedList( $unsorted_list );
            $this->_heapify( $largest, $max );
        }
    }

    private function _buildHeap(){
        for( $index = ( int ) ( count( $this->getList() ) / 2 ); $index >= 0; $index-- ){
            $this->_heapify( $index, count( $this->getList() ) );
        }
    }

    public function execute() {
        $this->_buildHeap();
        $unsorted_list = $this->getList();
        for( $index = count( $unsorted_list ) - 1; $index >= 1; $index-- ){
            list( $unsorted_list[ 0 ], $unsorted_list[ $index ] ) = 
                array( $unsorted_list[ $index ], $unsorted_list[ 0 ] );
            $this->updateSortedList( $unsorted_list );
            $this->_heapify( 0, $index );
        }
        $this->checkListSorting();
    }
}
?>
