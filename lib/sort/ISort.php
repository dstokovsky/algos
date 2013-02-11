<?php

interface ISort{
    
    const ORDER_ASC = "asc";
    const ORDER_DESC = "desc";
    
    public function execute( $order = ISort::ORDER_ASC );
}
?>
