<main class="main container">
    <div class="ui container">
        <div class="ui segment">
            <div class="ui items">
                <div class="item">
                    <div class="image">
                        <img src="<?php echo base_url() . 'upload/' . $restaurant['img_path']; ?>" alt="">
                    </div>
                    <div class="content">
                        <div class="header">
                            <h2 class="ui header"><?php echo $restaurant['name']; ?></h2>
                        </div>
                        <div class="rating">
                            <div class="ui star rating" data-rating="<?php echo $restaurant['rating']; ?>" data-max-rating="5"></div>
                        </div>
                        <div class="ui divider"></div>
                        <div class="description">
                            <?php echo $restaurant['location']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui divider"></div>
            <div class="header">
                <h2 class="ui header">Menu</h2>
            </div>
            <div class="ui cards">
                <?php foreach ($dishes as $dish) : ?>
                    <div class="card">
                        <div class="image">
                            <img src="<?php echo base_url() . 'upload/' . $dish['img_path']; ?>" alt="">
                        </div>
                        <div class="content">
                            <div class="header">
                                <?php echo $dish['name']; ?>
                                <input type="hidden" name="id" value="<?php echo $dish['id'] ?>">
                            </div>
                            <div class="description">
                                <?php echo $dish['description']; ?>
                            </div>
                        </div>
                        <div class="extra content">
                            <span class="price">
                                $ <?php echo $dish['price']; ?>
                            </span>
                            <a class="add_item" href="javascript:void(0);" data-id="<?php echo $dish['id'] ?>">
                                <div class="right floated">
                                    <i class="add icon"></i>
                                    Add to Cart
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('.ui.rating').rating();
        $('.add_item').click(function() {
            <?php if (isset($_SESSION['email'])) : ?>
                var dish_id = $(this).data('id');
                $.ajax({
                    url: '<?php echo base_url(); ?>Cart/add_item',
                    method: 'POST',
                    data: {
                        dish_id: dish_id
                    },
                    success: function(data) {
                        alert("Product Added into Cart");
                    }
                });
            <?php else : ?>
                alert('Please Login first');
                window.location = '<?php echo base_url(); ?>Login';
            <?php endif; ?>
        });
    });
</script>