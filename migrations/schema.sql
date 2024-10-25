CREATE DATABASE IF NOT EXISTS `planigo`;

-- Users table with AUTO_INCREMENT integer primary key
CREATE TABLE IF NOT EXISTS `User`
(
    `id`                INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `email`             VARCHAR(255) UNIQUE     NOT NULL,
    `firstname`         VARCHAR(255)            NOT NULL,
    `lastname`          VARCHAR(255)            NOT NULL,
    `role`              ENUM ('admin', 'owner', 'customer') DEFAULT 'customer',
    `password`          TEXT                    NOT NULL,
    `is_email_verified` BOOLEAN DEFAULT FALSE
    );

-- Categories table with AUTO_INCREMENT integer primary key
CREATE TABLE IF NOT EXISTS `Category`
(
    `id`   INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `slug` VARCHAR(255) UNIQUE NOT NULL,
    `name` VARCHAR(255) NOT NULL
    );

-- Shops table with AUTO_INCREMENT integer primary key
CREATE TABLE IF NOT EXISTS `Shop`
(
    `id`          INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `slug`        VARCHAR(255) NOT NULL,
    `name`        VARCHAR(255) NOT NULL,
    `description` TEXT,
    `owner_id`    INT,
    `category_id` INT,
    CONSTRAINT `fk_shop_category`
    FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`),
    CONSTRAINT `fk_shop_owner`
    FOREIGN KEY (`owner_id`) REFERENCES `User` (`id`)
    );

-- Services table with AUTO_INCREMENT integer primary key
CREATE TABLE IF NOT EXISTS `Service`
(
    `id`          INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `name`        VARCHAR(255) NOT NULL,
    `description` TEXT,
    `price`       FLOAT,
    `duration`    INTEGER DEFAULT 60,
    `shop_id`     INT,
    CONSTRAINT `fk_service_shop`
    FOREIGN KEY (`shop_id`) REFERENCES `Shop` (`id`)
    );

-- Reservations table with AUTO_INCREMENT integer primary key
CREATE TABLE IF NOT EXISTS `Reservation`
(
    `id`           INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `start`        datetime,
    `service_id`   INT,
    `user_id`      INT,
    `is_cancelled` BOOLEAN DEFAULT FALSE,
    CONSTRAINT `fk_reservation_service`
    FOREIGN KEY (`service_id`) REFERENCES `Service` (`id`),
    CONSTRAINT `fk_reservation_user`
    FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)
    );

-- Hours table with AUTO_INCREMENT integer primary key
CREATE TABLE IF NOT EXISTS `Hour`
(
    `id`      INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `start`   time,
    `end`     time,
    `day`     integer,
    `shop_id` INT,
    CONSTRAINT `fk_hours_shop`
    FOREIGN KEY (`shop_id`) REFERENCES `Shop` (`id`)
    );
