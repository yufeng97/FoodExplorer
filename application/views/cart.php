<main class="main container">
    <div class="ui container">
        <div class="ui segment">
            <h3 class="ui center aligned header">Cart</h3>
            <?php if ($message) : ?>
                <div class="ui positive message">
                    <i class="close icon"></i>
                    <div class="header">
                        <?php echo $message; ?>
                    </div>
                </div>
            <?php endif; ?>
            <table class="ui selectable striped table">
                <thead>
                    <tr>
                        <th>Dish Name</th>
                        <th>Dish Price</th>
                        <th class="three wide">Dish quantity</th>
                        <th class="three wide">Subtotal</th>
                        <th class="two wide">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($cart) : ?>
                        <?php $total = 0 ?>
                        <?php foreach ($cart as $row) : ?>
                            <tr>
                                <td><?php echo $row['dish_name']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td>
                                    <?php
                                    $subtotal = $row['price'] * $row['quantity'];
                                    $total += $subtotal;
                                    echo $subtotal;
                                    ?>
                                </td>
                                <td><a href="<?php base_url(); ?>Cart/remove_item/<?php echo $row['cart_id']; ?>">Remove</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td class="center aligned" colspan="5">No Items In Cart</td>
                        </tr>
                    <?php endif; ?>

                </tbody>
                <?php if ($cart) : ?>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="right aligned">Total</th>
                            <th><?php echo $total; ?></th>
                            <th>
                                <button class="ui primary compact button" id="check_out_button">
                                    <i class="shopping cart icon"></i>Check Out
                                </button>
                            </th>
                            <th>
                                <button class="ui compact button" id="clear_button">
                                    <i class="trash alternate icon"></i>Clear
                                </button>
                            </th>
                        </tr>
                    </tfoot>
                <?php endif; ?>

            </table>

        </div>

    </div>
</main>

<script>
    $(document).ready(function() {
        $('.message .close').on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade');
        });
        $('#clear_button').click(function() {
            window.location = '<?php echo base_url(); ?>Cart/remove_all_items';
        });
        $('#check_out_button').click(function() {
            $.ajax({
                url: '<?php echo base_url(); ?>User/get_user_details',
                method: 'POST',
                success: function(data) {
                    details = jQuery.parseJSON(data);
                    if (details.mobile_phone && details.address) {
                        window.location = '<?php echo base_url(); ?>Cart/checkout';
                    } else {
                        alert('Please fill in your Mobile Phone and address');
                    }
                }
            });
        });
    });
</script>