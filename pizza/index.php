<?php
require('../util/main.php');
require('model/database.php');
require('model/order_db.php');
require('model/topping_db.php');
require('model/size_db.php');
require('model/inventory.php');
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
    $toppings = get_available_toppings();
    if (isset($_SESSION["room"])) {
        $room_orders = orders_of_room($_SESSION["room"]);
    }
    include('student_welcome.php');
} else if ($action == 'form_order_pizza') {
    include ('order_pizza.php');
} elseif ($action == 'add_order') {
    $size_id = filter_input(INPUT_GET, 'pizza_size', FILTER_VALIDATE_INT);
    $room = filter_input(INPUT_GET, 'room', FILTER_VALIDATE_INT);
    $current_day = current_day();
    // $order_id = get_order_id()+1;
    $n = filter_input(INPUT_GET,'n',FILTER_VALIDATE_INT);
    $status = 1;

    if ($size_id == NULL || $size_id == FALSE ||$n==NULL|| $room == NULL || $room == FALSE || empty($_GET['pizza_topping'])) {
        $error = "Invalid topping data. Check Name field and try again.".$size_id."  ".$n."  ".$room."  ".$status;
        include('errors/error.php');
    } else {
        $flour = get_current_flour();
        $cheese=  get_current_cheese();
        $orders= no_todays_orders($current_day);
        
        
        if (($flour) >= $n && ($cheese) >= $n && ($orders + $n) <= 50)
        {
        for ($i=0;$i<$n;$i++) {
            $order_id = add_order($room, $size_id, $current_day, $status);
            //  update_order_id($order_id);
            decrease_inventory();
            foreach ($_GET['pizza_topping'] as $value) {
                add_order_topping($order_id, $value);
                echo $value;
            }
        }
        $_SESSION["room"] = $room;
        header("Location: .");
        }else{
                    $error = "Not enough inventory! Try lesser quantity.";
                    include('errors/error.php');
                }
    }
} elseif ($action == 'update_order_status') {
    $id = filter_input(INPUT_POST, 'id');


    if ($id == NULL || $id == FALSE) {
        $error = "Invalid product data. Check all fields and try again.";
        include('errors/error.php');
    } else {

        update_to_finished($id);
        header("Location: .");
    }
} elseif ($action == 'order_pizza') {

    $sizes = get_available_size();
    $toppings = get_available_toppings();

    include('order_pizza.php');
} elseif ($action == 'select_room') {

    $_SESSION["room"] = filter_input(INPUT_POST, 'room', FILTER_VALIDATE_INT);
    header("Location: .");
}
?>