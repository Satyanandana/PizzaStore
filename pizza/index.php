<?php
require('../model/database.php');
require('../model/order_db.php');
require('../model/topping_db.php');
require('../model/size_db.php');
session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'student_welcome';
    }
}

if ($action == 'student_welcome') {
 
    $sizes = get_available_size();
    $toppings= get_available_toppings();
    if(isset($_SESSION["room"])){
    $room_orders=  orders_of_room($_SESSION["room"]);
    }
    include('student_welcome.php');
}    
 else if ($action == 'form_order_pizza') {
 include ('order_pizza.php');
    }
    elseif ($action=='add_order') {
        $size_id = filter_input(INPUT_POST,'pizza_size',FILTER_VALIDATE_INT);
        $room = filter_input(INPUT_POST,'room',FILTER_VALIDATE_INT);
        $current_day = current_day();
        $order_id = get_order_id()+1;
        $status=1;
    
    if ($size_id == NULL || $size_id == FALSE||$room==NULL||$room==FALSE ) {
        $error = "Invalid topping data. Check Name field and try again."."$size_id"." $topping_ids"."$room";
        include('../errors/error.php');
        } else { 
        
        add_order($order_id,$room,$size_id,$current_day,$status);
        update_order_id($order_id);
        $_SESSION["room"]=$room;
        foreach($_POST['pizza_topping'] as $value){
          add_order_topping($order_id,$value);
          echo $value;
        }
                
        header("Location: .");
    }
    
}elseif ($action=='update_order_status') {
        $id = filter_input(INPUT_POST, 'id');
        
           
    if ($id == NULL || $id == FALSE ) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        
        update_to_finished($id);
        header("Location: .");
    }
    
}elseif ($action == 'order_pizza') {
 
    $sizes = get_available_size();
    $toppings=  get_available_toppings();
    
    include('order_pizza.php');
}
elseif ($action == 'select_room') {
 
    $_SESSION["room"]=  filter_input(INPUT_POST,'room',FILTER_VALIDATE_INT);
    header("Location: .");
    
}
   
?>