<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Order Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/components/container.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/components/table.min.css">
</head>

<body>
    <div class="ui container">
        <div style="text-align: center;">
            <h3>Food Explorer</h3>
        </div>
        
        <div class="list">
            <div class="item">
                <label>Order number: </label>
                <?php echo $order_number; ?>
            </div>
            <div class="item">
                <label>Created time: </label>
                <?php echo $create_time; ?>
            </div>
            <div class="item">
                <label>User: </label>
                <?php echo $username; ?>
            </div>
            <div class="item">
                <label>Phone: </label>
                <?php echo $mobile_phone; ?>
            </div>
            <div class="item">
                <label>Location: </label>
                <?php echo $address; ?>
            </div>
            <div class="item">
                <label>Email: </label>
                <?php echo $email; ?>
            </div>
        </div>
        <br>
        <table class="ui striped table">
            <thead>
                <tr>
                    <th>Dish</th>
                    <th>Restaurant</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0 ?>
                <?php foreach ($cart as $row) : ?>
                    <tr>
                        <td><?php echo $row['dish_name']; ?></td>
                        <td><?php echo $row['restaurant_name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td>
                            <?php
                            $subtotal = $row['price'] * $row['quantity'];
                            $total += $subtotal;
                            echo $subtotal;
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="right aligned">Total</th>
                    <th><?php echo $total; ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>