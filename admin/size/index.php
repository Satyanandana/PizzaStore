<?php
require('../../model/database.php');
require('../../model/size_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'size_list';
    }
}

if ($action == 'size_list') {
 
    $sizes = get_size();
    include('size_list.php');
}    
 else if ($action == 'form_size_add') {
 include ('size_add.php');
    }
    elseif ($action=='add_size') {
        $size_name = filter_input(INPUT_POST, 'size_name');
        $current_size_id =get_size_id();
        $size_id=$current_size_id + 1;
        $s_status=1;
    
    if ($size_name == NULL || $size_name == FALSE ) {
        $error = "Invalid topping data. Check Name field and try again.";
        include('../../errors/error.php');
    } else { 
        
        add_size($size_id,$s_status,$size_name);
        update_size_id($size_id);
        header("Location: .");
    }
    
}elseif ($action=='delete_size') {
        $id = filter_input(INPUT_POST, 'id');
        
    if ($id == NULL || $id == FALSE ) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        
        delete_size($id);
//        $current_size_id =get_size_id();
//        $size_id=$current_size_id - 1;
//        update_size_id($size_id);
        header("Location: .");
    }
    
}
elseif ($action=='update_size_status') {
        $id = filter_input(INPUT_POST,'id');
        $s_status = filter_input(INPUT_POST,'s_status',FILTER_VALIDATE_INT);
        
        echo $id;
    
    if ($id == NULL || $id == FALSE ) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        update_size_status($id,$s_status);
        header("Location: .");
    }
    
}
   
?>