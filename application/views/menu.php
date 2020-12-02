<!-- <div style="display=flex;min-height:70vh;flex-direction:column;"> -->
<main class="main container">
    <div class="ui container">
        <div class="ui segment">
            <div class="ui three cards">
                <?php foreach ($dishes as $dish) : ?>
                    <div class="card">
                        <img class="ui fluid image" src="<?php echo base_url() . 'upload/' . $dish['img_path']; ?>" alt="">
                        <div class="content">
                            <a class="header" href="<?php echo base_url(); ?>Shop/visit/?id=<?php echo $dish['restaurant_id']; ?>">
                                <?php echo $dish['name']; ?>
                            </a>
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