<div class="ui container">
    <div class="ui segment">
        <?php if ($result) : ?>
            Result is empty
        <?php else : ?>
            <div class="ui items">
                <?php foreach ($restaurants as $restaurant) : ?>
                    <div class="item">
                        <div class="image">
                            <img src="<?php echo $restaurant['img_path']; ?>" alt="">
                        </div>
                        <div class="content">
                            <div class="header">
                                <h2 class="ui header"><?php echo $restaurant['name']; ?></h2>
                            </div>
                            <div class="rating">
                                <div class="ui star rating" data-rating="3" data-max-rating="5"></div>
                            </div>
                            <div class="ui divider"></div>
                            <div class="description">
                                Position
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="ui divider"></div>
            <div class="header">
                <h2 class="ui header">Menu</h2>
            </div>
            <div class="ui cards">
                <?php foreach ($dishes as $dish) : ?>
                    <div class="card">
                        <div class="image">
                            <img src="<?php echo $dish['img_path']; ?>" alt="">
                        </div>
                        <div class="content">
                            <div class="header"><?php echo $dish['name']; ?></div>
                            <div class="description">
                                <?php echo $dish['description']; ?>
                            </div>
                        </div>
                        <div class="extra content">
                            $ <?php echo $dish['price']; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>