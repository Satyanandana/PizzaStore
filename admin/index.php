<?php include '../util/main.php';?>
<?php include 'view/header.php'; ?> 
<section>

    <h1>Admin Menu</h1>
    <ul class="last_paragraph">
        <li><a href="topping">Topping Manager</a></li>
        <li><a href="size">Size Manager</a></li>
        <li><a href="day">Day Manager</a></li>
        <li><a href="order">Order Manager</a></li>
    </ul>
       
    <form  action="order/index.php" method="post" id="add_product_form">
        <input type="hidden" name="action" value="initial_db">           
        <input type="submit" value="Initialize Database" />
        <br>
    </form>
</section>
<?php include 'view/footer.php'; ?>
