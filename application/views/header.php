<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title><?php echo $title; ?> - Food Explorer</title>
    <link rel="stylesheet" href="/css/semantic.min.css">
    <link rel="stylesheet" href="/css/swiper.min.css">
    <link rel="stylesheet" href="/css/style.css">
    
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/semantic.min.js"></script>
    <script src="/js/swiper.min.js"></script>

</head>

<body>
    <nav class="ui large secondary menu">
        <div class="ui container">
            <a class="<?php if ($tab == 'Home') echo 'active '; ?>item" href="<?php echo base_url(); ?>Home">Home</a>
            <a class="<?php if ($tab == 'Menu') echo 'active '; ?>item" href="<?php echo base_url(); ?>Menu">Menu</a>
            <a class="<?php if ($tab == 'Shop') echo 'active '; ?>item" href="<?php echo base_url(); ?>Shop">Shop</a>
            <div class="right menu">
                <?php if (isset($_SESSION["email"])) : ?>
                    <a class="<?php if ($tab == 'Cart') echo 'active '; ?>item" href="<?php echo base_url(); ?>Cart"><i class="shopping cart icon"></i>Cart</a>
                    <a class="<?php if ($tab == 'User') echo 'active '; ?>item" href="<?php echo base_url(); ?>User"><?php echo $_SESSION['email']; ?></a>
                    <a class="item" href="<?php echo base_url(); ?>User/logout">Sign out</a>
                <?php else : ?>
                    <a class="<?php if ($tab == 'Login') echo 'active '; ?>item" href="<?php echo base_url(); ?>Login">Log in</a>
                    <a class="<?php if ($tab == 'SignUp') echo 'active '; ?>item" href="<?php echo base_url(); ?>SignUp">Sign Up</a>
                <?php endif ?>
            </div>
        </div>
    </nav>