<?php   include '../view/header.php'; ?>

<main>
    <h1> Order Pizza</h1>
    <form  action="index.php" method="post" id="add_product_form">
        <input type="hidden" name="action" value="add_order">
        <label>Pizza Size:</label><br>
        <?php foreach ($sizes as $size) : ?>
        <input type="radio" name="pizza_size"  value="<?php echo $size['id'];?>" required="required"><label><?php echo $size['size_name'];?> </label>
                    <br>
        <?php endforeach; ?><br>
         
        
                    
         <label>Toppings:</label><br>
        <?php foreach ($toppings as $topping) : ?>
         <input type="checkbox" name="pizza_topping[]"  value="<?php echo $topping['id'];?>" required="required" ><label><?php echo $topping['topping_name'];?> </label><br>
        <?php endforeach; ?> <br>
                    
        <label for="room">Room No:</label>
        <select name="room" required="required">
            <?php for ($i = 1; $i <= 10; $i++): ?>
         <option  value="<?php echo $i; ?>" > <?php echo $i; ?> </option>
        <?php endfor; ?> 
        </select><br><br>
        
        <input type="submit" value="Order Pizza" /> <br><br>
        
        
    </form>

</main>
<?php  include '../view/footer.php'; ?>