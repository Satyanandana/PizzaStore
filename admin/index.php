<?php
require('../model/database.php');
require('../model/initialize.php');
$action = filter_input(INPUT_POST, 'action');
 if ($action == 'initialize_db') {
        $message= 'Database Initialized'; 
        initialize_db();
        }
        else{
            $message='';
        }
        
 ?>

<?php include '../view/header.php'; ?> 
<section>

    <h1>Admin Menu</h1>
    <ul class="last_paragraph">
        <li><a href="topping">Topping Manager</a></li>
        <li><a href="size">Size Manager</a></li>
        <li><a href="day">Day Manager</a></li>
        <li><a href="order">Order Manager</a></li>
    </ul>
    
    <h2><?php echo $message; ?></h2>
    
    <form  action="index.php" method="post" id="add_product_form">
        <input type="hidden" name="action" value="initialize_db">           
        <input type="submit" value="Initialize Database" />
        <br>
    </form>
</section>
<?php include '../view/footer.php'; ?>
