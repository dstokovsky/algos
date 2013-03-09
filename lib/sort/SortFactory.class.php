<?php

class SortFactory {

    public static function create( $type, $list = array() ) {
        switch ( $type ) {
            case "Insertion":
                return new InsertionSort( $list );
            case "Median":
                return new MedianSort( $list );
            case "Quick":
                return new QuickSort( $list );
            case "Selection":
                return new SelectionSort( $list );
            case "Heap":
                return new HeapSort( $list );
            case "Counting":
                return new CountingSort( $list );
            case "Bucket":
                return new BucketSort( $list );
            default:
                return new InsertionSort( $list );
        }
    }

}
?>
