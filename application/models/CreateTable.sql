CREATE DATABASE IF NOT EXISTS `food_order`;
DROP TABLE IF EXISTS `food_order`.`orders`;
DROP TABLE IF EXISTS `food_order`.`cart_items`;
DROP TABLE IF EXISTS `food_order`.`dish_images`;
DROP TABLE IF EXISTS `food_order`.`dishes`;
DROP TABLE IF EXISTS `food_order`.`restaurants`;
DROP TABLE IF EXISTS `food_order`.`users`;

CREATE TABLE `food_order`.`users` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` varchar(20) NOT NULL,
    `email` varchar(40) NOT NULL,
    `password` varchar(20) NOT NULL,
    `fullname` varchar(20) NULL,
    `mobile_phone` char(10) NULL,
    `position` varchar(100) NULL,
    `address` varchar(256) NULL,
    `imgPath` varchar(255) NULL,
    `token` char(13) NOT NULL,
    `verificationKey` char(32) NOT NULL,
    `is_email_verified` bit(1) NULL,
    `reset_key` char(32) NULL,
    `is_reset_key_used` bit(1) NULL
    PRIMARY KEY (id),
    UNIQUE KEY (username),
    UNIQUE KEY (email)
) DEFAULT CHARSET=utf8 COMMENT='user information';
INSERT INTO `food_order`.`users` (`username`, `email`, `password`, `token`, `verificationKey`, `is_email_verified`) VALUES ("admin", "admin@admin.com", "123456", "", "", "1");
INSERT INTO `food_order`.`users` (`username`, `email`, `password`, `token`, `verificationKey`, `is_email_verified`) VALUES ("yufeng", "infs@3202.com", "123456", "", "", "1");

CREATE TABLE IF NOT EXISTS `food_order`.`restaurants` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `description` text NULL,
    `location` varchar(256) NULL,
    `rating` int(2) DEFAULT 0,
    `img_path` varchar(256) NULL,
    `modified` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 COMMENT='restaurants that contains various dishes';

INSERT INTO `food_order`.`restaurants` (`name`, `location`, `img_path`) VALUES ('Sushi Train', 'City', 'sushi_train.png');
INSERT INTO `food_order`.`restaurants` (`name`, `location`, `img_path`) VALUES ('Main Course', 'UQ Union', 'Main Course.jpg');
INSERT INTO `food_order`.`restaurants` (`name`, `location`, `img_path`) VALUES ('KFC', 'Indooroopilly', 'kfc.png');

CREATE TABLE IF NOT EXISTS `food_order`.`dishes` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `restaurant_id` int(10) UNSIGNED NOT NULL,
    `name` varchar(100) NOT NULL,
    `description` text NULL,
    `category` varchar(40) NULL,
    `price` int(10) NOT NULL,
    `img_path` varchar(256) NULL,
    `modified` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`restaurant_id`) REFERENCES `food_order`.`restaurants` (`id`)
) DEFAULT CHARSET=utf8 COMMENT='dishes that can be added to cart';

CREATE TABLE IF NOT EXISTS `food_order`.`dish_images` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `dish_id` int(10) UNSIGNED NOT NULL,
    `name` varchar(256) NOT NULL,
    `path` varchar(256) NOT NULL,
    `modified` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`dish_id`) REFERENCES `food_order`.`dishes` (`id`)
) DEFAULT CHARSET=utf8 COMMENT='image files related to a dish';

CREATE TABLE IF NOT EXISTS `food_order`.`cart_items` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` int(10) UNSIGNED NOT NULL,
    `dish_id` int(10) UNSIGNED NOT NULL,
    `quantity` int(10) NOT NULL,
    `modified` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`dish_id`) REFERENCES `food_order`.`dishes` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `food_order`.`users` (`id`)
) DEFAULT CHARSET=utf8 COMMENT='dishes that were added by users';

CREATE TABLE IF NOT EXISTS `food_order`.`orders` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `order_number` varchar(256) NOT NULL,
    `user_id` int(10) UNSIGNED NOT NULL,
    `dish_id` int(10) UNSIGNED NOT NULL,
    `quantity` int(10) NOT NULL,
    `create_time` timestamp Not NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`dish_id`) REFERENCES `food_order`.`dishes` (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `food_order`.`users` (`id`)
) DEFAULT CHARSET=utf8 COMMENT='order details about users';
