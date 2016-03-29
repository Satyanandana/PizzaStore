<?php
function get_baked_orders() {
    global $db;
    try {
    $query = 'SELECT * FROM pizza_orders where status=2';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement;
    $statement->closeCursor();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../../errors/database_error.php');
    exit();
    }
     
    
        
}
function orders_of_room($room) {
    global $db;
    try {
    $query = 'SELECT * FROM pizza_orders where status<>3 and room_number=:room';
    $statement = $db->prepare($query);
    $statement->bindValue(':room',$room);
    $statement->execute();
    return $statement;
    $statement->closeCursor();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../../errors/database_error.php');
    exit();
    }
     
    
        
}

function get_preparing_orders() {
    global $db;
    try {
    $query = 'SELECT * FROM pizza_orders where status=1';
    $statement = $db->prepare($query);
    $statement->execute();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../../errors/database_error.php');
    exit();
    }
    return $statement;  
    $statement->closeCursor();
}
function change_to_baked($id) {
    global $db;
    try {
    $query = 'UPDATE `pizza_orders` SET `status`=2 WHERE status=1 and id=:id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id',$id);
    $statement->execute();
    $statement->closeCursor();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../../errors/database_error.php');
    exit();
    }
        
}

function next_baked_orderid() {
    global $db;
    try {
    $query = 'SELECT min(id) id FROM pizza_orders where status=1';
    $statement = $db->prepare($query);
    $statement->execute();
    foreach ($statement as $ids){
    $id=$ids['id'];
    }
    $statement->closeCursor();
    return $id; 
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../../errors/database_error.php');
    exit();
    }
    
    
}
function get_todays_orders($day) {
    global $db;
    try {
    $query = 'SELECT * FROM pizza_orders where day=:day ORDER BY status ASC';
    $statement = $db->prepare($query);
    $statement->bindValue(':day',$day);
    $statement->execute();
    return $statement;
    $statement->closeCursor();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../../errors/database_error.php');
    exit();
    }
    
             
}

function no_todays_orders($day) {
    global $db;
    try {
    $query = 'SELECT count(*)as number FROM pizza_orders where day=:day ORDER BY status ASC';
    $statement = $db->prepare($query);
    $statement->bindValue(':day',$day);
    $statement->execute();
    $no = $statement->fetch();
    $statement->closeCursor();
    return $no['number'];
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../../errors/database_error.php');
    exit();
    }
    
             
}
function current_day() {
    global $db;
    $query = 'SELECT * FROM pizza_sys_tab';    
    $statement = $db->prepare($query);
    $statement->execute();    
    $currentday = $statement->fetch();
    $statement->closeCursor();    
    $current_day = $currentday['current_day'];
    return $current_day;
}
function update_next_day($next_day){
    global $db;
    $query = 'UPDATE `pizza_sys_tab` SET `current_day`=:next_day';    
    $statement = $db->prepare($query);
    $statement->bindValue(':next_day', $next_day);
    $statement->execute();    
    $statement->closeCursor();    
}
function change_to_finished($current_day) {
    global $db;
    try {
    $query = 'UPDATE `pizza_orders` SET `status`=3 WHERE day=:current_day';
    $statement = $db->prepare($query);
    $statement->bindValue(':current_day',$current_day);
    $statement->execute();
    $statement->closeCursor();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../../errors/database_error.php');
    exit();
    }
        
}

function update_to_finished($id) {
    global $db;
    try {
    $query = 'UPDATE `pizza_orders` SET `status`=3 WHERE id=:id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id',$id);
    $statement->execute();
    $statement->closeCursor();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../../errors/database_error.php');
    exit();
    }
        
}

function get_orders_toppings($order_id) {
    global $db;
    try {
    $query = 'select T.topping_name from toppings T,order_topping OT where OT.topping_id=T.id and OT.order_id=:order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id',$order_id);
    $statement->execute();
    return $statement;
    $statement->closeCursor();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../../errors/database_error.php');
    exit();
    }
}

function get_order_id() {
    global $db;
    $query = 'SELECT MAX(id) as id FROM pizza_orders';    
    $statement = $db->prepare($query);
    $statement->execute();    
    $orderid = $statement->fetch();
    $statement->closeCursor(); 
    $id=$orderid['id'];
    
    return $id;
}
function update_order_id($order_id) {
    global $db;
    $query = 'UPDATE `pizza_sys_tab` SET `next_order_id`=:order_id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();    
    $statement->closeCursor();    
}

function add_order($room,$size_id,$current_day,$status) {
    global $db;
    try {
    $query = 'INSERT INTO `pizza_orders`(`room_number`, `size_id`, `day`, `status`) VALUES (:room,:size_id,:current_day,:status)';
    $statement = $db->prepare($query);
    $statement->bindValue(':room',$room);
    $statement->bindValue(':size_id',$size_id);
    $statement->bindValue(':current_day',$current_day);
    $statement->bindValue(':status',$status);
    $statement->execute();
    $statement->closeCursor();
    return get_order_id();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../errors/database_error.php');
    exit();
    }
}

function add_order_topping($order_id,$topping_id) {
    global $db;
    $query = 'INSERT INTO `order_topping`(`order_id`, `topping_id`) VALUES (:order_id,:topping_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->bindValue(':topping_id', $topping_id);
    $statement->execute();
    $statement->closeCursor();
}