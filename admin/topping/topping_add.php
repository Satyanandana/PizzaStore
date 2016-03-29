<section>
    <h1>Add New Topping</h1>
    <form  action="index.php" method="post" id="add_product_form">
        <input type="hidden" name="action" value="add_topping">
        <label>Topping Name:</label>
        <input type="text" name="topping_name" placeholder=" Enter topping name" required="required" />       
        <input type="submit" value="Add" />
        <br>
    </form>

</section>
