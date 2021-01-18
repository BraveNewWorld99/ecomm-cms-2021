-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2020 at 01:59 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

CREATE DATABASE cms;

USE DATABASE cms;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePage` (IN `_page_id` SMALLINT(5))  BEGIN

    START TRANSACTION;

    UPDATE pages SET deleted = 1 WHERE page_id = _page_id;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteUser` (IN `_user_id` MEDIUMINT(6), IN `_date_modified` DATETIME)  BEGIN

    START TRANSACTION;

    UPDATE users SET date_modified=_date_modified, deleted=1 WHERE user_id = _user_id;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllArtByPriceRange` (IN `_price1` INT(10), IN `_price2` INT(10))  BEGIN


    START TRANSACTION;

    SELECT * FROM cms.art WHERE price BETWEEN _price1 AND _price2;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getArtByMedium` (IN `_medium` VARCHAR(50))  BEGIN

    START TRANSACTION;

    SELECT * FROM art WHERE medium = _medium;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getArtByPriceRanges` ()  BEGIN


    START TRANSACTION;

    (SELECT * FROM art WHERE price BETWEEN 0 AND 100000 ORDER BY RAND() LIMIT 1)
    UNION (

        SELECT * FROM art WHERE price BETWEEN 100000 AND 200000 ORDER BY RAND() LIMIT 1
    )
    UNION (
        SELECT * FROM art WHERE price BETWEEN 200000 AND 500000 ORDER BY RAND() LIMIT 1

    )
    UNION (
        SELECT * FROM art WHERE price BETWEEN 500000 AND 1000000 ORDER BY RAND() LIMIT 1
    );

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getArtByStyle` (IN `_style` VARCHAR(50))  BEGIN

    START TRANSACTION;

    SELECT * FROM art WHERE style = _style;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getChildPagesfromParent` (IN `_url` VARCHAR(255))  BEGIN

    START TRANSACTION;

    SELECT * FROM pages WHERE parentName =_url AND parentName <> 'top_menu_item' AND deleted=0;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPageByID` (IN `_page_id` INT(5))  BEGIN

    START TRANSACTION;

    SELECT * FROM pages WHERE page_id = _page_id;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPageList` (IN `numRows` INT(7))  BEGIN

    START TRANSACTION;

    SELECT SQL_CALC_FOUND_ROWS * FROM pages LIMIT numRows;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductsByID` (IN `_art_id` INT(8))  BEGIN

    START TRANSACTION;

    SELECT * FROM art WHERE art_id = _art_id;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getRandomArtByMedium` ()  BEGIN


    START TRANSACTION;

    SELECT a.*
    FROM art a
             INNER JOIN
         (SELECT medium,
                 MIN(art_id) as id
          FROM art
          GROUP BY medium
         ) AS b
         ON a.medium = b.medium
             AND a.art_id = b.id ORDER BY RAND() LIMIT 4;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getRandomArtByStyle` ()  BEGIN


    START TRANSACTION;

    SELECT a.*
    FROM art a
             INNER JOIN
         (SELECT style,
                 MIN(art_id) as id
          FROM art
          GROUP BY style
         ) AS b
         ON a.style = b.style
             AND a.art_id = b.id ORDER BY RAND() LIMIT 4;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserByID` (IN `_user_id` MEDIUMINT(6))  BEGIN

    START TRANSACTION;

    SELECT * FROM users WHERE user_id = _user_id;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserRegData` (IN `_start` INT, IN `_pagerows` INT)  BEGIN

    START TRANSACTION;

    SELECT last_name, first_name, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat, user_id FROM users WHERE deleted = 0 ORDER BY registration_date ASC LIMIT _start, _pagerows;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUserSearchRegData` (IN `_query` VARCHAR(255))  BEGIN

    START TRANSACTION;

    SELECT last_name, first_name, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat, user_id FROM users WHERE deleted = 0 AND (`first_name` LIKE CONCAT('%',_query,'%')) OR (`last_name` LIKE CONCAT('%',_query,'%')) OR (`email` LIKE CONCAT('%',_query,'%')) ORDER BY registration_date ASC;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertAdmin` (IN `login` VARCHAR(255), IN `password` VARCHAR(255), IN `salt` VARCHAR(255), IN `hash_value` VARCHAR(255), IN `perm_level` INT(11), IN `per_name` VARCHAR(255))  BEGIN

START TRANSACTION;

INSERT INTO auth ( login, password, salt, hash_value, perm_level, perm_name) VALUES ( login, password, salt, hash_value, perm_level, perm_name);

COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertCart` (IN `_user_session_id` CHAR(40), IN `_art_id` INT(8), IN `_quantity` INT(3), IN `_date_created` DATETIME, IN `_date_modified` DATETIME)  BEGIN

    START TRANSACTION;

    INSERT INTO carts (user_session_id, art_id, quantity, date_created, date_modified) VALUES (_user_session_id, _art_id, _quantity, _date_created, _date_modified);

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPage` (IN `_url` VARCHAR(255), IN `_parentName` VARCHAR(255), IN `_pageTitle` VARCHAR(255), IN `_pageContent` MEDIUMTEXT)  BEGIN

    START TRANSACTION;

    INSERT INTO pages (url, parentName, pageTitle, pageContent) VALUES (_url, _parentName, _pageTitle, _pageContent);

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertProduct` (IN `_sku` VARCHAR(24), IN `_thumb` VARCHAR(100), IN `_midsize` VARCHAR(100), IN `_style` VARCHAR(50), IN `_price` INT(10), IN `_medium` VARCHAR(50), IN `_artist` VARCHAR(50), IN `_mini_description` VARCHAR(150))  BEGIN

    START TRANSACTION;

    INSERT INTO art (sku, thumb, midsize, style, price, medium, artist, mini_description) VALUES (_sku, _thumb, _midsize, _style, _price, _medium, _artist, _mini_description);

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertUser` (IN `title` TINYTEXT, IN `first_name` VARCHAR(30), IN `last_name` VARCHAR(40), IN `email` VARCHAR(50), IN `password` VARCHAR(90), IN `registration_date` DATETIME, IN `address1` VARCHAR(50), IN `address2` VARCHAR(50), IN `city` VARCHAR(50), IN `state` CHAR(25), IN `country` CHAR(25), IN `zip_code_post_code` CHAR(10), IN `phone` CHAR(15), IN `secret` VARCHAR(30), IN `user_level` INT(1))  BEGIN

    START TRANSACTION;

    INSERT INTO users ( title, first_name, last_name, email, password, registration_date, address1, address2, city, state, country, zip_code_post_code, phone, secret, user_level) VALUES (title, first_name, last_name, email, password, registration_date, address1, address2, city, state, country, zip_code_post_code, phone, secret, user_level);

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertWishlist` (IN `_user_session_id` CHAR(40), IN `_art_id` INT(8), IN `_quantity` INT(3), IN `_date_created` DATETIME, IN `_date_modified` DATETIME)  BEGIN

    START TRANSACTION;

    INSERT INTO wish_lists (user_session_id, art_id, quantity, date_created, date_modified) VALUES (_user_session_id, _art_id, _quantity, _date_created, _date_modified);

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateActiveCategories` (IN `_art_by_style` TINYINT(1), IN `_art_popular` TINYINT(1), IN `_art_by_price` TINYINT(1), IN `_art_sale` TINYINT(1), IN `_art_by_medium` TINYINT(1))  BEGIN

    START TRANSACTION;

    UPDATE active_categories SET category_active = _art_by_style WHERE category_description = 'art_by_style';
    UPDATE active_categories SET category_active = _art_popular WHERE category_description = 'popular_products';
    UPDATE active_categories SET category_active = _art_by_price WHERE category_description = 'art_by_price';
    UPDATE active_categories SET category_active = _art_sale WHERE category_description = 'art_on_sale';
    UPDATE active_categories SET category_active = _art_by_medium WHERE category_description = 'art_by_medium';

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePage` (IN `_page_id` SMALLINT(5), IN `_url` VARCHAR(255), IN `_parentName` VARCHAR(255), IN `_pageTitle` VARCHAR(255), IN `_pageContent` MEDIUMTEXT)  BEGIN

    START TRANSACTION;

    UPDATE pages SET url=_url, parentName=_parentName, pageTitle=_pageTitle, pageContent=_pageContent WHERE page_id = _page_id;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateProduct` (IN `_art_id` INT(8), IN `_sku` VARCHAR(24), IN `_thumb` VARCHAR(100), IN `_midsize` VARCHAR(100), IN `_large` VARCHAR(100), IN `_style` VARCHAR(50), IN `_price` INT(10), IN `_medium` VARCHAR(50), IN `_artist` VARCHAR(50), IN `_mini_description` VARCHAR(150))  BEGIN

    START TRANSACTION;

    UPDATE art SET sku=_sku, thumb=_thumb, midsize=_midsize, style=_style, large=_large, price=_price, medium=_medium, artist=_artist, mini_description=_mini_description WHERE art_id = _art_id;

    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateUser` (IN `_user_id` MEDIUMINT(6), IN `title` TINYTEXT, IN `first_name` VARCHAR(30), IN `last_name` VARCHAR(40), IN `email` VARCHAR(50), IN `address1` VARCHAR(50), IN `address2` VARCHAR(50), IN `city` VARCHAR(50), IN `state` CHAR(25), IN `country` CHAR(25), IN `zip_code_post_code` CHAR(10), IN `phone` CHAR(15), IN `secret` VARCHAR(30), IN `user_level` INT(1), IN `date_modified` DATETIME)  BEGIN

    START TRANSACTION;

    UPDATE users SET title=title, first_name=first_name, last_name=last_name, email=email, address1=address1, address2=address2, city=city, state=state, country=country, zip_code_post_code=zip_code_post_code, phone=phone, secret=secret, user_level=user_level, date_modified=date_modified WHERE user_id = _user_id;

    COMMIT;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `active_categories`
--

CREATE TABLE `active_categories` (
  `category_id` int(2) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `category_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `active_categories`
--

INSERT INTO `active_categories` (`category_id`, `category_description`, `category_active`) VALUES
(1, 'art_by_style', 1),
(2, 'popular_products', 0),
(6, 'art_by_price', 1),
(7, 'art_on_sale', 0),
(10, 'art_by_medium', 1);

-- --------------------------------------------------------

--
-- Table structure for table `art`
--

CREATE TABLE `art` (
  `art_id` int(8) UNSIGNED NOT NULL,
  `sku` varchar(24) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `midsize` varchar(100) NOT NULL,
  `large` varchar(100) NOT NULL,
  `style` varchar(50) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `medium` varchar(50) NOT NULL,
  `artist` varchar(50) NOT NULL,
  `mini_description` varchar(150) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `art`
--

INSERT INTO `art` (`art_id`, `sku`, `thumb`, `midsize`, `large`, `style`, `price`, `medium`, `artist`, `mini_description`, `deleted`) VALUES
(1, 'VGV1', 'product_images/thumbs/La_Berceuse_Augustine_Roulin_thumb.jpg', 'product_images/midsize/La_Berceuse_Augustine_Roulin_midsize.jpg', 'product_images/large/La_Berceuse_Augustine_Roulin_large.jpg', 'post-impressionism', 10000, 'oil', 'Vincent van Gogh', 'La Berceuse (Augustine Roulin)', 0),
(2, 'VGV2', 'product_images/thumbs/Paul_Gauguin_Man_in_a_Red_Beret_thumb.jpg', 'product_images/midsize/Paul_Gauguin_Man_in_a_Red_Beret_midsize.jpg', 'product_images/large/Paul_Gauguin_Man_in_a_Red_Beret_large.jpg', 'post-impressionism', 10000, 'oil', 'Vincent van Gogh', 'Paul Gauguin (Man in a Red Beret)', 0),
(3, 'VGV3', 'product_images/thumbs/Portrait_of_a_Man_with_a_Moustache_thumb.jpg', 'product_images/midsize/Portrait_of_a_Man_with_a_Moustache_midsize.jpg', 'product_images/large/Portrait_of_a_Man_with_a_Moustache_large.jpg', 'post-impressionism', 780, 'oil', 'Vincent van Gogh', 'Portrait of a Man with a Moustache', 0),
(4, 'VGV4', 'product_images/thumbs/Portrait_of_a_Man_with_a_Skull_Cap_thumb.jpg', 'product_images/midsize/Portrait_of_a_Man_with_a_Skull_Cap_midsize.jpg', 'product_images/large/Portrait_of_a_Man_with_a_Skull_Cap_large.jpg', 'post-impressionism', 2000, 'oil', 'Vincent van Gogh', 'Portrait of a Man with a Skull Cap', 0),
(5, 'VGV5', 'product_images/thumbs/Portrait_of_a_Patient_in_Saint_Paul_Hospital_thumb.jpg', 'product_images/midsize/Portrait_of_a_Patient_in_Saint_Paul_Hospital_midsize.jpg', 'product_images/large/Portrait_of_a_Patient_in_Saint_Paul_Hospital_large.jpg', 'post-impressionism', 200, 'oil', 'Vincent van Gogh', 'Portrait of a Patient in Saint-Paul Hospital', 0),
(6, 'VGV6', 'product_images/thumbs/Portrait_of_a_Woman_Facing_Right_thumb.jpg', 'product_images/midsize/Portrait_of_a_Woman_Facing_Right_midsize.jpg', 'product_images/large/Portrait_of_a_Woman_Facing_Right_large.jpg', 'post-impressionism', 3, 'oil', 'Vincent van Gogh', 'Portrait of a Woman, Facing Right', 0),
(7, 'VGV7', 'product_images/thumbs/Portrait_of_a_Woman_with_Hat_thumb.jpg', 'product_images/midsize/Portrait_of_a_Woman_with_Hat_midsize.jpg', 'product_images/midsize/Portrait_of_a_Woman_with_Hat_large.jpg', 'post-impressionism', 10000, 'oil', 'Vincent van Gogh', 'Portrait of a Woman with Hat', 0),
(8, 'VGV8', 'product_images/thumbs/Potrait_of_a_One_Eyed_Man_thumb.jpg', 'product_images/midsize/Potrait_of_a_One_Eyed_Man_midsize.jpg', 'product_images/large/Potrait_of_a_One_Eyed_Man_large.jpg', 'post-impressionism', 100100, 'oil', 'Vincent van Gogh', 'Portrait of a One-Eyed Man', 0),
(9, 'VGV9', 'product_images/thumbs/Potrait_of_a_Woman_Seated_thumb.jpg', 'product_images/midsize/Potrait_of_a_Woman_Seated_midsize.jpg', 'product_images/large/Potrait_of_a_Woman_Seated_large.jpg', 'post-impressionism', 776, 'oil', 'Vincent van Gogh', 'Portrait of a Woman Seated', 0),
(10, 'VGV10', 'product_images/thumbs/Potrait_of_a_Woman_with_Red_Ribbon_thumb.jpg', 'product_images/midsize/Potrait_of_a_Woman_with_Red_Ribbon_midsize.jpg', 'product_images/large/Potrait_of_a_Woman_with_Red_Ribbon_large.jpg', 'post-impressionism', 50, 'oil', 'Vincent van Gogh', 'Portrait of a Woman with Red Ribbon', 0),
(11, 'RVR1', 'product_images/thumbs/A_Study_of_a_Woman_Asleep_thumb.jpg', 'product_images/midsize/A_Study_of_a_Woman_Asleep_midsize.jpg', 'product_images/large/A_Study_of_a_Woman_Asleep_large.jpg', 'baroque', 10000, 'pencil', 'Rembrandt van Rijn', 'A Study of a Woman Asleep', 0),
(12, 'RVR2', 'product_images/thumbs/A_Woman_with_a_Little_Child_on_her_Lap_thumb.jpg', 'product_images/midsize/A_Woman_with_a_Little_Child_on_her_Lap_midsize.jpg', 'product_images/large/A_Woman_with_a_Little_Child_on_her_Lap_large.jpg', 'baroque', 10, 'pencil', 'Rembrandt van Rijn', 'A Woman with a Little Child on her Lap', 0),
(13, 'RVR3', 'product_images/thumbs/Man_Pulling_a_Rope_thumb.jpg', 'product_images/midsize/Man_Pulling_a_Rope_midsize.jpg', 'product_images/large/Man_Pulling_a_Rope_large.jpg', 'baroque', 6, 'pencil', 'Rembrandt van Rij', 'Man Pulling a Rope', 0),
(14, 'RVR4', 'product_images/thumbs/Self_Portrait_with_Tousled_Hair_thumb.jpg', 'product_images/midsize/Self_Portrait_with_Tousled_Hair_midsize.jpg', 'product_images/large/Self_Portrait_with_Tousled_Hair_large.jpg', 'baroque', 200100, 'pencil', 'Rembrandt van Rijn', 'Self Portrait with Tousled Hair', 0),
(15, 'RVR5', 'product_images/thumbs/Standing_Beggar_Turned_to_the_Right_thumb.jpg', 'product_images/midsize/Standing_Beggar_Turned_to_the_Right_midsize.jpg', 'product_images/large/Standing_Beggar_Turned_to_the_Right_large.jpg', 'baroque', 800, 'pencil', 'Rembrandt van Rijn', 'Standing Beggar Turned to the Right', 0),
(17, 'JV2', 'product_images/thumbs/Diana_and_her_Companions.jpg', 'product_images/midsize/Diana_and_her_Companions_midsize.jpg', 'product_images/large/Diana_and_her_Companions_large.jpg', 'baroque', 30000, 'oil', 'Johannes Vermeer', 'Dianna and her Companions', 0),
(18, 'ABS1', 'product_images/thumbs/Abstract.png', 'product_images/midsize/Abstract.png', 'product_images/large/Abstract_large.png', 'abstract', 75000, 'acrylic', 'Robert Hosin', 'Color Splash', 0),
(19, 'PRP1', 'product_images/thumbs/Contemporary.png', 'product_images/midsize/Contemporary.png', 'product_images/large/Contemporary_large.png', 'mixed-medium', 90000, 'paper-mache', 'Gilbert Ghoss', 'Paper Bird on Wood', 0),
(20, 'PTG1', 'product_images/thumbs/Documents.png', 'product_images/midsize/Documents.png', 'product_images/large/Documents_large.png', 'realism', 50000, 'photography', 'Jack Jones', 'Documents', 0),
(21, 'INK1', 'product_images/thumbs/Ink.png', 'product_images/midsize/Ink.png', 'product_images/large/Ink_large.png', 'ink', 75000, 'ink', 'Ross Halen', 'Ink Blots in Flight', 0),
(22, 'INK1', 'product_images/thumbs/Ink_Melt.png', 'product_images/midsize/Ink_Melt.png', 'product_images/large/Ink_Melt_large.png', 'ink', 60000, 'ink', 'Ross Halen', 'Ink Melt', 0),
(23, 'LDS1', 'product_images/thumbs/Ladies.png', 'product_images/midsize/Ladies.png', 'product_images/large/Ladies_large.png', 'pointillism', 990000, 'oil', 'Hilbert Hogan', 'Ladies at Party', 0),
(24, 'SLH1', 'product_images/thumbs/Mixed.png', 'product_images/midsize/Mixed.png', 'product_images/large/Mixed_large.png', 'mixed-medium', 12489, 'acrylic', 'Fredrick Johnson', 'Paint Rain', 0),
(25, 'CTP1', 'product_images/thumbs/Modern.png', 'product_images/midsize/Modern.png', 'product_images/large/Modern_large.png', 'contemporary', 99000, 'oil', 'Josh Kesney', 'Red Shapes', 0),
(26, 'CHR1', 'product_images/thumbs/Photography.png', 'product_images/midsize/Photography.png', 'product_images/large/Photography_large.png', 'realism', 5000, 'photography', 'Jim Nepert', 'Hanging Chairs', 0),
(27, 'WRT1', 'product_images/thumbs/Photography2.png', 'product_images/midsize/Photography2.png', 'product_images/large/Photography2_large.png', 'realism', 75000, 'photography', 'Bob Kaide', 'Waterfall', 0),
(28, 'SLT1', 'product_images/thumbs/Silloutte.png', 'product_images/midsize/Sillouette.png', 'product_images/large/Sillouette_large.png', 'contemporary', 1900, 'print', 'Derek Thompson', 'Siloutte', 0),
(29, 'TSW1', 'product_images/thumbs/Tidal_Swirl.png', 'product_images/midsize/Tidal_Swirl.png', 'product_images/large/Tidal_Swirl_large.png', 'contemporary', 60000, 'oil', 'Godfrey Ryan', 'Tidal Swirl', 0),
(30, 'CAR1', 'product_images/thumbs/Car_thumb.jpg', 'product_images/midsize/Car_midsize.jpeg', 'product_images/large/Car_large.jpeg', 'photography', 10000, 'photography', 'Viva Vida', 'car under tree', 0);

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `art_id` int(8) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`art_id`, `first_name`, `middle_name`, `last_name`, `deleted`) VALUES
(1, 'Vincent', 'van', 'Gogh', 0),
(2, 'Rembrandt', 'van', 'Rijn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `hash_value` varchar(255) NOT NULL,
  `perm_level` int(11) NOT NULL,
  `perm_name` varchar(255) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `login`, `password`, `salt`, `hash_value`, `perm_level`, `perm_name`, `reset_token`, `deleted`) VALUES
(6, 'admin', 'EhRvJwbi', 'ñØø@!hV’s\r²¡bNq', '$2y$10$z84u7ftEwydEVpzBse1TEuT91v2M8KiUwZx0XcdbTow2OSTftb3fa', 1, 'admin', '', 0),
(7, 'john', '9iOg8$Df', ':åÑ´QÇÌn»C{¬šÅt', '$2y$10$eEiqN.CMjsrSu9VbRf5mBek0TqYoTGRIz3vWauXdIpSPbh17IqTTW', 1, '', '', 0),
(8, 'john', 'eux3c$4Y', '<÷Vgæ‡Ú]ÑäåÇGÐ‚', '$2y$10$NuVXlqvlus.Al1DE5L6RJOHdB/R5MqHscoGeLaNRzMiZb33K/Xcfe', 1, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(10) UNSIGNED NOT NULL,
  `user_session_id` char(40) NOT NULL,
  `art_id` mediumint(8) UNSIGNED NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_session_id`, `art_id`, `quantity`, `date_created`, `date_modified`) VALUES
(1, '', 21, 1, '2020-01-19 13:33:38', '2020-01-19 13:33:38'),
(2, '', 28, 1, '2020-01-19 14:29:29', '2020-01-19 14:29:29'),
(3, '', 28, 1, '2020-01-19 14:34:27', '2020-01-19 14:34:27'),
(4, '', 23, 1, '2020-01-19 14:38:06', '2020-01-19 14:38:06'),
(5, '', 28, 1, '2020-01-19 14:39:28', '2020-01-19 14:39:28'),
(6, '', 28, 1, '2020-01-19 14:39:43', '2020-01-19 14:39:43'),
(7, '', 25, 1, '2020-01-19 15:06:07', '2020-01-19 15:06:07'),
(8, '', 25, 1, '2020-01-19 15:06:46', '2020-01-19 15:06:46'),
(9, '', 25, 1, '2020-01-19 15:11:08', '2020-01-19 15:11:08'),
(10, '', 18, 1, '2020-01-19 15:45:09', '2020-01-19 15:45:09'),
(11, '', 18, 1, '2020-01-19 15:45:51', '2020-01-19 15:45:51'),
(12, '', 18, 1, '2020-01-19 15:48:31', '2020-01-19 15:48:31'),
(13, '', 23, 1, '2020-01-19 15:48:49', '2020-01-19 15:48:49'),
(14, '', 23, 1, '2020-01-19 15:49:21', '2020-01-19 15:49:21'),
(15, '', 29, 1, '2020-01-20 11:25:03', '2020-01-20 11:25:03'),
(16, '', 28, 1, '2020-01-20 11:27:02', '2020-01-20 11:27:02'),
(17, '', 28, 1, '2020-01-20 11:31:38', '2020-01-20 11:31:38'),
(18, '', 28, 7, '2020-01-20 11:42:20', '2020-01-20 11:42:20'),
(19, '', 28, 1, '2020-01-20 11:51:43', '2020-01-20 11:51:43'),
(20, '', 25, 2, '2020-01-20 12:01:33', '2020-01-20 12:01:33'),
(21, '', 25, 1, '2020-01-20 12:03:33', '2020-01-20 12:03:33'),
(22, '', 1, 5, '2020-01-20 12:04:17', '2020-01-20 12:04:17'),
(23, '', 1, 99, '2020-01-20 12:09:20', '2020-01-20 12:09:20'),
(24, '', 1, 99, '2020-01-20 12:10:57', '2020-01-20 12:10:57'),
(25, '', 1, 99, '2020-01-20 12:11:30', '2020-01-20 12:11:30'),
(26, '', 1, 3, '2020-01-20 12:11:48', '2020-01-20 12:11:48'),
(27, '', 1, 5, '2020-01-20 12:12:46', '2020-01-20 12:12:46'),
(28, '', 2, 2, '2020-01-20 12:15:36', '2020-01-20 12:15:36'),
(29, '', 2, 10, '2020-01-20 12:16:10', '2020-01-20 12:16:10'),
(30, '', 2, 9, '2020-01-20 12:16:47', '2020-01-20 12:16:47'),
(31, '', 2, 4, '2020-01-20 12:20:34', '2020-01-20 12:20:34'),
(32, '', 2, 1, '2020-01-20 12:21:16', '2020-01-20 12:21:16'),
(33, '', 2, 10, '2020-01-20 12:21:29', '2020-01-20 12:21:29'),
(34, '', 3, 3, '2020-01-20 12:23:05', '2020-01-20 12:23:05'),
(35, '', 3, 6, '2020-01-20 12:24:47', '2020-01-20 12:24:47'),
(36, '', 3, 6, '2020-01-20 12:25:22', '2020-01-20 12:25:22'),
(37, '', 3, 1, '2020-01-20 12:33:03', '2020-01-20 12:33:03'),
(38, '8upavrfggpc9trfst7lrfm7n17', 3, 1, '2020-01-20 12:36:25', '2020-01-20 12:36:25'),
(39, '8upavrfggpc9trfst7lrfm7n17', 3, 1, '2020-01-20 12:39:29', '2020-01-20 12:39:29');

-- --------------------------------------------------------

--
-- Stand-in structure for view `getactiveproductcategories`
-- (See below for the actual view)
--
CREATE TABLE `getactiveproductcategories` (
`category_id` int(2)
,`category_description` varchar(255)
,`category_active` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `getdistinctmedium`
-- (See below for the actual view)
--
CREATE TABLE `getdistinctmedium` (
`medium` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `getdistinctstyles`
-- (See below for the actual view)
--
CREATE TABLE `getdistinctstyles` (
`style` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `gethomecontent`
-- (See below for the actual view)
--
CREATE TABLE `gethomecontent` (
`page_id` smallint(5) unsigned
,`url` varchar(255)
,`pageTitle` varchar(255)
,`pageContent` mediumtext
,`deleted` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `getproducts`
-- (See below for the actual view)
--
CREATE TABLE `getproducts` (
`art_id` int(8) unsigned
,`sku` varchar(24)
,`thumb` varchar(100)
,`style` varchar(50)
,`price` int(10) unsigned
,`medium` varchar(50)
,`artist` varchar(50)
,`mini_description` varchar(150)
,`deleted` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `geturlparentnamelist`
-- (See below for the actual view)
--
CREATE TABLE `geturlparentnamelist` (
`url` varchar(255)
,`parentName` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `getusercount`
-- (See below for the actual view)
--
CREATE TABLE `getusercount` (
`COUNT(user_id)` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `getusers`
-- (See below for the actual view)
--
CREATE TABLE `getusers` (
`user_id` mediumint(6) unsigned
,`title` tinytext
,`first_name` varchar(30)
,`last_name` varchar(40)
,`email` varchar(50)
,`password` varchar(90)
,`token` varchar(60)
,`registration_date` datetime
,`address1` varchar(50)
,`address2` varchar(50)
,`city` varchar(50)
,`state` char(25)
,`country` char(25)
,`zip_code_post_code` char(10)
,`phone` char(15)
,`secret` varchar(30)
,`user_level` int(1)
,`date_modified` datetime
,`deleted` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(8) UNSIGNED NOT NULL,
  `user_id` int(8) UNSIGNED NOT NULL,
  `art_id` int(8) UNSIGNED NOT NULL,
  `transaction_id` varchar(45) NOT NULL,
  `payment_status` varchar(45) NOT NULL,
  `payment_amount` int(7) UNSIGNED NOT NULL,
  `shipping_amount` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` smallint(5) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `parentName` varchar(255) DEFAULT NULL,
  `pageTitle` varchar(255) NOT NULL,
  `pageContent` mediumtext NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `url`, `parentName`, `pageTitle`, `pageContent`, `deleted`) VALUES
(2, 'home', 'top_menu_item', 'Home', 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0),
(3, 'about', 'top_menu_item', 'About', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0),
(4, 'services', 'top_menu_item', 'Services', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0),
(5, 'blog', 'top_menu_item', 'Blog', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0),
(6, 'sale', NULL, 'Sale', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 1),
(7, 'contact', 'top_menu_item', 'Contact', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0),
(9, 'blog', 'blog', 'Dec. 15th 2019', 'Fun Content', 0),
(10, 'blog', 'blog', 'Dec. 12th 2019', 'Lorem Ipsum', 0),
(11, 'about', 'about', 'About 2', 'Lorem Ipsum About 2', 0),
(12, 'about', 'about', 'About 3', 'Lorem Ipsum 3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` mediumint(6) UNSIGNED NOT NULL,
  `title` tinytext,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(90) NOT NULL,
  `token` varchar(60) DEFAULT NULL,
  `registration_date` datetime NOT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` char(25) DEFAULT NULL,
  `country` char(25) DEFAULT NULL,
  `zip_code_post_code` char(10) DEFAULT NULL,
  `phone` char(15) DEFAULT NULL,
  `secret` varchar(30) NOT NULL,
  `user_level` int(1) NOT NULL DEFAULT '0',
  `date_modified` datetime NOT NULL,
  `deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `title`, `first_name`, `last_name`, `email`, `password`, `token`, `registration_date`, `address1`, `address2`, `city`, `state`, `country`, `zip_code_post_code`, `phone`, `secret`, `user_level`, `date_modified`, `deleted`) VALUES
(1, 'c', 'c', 'c', 'c', '$2y$10$JDckrDMStEGaKonmdl2T0exJjX4dJbd6fgqnJLLzDQhWqYLd/yB9W', NULL, '2019-12-05 08:10:32', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 0, '2019-12-06 13:47:59', 1),
(2, 'Ms.', 'Jeanie', 'Dungarie', 'jeanie.dungarie@isp.net', '$2y$10$c89S4pZjliGE8VS37roSCu.ws9V340l6KCnaZ1ADhUMwDWX6/zkNO', NULL, '2019-11-27 05:20:47', '101 Salmon St.', '#303', 'Brisbane', 'N/A', 'Australia', 'AK10292', '005128274838', 'kangaroo', 1, '0000-00-00 00:00:00', 0),
(3, 'Mr.', 'Johnny', 'Jacob', 'john.jacob@isp.net', '$2y$10$xiN6nsumy313gpLtNvDe2u6BIHje5E5qtInJ9PYvHVTA81QvuyqxK', NULL, '2019-11-22 07:50:07', '123 Fake St.', '# 101', 'Los Angeles', 'CA', 'USA', '91011', '555-555-5555', 'umbrellas', 0, '0000-00-00 00:00:00', 0),
(4, 'Ms.', 'Tiny', 'Tim', 'tiny.tim@isp.net', '$2y$10$H/LPIPCXLnWXAyF0bLZMHOe0rZykSQUym9uBJWiEv/MsHfD27yxOS', NULL, '2019-11-01 00:00:00', '555 Fake St.', NULL, 'Jerusalem', '', 'Israel', 'AB1234', '0051245893993', 'fish', 0, '0000-00-00 00:00:00', 0),
(5, 'Ms.', 'Rainbow', 'Jimbow', 'janie.jimbow@isp.net', '$2y$10$H/LPIPCXLnWXAyF0bLZMHOe0rZykSQUym9uBJWiEv/MsHfD27yxOS', NULL, '2019-10-07 00:00:00', '789 Apple St.', '#401', 'St. Louis', 'MO', 'USA', '61882', '555-555-5555', 'car', 0, '2019-12-06 14:08:34', 0),
(6, 'Mr', 'Jean', 'Kearny', 'john.kearny@isp.net', '$2y$10$H/LPIPCXLnWXAyF0bLZMHOe0rZykSQUym9uBJWiEv/MsHfD27yxOS', NULL, '2019-11-19 00:00:00', '345 Tail Lane', '2', 'Jupiter', 'FL', 'USA', '51612', '555-555-5555', 'alligator', 0, '0000-00-00 00:00:00', 0),
(7, 'Dr.', 'Robotic', 'Lovestrange', 'robo.strange@isp.net', '$2y$10$Trej/v7ePnx5JDJnkhP4DuAdxquBb.UPF.I2CemybmBvydK8PttOC', NULL, '2019-11-22 14:10:52', '999 Downtown St.', 'NULL', 'Downtown', 'WA', 'XYZ', '91919', '111-111-1111', 'orange', 0, '2019-12-06 13:52:02', 1),
(8, 'Capt.', 'Planet', 'Orbitor', 'planet@planet.com', '$2y$10$7Ot8jQ75hC6tyxChPuoSu.ZaX6hbFRaJOEOyAMpLfWJhU3dYqwskC', NULL, '2019-12-06 14:11:36', 'Mars', 'Colony1', 'New Colony 11', 'Geodorphous Region', 'Mars', '000000', '0', 'mars', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wish_lists`
--

CREATE TABLE `wish_lists` (
  `wish_list_id` int(10) UNSIGNED NOT NULL,
  `user_session_id` char(32) NOT NULL,
  `art_id` mediumint(8) UNSIGNED NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wish_lists`
--

INSERT INTO `wish_lists` (`wish_list_id`, `user_session_id`, `art_id`, `quantity`, `date_created`, `date_modified`) VALUES
(1, '8upavrfggpc9trfst7lrfm7n17', 3, 1, '2020-01-20 12:56:39', '2020-01-20 12:56:39'),
(2, '8upavrfggpc9trfst7lrfm7n17', 4, 4, '2020-01-20 12:57:54', '2020-01-20 12:57:54');

-- --------------------------------------------------------

--
-- Structure for view `getactiveproductcategories`
--
DROP TABLE IF EXISTS `getactiveproductcategories`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getactiveproductcategories`  AS  select `active_categories`.`category_id` AS `category_id`,`active_categories`.`category_description` AS `category_description`,`active_categories`.`category_active` AS `category_active` from `active_categories` where (`active_categories`.`category_active` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `getdistinctmedium`
--
DROP TABLE IF EXISTS `getdistinctmedium`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getdistinctmedium`  AS  select distinct `art`.`medium` AS `medium` from `art` ;

-- --------------------------------------------------------

--
-- Structure for view `getdistinctstyles`
--
DROP TABLE IF EXISTS `getdistinctstyles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getdistinctstyles`  AS  select distinct `art`.`style` AS `style` from `art` ;

-- --------------------------------------------------------

--
-- Structure for view `gethomecontent`
--
DROP TABLE IF EXISTS `gethomecontent`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `gethomecontent`  AS  select `pages`.`page_id` AS `page_id`,`pages`.`url` AS `url`,`pages`.`pageTitle` AS `pageTitle`,`pages`.`pageContent` AS `pageContent`,`pages`.`deleted` AS `deleted` from `pages` where (`pages`.`url` = 'home') ;

-- --------------------------------------------------------

--
-- Structure for view `getproducts`
--
DROP TABLE IF EXISTS `getproducts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getproducts`  AS  select `art`.`art_id` AS `art_id`,`art`.`sku` AS `sku`,`art`.`thumb` AS `thumb`,`art`.`style` AS `style`,`art`.`price` AS `price`,`art`.`medium` AS `medium`,`art`.`artist` AS `artist`,`art`.`mini_description` AS `mini_description`,`art`.`deleted` AS `deleted` from `art` limit 50 ;

-- --------------------------------------------------------

--
-- Structure for view `geturlparentnamelist`
--
DROP TABLE IF EXISTS `geturlparentnamelist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `geturlparentnamelist`  AS  select `pages`.`url` AS `url`,`pages`.`parentName` AS `parentName` from `pages` where (`pages`.`deleted` = 0) ;

-- --------------------------------------------------------

--
-- Structure for view `getusercount`
--
DROP TABLE IF EXISTS `getusercount`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getusercount`  AS  select count(`users`.`user_id`) AS `COUNT(user_id)` from `users` ;

-- --------------------------------------------------------

--
-- Structure for view `getusers`
--
DROP TABLE IF EXISTS `getusers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getusers`  AS  select `users`.`user_id` AS `user_id`,`users`.`title` AS `title`,`users`.`first_name` AS `first_name`,`users`.`last_name` AS `last_name`,`users`.`email` AS `email`,`users`.`password` AS `password`,`users`.`token` AS `token`,`users`.`registration_date` AS `registration_date`,`users`.`address1` AS `address1`,`users`.`address2` AS `address2`,`users`.`city` AS `city`,`users`.`state` AS `state`,`users`.`country` AS `country`,`users`.`zip_code_post_code` AS `zip_code_post_code`,`users`.`phone` AS `phone`,`users`.`secret` AS `secret`,`users`.`user_level` AS `user_level`,`users`.`date_modified` AS `date_modified`,`users`.`deleted` AS `deleted` from `users` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_categories`
--
ALTER TABLE `active_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `art`
--
ALTER TABLE `art`
  ADD PRIMARY KEY (`art_id`),
  ADD KEY `price` (`price`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`art_id`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wish_lists`
--
ALTER TABLE `wish_lists`
  ADD PRIMARY KEY (`wish_list_id`),
  ADD KEY `user_session_id` (`user_session_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_categories`
--
ALTER TABLE `active_categories`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `art`
--
ALTER TABLE `art`
  MODIFY `art_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `art_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wish_lists`
--
ALTER TABLE `wish_lists`
  MODIFY `wish_list_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
