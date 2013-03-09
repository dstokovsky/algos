<?php

class CountingSort extends AbstractSort{
    
    private function _countingSort( $bucket_size ){
        $unsorted_list = $this->getList();
        $idx = 0;
        $proxy_array = array();
        for( $i = 0; $i < count( $unsorted_list ); $i++ ){
            $proxy_array[ $unsorted_list[ $i ] ]++;
        }
        
        for( $i = 0; $i < $bucket_size; $i++ ){
            while ( $this->isLeftMoreThenRight( $proxy_array[ $i ], 0 ) ){
                $unsorted_list[ $idx++ ] = $i;
                $proxy_array[ $i ]--;
            }
        }
        $this->updateSortedList( $unsorted_list );
    }

    public function execute() {
        $this->_countingSort( count( $this->getList() ) + 1 );
        $this->checkListSorting();
    }
}
?>
