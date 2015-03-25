<?php
require('../../model/database.php');
require('../../model/topping_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'topping_list';
    }
}

if ($action == 'topping_list') {
 
    $toppings = get_toppings();
    include('topping_list.php');
}    
 else if ($action == 'form_topping_add') {
 include ('topping_add.php');
    }
    elseif ($action=='add_topping') {
        $topping_name = filter_input(INPUT_POST, 'topping_name');
        $current_topping_id =get_topping_id();
        $topping_id=$current_topping_id + 1;
        $t_status=1;
    
    if ($topping_name == NULL || $topping_name == FALSE ) {
        $error = "Invalid topping data. Check Name field and try again.";
        include('../../errors/error.php');
    } else { 
        
        add_topping($topping_id,$t_status,$topping_name);
        update_topping_id($topping_id);
        header("Location: .");
    }
    
}elseif ($action=='delete_topping') {
        $id = filter_input(INPUT_POST, 'id');
        
        
    
    if ($id == NULL || $id == FALSE ) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        
        delete_topping($id);
//        $current_topping_id =get_topping_id();
//        $topping_id=$current_topping_id - 1;
//        update_topping_id($topping_id);
        header("Location: .");
    }
    
}
elseif ($action=='update_topping_status') {
        $id = filter_input(INPUT_POST,'id');
        $t_status = filter_input(INPUT_POST,'t_status',FILTER_VALIDATE_INT);
        
        echo $id;
    
    if ($id == NULL || $id == FALSE ) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        update_topping_status($id,$t_status);
        header("Location: .");
    }
    
}
   
?>