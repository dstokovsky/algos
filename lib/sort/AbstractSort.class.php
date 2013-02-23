<?php

abstract class AbstractSort implements ISort {
    
    const LEFT_EQUALS_TO_RIGHT = 0;
    const LEFT_MORE_THEN_RIGHT = 1;
    const LEFT_LESS_THEN_RIGHT = -1;
    
    private $list = array();
    
    private $is_list_sorted = false;
    
    private function compare( $left, $right ){
        switch ( true ){
            case $left > $right:
                return self::LEFT_MORE_THEN_RIGHT;
            case $left < $right:
                return self::LEFT_LESS_THEN_RIGHT;
            default:
                return self::LEFT_EQUALS_TO_RIGHT;
        }
    }
    
    protected function isLeftEqualsToRight( $left, $right ){
        return $this->compare( $left, $right ) === self::LEFT_EQUALS_TO_RIGHT;
    }
    
    protected function isLeftMoreThenRight( $left, $right ){
        return $this->compare( $left, $right ) === self::LEFT_MORE_THEN_RIGHT;
    }
    
    protected function isLeftLessThenRight( $left, $right ){
        return $this->compare( $left, $right ) === self::LEFT_LESS_THEN_RIGHT;
    }
    
    protected function isLeftMoreOrEqualsToRight( $left, $right ){
        return $this->isLeftMoreThenRight( $left, $right ) || $this->isLeftEqualsToRight( $left, $right );
    }
    
    protected function isLeftLessOrEqualsToRight( $left, $right ){
        return $this->isLeftLessThenRight( $left, $right ) || $this->isLeftEqualsToRight( $left, $right );
    }
    
    protected function isLeftNotEqualsToRight( $left, $right ){
        return $this->isLeftLessThenRight( $left, $right ) || $this->isLeftMoreThenRight( $left, $right );
    }

    protected function checkListSorting(){
        $list = $this->getList();
        for( $index = 1; $index < count( $list ); $index++ ){
            if( $this->isLeftLessThenRight( $list[ $index ], $list[ $index - 1 ] ) ){
                $this->is_list_sorted = false;
                return;
            }
        }
        
        $this->is_list_sorted = true;
    }
    
    protected function updateSortedList( $partly_sorted_list ){
        if( !empty( $partly_sorted_list ) && is_array( $partly_sorted_list ) ){
            $this->list = $partly_sorted_list;
        }
    }

    public function __construct( $list = array() ) {
        $this->setListForSorting( $list );
    }
    
    public function setListForSorting( $list ){
        if( !empty( $list ) && is_array( $list ) ){
            $this->list = $list;
        }
    }
    
    public function getList(){
        return $this->list;
    }
    
    public function isListSorted(){
        return $this->is_list_sorted;
    }

    abstract public function execute();
}
?>
