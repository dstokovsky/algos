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
    
    private function _selectKth( $k, $left, $right ){
        $pivot_index = rand( $left, $right );
        $pivot_new_index = $this->_partition( $left, $right, $pivot_index );
        if( $this->isLeftEqualsToRight( $left + $k - 1, $pivot_new_index ) ){
            return $pivot_new_index;
        }
        
        if( $this->isLeftLessThenRight( $left + $k -1, $pivot_new_index ) ){
            return $this->_selectKth( $k, $left, $pivot_new_index - 1 );
        }else{
            return $this->_selectKth( $k - ( $pivot_new_index - $left + 1 ), $pivot_new_index + 1, $right );
        }
    }

    private function _medianSort( $left, $right ){
        if( $this->isLeftLessOrEqualsToRight( $right, $left ) ){
            return;
        }
        
        $mid = ( int ) ( ( $right - $left + 1 ) / 2 );
        $me = $this->_selectKth( $mid + 1, $left, $right );
        
        $this->_medianSort( $left, $left + $mid - 1 );
        $this->_medianSort( $left + $mid + 1, $right );
    }
    
    public function execute() {
        $this->_medianSort( 0, count( $this->getList() ) - 1 );
        $this->checkListSorting();
    }
}
?>
