<?php
function get_size() {
    global $db;
    try {
    $query = 'SELECT * FROM pizza_size';
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
function get_order_size($id) {
    global $db;
    try {
    $query = 'SELECT size_name FROM pizza_size where id=:id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id',$id);
    $statement->execute();
    } catch (PDOException $e) {
    $error_message = $e->getMessage(); 
    echo 'ERROR!!!';
    include('../../errors/database_error.php');
    exit();
    }
    return $statement;    
}
function get_available_size() {
    global $db;
    try {
    $query = 'SELECT * FROM pizza_size where s_status=1';
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




function add_size($size_id,$s_status,$size_name) {
    global $db;
    $query = 'INSERT INTO pizza_size(id,s_status,size_name)VALUES(:id,:s_status,:size_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $size_id);
    $statement->bindValue(':s_status',$s_status);
    $statement->bindValue(':size_name',$size_name);
    $statement->execute();
    $statement->closeCursor();
}
function delete_size($id) {
    global $db;
    $query = 'DELETE FROM pizza_size
              WHERE id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();
}
function get_size_id() {
    global $db;
    $query = 'SELECT * FROM pizza_sys_tab';    
    $statement = $db->prepare($query);
    $statement->execute();    
    $sizeid = $statement->fetch();
    $statement->closeCursor();    
    $current_size_id = $sizeid['next_size_id'];
    return $current_size_id;
}
function update_size_id($size_id) {
    global $db;
    $query = 'UPDATE `pizza_sys_tab` SET `next_size_id`=:size_id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':size_id', $size_id);
    $statement->execute();    
    $statement->closeCursor();    
}
function update_size_status($size_id,$s_status) {
    global $db;
    $query = 'UPDATE `pizza_size` SET `s_status`=:s_status where id=:id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':s_status', $s_status);
    $statement->bindValue(':id', $size_id);
    $statement->execute();    
    $statement->closeCursor();    
}
    
       

