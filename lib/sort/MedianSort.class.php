<?php

class MedianSort extends AbstractSort{
    
    private function _medianSort( $left, $right ){
        if( $this->isLeftLessThenRight( $left, $right ) ){
            $unsorted_list = $this->getList();
            $middle = ( int ) floor( ( $left + $right ) / 2 );
            $median = ( int ) ceil( ( $left + $right ) / 2 );
            list( $unsorted_list[ $middle ], $unsorted_list[ $median ] ) = 
                array( $unsorted_list[ $median ], $unsorted_list[ $middle ] );
            for( $position = $left; $position < $middle; $position++ ){
                if( $this->isLeftMoreThenRight( $unsorted_list[ $position ], $unsorted_list[ $middle ] ) ){
                    $index = $middle + 1;
                    while ( $this->isLeftLessOrEqualsToRight( $index, $right ) ){
                        if( $this->isLeftLessOrEqualsToRight( $unsorted_list[ $index ], $unsorted_list[ $middle ] ) ){
                            list( $unsorted_list[ $index ], $unsorted_list[ $position ] ) = 
                                array( $unsorted_list[ $position ], $unsorted_list[ $index ] );
                        }
                        $index++;
                    }
                }
            }
            
            $this->updateSortedList( $unsorted_list );
            $this->_medianSort( $left, $middle - 1 );
            $this->_medianSort( $median + 1, $right );
        }
    }
    
    public function execute( $order = ISort::ORDER_ASC ) {
        $this->_medianSort( 0, count( $this->getList() ) - 1 );
        $this->markListAsSorted();
    }
}
?>
