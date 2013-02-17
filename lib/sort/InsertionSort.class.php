<?php

class InsertionSort extends AbstractSort {
    
    private function _insert( $position, $value ){
        $unsorted_list = $this->getList();
        $index = $position - 1;
        while ( $this->isLeftMoreOrEqualsToRight( $index, 0 ) && $this->isLeftMoreThenRight( $unsorted_list[ $index ], $value ) ){
            $unsorted_list[ $index + 1 ] = $unsorted_list[ $index ];
            $index--;
        }
        $unsorted_list[ $index + 1 ] = $value;
        $this->updateSortedList( $unsorted_list );
    }

    public function execute() {
        $unsorted_list = $this->getList();
        for( $position = 1; $position < count( $unsorted_list ); $position++ ){
            $this->_insert( $position, $unsorted_list[ $position ] );
        }
        $this->checkListSorting();
    }
}
?>
