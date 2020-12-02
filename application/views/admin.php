<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/semantic.min.css">
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/semantic.min.js"></script>
</head>

<body>
    <nav class="ui inverted menu">
        <div class="ui container">
            <div class="header item">
                Admin
            </div>
            <div class="right item">
                <div class="ui dropdown item">
                    User <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="<?php echo base_url(); ?>Home">front-end</a>
                        <a class="item">Sign out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="ui centered grid">
        <div class="three wide column">
            <div class="ui secondary vertical menu">
                <a class="<?php if ($tab == 'dashboard') {
                                echo 'active ';
                            } ?>item" data-tab="first">
                    <div><i class="tachometer alternate icon"></i> Dashboard</div>
                </a>
                <a class="<?php if ($tab == 'add_dish') {
                                echo 'active ';
                            } ?>item" data-tab="second">
                    <div><i class="plus icon"></i> Add Dish</div>
                </a>
                <a class="<?php if ($tab == 'add_restaurant') {
                                echo 'active ';
                            } ?>item" data-tab="third">
                    <div><i class="plus icon"></i> Add Restaurant</div>
                </a>
                <a class="<?php if ($tab == 'manage_dishes') {
                                echo 'active ';
                            } ?>item" data-tab="fourth">
                    <div><i class="edit icon"></i> Manage Dishes</div>
                </a>
            </div>
        </div>
        <div class="twelve wide column">
            <div class="ui bottom attached tab segment <?php if ($tab == 'dashboard') {echo 'active';} ?>" data-tab="first">
                No Message
            </div>
            <div class="ui tab segment <?php if ($tab == 'add_dish') {echo 'active';} ?>" data-tab="second">
                <div class="ui grid">
                    <div class="eight wide column">
                        <?php if ($tab == 'add_dish' && $message) : ?>
                            <div class="ui positive message">
                                <i class="close icon"></i>
                                <div class="header">
                                    <?php echo $message; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo base_url(); ?>Admin/add_dish" class="ui form" id="dish_form" method="POST" enctype="multipart/form-data">
                            <div class="field">
                                <label for="item_name">Name</label>
                                <input type="text" id="item_name" name="item_name" placeholder="Item name">
                            </div>
                            <div class="field">
                                <label for="">Restaurant</label>
                                <select name="restaurant_id" id="" class="ui dropdown">
                                    <?php if ($restaurants) : ?>
                                        <?php foreach ($restaurants as $restaurant) : ?>
                                            <option value="<?php echo $restaurant['id']; ?>">
                                                <?php echo $restaurant['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="field">
                                <label for="price">Category</label>
                                <input type="text" id="category" name="category" placeholder="Item category">
                            </div>
                            <div class="field">
                                <label for="price">Price</label>
                                <input type="number" id="price" name="price" placeholder="Item price">
                            </div>
                            <div class="field">
                                <label for="item_description">Description</label>
                                <textarea name="description" id="item_description" cols="30" rows="5" placeholder="Item description"></textarea>
                            </div>
                            <div class="field">
                                <label>Image</label>
                                <input type="file" name="file">
                                <div class="uploaded_image"></div>
                            </div>
                            <button class="ui button">Submit</button>
                            <div class="ui error message"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="ui tab segment <?php if ($tab == 'add_restaurant') {echo 'active';} ?>" data-tab="third">
                <div class="ui grid">
                    <div class="eight wide column">
                        <?php if ($tab == 'add_restaurant' && $message) : ?>
                            <div class="ui positive message">
                                <i class="close icon"></i>
                                <div class="header">
                                    <?php echo $message; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo base_url(); ?>Admin/add_restaurant" class="ui form" id="restaurant_form" method="POST" enctype="multipart/form-data">
                            <div class="field">
                                <label for="restaurant_name">Name</label>
                                <input type="text" id="restaurant_name" name="restaurant_name" placeholder="Restaurant name">
                            </div>
                            <div class="field">
                                <label for="description">Description</label>
                                <textarea name="description" id="restaurant_description" cols="30" rows="5" placeholder="Restaurant description"></textarea>
                            </div>
                            <div class="field">
                                <label for="location">Location</label>
                                <input type="text" id="location" name="location" placeholder="Restaurant location">
                            </div>
                            <div class="field">
                                <label>Image</label>
                                <input type="file" name="file">
                            </div>

                            <button class="ui button">Submit</button>
                            <div class="ui error message"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="ui tab segment <?php if ($tab == 'manage_dishes') {echo 'active';} ?>" data-tab="fourth">
                <?php if ($tab == 'manage_dishes' && $message) : ?>
                    <div class="ui positive message">
                        <i class="close icon"></i>
                        <div class="header">
                            <?php echo $message; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <table class="ui selectable table">
                    <thead>
                        <tr>
                            <th>Dish name</th>
                            <th>Restaurant</th>
                            <th>Dish Price</th>
                            <th>Dish Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dishes as $dish) : ?>
                            <tr>
                                <td><?php echo $dish['dish_name']; ?></td>
                                <td><?php echo $dish['restaurant_name']; ?></td>
                                <td><?php echo $dish['price']; ?></td>
                                <td><?php echo $dish['category']; ?></td>
                                <td><a href="<?php echo base_url(); ?>Admin/remove_dish/<?php echo $dish['dish_id']; ?>">Remove</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $('.ui.dropdown.item').dropdown();
        $('.menu .item').tab();
        $('.ui.form').form({
            on: "blur",
            inline: true,
            fields: {
                item_name: 'empty',
                price: 'empty'
            }
        });
        $('.message .close').on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade');
        });
    </script>
</body>

</html>