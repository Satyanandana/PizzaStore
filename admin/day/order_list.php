<?php include 'util/main.php'; ?>
<?php include 'view/header.php'; ?>
<main>
    <section>
        <h1>Today is day <?php echo $current_day; ?></h1>
    <form  action="index.php" method="post" id="add_product_form">
        <input type="hidden" name="action" value="change_to_nextday">
              
        <input type="submit" value="Change To day <?php echo $current_day+1; ?>" />
        <br>
    </form>
    </section>
    <hr>
    <section>
        
        <h2>Todays Orders</h2>
        <?php if($todays_orders->rowCount()>0):?>
        
       <table>
        <tr>
            <th>Order ID</th>
            <th>Room No</th>
            <th>Status</th>
            <th>Size</th>
            <th>Toppings</th>

        </tr>

        <?php foreach ($todays_orders as $todays_order) : ?>
            <tr>
                <td><?php echo $todays_order['id']; ?> </td>
                <td><?php echo $todays_order['room_number']; ?> </td>  
                <td><?php if ($todays_order['status'] == 2) { echo 'Baked';}  
                elseif($todays_order['status'] == 1) {echo 'Preparing';} 
                elseif($todays_order['status'] == 3) {echo 'Finished';}  ?> </td>
                <td><?php $s_names = get_order_size($todays_order['size_id']);
                      foreach ($s_names as $name){
                    echo $name['size_name']."<br>";
                }
                ?> </td>
                <td><?php $order_toppings=  get_orders_toppings($todays_order['id']);
                foreach ($order_toppings as $order_topping){
                    echo $order_topping['topping_name']."<br>";
                }               
                ?></td>
            </tr>
<?php endforeach; ?>
    </table>
        <?php else: ?>
        <p>No Orders Today </p>
        <?php endif; ?>
        
    </section>
 <hr>   
    <section>
    <p class="last_paragraph">
        <a href="../">Back To Admin</a>
    </p>
    </section>
        
     
        
   
</main>
<?php include 'view/footer.php'; ?>