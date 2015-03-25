
<?php include '../../view/header.php'; ?>
<main>
    <h1>PIZZA SIZES</h1>

    <!-- display a list of toppings: incomplete but should work -->
    
    <table>
        <tr>
            <th>Size</th>
            <th>Status</th>
            <th>  Update Status</th>
            <th>Delete Size</th>

        </tr>

        <?php foreach ($sizes as $size) : ?>
            <tr>
                <td><?php echo $size['size_name']; ?> </td>
                <td><?php if ($size['s_status'] == 1) {
            echo 'Available';
        } else {
            echo 'UnAvailable';
        }
        ?> </td>
                <td> <form action="index.php" method="post" id="delete_topping_form">
                       <input type="hidden" name="action"
                               value="update_size_status">
                        <select name="s_status">
                            <option value="1" >Available</option>
                            <option value="0" >UnAvailable</option>
                        </select>
                        <input type="hidden" name="id"
                               value="<?php echo $size['id']; ?>">
                        <input type="submit" value="Update">
                    </form></td>

                <td> <form action="index.php" method="post" id="delete_topping_form">

                        <input type="hidden" name="action"
                               value="delete_size">
                        <input type="hidden" name="id"
                               value="<?php echo $size['id']; ?>">

                        <input type="submit" value="Delete">
                    </form></td>
            </tr>
<?php endforeach; ?>
    </table>
      
 <?php include 'size_add.php'; ?>
 
    <hr>   
    <section>
    <p class="last_paragraph">
        <a href="../">Back To Admin</a>
    </p>
    </section>
    
</main>
<?php include '../../view/footer.php'; ?>