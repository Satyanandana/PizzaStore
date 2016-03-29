<?php include '../util/main.php'; ?>
<?php include 'view/header.php'; ?>

<main>
    <h1> Student Service</h1>
    <hr>
    <section>
        <div>
        <h2>Available Sizes</h2>
        <?php if($sizes->rowCount()>0):?>
       <table>
        <tr>
            <th>Size</th>
        </tr>

        <?php foreach ($sizes as $size) : ?>
            <tr>
                <td><?php echo $size['size_name']; ?> </td>
            </tr>
<?php endforeach; ?>
    </table>
        <?php else: ?>
        <h3>No Sizes Available</h3>
        <br>
        <br>
        <?php endif; ?>
         </div>
      <div>
         <h2>Available Toppings</h2>
         <?php if($sizes->rowCount()>0):?>
       <table>
        <tr>
            <th>Topping</th>
        </tr>

        <?php foreach ($toppings as $topping) : ?>
            <tr>
                <td><?php echo $topping['topping_name']; ?> </td>
               
            </tr>
<?php endforeach; ?>
    </table>
         <?php else: ?>
        <h3>No Toppings Available</h3>
        <br>
        <br>
        <?php endif; ?>
        </div>
    </section> 
  
    <section>
    <hr>
    <?php if(isset($_SESSION["room"])):?>
    
    <form  action="index.php" method="post" id="add_product_form">
        <input type="hidden" name="action" value="select_room">
        <label for="room">Room No:</label>
        <select name="room" required="required">
            <?php for ($i = 1; $i <= 10; $i++): ?>
         <option  value="<?php echo $i; ?>" > <?php echo $i; ?> </option>
        <?php endfor; ?> 
        </select>
        
        <input style="float:none;" type="submit" value="Select Room" /> <br><br>
        
        
    </form>
    </section>
    <section >
        
        <h2>Orders From Room <?php echo $_SESSION["room"]?></h2>
        <hr>
        <?php if($room_orders->rowCount()>0):?>
        
       <table>
        <tr>
            <th>Order ID</th>
            <th>Room No</th>
            <th>Status</th>
            <th>Size</th>
            <th>Toppings</th>
            <th>Acknowledge</th>
           

        </tr>

        <?php foreach ($room_orders as $room_order) : ?>
            <tr>
                <td><?php echo $room_order['id']; ?> </td>
                <td><?php echo $room_order['room_number']; ?> </td>  
                <td><?php if ($room_order['status'] == 2) { echo 'Baked';}  else { echo 'Preparing';}  ?> </td>
                <td><?php $s_names = get_order_size($room_order['size_id']);
                      foreach ($s_names as $name){
                    echo $name['size_name']."<br>";
                }  
                      
                      ?> </td>
                <td><?php $order_toppings=  get_orders_toppings($room_order['id']);
                foreach ($order_toppings as $order_topping){
                    echo $order_topping['topping_name']."<br>";
                }               
                ?></td>
                <?php if($room_order['status']==2):?>
                 <td> <form action="index.php" method="post" id="delete_topping_form">

                        <input type="hidden" name="action"
                               value="update_order_status">
                        <input type="hidden" name="id"
                               value="<?php echo $room_order['id']; ?>">

                        <input type="submit" value="Acknowledge Delivery">
                    </form></td>
                    <?php else: ?>
                    <td><?php echo 'Not Yet Delivered'; ?></td>
                <?php endif; ?>
            </tr>
<?php endforeach; ?>
    </table>
        <?php else: ?>
        <h3>No orders form room <?php echo $_SESSION["room"]?></h3>
        <?php endif; ?>
        <br>
        <hr>
        <?php endif; ?>
    </section> 
    
    <section>
    <p class="last_paragraph">
        <a href="?action=order_pizza">Order Pizza</a>
    </p>
    </section>
</main>
<?php include 'view/footer.php'; ?>