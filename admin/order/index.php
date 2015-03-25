<?php
require('../../model/database.php');
require('../../model/order_db.php');
require('../../model/size_db.php');


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_orders';
    }
}

if ($action == 'list_orders') {
    
    $baked_orders = get_baked_orders();
    
    $preparing_orders = get_preparing_orders();
    
    include('order_list.php');
} else if ($action == 'change_to_baked') {
    
    $next_id=  next_baked_orderid();
    change_to_baked($next_id);
    header("Location: .");
    
} 
?>