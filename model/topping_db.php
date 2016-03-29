<?php
function get_toppings() {
    global $db;
    try {
    $query = 'SELECT * FROM toppings';
    $statement = $db->prepare($query);
    $statement->execute();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../../errors/database_error.php');
    exit();
    }
    return $statement;    
}
function get_available_toppings() {
    global $db;
    try {
    $query = 'SELECT * FROM toppings where t_status=1';
    $statement = $db->prepare($query);
    $statement->execute();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../../errors/database_error.php');
    exit();
    }
    return $statement;    
}




function add_topping($t_status,$topping_name) {
    global $db;
    $query = 'INSERT INTO toppings(t_status,topping_name)VALUES(:t_status,:topping_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':t_status', $t_status);
    $statement->bindValue(':topping_name', $topping_name);
    $statement->execute();
    $statement->closeCursor();
}
function delete_topping($id) {
    global $db;
    $query = 'DELETE FROM toppings
              WHERE id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();
}
function get_topping_id() {
    global $db;
    $query = 'SELECT * FROM pizza_sys_tab';    
    $statement = $db->prepare($query);
    $statement->execute();    
    $toppingid = $statement->fetch();
    $statement->closeCursor();    
    $next_topping_id = $toppingid['next_topping_id'];
    return $next_topping_id;
}
function update_topping_id($topping_id) {
    global $db;
    $query = 'UPDATE `pizza_sys_tab` SET `next_topping_id`=:topping_id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':topping_id', $topping_id);
    $statement->execute();    
    $statement->closeCursor();    
}
function update_topping_status($topping_id,$t_status) {
    global $db;
    $query = 'UPDATE `toppings` SET `t_status`=:t_status where id=:id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':t_status', $t_status);
    $statement->bindValue(':id', $topping_id);
    $statement->execute();    
    $statement->closeCursor();    
}
    
       

