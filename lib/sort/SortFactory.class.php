<?php

class SortFactory {

    public static function create( $type, $list = array() ) {
        switch ( $type ) {
            case "Insertion":
                return new InsertionSort( $list );
            case "Median":
                return new MedianSort( $list );
            default:
                return new InsertionSort( $list );
        }
    }

}
?>
