<?php
function initialize_db() {
    global $db;
    try {
    $query ='delete from order_topping;';
    $query.='delete from pizza_orders;';
    $query.='delete from pizza_size;';
    $query.='delete from toppings;';
    $query.='delete from pizza_sys_tab;';
    $query.='insert into pizza_sys_tab values (0, 0, 0, 1);';
    $query.='delete from inventory;';
    $query.='delete from undelivered_supplyid;';
    $query.='truncate table supply_orders;';
    $query.='delete from system_day;';
    $query.='insert into inventory values (11,100);';
    $query.='insert into inventory values (12,100);';
    $query.='insert into system_day values (1);';
    
    
    $statement = $db->prepare($query);
    $statement->execute();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('errors/database_error.php');
    exit();
    }
    return $statement;    
}

