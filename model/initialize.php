<?php
function initialize_db() {
    global $db;
    try {
    $query ='delete from order_topping;';
    $query.='delete from pizza_orders;';
    $query.='delete from pizza_size;';
    $query.='delete from toppings;';
    $query.='delete from pizza_sys_tab;';
    $query.='insert into pizza_sys_tab values (0, 1, 1, 1);';
    $query.="insert into toppings values (1,1,'Pepperoni');";
    $query.="insert into pizza_size values (1,1,'Small');";
    
    $statement = $db->prepare($query);
    $statement->execute();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../errors/database_error.php');
    exit();
    }
    return $statement;    
}

