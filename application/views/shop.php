<main class="main container">
    <div class="ui container">
        <div class="ui segment">
            <div class="ui top attached tabular menu">
                <div class="item">Popular</div>
                <div class="item">Rating</div>
                <div class="item">Tab</div>
            </div>
            <div class="ui divided items">
                <?php foreach ($restaurants as $restaurant) : ?>
                    <div class="item">
                        <div class="image">
                            <img src="<?php echo base_url() . 'upload/' . $restaurant['img_path']; ?>">
                        </div>
                        <div class="content">
                            <a class="header" href="<?php echo base_url(); ?>Shop/visit?id=<?php echo $restaurant['id']; ?>"><?php echo $restaurant['name']; ?></a>
                            <div class="meta">
                                <div class="rating">
                                    <div class="ui star rating" data-rating="<?php echo $restaurant['rating']; ?>" data-max-rating="5"></div>
                                </div>
                            </div>
                            <div class="description">
                                <?php echo $restaurant['description']; ?>
                            </div>
                            <div class="extra">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<script>
    $('.ui.rating').rating();
</script>