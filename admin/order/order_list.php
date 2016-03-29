
<?php include 'util/main.php'; ?>
<?php include 'view/header.php'; ?>
<main>
    <h1>Order Status Report</h1>
    
    <section>
        <br>
        <h2>Baked Orders Yet To Be Delivered</h2>
        <hr>
        <?php if($baked_orders->rowCount()>0):?>
        
       <table>
        <tr>
            <th>Order ID</th>
            <th>Room No</th>
            <th>Status</th>
            <th>Size</th>
            <th>Toppings</th>
           

        </tr>

        <?php foreach ($baked_orders as $baked_order) : ?>
            <tr>
                <td><?php echo $baked_order['id']; ?> </td>
                <td><?php echo $baked_order['room_number']; ?> </td>  
                <td><?php if ($baked_order['status'] == 2) { echo 'Baked';}  ?> </td>
                <td><?php $s_names = get_order_size($baked_order['size_id']);
                      foreach ($s_names as $name){
                    echo $name['size_name']."<br>";
                }
                ?> </td>
                <td><?php $order_toppings=  get_orders_toppings($baked_order['id']);
                foreach ($order_toppings as $order_topping){
                    echo $order_topping['topping_name']."<br>";
                }               
                ?></td>
            </tr>
<?php endforeach; ?>
    </table>
        <?php else: ?>
        <h3>No Baked orders</h3>
        <br>
        <br>
        <?php endif; ?>
        <hr>
    </section>
    
    <section>
        <br>
        <br>
        <h2>Orders being prepared in Oven</h2>
        <hr>
        <?php if($preparing_orders->rowCount()>0):?>
       <table>
        <tr>
            <th>Order ID</th>
            <th>Room No</th>
            <th>Status</th>
            <th>Size</th>
            <th>Toppings</th>
           

        </tr>

        <?php foreach ($preparing_orders as $preparing_order) : ?>
            <tr>
                <td><?php echo $preparing_order['id']; ?> </td>
                <td><?php echo $preparing_order['room_number']; ?> </td>  
                <td><?php if ($preparing_order['status'] == 1) { echo 'Preparing';}  ?> </td>
                <td><?php $s_names = get_order_size($preparing_order['size_id']);
                      foreach ($s_names as $name){
                    echo $name['size_name']."<br>";
                }
                ?> </td>
                <td><?php $order_toppings=  get_orders_toppings($preparing_order['id']);
                foreach ($order_toppings as $order_topping){
                    echo $order_topping['topping_name']."<br>";
                }               
                ?></td>
            </tr>
<?php endforeach; ?>
    </table>
        <?php else: ?>
        <h3>No orders are being prepared in Oven</h3>
        <br>
        <br>
        <?php endif; ?>
        <hr>
        </section>
    <br>
        <br>
    <section>     
        <h4>Change Status to Baked for next order</h4>
    <form  action="index.php" method="post" id="add_product_form">
        <input type="hidden" name="action" value="change_to_baked">
              
        <input type="submit" value="Change Status To Baked" />
        <br>
    </form>
        
    </section>
    <section>
    <p class="last_paragraph">
        <a href="../">Back To Admin</a>
    </p>
    </section>
</main>
<?php include 'view/footer.php'; ?>