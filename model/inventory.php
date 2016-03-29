<?php

function get_current_flour() {
    global $db;
    $query = 'SELECT quantity FROM inventory where productID=11';    
    $statement = $db->prepare($query);
    $statement->execute();    
    $currentflour = $statement->fetch();
    $statement->closeCursor();    
    $current_flour = $currentflour['quantity'];
    return $current_flour;
}
function get_current_cheese() {
    global $db;
    $query = 'SELECT quantity FROM inventory where productID=12';    
    $statement = $db->prepare($query);
    $statement->execute();    
    $currentcheese = $statement->fetch();
    $statement->closeCursor();    
    $current_cheese = $currentcheese['quantity'];
    return $current_cheese;
}

function decrease_inventory(){
     global $db;
    $query = 'UPDATE inventory SET quantity=quantity-1';
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();      
}

function add_flour_inventory($flour)
{
    global $db;
    $query = 'UPDATE inventory SET quantity = quantity + (:flour_quantity * 30) WHERE productID = 11';
    $statement = $db->prepare($query);
    $statement->bindValue(':flour_quantity',$flour);
    $statement->execute();
    $statement->closeCursor();
}

function add_cheese_inventory($cheese)
{
    global $db;
    $query = 'UPDATE inventory SET quantity = quantity + (:cheese_quantity * 20) WHERE productID = 12';
    $statement = $db->prepare($query);
    $statement->bindValue(':cheese_quantity',$cheese);
    $statement->execute();
    $statement->closeCursor();
}

function get_undeliveredorders()
{
    global $db;
    $query = 'SELECT * FROM undelivered_supplyid';
    $statement = $db->prepare($query);
    $statement->execute();    
    $undelivered = $statement->fetchAll();
    $statement->closeCursor();
    return $undelivered;
}

function insert_orderID($orderID)
{
    global $db;
    $query = 'INSERT INTO undelivered_supplyid VALUES (:order_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $orderID);
    $statement->execute();
    $statement->closeCursor();
}

function delete_deliverorder_ids($id)
{
    global $db;
    $query = 'DELETE FROM undelivered_supplyid WHERE orderID = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $statement->closeCursor();
}
?>
