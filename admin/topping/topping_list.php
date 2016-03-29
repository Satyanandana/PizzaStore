<?php include 'util/main.php';?>
<?php include 'view/header.php'; ?>
<main>
    <section>  
    <h1>Topping List</h1>

  <?php if($toppings->rowCount()>0):?>  
    
    <table>
        <tr>
            <th>Topping</th>
            <th>Status</th>
            <th>  Update Status</th>
<!--            <th>Delete Topping</th>-->

        </tr>

        <?php foreach ($toppings as $topping) : ?>
            <tr>
                <td><?php echo $topping['topping_name']; ?> </td>
                <td><?php if ($topping['t_status'] == 1) {
            echo 'Available';
        } else {
            echo 'UnAvailable';
        }
        ?> </td>
                <td> <form action="index.php" method="post" id="delete_topping_form">
                       <input type="hidden" name="action"
                               value="update_topping_status">
                        <select name="t_status">
                            <option value="1" >Available</option>
                            <option value="0" >UnAvailable</option>
                        </select>
                        <input type="hidden" name="id"
                               value="<?php echo $topping['id']; ?>">
                        <input type="submit" value="Update">
                    </form></td>

<!--                <td> <form action="index.php" method="post" id="delete_topping_form">

                        <input type="hidden" name="action"
                               value="delete_topping">
                        <input type="hidden" name="id"
                               value="<?php echo $topping['id']; ?>">

                        <input type="submit" value="Delete">
                    </form></td>-->
            </tr>
<?php endforeach; ?>
    </table>
    <?php else: ?>
        <h3>No Topping.Please add toppings</h3>
        <br>
        <br>
        <?php endif; ?>
    </section>    
<hr>
 <?php include 'topping_add.php'; ?>
<hr>   
    <section>
    <p class="last_paragraph">
        <a href="../">Back To Admin</a>
    </p>
    </section>
        
</main>
<?php include 'view/footer.php'; ?>