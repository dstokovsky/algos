<?php

class SelectionSort extends AbstractSort{
    
    private function _selectMax( $left, $right ){
        $max_pos = $index = $left;
        $unsorted_list = $this->getList();
        while ( $this->isLeftLessOrEqualsToRight( ++$index, $right ) ){
            if( $this->isLeftMoreThenRight( $unsorted_list[ $index ], $unsorted_list[ $max_pos ] ) ){
                $max_pos = $index;
            }
        }
        
        return $max_pos;
    }

    public function execute() {
        $unsorted_list = $this->getList();
        for( $index = count( $unsorted_list ) - 1; $index >= 1; $index-- ){
            $max_pos = $this->_selectMax( 0, $index );
            if( $this->isLeftNotEqualsToRight( $max_pos, $index ) ){
                list( $unsorted_list[ $index ], $unsorted_list[ $max_pos ] ) = 
                    array( $unsorted_list[ $max_pos ], $unsorted_list[ $index ] );
                $this->updateSortedList( $unsorted_list );
            }
        }
        $this->checkListSorting();
    }
}
?>
