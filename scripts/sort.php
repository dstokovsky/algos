<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "algorithms_config.php";

$sorting_data_file = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "fixtures" . 
    DIRECTORY_SEPARATOR . "sorting_data.txt";
$file_handler = fopen( $sorting_data_file, "r" );
$list = array();
while ( !feof( $file_handler ) ){
    $list[] = ( int ) fgets( $file_handler );
}
fclose( $file_handler );

$sort = SortFactory::create( "Heap", $list );
print "Unsorted list: " . implode( ", ", $sort->getList() ) . PHP_EOL;
$sort->execute();
if( $sort->isListSorted() ){
    print "Sorted list: " . implode( ", ", $sort->getList() ) . PHP_EOL;
}else{
    print "List was not sorted: " . implode( ", ", $sort->getList() ) . PHP_EOL;
}
?>
