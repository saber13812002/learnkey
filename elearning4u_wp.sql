-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2016 at 07:05 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning4u_wp`
--

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_commentmeta`
--

CREATE TABLE `d_wp_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_comments`
--

CREATE TABLE `d_wp_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_wp_comments`
--

INSERT INTO `d_wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Mr WordPress', '', 'https://wordpress.org/', '', '2014-11-01 09:02:00', '2014-11-01 09:02:00', 'Hi, this is a comment.\\nTo delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.', 0, '1', '', '', 0, 0),
(2, 1, 'Catherine', 'fxfubugwn@aim.com', 'http://cabkit.in/9mt5', '23.94.181.74', '2015-03-29 22:58:58', '2015-03-29 22:58:58', 'Hi, my name is Catherine and I am the sales manager at StarSEO Marketing. I was just looking at your Hello world! | آموزش مجازی site and see that your site has the potential to get a lot of visitors. I just want to tell you, In case you don\'t already know... There is a website network which already has more than 16 million users, and most of the users are looking for topics like yours. By getting your website on this service you have a chance to get your site more visitors than you can imagine. It is free to sign up and you can find out more about it here: http://9n3.us/6hpy - Now, let me ask you... Do you need your website to be successful to maintain your way of life? Do you need targeted visitors who are interested in the services and products you offer? Are looking for exposure, to increase sales, and to quickly develop awareness for your website? If your answer is YES, you can achieve these things only if you get your site on the service I am describing. This traffic service advertises you to thousands, while also giving you a chance to test the service before paying anything. All the popular sites are using this network to boost their readership and ad revenue! Why aren’t you? And what is better than traffic? It’s recurring traffic! That\'s how running a successful site works... Here\'s to your success! Read more here: http://9n3.us/6hpy', 0, '0', 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)', '', 0, 0),
(3, 1, 'Emily', 'mjtlkaoqxz@gmail.com', 'http://yxbp.com/9xxk', '23.95.215.121', '2016-05-08 05:27:01', '2016-05-08 05:27:01', 'If you need more traffic to your Hello world!  |  آموزش مجازی website you can try a keyword targeted traffic service free for 7 days here: http://nfc.lol/9h3i', 0, '0', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', '', 0, 0),
(4, 1, 'Donna', 'gtddizj@gmail.com', 'http://yxbp.com/87dm', '45.40.46.119', '2016-05-12 03:38:20', '2016-05-12 03:38:20', 'Did you just create your new Facebook page? Do you want your page to look a little more \"established\"? I found a service that can help you with that. They can send organic and 100% real likes and followers to your social pages and you can try before you buy with their free trial. Their service is completely safe and they send all likes to your page naturally and over time so nobody will suspect that you bought them. Try their service for free here: http://janluetzler.de/3vm2', 0, '0', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', '', 0, 0),
(5, 1, 'Bella', 'tqtpxxambxb@gmail.com', 'http://yxbp.com/9xxk', '23.95.212.116', '2016-05-20 09:09:36', '2016-05-20 09:09:36', 'There are thousands of targeted website viewers ready to view your website, get started for free today: http://shrtlnk.de/9jc2', 0, '0', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_links`
--

CREATE TABLE `d_wp_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_options`
--

CREATE TABLE `d_wp_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_wp_options`
--

INSERT INTO `d_wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://elearning4u.ir', 'yes'),
(2, 'blogname', 'آموزش مجازی', 'yes'),
(3, 'blogdescription', 'وبسایت آموزشی', 'yes'),
(4, 'users_can_register', '0', 'yes'),
(5, 'admin_email', 'mesbahsoft@gmail.com', 'yes'),
(6, 'start_of_week', '1', 'yes'),
(7, 'use_balanceTags', '0', 'yes'),
(8, 'use_smilies', '1', 'yes'),
(9, 'require_name_email', '1', 'yes'),
(10, 'comments_notify', '1', 'yes'),
(11, 'posts_per_rss', '10', 'yes'),
(12, 'rss_use_excerpt', '0', 'yes'),
(13, 'mailserver_url', 'mail.example.com', 'yes'),
(14, 'mailserver_login', 'login@example.com', 'yes'),
(15, 'mailserver_pass', 'password', 'yes'),
(16, 'mailserver_port', '110', 'yes'),
(17, 'default_category', '1', 'yes'),
(18, 'default_comment_status', 'open', 'yes'),
(19, 'default_ping_status', 'open', 'yes'),
(20, 'default_pingback_flag', '1', 'yes'),
(21, 'posts_per_page', '10', 'yes'),
(22, 'date_format', 'F j, Y', 'yes'),
(23, 'time_format', 'g:i a', 'yes'),
(24, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(25, 'comment_moderation', '0', 'yes'),
(26, 'moderation_notify', '1', 'yes'),
(27, 'permalink_structure', '', 'yes'),
(28, 'gzipcompression', '0', 'yes'),
(29, 'hack_file', '0', 'yes'),
(30, 'blog_charset', 'UTF-8', 'yes'),
(31, 'moderation_keys', '', 'no'),
(32, 'active_plugins', 'a:7:{i:0;s:36:\"contact-form-7/wp-contact-form-7.php\";i:1;s:32:\"links-dropdown-widget/plugin.php\";i:2;s:43:\"persian-woocommerce/woocommerce-persian.php\";i:3;s:25:\"podcasting/podcasting.php\";i:4;s:11:\"put/put.php\";i:5;s:27:\"woocommerce/woocommerce.php\";i:6;s:23:\"wp-jalali/wp-jalali.php\";}', 'yes'),
(33, 'home', 'http://elearning4u.ir', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'advanced_edit', '0', 'yes'),
(37, 'comment_max_links', '2', 'yes'),
(38, 'gmt_offset', '0', 'yes'),
(39, 'default_email_category', '1', 'yes'),
(40, 'recently_edited', 'a:5:{i:0;s:77:\"C:\\Inetpub\\vhosts\\learnkey.ir\\elearning4u/wp-content/themes/classic/index.php\";i:2;s:77:\"C:\\Inetpub\\vhosts\\learnkey.ir\\elearning4u/wp-content/themes/classic/style.css\";i:3;s:82:\"C:\\Inetpub\\vhosts\\learnkey.ir\\elearning4u/wp-content/themes/twentyfourteen/404.php\";i:4;s:84:\"C:\\Inetpub\\vhosts\\learnkey.ir\\elearning4u/wp-content/themes/twentyfourteen/style.css\";i:5;s:80:\"C:\\Inetpub\\vhosts\\learnkey.ir\\elearning4u/wp-content/themes/superstore/style.css\";}', 'no'),
(41, 'template', 'woostore', 'yes'),
(42, 'stylesheet', 'woostore', 'yes'),
(43, 'comment_whitelist', '1', 'yes'),
(44, 'blacklist_keys', '', 'no'),
(45, 'comment_registration', '0', 'yes'),
(46, 'html_type', 'text/html', 'yes'),
(47, 'use_trackback', '0', 'yes'),
(48, 'default_role', 'subscriber', 'yes'),
(49, 'db_version', '33056', 'yes'),
(50, 'uploads_use_yearmonth_folders', '1', 'yes'),
(51, 'upload_path', '', 'yes'),
(52, 'blog_public', '1', 'yes'),
(53, 'default_link_category', '2', 'yes'),
(54, 'show_on_front', 'posts', 'yes'),
(55, 'tag_base', '', 'yes'),
(56, 'show_avatars', '1', 'yes'),
(57, 'avatar_rating', 'G', 'yes'),
(58, 'upload_url_path', '', 'yes'),
(59, 'thumbnail_size_w', '150', 'yes'),
(60, 'thumbnail_size_h', '150', 'yes'),
(61, 'thumbnail_crop', '1', 'yes'),
(62, 'medium_size_w', '300', 'yes'),
(63, 'medium_size_h', '300', 'yes'),
(64, 'avatar_default', 'mystery', 'yes'),
(65, 'large_size_w', '1024', 'yes'),
(66, 'large_size_h', '1024', 'yes'),
(67, 'image_default_link_type', 'file', 'yes'),
(68, 'image_default_size', '', 'yes'),
(69, 'image_default_align', '', 'yes'),
(70, 'close_comments_for_old_posts', '0', 'yes'),
(71, 'close_comments_days_old', '14', 'yes'),
(72, 'thread_comments', '1', 'yes'),
(73, 'thread_comments_depth', '5', 'yes'),
(74, 'page_comments', '0', 'yes'),
(75, 'comments_per_page', '50', 'yes'),
(76, 'default_comments_page', 'newest', 'yes'),
(77, 'comment_order', 'asc', 'yes'),
(78, 'sticky_posts', 'a:0:{}', 'yes'),
(79, 'widget_categories', 'a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(80, 'widget_text', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(81, 'widget_rss', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(82, 'uninstall_plugins', 'a:0:{}', 'no'),
(83, 'timezone_string', '', 'yes'),
(84, 'page_for_posts', '0', 'yes'),
(85, 'page_on_front', '0', 'yes'),
(86, 'default_post_format', '0', 'yes'),
(87, 'link_manager_enabled', '0', 'yes'),
(88, 'initial_db_version', '29630', 'yes'),
(89, 'd_wp_user_roles', 'a:7:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:132:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:9:\"add_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;s:18:\"manage_woocommerce\";b:1;s:24:\"view_woocommerce_reports\";b:1;s:12:\"edit_product\";b:1;s:12:\"read_product\";b:1;s:14:\"delete_product\";b:1;s:13:\"edit_products\";b:1;s:20:\"edit_others_products\";b:1;s:16:\"publish_products\";b:1;s:21:\"read_private_products\";b:1;s:15:\"delete_products\";b:1;s:23:\"delete_private_products\";b:1;s:25:\"delete_published_products\";b:1;s:22:\"delete_others_products\";b:1;s:21:\"edit_private_products\";b:1;s:23:\"edit_published_products\";b:1;s:20:\"manage_product_terms\";b:1;s:18:\"edit_product_terms\";b:1;s:20:\"delete_product_terms\";b:1;s:20:\"assign_product_terms\";b:1;s:15:\"edit_shop_order\";b:1;s:15:\"read_shop_order\";b:1;s:17:\"delete_shop_order\";b:1;s:16:\"edit_shop_orders\";b:1;s:23:\"edit_others_shop_orders\";b:1;s:19:\"publish_shop_orders\";b:1;s:24:\"read_private_shop_orders\";b:1;s:18:\"delete_shop_orders\";b:1;s:26:\"delete_private_shop_orders\";b:1;s:28:\"delete_published_shop_orders\";b:1;s:25:\"delete_others_shop_orders\";b:1;s:24:\"edit_private_shop_orders\";b:1;s:26:\"edit_published_shop_orders\";b:1;s:23:\"manage_shop_order_terms\";b:1;s:21:\"edit_shop_order_terms\";b:1;s:23:\"delete_shop_order_terms\";b:1;s:23:\"assign_shop_order_terms\";b:1;s:16:\"edit_shop_coupon\";b:1;s:16:\"read_shop_coupon\";b:1;s:18:\"delete_shop_coupon\";b:1;s:17:\"edit_shop_coupons\";b:1;s:24:\"edit_others_shop_coupons\";b:1;s:20:\"publish_shop_coupons\";b:1;s:25:\"read_private_shop_coupons\";b:1;s:19:\"delete_shop_coupons\";b:1;s:27:\"delete_private_shop_coupons\";b:1;s:29:\"delete_published_shop_coupons\";b:1;s:26:\"delete_others_shop_coupons\";b:1;s:25:\"edit_private_shop_coupons\";b:1;s:27:\"edit_published_shop_coupons\";b:1;s:24:\"manage_shop_coupon_terms\";b:1;s:22:\"edit_shop_coupon_terms\";b:1;s:24:\"delete_shop_coupon_terms\";b:1;s:24:\"assign_shop_coupon_terms\";b:1;s:17:\"edit_shop_webhook\";b:1;s:17:\"read_shop_webhook\";b:1;s:19:\"delete_shop_webhook\";b:1;s:18:\"edit_shop_webhooks\";b:1;s:25:\"edit_others_shop_webhooks\";b:1;s:21:\"publish_shop_webhooks\";b:1;s:26:\"read_private_shop_webhooks\";b:1;s:20:\"delete_shop_webhooks\";b:1;s:28:\"delete_private_shop_webhooks\";b:1;s:30:\"delete_published_shop_webhooks\";b:1;s:27:\"delete_others_shop_webhooks\";b:1;s:26:\"edit_private_shop_webhooks\";b:1;s:28:\"edit_published_shop_webhooks\";b:1;s:25:\"manage_shop_webhook_terms\";b:1;s:23:\"edit_shop_webhook_terms\";b:1;s:25:\"delete_shop_webhook_terms\";b:1;s:25:\"assign_shop_webhook_terms\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}s:8:\"customer\";a:2:{s:4:\"name\";s:8:\"Customer\";s:12:\"capabilities\";a:3:{s:4:\"read\";b:1;s:10:\"edit_posts\";b:0;s:12:\"delete_posts\";b:0;}}s:12:\"shop_manager\";a:2:{s:4:\"name\";s:12:\"Shop Manager\";s:12:\"capabilities\";a:110:{s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:4:\"read\";b:1;s:18:\"read_private_pages\";b:1;s:18:\"read_private_posts\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_posts\";b:1;s:10:\"edit_pages\";b:1;s:20:\"edit_published_posts\";b:1;s:20:\"edit_published_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"edit_private_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:17:\"edit_others_pages\";b:1;s:13:\"publish_posts\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_posts\";b:1;s:12:\"delete_pages\";b:1;s:20:\"delete_private_pages\";b:1;s:20:\"delete_private_posts\";b:1;s:22:\"delete_published_pages\";b:1;s:22:\"delete_published_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:19:\"delete_others_pages\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:17:\"moderate_comments\";b:1;s:15:\"unfiltered_html\";b:1;s:12:\"upload_files\";b:1;s:6:\"export\";b:1;s:6:\"import\";b:1;s:10:\"list_users\";b:1;s:18:\"manage_woocommerce\";b:1;s:24:\"view_woocommerce_reports\";b:1;s:12:\"edit_product\";b:1;s:12:\"read_product\";b:1;s:14:\"delete_product\";b:1;s:13:\"edit_products\";b:1;s:20:\"edit_others_products\";b:1;s:16:\"publish_products\";b:1;s:21:\"read_private_products\";b:1;s:15:\"delete_products\";b:1;s:23:\"delete_private_products\";b:1;s:25:\"delete_published_products\";b:1;s:22:\"delete_others_products\";b:1;s:21:\"edit_private_products\";b:1;s:23:\"edit_published_products\";b:1;s:20:\"manage_product_terms\";b:1;s:18:\"edit_product_terms\";b:1;s:20:\"delete_product_terms\";b:1;s:20:\"assign_product_terms\";b:1;s:15:\"edit_shop_order\";b:1;s:15:\"read_shop_order\";b:1;s:17:\"delete_shop_order\";b:1;s:16:\"edit_shop_orders\";b:1;s:23:\"edit_others_shop_orders\";b:1;s:19:\"publish_shop_orders\";b:1;s:24:\"read_private_shop_orders\";b:1;s:18:\"delete_shop_orders\";b:1;s:26:\"delete_private_shop_orders\";b:1;s:28:\"delete_published_shop_orders\";b:1;s:25:\"delete_others_shop_orders\";b:1;s:24:\"edit_private_shop_orders\";b:1;s:26:\"edit_published_shop_orders\";b:1;s:23:\"manage_shop_order_terms\";b:1;s:21:\"edit_shop_order_terms\";b:1;s:23:\"delete_shop_order_terms\";b:1;s:23:\"assign_shop_order_terms\";b:1;s:16:\"edit_shop_coupon\";b:1;s:16:\"read_shop_coupon\";b:1;s:18:\"delete_shop_coupon\";b:1;s:17:\"edit_shop_coupons\";b:1;s:24:\"edit_others_shop_coupons\";b:1;s:20:\"publish_shop_coupons\";b:1;s:25:\"read_private_shop_coupons\";b:1;s:19:\"delete_shop_coupons\";b:1;s:27:\"delete_private_shop_coupons\";b:1;s:29:\"delete_published_shop_coupons\";b:1;s:26:\"delete_others_shop_coupons\";b:1;s:25:\"edit_private_shop_coupons\";b:1;s:27:\"edit_published_shop_coupons\";b:1;s:24:\"manage_shop_coupon_terms\";b:1;s:22:\"edit_shop_coupon_terms\";b:1;s:24:\"delete_shop_coupon_terms\";b:1;s:24:\"assign_shop_coupon_terms\";b:1;s:17:\"edit_shop_webhook\";b:1;s:17:\"read_shop_webhook\";b:1;s:19:\"delete_shop_webhook\";b:1;s:18:\"edit_shop_webhooks\";b:1;s:25:\"edit_others_shop_webhooks\";b:1;s:21:\"publish_shop_webhooks\";b:1;s:26:\"read_private_shop_webhooks\";b:1;s:20:\"delete_shop_webhooks\";b:1;s:28:\"delete_private_shop_webhooks\";b:1;s:30:\"delete_published_shop_webhooks\";b:1;s:27:\"delete_others_shop_webhooks\";b:1;s:26:\"edit_private_shop_webhooks\";b:1;s:28:\"edit_published_shop_webhooks\";b:1;s:25:\"manage_shop_webhook_terms\";b:1;s:23:\"edit_shop_webhook_terms\";b:1;s:25:\"delete_shop_webhook_terms\";b:1;s:25:\"assign_shop_webhook_terms\";b:1;}}}', 'yes'),
(90, 'widget_search', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(91, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(92, 'widget_recent-comments', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(93, 'widget_archives', 'a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(94, 'widget_meta', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(95, 'sidebars_widgets', 'a:7:{s:19:\"wp_inactive_widgets\";a:1:{i:0;s:8:\"search-2\";}s:18:\"orphaned_widgets_1\";a:3:{i:0;s:14:\"recent-posts-2\";i:1;s:10:\"archives-2\";i:2;s:12:\"categories-2\";}s:18:\"orphaned_widgets_2\";a:0:{}s:18:\"orphaned_widgets_3\";a:0:{}s:18:\"orphaned_widgets_4\";a:0:{}s:18:\"orphaned_widgets_5\";a:0:{}s:13:\"array_version\";i:3;}', 'yes'),
(96, 'cron', 'a:8:{i:1480145580;a:1:{s:20:\"wp_maybe_auto_update\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1480149042;a:1:{s:32:\"woocommerce_cancel_unpaid_orders\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:2:{s:8:\"schedule\";b:0;s:4:\"args\";a:0:{}}}}i:1480151072;a:3:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1480152756;a:1:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1480152836;a:1:{s:28:\"woocommerce_cleanup_sessions\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1480204800;a:1:{s:27:\"woocommerce_scheduled_sales\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1480227710;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}s:7:\"version\";i:2;}', 'yes'),
(99, '_transient_random_seed', 'c596342c0686f6b3769d9197361582e3', 'yes'),
(156, 'recently_activated', 'a:1:{s:25:\"powerpress/powerpress.php\";i:1418808185;}', 'yes'),
(160, 'woocommerce_default_country', 'IR:QM', 'yes'),
(161, 'woocommerce_allowed_countries', 'specific', 'yes'),
(162, 'woocommerce_specific_allowed_countries', 'a:1:{i:0;s:2:\"IR\";}', 'yes'),
(163, 'woocommerce_demo_store', 'no', 'yes'),
(164, 'woocommerce_demo_store_notice', 'This is a demo store for testing purposes — no orders shall be fulfilled.', 'no'),
(165, 'woocommerce_api_enabled', 'yes', 'yes'),
(166, 'woocommerce_currency', 'IRR', 'yes'),
(167, 'woocommerce_currency_pos', 'right_space', 'yes'),
(168, 'woocommerce_price_thousand_sep', ',', 'yes'),
(169, 'woocommerce_price_decimal_sep', '.', 'yes'),
(170, 'woocommerce_price_num_decimals', '2', 'yes'),
(171, 'woocommerce_enable_lightbox', 'no', 'yes'),
(172, 'woocommerce_enable_chosen', 'yes', 'no'),
(173, 'woocommerce_shop_page_id', '11', 'yes'),
(174, 'woocommerce_shop_page_display', '', 'yes'),
(175, 'woocommerce_category_archive_display', '', 'yes'),
(176, 'woocommerce_default_catalog_orderby', 'popularity', 'yes'),
(177, 'woocommerce_cart_redirect_after_add', 'no', 'yes'),
(178, 'woocommerce_enable_ajax_add_to_cart', 'yes', 'yes'),
(179, 'woocommerce_weight_unit', 'g', 'yes'),
(180, 'woocommerce_dimension_unit', 'cm', 'yes'),
(181, 'woocommerce_enable_review_rating', 'yes', 'no'),
(182, 'woocommerce_review_rating_required', 'yes', 'no'),
(183, 'woocommerce_review_rating_verification_label', 'yes', 'no'),
(184, 'woocommerce_review_rating_verification_required', 'yes', 'no'),
(185, 'shop_catalog_image_size', 'a:3:{s:5:\"width\";s:3:\"150\";s:6:\"height\";s:3:\"150\";s:4:\"crop\";s:1:\"1\";}', 'yes'),
(186, 'shop_single_image_size', 'a:3:{s:5:\"width\";s:3:\"300\";s:6:\"height\";s:3:\"300\";s:4:\"crop\";s:1:\"1\";}', 'yes'),
(187, 'shop_thumbnail_image_size', 'a:3:{s:5:\"width\";s:2:\"90\";s:6:\"height\";s:2:\"90\";s:4:\"crop\";s:1:\"1\";}', 'yes'),
(188, 'woocommerce_file_download_method', 'force', 'no'),
(189, 'woocommerce_downloads_require_login', 'yes', 'no'),
(190, 'woocommerce_downloads_grant_access_after_payment', 'yes', 'no'),
(191, 'woocommerce_manage_stock', 'yes', 'yes'),
(192, 'woocommerce_hold_stock_minutes', '60', 'no'),
(193, 'woocommerce_notify_low_stock', 'yes', 'no'),
(194, 'woocommerce_notify_no_stock', 'yes', 'no'),
(195, 'woocommerce_stock_email_recipient', 'mesbahsoft@gmail.com', 'no'),
(196, 'woocommerce_notify_low_stock_amount', '2', 'no'),
(197, 'woocommerce_notify_no_stock_amount', '0', 'no'),
(198, 'woocommerce_hide_out_of_stock_items', 'no', 'yes'),
(199, 'woocommerce_stock_format', '', 'yes'),
(200, 'woocommerce_calc_taxes', 'yes', 'yes'),
(201, 'woocommerce_prices_include_tax', 'no', 'yes'),
(202, 'woocommerce_tax_based_on', 'shipping', 'yes'),
(203, 'woocommerce_default_customer_address', 'base', 'yes'),
(204, 'woocommerce_shipping_tax_class', '', 'yes'),
(205, 'woocommerce_tax_round_at_subtotal', 'no', 'yes'),
(206, 'woocommerce_tax_classes', 'Reduced Rate\\r\\nZero Rate', 'yes'),
(207, 'woocommerce_tax_display_shop', 'excl', 'yes'),
(208, 'woocommerce_price_display_suffix', '', 'yes'),
(209, 'woocommerce_tax_display_cart', 'excl', 'no'),
(210, 'woocommerce_tax_total_display', 'itemized', 'no'),
(211, 'woocommerce_enable_coupons', 'yes', 'no'),
(212, 'woocommerce_enable_guest_checkout', 'yes', 'no'),
(213, 'woocommerce_force_ssl_checkout', 'no', 'yes'),
(214, 'woocommerce_unforce_ssl_checkout', 'no', 'yes'),
(215, 'woocommerce_cart_page_id', '12', 'yes'),
(216, 'woocommerce_checkout_page_id', '13', 'yes'),
(217, 'woocommerce_terms_page_id', '', 'no'),
(218, 'woocommerce_checkout_pay_endpoint', 'order-pay', 'yes'),
(219, 'woocommerce_checkout_order_received_endpoint', 'order-received', 'yes'),
(220, 'woocommerce_myaccount_add_payment_method_endpoint', 'add-payment-method', 'yes'),
(221, 'woocommerce_calc_shipping', 'yes', 'yes'),
(222, 'woocommerce_enable_shipping_calc', 'no', 'no'),
(223, 'woocommerce_shipping_cost_requires_address', 'no', 'no'),
(224, 'woocommerce_shipping_method_format', '', 'no'),
(225, 'woocommerce_ship_to_destination', 'shipping', 'no'),
(226, 'woocommerce_ship_to_countries', 'specific', 'yes'),
(227, 'woocommerce_specific_ship_to_countries', 'a:1:{i:0;s:2:\"IR\";}', 'yes'),
(228, 'woocommerce_myaccount_page_id', '14', 'yes'),
(229, 'woocommerce_myaccount_view_order_endpoint', 'view-order', 'yes'),
(230, 'woocommerce_myaccount_edit_account_endpoint', 'edit-account', 'yes'),
(231, 'woocommerce_myaccount_edit_address_endpoint', 'edit-address', 'yes'),
(232, 'woocommerce_myaccount_lost_password_endpoint', 'lost-password', 'yes'),
(233, 'woocommerce_logout_endpoint', 'customer-logout', 'yes'),
(234, 'woocommerce_enable_signup_and_login_from_checkout', 'yes', 'no'),
(235, 'woocommerce_enable_myaccount_registration', 'no', 'no'),
(236, 'woocommerce_enable_checkout_login_reminder', 'yes', 'no'),
(237, 'woocommerce_registration_generate_username', 'yes', 'no'),
(238, 'woocommerce_registration_generate_password', 'no', 'no'),
(239, 'woocommerce_email_from_name', 'آموزش مجازی', 'no'),
(240, 'woocommerce_email_from_address', 'mesbahsoft@gmail.com', 'no'),
(241, 'woocommerce_email_header_image', '', 'no'),
(242, 'woocommerce_email_footer_text', 'آموزش مجازی - Powered By WooCommerce', 'no'),
(243, 'woocommerce_email_base_color', '#557da1', 'no'),
(244, 'woocommerce_email_background_color', '#f5f5f5', 'no'),
(245, 'woocommerce_email_body_background_color', '#fdfdfd', 'no'),
(246, 'woocommerce_email_text_color', '#505050', 'no'),
(247, '_transient_wc_attribute_taxonomies', 'a:0:{}', 'yes'),
(248, 'woocommerce_db_version', '2.2.6', 'yes'),
(249, 'woocommerce_version', '2.2.6', 'yes'),
(257, 'woocommerce_meta_box_errors', 'a:0:{}', 'yes'),
(260, 'widget_pages', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(261, 'widget_calendar', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(262, 'widget_tag_cloud', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(263, 'widget_nav_menu', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(264, 'widget_widget_twentyfourteen_ephemera', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(265, 'theme_mods_twentyfourteen', 'a:8:{s:16:\"header_textcolor\";s:3:\"fff\";s:16:\"background_color\";s:6:\"f5f5f5\";s:16:\"background_image\";s:0:\"\";s:17:\"background_repeat\";s:6:\"repeat\";s:21:\"background_position_x\";s:4:\"left\";s:21:\"background_attachment\";s:6:\"scroll\";s:23:\"featured_content_layout\";s:4:\"grid\";s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1414836503;s:4:\"data\";a:4:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-2\";a:0:{}s:9:\"sidebar-3\";a:0:{}}}}', 'yes'),
(268, 'ztjalali_options', '{\"force_timezone\":false,\"change_date_to_jalali\":true,\"change_jdate_number_to_persian\":true,\"change_url_date_to_jalali\":false,\"afghan_month_name\":false,\"disallow_month_short_name\":true,\"change_title_number_to_persian\":true,\"change_content_number_to_persian\":true,\"change_excerpt_number_to_persian\":true,\"change_comment_number_to_persian\":true,\"change_commentcount_number_to_persian\":true,\"change_category_number_to_persian\":true,\"change_point_to_persian\":true,\"change_arabic_to_persian\":true,\"change_archive_title\":true,\"save_changes_in_db\":false,\"ztjalali_admin_style\":false,\"persian_planet\":true}', 'yes'),
(269, 'ztjalali_version', '5.0.0', 'yes'),
(282, 'current_theme', 'پوسته ووکامرس Woostore', 'yes'),
(283, 'theme_mods_woostore', 'a:1:{i:0;b:0;}', 'yes'),
(284, 'theme_switched', '', 'yes'),
(285, 'woocommerce_admin_notices', 'a:2:{i:0;s:14:\"template_files\";i:1;s:13:\"theme_support\";}', 'yes'),
(286, 'woo_timthumb_update', '', 'yes'),
(287, 'woocommerce_thumbnail_image_width', '180', 'yes'),
(288, 'woocommerce_thumbnail_image_height', '180', 'yes'),
(289, 'woocommerce_single_image_width', '320', 'yes'),
(290, 'woocommerce_single_image_height', '320', 'yes'),
(291, 'woocommerce_catalog_image_width', '180', 'yes'),
(292, 'woocommerce_catalog_image_height', '180', 'yes'),
(293, 'woo_framework_version', '4.7.2', 'yes'),
(294, 'woo_custom_seo_template', 'a:3:{i:0;a:5:{s:4:\"name\";s:10:\"seo_info_1\";s:3:\"std\";s:0:\"\";s:5:\"label\";s:4:\"SEO \";s:4:\"type\";s:4:\"info\";s:4:\"desc\";s:187:\"Additional SEO custom fields available: <strong>Custom Page Titles</strong>. Go to <a href=\"http://elearning4u.ir/wp-admin/admin.php?page=woothemes_seo\">SEO Settings</a> page to activate.\";}i:1;a:5:{s:4:\"name\";s:10:\"seo_follow\";s:3:\"std\";s:5:\"false\";s:5:\"label\";s:16:\"SEO - Set follow\";s:4:\"type\";s:8:\"checkbox\";s:4:\"desc\";s:77:\"Make links from this post/page <strong>followable</strong> by search engines.\";}i:2;a:5:{s:4:\"name\";s:11:\"seo_noindex\";s:3:\"std\";s:5:\"false\";s:5:\"label\";s:13:\"SEO - Noindex\";s:4:\"type\";s:8:\"checkbox\";s:4:\"desc\";s:56:\"Set the Page/Post to not be indexed by a search engines.\";}}', 'yes'),
(295, 'woo_options', 'a:131:{s:18:\"woo_alt_stylesheet\";s:11:\"default.css\";s:8:\"woo_logo\";s:75:\"http://elearning4u.ir/wp-content/uploads/2014/11/elearning-logoo-300x76.png\";s:13:\"woo_texttitle\";s:5:\"false\";s:19:\"woo_font_site_title\";a:5:{s:4:\"size\";s:2:\"30\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:11:\"Droid Serif\";s:5:\"style\";s:4:\"bold\";s:5:\"color\";s:7:\"#333333\";}s:11:\"woo_tagline\";s:5:\"false\";s:16:\"woo_font_tagline\";a:5:{s:4:\"size\";s:2:\"12\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:10:\"Droid Sans\";s:5:\"style\";s:6:\"normal\";s:5:\"color\";s:7:\"#999999\";}s:18:\"woo_custom_favicon\";s:60:\"http://elearning4u.ir/wp-content/uploads/2014/11/favicon.png\";s:20:\"woo_google_analytics\";s:0:\"\";s:12:\"woo_feed_url\";s:0:\"\";s:19:\"woo_subscribe_email\";s:0:\"\";s:14:\"woo_custom_css\";s:0:\"\";s:12:\"woo_comments\";s:4:\"post\";s:16:\"woo_post_content\";s:7:\"excerpt\";s:15:\"woo_post_author\";s:4:\"true\";s:20:\"woo_breadcrumbs_show\";s:5:\"false\";s:16:\"woo_pagenav_show\";s:4:\"true\";s:19:\"woo_pagination_type\";s:15:\"paginated_links\";s:14:\"woo_body_color\";s:0:\"\";s:12:\"woo_body_img\";s:0:\"\";s:15:\"woo_body_repeat\";s:9:\"no-repeat\";s:12:\"woo_body_pos\";s:8:\"top left\";s:19:\"woo_body_attachment\";s:6:\"scroll\";s:14:\"woo_link_color\";s:0:\"\";s:20:\"woo_link_hover_color\";s:0:\"\";s:16:\"woo_button_color\";s:0:\"\";s:14:\"woo_typography\";s:5:\"false\";s:13:\"woo_font_body\";a:5:{s:4:\"size\";s:2:\"12\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:6:\"normal\";s:5:\"color\";s:7:\"#555555\";}s:12:\"woo_font_nav\";a:5:{s:4:\"size\";s:2:\"14\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:6:\"normal\";s:5:\"color\";s:7:\"#555555\";}s:19:\"woo_font_page_title\";a:5:{s:4:\"size\";s:3:\"1.4\";s:4:\"unit\";s:2:\"em\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:4:\"bold\";s:5:\"color\";s:7:\"#3E3E3E\";}s:19:\"woo_font_post_title\";a:5:{s:4:\"size\";s:2:\"24\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:4:\"bold\";s:5:\"color\";s:7:\"#222222\";}s:18:\"woo_font_post_meta\";a:5:{s:4:\"size\";s:2:\"12\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:6:\"normal\";s:5:\"color\";s:7:\"#999999\";}s:19:\"woo_font_post_entry\";a:5:{s:4:\"size\";s:2:\"14\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:6:\"normal\";s:5:\"color\";s:7:\"#555555\";}s:22:\"woo_font_widget_titles\";a:5:{s:4:\"size\";s:2:\"16\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:4:\"bold\";s:5:\"color\";s:7:\"#555555\";}s:15:\"woo_site_layout\";s:19:\"layout-left-content\";s:21:\"woo_exclude_cats_home\";s:0:\"\";s:21:\"woo_exclude_cats_blog\";s:0:\"\";s:27:\"woo_business_display_slider\";s:4:\"true\";s:29:\"woo_business_display_features\";s:4:\"true\";s:33:\"woo_business_display_testimonials\";s:4:\"true\";s:25:\"woo_business_display_blog\";s:4:\"true\";s:12:\"woo_featured\";s:5:\"false\";s:20:\"woo_featured_entries\";s:1:\"3\";s:24:\"woo_featured_slide_group\";s:1:\"0\";s:23:\"woo_featured_videotitle\";s:4:\"true\";s:18:\"woo_featured_order\";s:4:\"DESC\";s:22:\"woo_featured_animation\";s:4:\"fade\";s:21:\"woo_featured_nextprev\";s:4:\"true\";s:23:\"woo_featured_pagination\";s:5:\"false\";s:18:\"woo_featured_hover\";s:4:\"true\";s:19:\"woo_featured_action\";s:4:\"true\";s:18:\"woo_featured_speed\";s:1:\"7\";s:28:\"woo_featured_animation_speed\";s:3:\"0.6\";s:19:\"woo_homepage_notice\";s:0:\"\";s:38:\"woo_homepage_enable_product_categories\";s:4:\"true\";s:37:\"woo_homepage_enable_featured_products\";s:4:\"true\";s:35:\"woo_homepage_enable_recent_products\";s:4:\"true\";s:32:\"woo_homepage_enable_testimonials\";s:4:\"true\";s:27:\"woo_homepage_enable_content\";s:4:\"true\";s:37:\"woo_homepage_product_categories_limit\";s:1:\"4\";s:36:\"woo_homepage_featured_products_limit\";s:1:\"4\";s:34:\"woo_homepage_recent_products_title\";s:0:\"\";s:34:\"woo_homepage_recent_products_limit\";s:1:\"4\";s:25:\"woo_homepage_content_type\";s:5:\"posts\";s:20:\"woo_homepage_page_id\";s:1:\"0\";s:28:\"woo_homepage_number_of_posts\";s:1:\"5\";s:27:\"woo_homepage_posts_category\";s:1:\"0\";s:26:\"woo_homepage_posts_sidebar\";s:4:\"true\";s:19:\"woo_placeholder_url\";s:0:\"\";s:28:\"woocommerce_header_cart_link\";s:4:\"true\";s:30:\"woocommerce_header_search_form\";s:4:\"true\";s:20:\"woocommerce_hide_nav\";s:5:\"false\";s:30:\"woocommerce_archives_fullwidth\";s:5:\"false\";s:27:\"woocommerce_product_columns\";s:1:\"3\";s:29:\"woocommerce_products_per_page\";s:2:\"12\";s:36:\"woocommerce_archives_infinite_scroll\";s:4:\"true\";s:28:\"woocommerce_related_products\";s:4:\"true\";s:36:\"woocommerce_related_products_maximum\";s:1:\"3\";s:30:\"woocommerce_products_fullwidth\";s:5:\"false\";s:18:\"woo_wpthumb_notice\";s:0:\"\";s:22:\"woo_post_image_support\";s:4:\"true\";s:14:\"woo_pis_resize\";s:4:\"true\";s:17:\"woo_pis_hard_crop\";s:4:\"true\";s:10:\"woo_resize\";s:4:\"true\";s:12:\"woo_auto_img\";s:5:\"false\";s:11:\"woo_thumb_w\";s:3:\"100\";s:11:\"woo_thumb_h\";s:3:\"100\";s:15:\"woo_thumb_align\";s:9:\"alignleft\";s:16:\"woo_thumb_single\";s:5:\"false\";s:12:\"woo_single_w\";s:3:\"200\";s:12:\"woo_single_h\";s:3:\"200\";s:22:\"woo_thumb_single_align\";s:10:\"alignright\";s:13:\"woo_rss_thumb\";s:5:\"false\";s:19:\"woo_enable_lightbox\";s:5:\"false\";s:19:\"woo_footer_sidebars\";s:1:\"4\";s:19:\"woo_footer_aff_link\";s:0:\"\";s:15:\"woo_footer_left\";s:5:\"false\";s:20:\"woo_footer_left_text\";s:0:\"\";s:16:\"woo_footer_right\";s:5:\"false\";s:21:\"woo_footer_right_text\";s:0:\"\";s:11:\"woo_connect\";s:5:\"false\";s:17:\"woo_connect_title\";s:0:\"\";s:19:\"woo_connect_content\";s:0:\"\";s:19:\"woo_connect_related\";s:4:\"true\";s:25:\"woo_connect_newsletter_id\";s:0:\"\";s:30:\"woo_connect_mailchimp_list_url\";s:0:\"\";s:15:\"woo_connect_rss\";s:4:\"true\";s:19:\"woo_connect_twitter\";s:0:\"\";s:20:\"woo_connect_facebook\";s:0:\"\";s:19:\"woo_connect_youtube\";s:0:\"\";s:18:\"woo_connect_flickr\";s:0:\"\";s:20:\"woo_connect_linkedin\";s:0:\"\";s:21:\"woo_connect_delicious\";s:0:\"\";s:22:\"woo_connect_googleplus\";s:0:\"\";s:10:\"woo_ad_top\";s:5:\"false\";s:18:\"woo_ad_top_adsense\";s:0:\"\";s:16:\"woo_ad_top_image\";s:40:\"http://www.woothemes.com/ads/468x60b.jpg\";s:14:\"woo_ad_top_url\";s:24:\"http://www.woothemes.com\";s:17:\"woo_contact_panel\";s:5:\"false\";s:17:\"woo_contact_title\";s:0:\"\";s:19:\"woo_contact_address\";s:0:\"\";s:18:\"woo_contact_number\";s:0:\"\";s:15:\"woo_contact_fax\";s:0:\"\";s:21:\"woo_contactform_email\";s:0:\"\";s:19:\"woo_contact_twitter\";s:0:\"\";s:33:\"woo_contact_subscribe_and_connect\";s:5:\"false\";s:26:\"woo_contactform_map_coords\";s:0:\"\";s:15:\"woo_maps_scroll\";s:5:\"false\";s:22:\"woo_maps_single_height\";s:3:\"250\";s:24:\"woo_maps_default_mapzoom\";s:1:\"9\";s:24:\"woo_maps_default_maptype\";s:12:\"G_NORMAL_MAP\";s:21:\"woo_maps_callout_text\";s:0:\"\";}', 'yes');
INSERT INTO `d_wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(296, 'woo_template', 'a:165:{i:0;a:3:{s:4:\"name\";s:16:\"General Settings\";s:4:\"type\";s:7:\"heading\";s:4:\"icon\";s:7:\"general\";}i:1;a:2:{s:4:\"name\";s:11:\"Quick Start\";s:4:\"type\";s:10:\"subheading\";}i:2;a:6:{s:4:\"name\";s:16:\"Theme Stylesheet\";s:4:\"desc\";s:44:\"Select your themes alternative color scheme.\";s:2:\"id\";s:18:\"woo_alt_stylesheet\";s:3:\"std\";s:11:\"default.css\";s:4:\"type\";s:6:\"select\";s:7:\"options\";a:12:{i:0;s:8:\"blue.css\";i:1;s:9:\"brown.css\";i:2;s:11:\"default.css\";i:3;s:13:\"grayscale.css\";i:4;s:9:\"green.css\";i:5;s:10:\"indigo.css\";i:6;s:14:\"monochrome.css\";i:7;s:10:\"orange.css\";i:8;s:7:\"red.css\";i:9;s:11:\"shadows.css\";i:10;s:10:\"violet.css\";i:11;s:10:\"yellow.css\";}}i:3;a:5:{s:4:\"name\";s:11:\"Custom Logo\";s:4:\"desc\";s:63:\"Upload a logo for your theme, or specify an image URL directly.\";s:2:\"id\";s:8:\"woo_logo\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:6:\"upload\";}i:4;a:6:{s:4:\"name\";s:10:\"Text Title\";s:4:\"desc\";s:149:\"Enable text-based Site Title and Tagline. Setup title & tagline in <a href=\"http://elearning4u.ir/wp-admin/options-general.php\">General Settings</a>.\";s:2:\"id\";s:13:\"woo_texttitle\";s:3:\"std\";s:5:\"false\";s:5:\"class\";s:9:\"collapsed\";s:4:\"type\";s:8:\"checkbox\";}i:5;a:6:{s:4:\"name\";s:10:\"Site Title\";s:4:\"desc\";s:33:\"Change the site title typography.\";s:2:\"id\";s:19:\"woo_font_site_title\";s:3:\"std\";a:5:{s:4:\"size\";s:1:\"1\";s:4:\"unit\";s:2:\"em\";s:4:\"face\";s:9:\"Helvetica\";s:5:\"style\";s:0:\"\";s:5:\"color\";s:7:\"#333333\";}s:5:\"class\";s:6:\"hidden\";s:4:\"type\";s:10:\"typography\";}i:6;a:6:{s:4:\"name\";s:16:\"Site Description\";s:4:\"desc\";s:53:\"Enable the site description/tagline under site title.\";s:2:\"id\";s:11:\"woo_tagline\";s:5:\"class\";s:6:\"hidden\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:7;a:6:{s:4:\"name\";s:16:\"Site Description\";s:4:\"desc\";s:39:\"Change the site description typography.\";s:2:\"id\";s:16:\"woo_font_tagline\";s:3:\"std\";a:5:{s:4:\"size\";s:1:\"1\";s:4:\"unit\";s:2:\"em\";s:4:\"face\";s:9:\"Helvetica\";s:5:\"style\";s:0:\"\";s:5:\"color\";s:7:\"#999999\";}s:5:\"class\";s:11:\"hidden last\";s:4:\"type\";s:10:\"typography\";}i:8;a:5:{s:4:\"name\";s:14:\"Custom Favicon\";s:4:\"desc\";s:113:\"Upload a 16px x 16px <a href=\"http://www.faviconr.com/\">ico image</a> that will represent your website\'s favicon.\";s:2:\"id\";s:18:\"woo_custom_favicon\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:6:\"upload\";}i:9;a:5:{s:4:\"name\";s:13:\"Tracking Code\";s:4:\"desc\";s:117:\"Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.\";s:2:\"id\";s:20:\"woo_google_analytics\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"textarea\";}i:10;a:2:{s:4:\"name\";s:21:\"Subscription Settings\";s:4:\"type\";s:10:\"subheading\";}i:11;a:5:{s:4:\"name\";s:7:\"RSS URL\";s:4:\"desc\";s:51:\"Enter your preferred RSS URL. (Feedburner or other)\";s:2:\"id\";s:12:\"woo_feed_url\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:12;a:5:{s:4:\"name\";s:23:\"E-Mail Subscription URL\";s:4:\"desc\";s:67:\"Enter your preferred E-mail subscription URL. (Feedburner or other)\";s:2:\"id\";s:19:\"woo_subscribe_email\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:13;a:2:{s:4:\"name\";s:15:\"Display Options\";s:4:\"type\";s:10:\"subheading\";}i:14;a:5:{s:4:\"name\";s:10:\"Custom CSS\";s:4:\"desc\";s:62:\"Quickly add some CSS to your theme by adding it to this block.\";s:2:\"id\";s:14:\"woo_custom_css\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"textarea\";}i:15;a:6:{s:4:\"name\";s:18:\"Post/Page Comments\";s:4:\"desc\";s:68:\"Select if you want to enable/disable comments on posts and/or pages.\";s:2:\"id\";s:12:\"woo_comments\";s:3:\"std\";s:4:\"both\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:4:{s:4:\"post\";s:10:\"Posts Only\";s:4:\"page\";s:10:\"Pages Only\";s:4:\"both\";s:13:\"Pages / Posts\";s:4:\"none\";s:4:\"None\";}}i:16;a:5:{s:4:\"name\";s:12:\"Post Content\";s:4:\"desc\";s:68:\"Select if you want to show the full content or the excerpt on posts.\";s:2:\"id\";s:16:\"woo_post_content\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:2:{s:7:\"excerpt\";s:11:\"The Excerpt\";s:7:\"content\";s:12:\"Full Content\";}}i:17;a:5:{s:4:\"name\";s:15:\"Post Author Box\";s:4:\"desc\";s:148:\"This will enable the post author box on the single posts page. Edit description in <a href=\"http://elearning4u.ir/wp-admin/profile.php\">Profile</a>.\";s:2:\"id\";s:15:\"woo_post_author\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:18;a:5:{s:4:\"name\";s:19:\"Display Breadcrumbs\";s:4:\"desc\";s:57:\"Display dynamic breadcrumbs on each page of your website.\";s:2:\"id\";s:20:\"woo_breadcrumbs_show\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:19;a:5:{s:4:\"name\";s:18:\"Display Pagination\";s:4:\"desc\";s:31:\"Display pagination on the blog.\";s:2:\"id\";s:16:\"woo_pagenav_show\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:20;a:5:{s:4:\"name\";s:16:\"Pagination Style\";s:4:\"desc\";s:65:\"Select the style of pagination you would like to use on the blog.\";s:2:\"id\";s:19:\"woo_pagination_type\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:2:{s:15:\"paginated_links\";s:7:\"Numbers\";s:6:\"simple\";s:13:\"Next/Previous\";}}i:21;a:3:{s:4:\"name\";s:7:\"Styling\";s:4:\"type\";s:7:\"heading\";s:4:\"icon\";s:7:\"styling\";}i:22;a:2:{s:4:\"name\";s:10:\"Background\";s:4:\"type\";s:10:\"subheading\";}i:23;a:5:{s:4:\"name\";s:21:\"Body Background Color\";s:4:\"desc\";s:66:\"Pick a custom color for background color of the theme e.g. #697e09\";s:2:\"id\";s:14:\"woo_body_color\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:5:\"color\";}i:24;a:5:{s:4:\"name\";s:21:\"Body background image\";s:4:\"desc\";s:42:\"Upload an image for the theme\'s background\";s:2:\"id\";s:12:\"woo_body_img\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:6:\"upload\";}i:25;a:6:{s:4:\"name\";s:23:\"Background image repeat\";s:4:\"desc\";s:56:\"Select how you would like to repeat the background-image\";s:2:\"id\";s:15:\"woo_body_repeat\";s:3:\"std\";s:9:\"no-repeat\";s:4:\"type\";s:6:\"select\";s:7:\"options\";a:4:{i:0;s:9:\"no-repeat\";i:1;s:8:\"repeat-x\";i:2;s:8:\"repeat-y\";i:3;s:6:\"repeat\";}}i:26;a:6:{s:4:\"name\";s:25:\"Background image position\";s:4:\"desc\";s:52:\"Select how you would like to position the background\";s:2:\"id\";s:12:\"woo_body_pos\";s:3:\"std\";s:3:\"top\";s:4:\"type\";s:6:\"select\";s:7:\"options\";a:9:{i:0;s:8:\"top left\";i:1;s:10:\"top center\";i:2;s:9:\"top right\";i:3;s:11:\"center left\";i:4;s:13:\"center center\";i:5;s:12:\"center right\";i:6;s:11:\"bottom left\";i:7;s:13:\"bottom center\";i:8;s:12:\"bottom right\";}}i:27;a:6:{s:4:\"name\";s:21:\"Background Attachment\";s:4:\"desc\";s:75:\"Select whether the background should be fixed or move when the user scrolls\";s:2:\"id\";s:19:\"woo_body_attachment\";s:3:\"std\";s:6:\"scroll\";s:4:\"type\";s:6:\"select\";s:7:\"options\";a:2:{i:0;s:6:\"scroll\";i:1;s:5:\"fixed\";}}i:28;a:2:{s:4:\"name\";s:5:\"Links\";s:4:\"type\";s:10:\"subheading\";}i:29;a:5:{s:4:\"name\";s:10:\"Link Color\";s:4:\"desc\";s:66:\"Pick a custom color for links or add a hex color code e.g. #697e09\";s:2:\"id\";s:14:\"woo_link_color\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:5:\"color\";}i:30;a:5:{s:4:\"name\";s:16:\"Link Hover Color\";s:4:\"desc\";s:72:\"Pick a custom color for links hover or add a hex color code e.g. #697e09\";s:2:\"id\";s:20:\"woo_link_hover_color\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:5:\"color\";}i:31;a:5:{s:4:\"name\";s:12:\"Button Color\";s:4:\"desc\";s:68:\"Pick a custom color for buttons or add a hex color code e.g. #697e09\";s:2:\"id\";s:16:\"woo_button_color\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:5:\"color\";}i:32;a:3:{s:4:\"name\";s:10:\"Typography\";s:4:\"type\";s:7:\"heading\";s:4:\"icon\";s:10:\"typography\";}i:33;a:5:{s:4:\"name\";s:24:\"Enable Custom Typography\";s:4:\"desc\";s:100:\"Enable the use of custom typography for your site. Custom styling will be output in your sites HEAD.\";s:2:\"id\";s:14:\"woo_typography\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:34;a:5:{s:4:\"name\";s:18:\"General Typography\";s:4:\"desc\";s:24:\"Change the general font.\";s:2:\"id\";s:13:\"woo_font_body\";s:3:\"std\";a:5:{s:4:\"size\";s:3:\"1.4\";s:4:\"unit\";s:2:\"em\";s:4:\"face\";s:18:\"FontSiteSans-Roman\";s:5:\"style\";s:0:\"\";s:5:\"color\";s:7:\"#3E3E3E\";}s:4:\"type\";s:10:\"typography\";}i:35;a:5:{s:4:\"name\";s:10:\"Navigation\";s:4:\"desc\";s:27:\"Change the navigation font.\";s:2:\"id\";s:12:\"woo_font_nav\";s:3:\"std\";a:5:{s:4:\"size\";s:1:\"1\";s:4:\"unit\";s:2:\"em\";s:4:\"face\";s:17:\"FontSiteSans-Cond\";s:5:\"style\";s:0:\"\";s:5:\"color\";s:7:\"#3E3E3E\";}s:4:\"type\";s:10:\"typography\";}i:36;a:5:{s:4:\"name\";s:10:\"Page Title\";s:4:\"desc\";s:22:\"Change the page title.\";s:2:\"id\";s:19:\"woo_font_page_title\";s:3:\"std\";a:5:{s:4:\"size\";s:3:\"1.4\";s:4:\"unit\";s:2:\"em\";s:4:\"face\";s:10:\"BergamoStd\";s:5:\"style\";s:4:\"bold\";s:5:\"color\";s:7:\"#3E3E3E\";}s:4:\"type\";s:10:\"typography\";}i:37;a:5:{s:4:\"name\";s:10:\"Post Title\";s:4:\"desc\";s:22:\"Change the post title.\";s:2:\"id\";s:19:\"woo_font_post_title\";s:3:\"std\";a:5:{s:4:\"size\";s:3:\"1.4\";s:4:\"unit\";s:2:\"em\";s:4:\"face\";s:10:\"BergamoStd\";s:5:\"style\";s:4:\"bold\";s:5:\"color\";s:7:\"#3E3E3E\";}s:4:\"type\";s:10:\"typography\";}i:38;a:5:{s:4:\"name\";s:9:\"Post Meta\";s:4:\"desc\";s:21:\"Change the post meta.\";s:2:\"id\";s:18:\"woo_font_post_meta\";s:3:\"std\";a:5:{s:4:\"size\";s:1:\"1\";s:4:\"unit\";s:2:\"em\";s:4:\"face\";s:10:\"BergamoStd\";s:5:\"style\";s:0:\"\";s:5:\"color\";s:7:\"#3E3E3E\";}s:4:\"type\";s:10:\"typography\";}i:39;a:5:{s:4:\"name\";s:10:\"Post Entry\";s:4:\"desc\";s:22:\"Change the post entry.\";s:2:\"id\";s:19:\"woo_font_post_entry\";s:3:\"std\";a:5:{s:4:\"size\";s:1:\"1\";s:4:\"unit\";s:2:\"em\";s:4:\"face\";s:10:\"BergamoStd\";s:5:\"style\";s:0:\"\";s:5:\"color\";s:7:\"#3E3E3E\";}s:4:\"type\";s:10:\"typography\";}i:40;a:5:{s:4:\"name\";s:13:\"Widget Titles\";s:4:\"desc\";s:25:\"Change the widget titles.\";s:2:\"id\";s:22:\"woo_font_widget_titles\";s:3:\"std\";a:5:{s:4:\"size\";s:1:\"1\";s:4:\"unit\";s:2:\"em\";s:4:\"face\";s:17:\"FontSiteSans-Cond\";s:5:\"style\";s:4:\"bold\";s:5:\"color\";s:7:\"#3E3E3E\";}s:4:\"type\";s:10:\"typography\";}i:41;a:3:{s:4:\"name\";s:6:\"Layout\";s:4:\"type\";s:7:\"heading\";s:4:\"icon\";s:6:\"layout\";}i:42;a:6:{s:4:\"name\";s:11:\"Main Layout\";s:4:\"desc\";s:43:\"Select which layout you want for your site.\";s:2:\"id\";s:15:\"woo_site_layout\";s:3:\"std\";s:20:\"layout-right-content\";s:4:\"type\";s:6:\"images\";s:7:\"options\";a:2:{s:19:\"layout-left-content\";s:75:\"http://elearning4u.ir/wp-content/themes/superstore/functions/images/2cl.png\";s:20:\"layout-right-content\";s:75:\"http://elearning4u.ir/wp-content/themes/superstore/functions/images/2cr.png\";}}i:43;a:5:{s:4:\"name\";s:27:\"Category Exclude - Homepage\";s:4:\"desc\";s:122:\"Specify a comma seperated list of category IDs or slugs that you\'d like to exclude from your homepage (eg: uncategorized).\";s:2:\"id\";s:21:\"woo_exclude_cats_home\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:44;a:5:{s:4:\"name\";s:37:\"Category Exclude - Blog Page Template\";s:4:\"desc\";s:134:\"Specify a comma seperated list of category IDs or slugs that you\'d like to exclude from your \'Blog\' page template (eg: uncategorized).\";s:2:\"id\";s:21:\"woo_exclude_cats_blog\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:45;a:3:{s:4:\"name\";s:17:\"Business Template\";s:4:\"type\";s:7:\"heading\";s:4:\"icon\";s:6:\"layout\";}i:46;a:5:{s:4:\"name\";s:17:\"Display WooSlider\";s:4:\"desc\";s:188:\"Display a slider above the page content? Requires <a href=\"http://www.woothemes.com/products/wooslider/\" title=\"Purchase WooSlider from WooThemes.com\" target=\"_blank\">WooSlider</a> plugin.\";s:2:\"id\";s:27:\"woo_business_display_slider\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:47;a:5:{s:4:\"name\";s:16:\"Display Features\";s:4:\"desc\";s:217:\"Display Features beneath the page content? Requires <a href=\"http://wordpress.org/extend/plugins/features-by-woothemes/\" title=\"Download \'Features by WooThemes\' from WordPress.org\" target=\"_blank\">Features</a> plugin.\";s:2:\"id\";s:29:\"woo_business_display_features\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:48;a:5:{s:4:\"name\";s:20:\"Display Testimonials\";s:4:\"desc\";s:233:\"Display testimonials beneath the page content? Requires <a href=\"http://wordpress.org/extend/plugins/testimonials-by-woothemes/\" title=\"Download \'Testimonials by WooThemes\' from WordPress.org\" target=\"_blank\">Testimonials</a> plugin.\";s:2:\"id\";s:33:\"woo_business_display_testimonials\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:49;a:5:{s:4:\"name\";s:37:\"Display latest blog posts and sidebar\";s:4:\"desc\";s:88:\"Display your latest blog posts and primary sidebar beneath the business template content\";s:2:\"id\";s:25:\"woo_business_display_blog\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:50;a:3:{s:4:\"name\";s:15:\"Featured Slider\";s:4:\"icon\";s:6:\"slider\";s:4:\"type\";s:7:\"heading\";}i:51;a:2:{s:4:\"name\";s:14:\"Slider Content\";s:4:\"type\";s:10:\"subheading\";}i:52;a:5:{s:4:\"name\";s:22:\"Enable Featured Slider\";s:4:\"desc\";s:43:\"Enable the featured slider on the homepage.\";s:2:\"id\";s:12:\"woo_featured\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:53;a:6:{s:4:\"name\";s:16:\"Number of Slides\";s:4:\"desc\";s:70:\"Select the number of slides that should appear in the featured slider.\";s:2:\"id\";s:20:\"woo_featured_entries\";s:3:\"std\";s:1:\"3\";s:4:\"type\";s:6:\"select\";s:7:\"options\";a:10:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;i:8;i:8;i:9;i:9;i:10;}}i:54;a:6:{s:4:\"name\";s:11:\"Slide Group\";s:4:\"desc\";s:69:\"Optionally choose to display only slides from a specific slide group.\";s:2:\"id\";s:24:\"woo_featured_slide_group\";s:3:\"std\";s:1:\"0\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:1:{i:0;s:21:\"Select a Slide Group:\";}}i:55;a:5:{s:4:\"name\";s:29:\"Display Title On Video Slides\";s:4:\"desc\";s:84:\"If a slide has a video in the \"Embed Code\" field, display the slide title & content.\";s:2:\"id\";s:23:\"woo_featured_videotitle\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:56;a:6:{s:4:\"name\";s:13:\"Display Order\";s:4:\"desc\";s:53:\"Select which way you wish to order your slider posts.\";s:2:\"id\";s:18:\"woo_featured_order\";s:3:\"std\";s:4:\"DESC\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:2:{s:4:\"DESC\";s:16:\"Newest to oldest\";s:3:\"ASC\";s:16:\"Oldest to newest\";}}i:57;a:2:{s:4:\"name\";s:15:\"Slider Settings\";s:4:\"type\";s:10:\"subheading\";}i:58;a:6:{s:4:\"name\";s:16:\"Animation Effect\";s:4:\"desc\";s:56:\"Select whether the featured slider should slide or fade.\";s:2:\"id\";s:22:\"woo_featured_animation\";s:3:\"std\";s:4:\"fade\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:2:{s:4:\"fade\";s:4:\"Fade\";s:5:\"slide\";s:5:\"Slide\";}}i:59;a:5:{s:4:\"name\";s:26:\"Next / Previous Navigation\";s:4:\"desc\";s:58:\"Select to enable next/prev slider for the featured slider.\";s:2:\"id\";s:21:\"woo_featured_nextprev\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:60;a:5:{s:4:\"name\";s:19:\"Pagination Controls\";s:4:\"desc\";s:52:\"Select to enable pagination for the featured slider.\";s:2:\"id\";s:23:\"woo_featured_pagination\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:61;a:5:{s:4:\"name\";s:14:\"Pause On Hover\";s:4:\"desc\";s:48:\"Hovering over the featured slider will pause it.\";s:2:\"id\";s:18:\"woo_featured_hover\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:62;a:5:{s:4:\"name\";s:15:\"Pause On Action\";s:4:\"desc\";s:60:\"Using the featured slider navigation manually will pause it.\";s:2:\"id\";s:19:\"woo_featured_action\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:63;a:6:{s:4:\"name\";s:21:\"Auto-Animate Interval\";s:4:\"desc\";s:153:\"The time in <strong>seconds</strong> each slide pauses for, before transitioning to the next <br /><br />(set to \"Off\" to disable automatic transitions).\";s:2:\"id\";s:18:\"woo_featured_speed\";s:3:\"std\";s:1:\"7\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:11:{i:0;s:3:\"Off\";i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;i:8;i:8;i:9;i:9;i:10;i:10;}}i:64;a:6:{s:4:\"name\";s:15:\"Animation Speed\";s:4:\"desc\";s:76:\"The time in <strong>seconds</strong> the animation between slides will take.\";s:2:\"id\";s:28:\"woo_featured_animation_speed\";s:3:\"std\";s:3:\"0.6\";s:4:\"type\";s:6:\"select\";s:7:\"options\";a:21:{i:0;s:3:\"0.0\";i:1;s:3:\"0.1\";i:2;s:3:\"0.2\";i:3;s:3:\"0.3\";i:4;s:3:\"0.4\";i:5;s:3:\"0.5\";i:6;s:3:\"0.6\";i:7;s:3:\"0.7\";i:8;s:3:\"0.8\";i:9;s:3:\"0.9\";i:10;s:3:\"1.0\";i:11;s:3:\"1.1\";i:12;s:3:\"1.2\";i:13;s:3:\"1.3\";i:14;s:3:\"1.4\";i:15;s:3:\"1.5\";i:16;s:3:\"1.6\";i:17;s:3:\"1.7\";i:18;s:3:\"1.8\";i:19;s:3:\"1.9\";i:20;s:3:\"2.0\";}}i:65;a:3:{s:4:\"name\";s:8:\"Homepage\";s:4:\"icon\";s:8:\"homepage\";s:4:\"type\";s:7:\"heading\";}i:66;a:2:{s:4:\"name\";s:14:\"Homepage Setup\";s:4:\"type\";s:10:\"subheading\";}i:67;a:5:{s:4:\"name\";s:14:\"Homepage Setup\";s:4:\"desc\";s:0:\"\";s:2:\"id\";s:19:\"woo_homepage_notice\";s:3:\"std\";s:272:\"You can optionally customise the homepage by adding widgets to the \"Homepage\" widgetized area on the \"<a href=\"http://elearning4u.ir/wp-admin/widgets.php\">Widgets</a>\" screen with the \"Woo - Component\" widget.<br /><br />If you do so, this will override the options below.\";s:4:\"type\";s:4:\"info\";}i:68;a:5:{s:4:\"name\";s:25:\"Enable Product Categories\";s:4:\"desc\";s:43:\"Display product categories on the homepage.\";s:2:\"id\";s:38:\"woo_homepage_enable_product_categories\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:69;a:5:{s:4:\"name\";s:24:\"Enable Featured Products\";s:4:\"desc\";s:42:\"Display featured products on the homepage.\";s:2:\"id\";s:37:\"woo_homepage_enable_featured_products\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:70;a:5:{s:4:\"name\";s:22:\"Enable Recent Products\";s:4:\"desc\";s:40:\"Display recent products on the homepage.\";s:2:\"id\";s:35:\"woo_homepage_enable_recent_products\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:71;a:5:{s:4:\"name\";s:19:\"Enable Testimonials\";s:4:\"desc\";s:224:\"Display testimonials on the homepage. Requires <a href=\"http://wordpress.org/extend/plugins/testimonials-by-woothemes/\" title=\"Download \'Testimonials by WooThemes\' from WordPress.org\" target=\"_blank\">Testimonials</a> plugin.\";s:2:\"id\";s:32:\"woo_homepage_enable_testimonials\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:72;a:5:{s:4:\"name\";s:19:\"Enable Content Area\";s:4:\"desc\";s:74:\"Display the content area with either page content or a list of blog posts.\";s:2:\"id\";s:27:\"woo_homepage_enable_content\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:73;a:2:{s:4:\"name\";s:26:\"دسته های محصول\";s:4:\"type\";s:10:\"subheading\";}i:74;a:6:{s:4:\"name\";s:28:\"Number of Product Categories\";s:4:\"desc\";s:67:\"Select the number of product categories to display on the homepage.\";s:2:\"id\";s:37:\"woo_homepage_product_categories_limit\";s:3:\"std\";s:1:\"4\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:20:{i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;i:8;i:8;i:9;i:9;i:10;i:10;i:11;i:11;i:12;i:12;i:13;i:13;i:14;i:14;i:15;i:15;i:16;i:16;i:17;i:17;i:18;i:18;i:19;i:19;i:20;i:20;}}i:75;a:2:{s:4:\"name\";s:23:\"محصولات ویژه\";s:4:\"type\";s:10:\"subheading\";}i:76;a:6:{s:4:\"name\";s:18:\"Number of Products\";s:4:\"desc\";s:66:\"Select the number of featured products to display on the homepage.\";s:2:\"id\";s:36:\"woo_homepage_featured_products_limit\";s:3:\"std\";s:1:\"4\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:20:{i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;i:8;i:8;i:9;i:9;i:10;i:10;i:11;i:11;i:12;i:12;i:13;i:13;i:14;i:14;i:15;i:15;i:16;i:16;i:17;i:17;i:18;i:18;i:19;i:19;i:20;i:20;}}i:77;a:2:{s:4:\"name\";s:31:\"جدیدترین محصولات\";s:4:\"type\";s:10:\"subheading\";}i:78;a:5:{s:4:\"name\";s:5:\"Title\";s:4:\"desc\";s:69:\"Enter the title to display above the recent products on the homepage.\";s:2:\"id\";s:34:\"woo_homepage_recent_products_title\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:79;a:6:{s:4:\"name\";s:18:\"Number of Products\";s:4:\"desc\";s:64:\"Select the number of recent products to display on the homepage.\";s:2:\"id\";s:34:\"woo_homepage_recent_products_limit\";s:3:\"std\";s:1:\"4\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:20:{i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;i:8;i:8;i:9;i:9;i:10;i:10;i:11;i:11;i:12;i:12;i:13;i:13;i:14;i:14;i:15;i:15;i:16;i:16;i:17;i:17;i:18;i:18;i:19;i:19;i:20;i:20;}}i:80;a:2:{s:4:\"name\";s:12:\"Content Area\";s:4:\"type\";s:10:\"subheading\";}i:81;a:6:{s:4:\"name\";s:12:\"Content Type\";s:4:\"desc\";s:88:\"Determine whether to display the content of a specified page, or your recent blog posts.\";s:2:\"id\";s:25:\"woo_homepage_content_type\";s:3:\"std\";s:5:\"posts\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:2:{s:5:\"posts\";s:10:\"Blog Posts\";s:4:\"page\";s:12:\"Page Content\";}}i:82;a:6:{s:4:\"name\";s:12:\"Page Content\";s:4:\"desc\";s:80:\"Select the page to display content from if the homepage content area is enabled.\";s:2:\"id\";s:20:\"woo_homepage_page_id\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:5:{i:0;s:14:\"Select a Page:\";i:22;s:22:\"ارتباط با ما\";i:14;s:13:\"حساب من\";i:12;s:15:\"سبد خرید\";i:11;s:14:\"فروشگاه\";}}i:83;a:6:{s:4:\"name\";s:20:\"Number of Blog Posts\";s:4:\"desc\";s:81:\"Select the number of posts to display if the content type is set to \"Blog Posts\".\";s:2:\"id\";s:28:\"woo_homepage_number_of_posts\";s:3:\"std\";s:1:\"5\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:20:{i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;i:8;i:8;i:9;i:9;i:10;i:10;i:11;i:11;i:12;i:12;i:13;i:13;i:14;i:14;i:15;i:15;i:16;i:16;i:17;i:17;i:18;i:18;i:19;i:19;i:20;i:20;}}i:84;a:6:{s:4:\"name\";s:14:\"Posts Category\";s:4:\"desc\";s:92:\"Optionally select a category of posts to display if the content type is set to \"Blog Posts\".\";s:2:\"id\";s:27:\"woo_homepage_posts_category\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:2:{i:0;s:18:\"Select a Category:\";i:1;s:13:\"Uncategorized\";}}i:85;a:5:{s:4:\"name\";s:12:\"Show Sidebar\";s:4:\"desc\";s:36:\"Display the sidebar on the homepage.\";s:2:\"id\";s:26:\"woo_homepage_posts_sidebar\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:86;a:3:{s:4:\"name\";s:11:\"WooCommerce\";s:4:\"type\";s:7:\"heading\";s:4:\"icon\";s:11:\"woocommerce\";}i:87;a:2:{s:4:\"name\";s:7:\"General\";s:4:\"type\";s:10:\"subheading\";}i:88;a:5:{s:4:\"name\";s:18:\"Custom Placeholder\";s:4:\"desc\";s:75:\"Upload a custom placeholder to be displayed when there is no product image.\";s:2:\"id\";s:19:\"woo_placeholder_url\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:6:\"upload\";}i:89;a:5:{s:4:\"name\";s:16:\"Header Cart Link\";s:4:\"desc\";s:49:\"Display a link to the cart in the main navigation\";s:2:\"id\";s:28:\"woocommerce_header_cart_link\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:90;a:5:{s:4:\"name\";s:21:\"Header Product Search\";s:4:\"desc\";s:43:\"Display a product search form in the header\";s:2:\"id\";s:30:\"woocommerce_header_search_form\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:91;a:5:{s:4:\"name\";s:27:\"Hide navigation on checkout\";s:4:\"desc\";s:84:\"Hiding distracting elements like navigation can increase conversions at the checkout\";s:2:\"id\";s:20:\"woocommerce_hide_nav\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:92;a:2:{s:4:\"name\";s:16:\"Product Archives\";s:4:\"type\";s:10:\"subheading\";}i:93;a:5:{s:4:\"name\";s:25:\"Shop archives full width?\";s:4:\"desc\";s:91:\"Display the product archive in a full-width single column format? (The sidebar is removed).\";s:2:\"id\";s:30:\"woocommerce_archives_fullwidth\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:94;a:6:{s:4:\"name\";s:15:\"Product columns\";s:4:\"desc\";s:70:\"Select how many columns of products you want on product archive pages.\";s:2:\"id\";s:27:\"woocommerce_product_columns\";s:3:\"std\";s:1:\"3\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:4:{i:0;s:1:\"2\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"5\";}}i:95;a:5:{s:4:\"name\";s:17:\"Products per page\";s:4:\"desc\";s:66:\"How many products do you want to display on product archive pages?\";s:2:\"id\";s:29:\"woocommerce_products_per_page\";s:3:\"std\";s:2:\"12\";s:4:\"type\";s:4:\"text\";}i:96;a:5:{s:4:\"name\";s:23:\"Enable infinite scroll?\";s:4:\"desc\";s:101:\"Automatically loads the next set of products via AJAX when the user scrolls to the bottom of the page\";s:2:\"id\";s:36:\"woocommerce_archives_infinite_scroll\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:97;a:2:{s:4:\"name\";s:15:\"Product Details\";s:4:\"type\";s:10:\"subheading\";}i:98;a:6:{s:4:\"name\";s:24:\"Display related products\";s:4:\"desc\";s:52:\"Display related products on the product details page\";s:2:\"id\";s:28:\"woocommerce_related_products\";s:3:\"std\";s:4:\"true\";s:5:\"class\";s:9:\"collapsed\";s:4:\"type\";s:8:\"checkbox\";}i:99;a:7:{s:4:\"name\";s:24:\"Maximum related products\";s:4:\"desc\";s:50:\"The maximum number of related products to display.\";s:2:\"id\";s:36:\"woocommerce_related_products_maximum\";s:3:\"std\";s:1:\"3\";s:4:\"type\";s:7:\"select2\";s:5:\"class\";s:11:\"hidden last\";s:7:\"options\";a:7:{i:0;s:1:\"2\";i:1;s:1:\"3\";i:2;s:1:\"4\";i:3;s:1:\"5\";i:4;s:1:\"6\";i:5;s:1:\"7\";i:6;s:1:\"8\";}}i:100;a:5:{s:4:\"name\";s:33:\"Product details pages full width?\";s:4:\"desc\";s:90:\"Display the product details in a full-width single column format? (The sidebar is removed)\";s:2:\"id\";s:30:\"woocommerce_products_fullwidth\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:101;a:3:{s:4:\"name\";s:14:\"Dynamic Images\";s:4:\"type\";s:7:\"heading\";s:4:\"icon\";s:5:\"image\";}i:102;a:2:{s:4:\"name\";s:16:\"Resizer Settings\";s:4:\"type\";s:10:\"subheading\";}i:103;a:5:{s:4:\"name\";s:22:\"Dynamic Image Resizing\";s:4:\"desc\";s:0:\"\";s:2:\"id\";s:18:\"woo_wpthumb_notice\";s:3:\"std\";s:220:\"There are two alternative methods of dynamically resizing the thumbnails in the theme, <strong>WP Post Thumbnail</strong> or <strong>TimThumb - Custom Settings panel</strong>. We recommend using WP Post Thumbnail option.\";s:4:\"type\";s:4:\"info\";}i:104;a:6:{s:4:\"name\";s:17:\"WP Post Thumbnail\";s:4:\"desc\";s:170:\"Use WordPress post thumbnail to assign a post thumbnail. Will enable the <strong>Featured Image panel</strong> in your post sidebar where you can assign a post thumbnail.\";s:2:\"id\";s:22:\"woo_post_image_support\";s:3:\"std\";s:4:\"true\";s:5:\"class\";s:9:\"collapsed\";s:4:\"type\";s:8:\"checkbox\";}i:105;a:6:{s:4:\"name\";s:42:\"WP Post Thumbnail - Dynamic Image Resizing\";s:4:\"desc\";s:113:\"The post thumbnail will be dynamically resized using native WP resize functionality. <em>(Requires PHP 5.2+)</em>\";s:2:\"id\";s:14:\"woo_pis_resize\";s:3:\"std\";s:4:\"true\";s:5:\"class\";s:6:\"hidden\";s:4:\"type\";s:8:\"checkbox\";}i:106;a:6:{s:4:\"name\";s:29:\"WP Post Thumbnail - Hard Crop\";s:4:\"desc\";s:119:\"The post thumbnail will be cropped to match the target aspect ratio (only used if \"Dynamic Image Resizing\" is enabled).\";s:2:\"id\";s:17:\"woo_pis_hard_crop\";s:3:\"std\";s:4:\"true\";s:5:\"class\";s:11:\"hidden last\";s:4:\"type\";s:8:\"checkbox\";}i:107;a:5:{s:4:\"name\";s:32:\"TimThumb - Custom Settings Panel\";s:4:\"desc\";s:358:\"This will enable the <a href=\"http://code.google.com/p/timthumb/\">TimThumb</a> (thumb.php) script which dynamically resizes images added through the <strong>custom settings panel below the post</strong>. Make sure your themes <em>cache</em> folder is writable. <a href=\"http://www.woothemes.com/2008/10/troubleshooting-image-resizer-thumbphp/\">Need help?</a>\";s:2:\"id\";s:10:\"woo_resize\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:108;a:5:{s:4:\"name\";s:25:\"Automatic Image Thumbnail\";s:4:\"desc\";s:81:\"If no thumbnail is specifified then the first uploaded image in the post is used.\";s:2:\"id\";s:12:\"woo_auto_img\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:109;a:2:{s:4:\"name\";s:18:\"Thumbnail Settings\";s:4:\"type\";s:10:\"subheading\";}i:110;a:5:{s:4:\"name\";s:26:\"Thumbnail Image Dimensions\";s:4:\"desc\";s:109:\"Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.\";s:2:\"id\";s:20:\"woo_image_dimensions\";s:3:\"std\";s:0:\"\";s:4:\"type\";a:2:{i:0;a:4:{s:2:\"id\";s:11:\"woo_thumb_w\";s:4:\"type\";s:4:\"text\";s:3:\"std\";i:800;s:4:\"meta\";s:5:\"Width\";}i:1;a:4:{s:2:\"id\";s:11:\"woo_thumb_h\";s:4:\"type\";s:4:\"text\";s:3:\"std\";i:300;s:4:\"meta\";s:6:\"Height\";}}}i:111;a:6:{s:4:\"name\";s:19:\"Thumbnail Alignment\";s:4:\"desc\";s:47:\"Select how to align your thumbnails with posts.\";s:2:\"id\";s:15:\"woo_thumb_align\";s:3:\"std\";s:11:\"aligncenter\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:3:{s:9:\"alignleft\";s:4:\"چپ\";s:10:\"alignright\";s:8:\"راست\";s:11:\"aligncenter\";s:6:\"Center\";}}i:112;a:6:{s:4:\"name\";s:28:\"Single Post - Show Thumbnail\";s:4:\"desc\";s:43:\"Show the thumbnail in the single post page.\";s:2:\"id\";s:16:\"woo_thumb_single\";s:5:\"class\";s:9:\"collapsed\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:113;a:6:{s:4:\"name\";s:34:\"Single Post - Thumbnail Dimensions\";s:4:\"desc\";s:69:\"Enter an integer value i.e. 250 for the image size. Max width is 576.\";s:2:\"id\";s:20:\"woo_image_dimensions\";s:3:\"std\";s:0:\"\";s:5:\"class\";s:11:\"hidden last\";s:4:\"type\";a:2:{i:0;a:4:{s:2:\"id\";s:12:\"woo_single_w\";s:4:\"type\";s:4:\"text\";s:3:\"std\";i:200;s:4:\"meta\";s:5:\"Width\";}i:1;a:4:{s:2:\"id\";s:12:\"woo_single_h\";s:4:\"type\";s:4:\"text\";s:3:\"std\";i:200;s:4:\"meta\";s:6:\"Height\";}}}i:114;a:7:{s:4:\"name\";s:33:\"Single Post - Thumbnail Alignment\";s:4:\"desc\";s:53:\"Select how to align your thumbnail with single posts.\";s:2:\"id\";s:22:\"woo_thumb_single_align\";s:3:\"std\";s:10:\"alignright\";s:4:\"type\";s:7:\"select2\";s:5:\"class\";s:6:\"hidden\";s:7:\"options\";a:3:{s:9:\"alignleft\";s:4:\"چپ\";s:10:\"alignright\";s:8:\"راست\";s:11:\"aligncenter\";s:6:\"Center\";}}i:115;a:5:{s:4:\"name\";s:25:\"Add thumbnail to RSS feed\";s:4:\"desc\";s:74:\"Add the the image uploaded via your Custom Settings panel to your RSS feed\";s:2:\"id\";s:13:\"woo_rss_thumb\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:116;a:5:{s:4:\"name\";s:15:\"Enable Lightbox\";s:4:\"desc\";s:78:\"Enable the PrettyPhoto lighbox script on images within your website\'s content.\";s:2:\"id\";s:19:\"woo_enable_lightbox\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:117;a:3:{s:4:\"name\";s:20:\"Footer Customization\";s:4:\"type\";s:7:\"heading\";s:4:\"icon\";s:6:\"footer\";}i:118;a:6:{s:4:\"name\";s:19:\"Footer Widget Areas\";s:4:\"desc\";s:56:\"Select how many footer widget areas you want to display.\";s:2:\"id\";s:19:\"woo_footer_sidebars\";s:3:\"std\";s:1:\"4\";s:4:\"type\";s:6:\"images\";s:7:\"options\";a:5:{i:0;s:82:\"http://elearning4u.ir/wp-content/themes/superstore/functions/images/layout-off.png\";i:1;s:88:\"http://elearning4u.ir/wp-content/themes/superstore/functions/images/footer-widgets-1.png\";i:2;s:88:\"http://elearning4u.ir/wp-content/themes/superstore/functions/images/footer-widgets-2.png\";i:3;s:88:\"http://elearning4u.ir/wp-content/themes/superstore/functions/images/footer-widgets-3.png\";i:4;s:88:\"http://elearning4u.ir/wp-content/themes/superstore/functions/images/footer-widgets-4.png\";}}i:119;a:5:{s:4:\"name\";s:21:\"Custom Affiliate Link\";s:4:\"desc\";s:71:\"Add an affiliate link to the WooThemes logo in the footer of the theme.\";s:2:\"id\";s:19:\"woo_footer_aff_link\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:120;a:5:{s:4:\"name\";s:27:\"Enable Custom Footer (Left)\";s:4:\"desc\";s:58:\"Activate to add the custom text below to the theme footer.\";s:2:\"id\";s:15:\"woo_footer_left\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:121;a:5:{s:4:\"name\";s:18:\"Custom Text (Left)\";s:4:\"desc\";s:66:\"Custom HTML and Text that will appear in the footer of your theme.\";s:2:\"id\";s:20:\"woo_footer_left_text\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"textarea\";}i:122;a:5:{s:4:\"name\";s:28:\"Enable Custom Footer (Right)\";s:4:\"desc\";s:58:\"Activate to add the custom text below to the theme footer.\";s:2:\"id\";s:16:\"woo_footer_right\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:123;a:5:{s:4:\"name\";s:19:\"Custom Text (Right)\";s:4:\"desc\";s:66:\"Custom HTML and Text that will appear in the footer of your theme.\";s:2:\"id\";s:21:\"woo_footer_right_text\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"textarea\";}i:124;a:3:{s:4:\"name\";s:19:\"Subscribe & Connect\";s:4:\"type\";s:7:\"heading\";s:4:\"icon\";s:7:\"connect\";}i:125;a:2:{s:4:\"name\";s:5:\"Setup\";s:4:\"type\";s:10:\"subheading\";}i:126;a:5:{s:4:\"name\";s:40:\"Enable Subscribe & Connect - Single Post\";s:4:\"desc\";s:160:\"Enable the subscribe & connect area on single posts. You can also add this as a <a href=\"http://elearning4u.ir/wp-admin/widgets.php\">widget</a> in your sidebar.\";s:2:\"id\";s:11:\"woo_connect\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:127;a:5:{s:4:\"name\";s:15:\"Subscribe Title\";s:4:\"desc\";s:57:\"Enter the title to show in your subscribe & connect area.\";s:2:\"id\";s:17:\"woo_connect_title\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:128;a:5:{s:4:\"name\";s:4:\"Text\";s:4:\"desc\";s:37:\"Change the default text in this area.\";s:2:\"id\";s:19:\"woo_connect_content\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"textarea\";}i:129;a:5:{s:4:\"name\";s:20:\"Enable Related Posts\";s:4:\"desc\";s:158:\"Enable related posts in the subscribe area. Uses posts with the same <strong>tags</strong> to find related posts. Note: Will not show in the Subscribe widget.\";s:2:\"id\";s:19:\"woo_connect_related\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:130;a:2:{s:4:\"name\";s:18:\"Subscribe Settings\";s:4:\"type\";s:10:\"subheading\";}i:131;a:5:{s:4:\"name\";s:35:\"Subscribe By E-mail ID (Feedburner)\";s:4:\"desc\";s:162:\"Enter your <a href=\"http://www.woothemes.com/tutorials/how-to-find-your-feedburner-id-for-email-subscription/\">Feedburner ID</a> for the e-mail subscription form.\";s:2:\"id\";s:25:\"woo_connect_newsletter_id\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:132;a:5:{s:4:\"name\";s:32:\"Subscribe By E-mail to MailChimp\";s:4:\"desc\";s:189:\"If you have a MailChimp account you can enter the <a href=\"http://woochimp.heroku.com\" target=\"_blank\">MailChimp List Subscribe URL</a> to allow your users to subscribe to a MailChimp List.\";s:2:\"id\";s:30:\"woo_connect_mailchimp_list_url\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:133;a:2:{s:4:\"name\";s:16:\"Connect Settings\";s:4:\"type\";s:10:\"subheading\";}i:134;a:5:{s:4:\"name\";s:10:\"Enable RSS\";s:4:\"desc\";s:34:\"Enable the subscribe and RSS icon.\";s:2:\"id\";s:15:\"woo_connect_rss\";s:3:\"std\";s:4:\"true\";s:4:\"type\";s:8:\"checkbox\";}i:135;a:5:{s:4:\"name\";s:11:\"Twitter URL\";s:4:\"desc\";s:98:\"Enter your <a href=\"http://www.twitter.com/\">Twitter</a> URL e.g. http://www.twitter.com/woothemes\";s:2:\"id\";s:19:\"woo_connect_twitter\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:136;a:5:{s:4:\"name\";s:12:\"Facebook URL\";s:4:\"desc\";s:101:\"Enter your <a href=\"http://www.facebook.com/\">Facebook</a> URL e.g. http://www.facebook.com/woothemes\";s:2:\"id\";s:20:\"woo_connect_facebook\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:137;a:5:{s:4:\"name\";s:11:\"YouTube URL\";s:4:\"desc\";s:98:\"Enter your <a href=\"http://www.youtube.com/\">YouTube</a> URL e.g. http://www.youtube.com/woothemes\";s:2:\"id\";s:19:\"woo_connect_youtube\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:138;a:5:{s:4:\"name\";s:10:\"Flickr URL\";s:4:\"desc\";s:95:\"Enter your <a href=\"http://www.flickr.com/\">Flickr</a> URL e.g. http://www.flickr.com/woothemes\";s:2:\"id\";s:18:\"woo_connect_flickr\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:139;a:5:{s:4:\"name\";s:12:\"LinkedIn URL\";s:4:\"desc\";s:112:\"Enter your <a href=\"http://www.www.linkedin.com.com/\">LinkedIn</a> URL e.g. http://www.linkedin.com/in/woothemes\";s:2:\"id\";s:20:\"woo_connect_linkedin\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:140;a:5:{s:4:\"name\";s:13:\"Delicious URL\";s:4:\"desc\";s:104:\"Enter your <a href=\"http://www.delicious.com/\">Delicious</a> URL e.g. http://www.delicious.com/woothemes\";s:2:\"id\";s:21:\"woo_connect_delicious\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:141;a:5:{s:4:\"name\";s:11:\"Google+ URL\";s:4:\"desc\";s:112:\"Enter your <a href=\"http://plus.google.com/\">Google+</a> URL e.g. https://plus.google.com/104560124403688998123/\";s:2:\"id\";s:22:\"woo_connect_googleplus\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:142;a:3:{s:4:\"name\";s:11:\"Advertising\";s:4:\"type\";s:7:\"heading\";s:4:\"icon\";s:3:\"ads\";}i:143;a:2:{s:4:\"name\";s:17:\"Top Ad (468x60px)\";s:4:\"type\";s:10:\"subheading\";}i:144;a:5:{s:4:\"name\";s:9:\"Enable Ad\";s:4:\"desc\";s:19:\"Enable the ad space\";s:2:\"id\";s:10:\"woo_ad_top\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:145;a:5:{s:4:\"name\";s:12:\"Adsense code\";s:4:\"desc\";s:56:\"Enter your adsense code (or other ad network code) here.\";s:2:\"id\";s:18:\"woo_ad_top_adsense\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"textarea\";}i:146;a:5:{s:4:\"name\";s:14:\"Image Location\";s:4:\"desc\";s:46:\"Enter the URL to the banner ad image location.\";s:2:\"id\";s:16:\"woo_ad_top_image\";s:3:\"std\";s:40:\"http://www.woothemes.com/ads/468x60b.jpg\";s:4:\"type\";s:6:\"upload\";}i:147;a:5:{s:4:\"name\";s:15:\"Destination URL\";s:4:\"desc\";s:45:\"Enter the URL where this banner ad points to.\";s:2:\"id\";s:14:\"woo_ad_top_url\";s:3:\"std\";s:24:\"http://www.woothemes.com\";s:4:\"type\";s:4:\"text\";}i:148;a:3:{s:4:\"name\";s:12:\"Contact Page\";s:4:\"icon\";s:4:\"maps\";s:4:\"type\";s:7:\"heading\";}i:149;a:2:{s:4:\"name\";s:19:\"Contact Information\";s:4:\"type\";s:10:\"subheading\";}i:150;a:6:{s:4:\"name\";s:32:\"Enable Contact Information Panel\";s:4:\"desc\";s:33:\"Enable the contact informal panel\";s:2:\"id\";s:17:\"woo_contact_panel\";s:3:\"std\";s:5:\"false\";s:5:\"class\";s:9:\"collapsed\";s:4:\"type\";s:8:\"checkbox\";}i:151;a:6:{s:4:\"name\";s:13:\"Location Name\";s:4:\"desc\";s:47:\"Enter the location name. Example: London Office\";s:2:\"id\";s:17:\"woo_contact_title\";s:3:\"std\";s:0:\"\";s:5:\"class\";s:6:\"hidden\";s:4:\"type\";s:4:\"text\";}i:152;a:6:{s:4:\"name\";s:16:\"Location Address\";s:4:\"desc\";s:28:\"Enter your company\'s address\";s:2:\"id\";s:19:\"woo_contact_address\";s:3:\"std\";s:0:\"\";s:5:\"class\";s:6:\"hidden\";s:4:\"type\";s:8:\"textarea\";}i:153;a:6:{s:4:\"name\";s:9:\"Telephone\";s:4:\"desc\";s:27:\"Enter your telephone number\";s:2:\"id\";s:18:\"woo_contact_number\";s:3:\"std\";s:0:\"\";s:5:\"class\";s:6:\"hidden\";s:4:\"type\";s:4:\"text\";}i:154;a:6:{s:4:\"name\";s:3:\"Fax\";s:4:\"desc\";s:21:\"Enter your fax number\";s:2:\"id\";s:15:\"woo_contact_fax\";s:3:\"std\";s:0:\"\";s:5:\"class\";s:11:\"hidden last\";s:4:\"type\";s:4:\"text\";}i:155;a:5:{s:4:\"name\";s:19:\"Contact Form E-Mail\";s:4:\"desc\";s:69:\"Enter your E-mail address to use on the \'Contact Form\' page Template.\";s:2:\"id\";s:21:\"woo_contactform_email\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:156;a:5:{s:4:\"name\";s:21:\"Your Twitter username\";s:4:\"desc\";s:47:\"Enter your Twitter username. Example: woothemes\";s:2:\"id\";s:19:\"woo_contact_twitter\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:157;a:5:{s:4:\"name\";s:28:\"Enable Subscribe and Connect\";s:4:\"desc\";s:75:\"Enable the subscribe and connect functionality on the contact page template\";s:2:\"id\";s:33:\"woo_contact_subscribe_and_connect\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:158;a:2:{s:4:\"name\";s:4:\"Maps\";s:4:\"type\";s:10:\"subheading\";}i:159;a:5:{s:4:\"name\";s:36:\"Contact Form Google Maps Coordinates\";s:4:\"desc\";s:226:\"Enter your Google Map coordinates to display a map on the Contact Form page template and a link to it on the Contact Us widget. You can get these details from <a href=\"http://dbsgeo.com/latlon/\" target=\"_blank\">Google Maps</a>\";s:2:\"id\";s:26:\"woo_contactform_map_coords\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:4:\"text\";}i:160;a:5:{s:4:\"name\";s:19:\"Disable Mousescroll\";s:4:\"desc\";s:112:\"Turn off the mouse scroll action for all the Google Maps on the site. This could improve usability on your site.\";s:2:\"id\";s:15:\"woo_maps_scroll\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"checkbox\";}i:161;a:5:{s:4:\"name\";s:10:\"Map Height\";s:4:\"desc\";s:60:\"Height in pixels for the maps displayed on Single.php pages.\";s:2:\"id\";s:22:\"woo_maps_single_height\";s:3:\"std\";s:3:\"250\";s:4:\"type\";s:4:\"text\";}i:162;a:6:{s:4:\"name\";s:22:\"Default Map Zoom Level\";s:4:\"desc\";s:63:\"Set this to adjust the default in the post & page edit backend.\";s:2:\"id\";s:24:\"woo_maps_default_mapzoom\";s:3:\"std\";s:1:\"9\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:20:{i:0;s:1:\"0\";i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";i:4;s:1:\"4\";i:5;s:1:\"5\";i:6;s:1:\"6\";i:7;s:1:\"7\";i:8;s:1:\"8\";i:9;s:1:\"9\";i:10;s:2:\"10\";i:11;s:2:\"11\";i:12;s:2:\"12\";i:13;s:2:\"13\";i:14;s:2:\"14\";i:15;s:2:\"15\";i:16;s:2:\"16\";i:17;s:2:\"17\";i:18;s:2:\"18\";i:19;s:2:\"19\";}}i:163;a:6:{s:4:\"name\";s:16:\"Default Map Type\";s:4:\"desc\";s:53:\"Set this to the default rendered in the post backend.\";s:2:\"id\";s:24:\"woo_maps_default_maptype\";s:3:\"std\";s:12:\"G_NORMAL_MAP\";s:4:\"type\";s:7:\"select2\";s:7:\"options\";a:4:{s:12:\"G_NORMAL_MAP\";s:6:\"Normal\";s:15:\"G_SATELLITE_MAP\";s:9:\"Satellite\";s:12:\"G_HYBRID_MAP\";s:6:\"Hybrid\";s:14:\"G_PHYSICAL_MAP\";s:7:\"Terrain\";}}i:164;a:5:{s:4:\"name\";s:16:\"Map Callout Text\";s:4:\"desc\";s:84:\"Text or HTML that will be output when you click on the map marker for your location.\";s:2:\"id\";s:21:\"woo_maps_callout_text\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"textarea\";}}', 'yes'),
(297, 'woo_themename', 'Superstore', 'yes'),
(298, 'woo_shortname', 'woo', 'yes'),
(299, 'woo_manual', 'http://www.woothemes.com/support/theme-documentation/superstore/', 'yes'),
(300, 'woo_custom_template', 'a:6:{i:0;a:4:{s:4:\"name\";s:5:\"image\";s:5:\"label\";s:5:\"Image\";s:4:\"type\";s:6:\"upload\";s:4:\"desc\";s:32:\"Upload an image or enter an URL.\";}i:1;a:6:{s:4:\"name\";s:16:\"_image_alignment\";s:3:\"std\";s:6:\"Center\";s:5:\"label\";s:20:\"Image Crop Alignment\";s:4:\"type\";s:7:\"select2\";s:4:\"desc\";s:39:\"Select crop alignment for resized image\";s:7:\"options\";a:5:{s:1:\"c\";s:6:\"Center\";s:1:\"t\";s:3:\"Top\";s:1:\"b\";s:6:\"Bottom\";s:1:\"l\";s:4:\"Left\";s:1:\"r\";s:5:\"Right\";}}i:2;a:5:{s:4:\"name\";s:5:\"embed\";s:3:\"std\";s:0:\"\";s:5:\"label\";s:10:\"Embed Code\";s:4:\"type\";s:8:\"textarea\";s:4:\"desc\";s:69:\"Enter the video embed code for your video (YouTube, Vimeo or similar)\";}i:3;a:6:{s:4:\"name\";s:7:\"_layout\";s:3:\"std\";s:6:\"normal\";s:5:\"label\";s:6:\"Layout\";s:4:\"type\";s:6:\"images\";s:4:\"desc\";s:54:\"Select the layout you want on this specific post/page.\";s:7:\"options\";a:4:{s:14:\"layout-default\";s:82:\"http://elearning4u.ir/wp-content/themes/superstore/functions/images/layout-off.png\";s:11:\"layout-full\";s:74:\"http://elearning4u.ir/wp-content/themes/superstore/functions/images/1c.png\";s:19:\"layout-left-content\";s:75:\"http://elearning4u.ir/wp-content/themes/superstore/functions/images/2cl.png\";s:20:\"layout-right-content\";s:75:\"http://elearning4u.ir/wp-content/themes/superstore/functions/images/2cr.png\";}}i:4;a:4:{s:4:\"name\";s:3:\"url\";s:5:\"label\";s:9:\"Slide URL\";s:4:\"type\";s:4:\"text\";s:4:\"desc\";s:93:\"Enter an URL to link the slider title to a page e.g. http://yoursite.com/pagename/ (optional)\";}i:5;a:5:{s:4:\"name\";s:5:\"embed\";s:3:\"std\";s:0:\"\";s:5:\"label\";s:10:\"Embed Code\";s:4:\"type\";s:8:\"textarea\";s:4:\"desc\";s:69:\"Enter the video embed code for your video (YouTube, Vimeo or similar)\";}}', 'yes'),
(309, 'category_children', 'a:0:{}', 'yes'),
(320, '_transient_product_query-transient-version', '1419053651', 'yes'),
(414, 'woocommerce_language_pack_version', 'a:2:{i:0;s:5:\"2.2.6\";i:1;s:5:\"fa_IR\";}', 'yes'),
(422, 'woocommerce_default_gateway', 'cod', 'yes'),
(423, 'woocommerce_gateway_order', 'a:4:{s:4:\"bacs\";i:0;s:6:\"cheque\";i:1;s:3:\"cod\";i:2;s:6:\"paypal\";i:3;}', 'yes'),
(425, 'woocommerce_cod_settings', 'a:6:{s:7:\"enabled\";s:3:\"yes\";s:5:\"title\";s:36:\"پرداخت هنگام دریافت\";s:11:\"description\";s:43:\"پرداخت نقدی پس از تحویل.\";s:12:\"instructions\";s:43:\"پرداخت نقدی پس از تحویل.\";s:18:\"enable_for_methods\";s:0:\"\";s:18:\"enable_for_virtual\";s:3:\"yes\";}', 'yes'),
(428, 'woocommerce_default_shipping_method', '', 'yes'),
(429, 'woocommerce_shipping_method_order', 'a:5:{s:13:\"free_shipping\";i:0;s:9:\"flat_rate\";i:1;s:22:\"international_delivery\";i:2;s:14:\"local_delivery\";i:3;s:12:\"local_pickup\";i:4;}', 'yes'),
(433, '_transient_woocommerce_cache_excluded_uris', 'a:6:{i:0;s:4:\"p=12\";i:1;s:5:\"/cart\";i:2;s:4:\"p=13\";i:3;s:9:\"/checkout\";i:4;s:4:\"p=14\";i:5;s:11:\"/my-account\";}', 'yes'),
(434, 'woo_alt_stylesheet', 'default.css', 'yes'),
(435, 'woo_logo', 'http://elearning4u.ir/wp-content/uploads/2014/11/elearning-logoo-300x76.png', 'yes'),
(436, 'woo_texttitle', 'false', 'yes'),
(437, 'woo_font_site_title', 'a:5:{s:4:\"size\";s:2:\"30\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:11:\"Droid Serif\";s:5:\"style\";s:4:\"bold\";s:5:\"color\";s:7:\"#333333\";}', 'yes'),
(438, 'woo_tagline', 'false', 'yes'),
(439, 'woo_font_tagline', 'a:5:{s:4:\"size\";s:2:\"12\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:10:\"Droid Sans\";s:5:\"style\";s:6:\"normal\";s:5:\"color\";s:7:\"#999999\";}', 'yes'),
(440, 'woo_custom_favicon', 'http://elearning4u.ir/wp-content/uploads/2014/11/favicon.png', 'yes'),
(441, 'woo_google_analytics', '', 'yes'),
(442, 'woo_feed_url', '', 'yes'),
(443, 'woo_subscribe_email', '', 'yes'),
(444, 'woo_contactform_email', '', 'yes'),
(445, 'woo_custom_css', '', 'yes'),
(446, 'woo_comments', 'post', 'yes'),
(447, 'woo_post_content', 'excerpt', 'yes'),
(448, 'woo_post_author', 'true', 'yes'),
(449, 'woo_breadcrumbs_show', 'false', 'yes'),
(450, 'woo_pagination_type', 'paginated_links', 'yes'),
(451, 'woo_body_color', '', 'yes'),
(452, 'woo_body_img', '', 'yes'),
(453, 'woo_body_repeat', 'no-repeat', 'yes'),
(454, 'woo_body_pos', 'top left', 'yes'),
(455, 'woo_link_color', '', 'yes'),
(456, 'woo_link_hover_color', '', 'yes'),
(457, 'woo_button_color', '', 'yes'),
(458, 'woo_typography', 'false', 'yes'),
(459, 'woo_font_body', 'a:5:{s:4:\"size\";s:2:\"12\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:6:\"normal\";s:5:\"color\";s:7:\"#555555\";}', 'yes'),
(460, 'woo_font_nav', 'a:5:{s:4:\"size\";s:2:\"14\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:6:\"normal\";s:5:\"color\";s:7:\"#555555\";}', 'yes'),
(461, 'woo_font_post_title', 'a:5:{s:4:\"size\";s:2:\"24\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:4:\"bold\";s:5:\"color\";s:7:\"#222222\";}', 'yes'),
(462, 'woo_font_post_meta', 'a:5:{s:4:\"size\";s:2:\"12\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:6:\"normal\";s:5:\"color\";s:7:\"#999999\";}', 'yes'),
(463, 'woo_font_post_entry', 'a:5:{s:4:\"size\";s:2:\"14\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:6:\"normal\";s:5:\"color\";s:7:\"#555555\";}', 'yes'),
(464, 'woo_font_widget_titles', 'a:5:{s:4:\"size\";s:2:\"16\";s:4:\"unit\";s:2:\"px\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:4:\"bold\";s:5:\"color\";s:7:\"#555555\";}', 'yes'),
(465, 'woo_slider', 'true', 'yes'),
(466, 'woo_featured_product_style', 'slider', 'yes'),
(467, 'woo_homepage_content', 'Disabled', 'yes'),
(468, 'woo_slider_entries', '3', 'yes'),
(469, 'woo_slider_effect', 'slide', 'yes'),
(470, 'woo_slider_speed', '0.6', 'yes'),
(471, 'woo_slider_hover', 'false', 'yes'),
(472, 'woo_slider_random', 'false', 'yes'),
(473, 'woo_slider_autoheight', 'false', 'yes'),
(474, 'woo_slider_fixed_height', '320', 'yes'),
(475, 'woo_slider_auto', 'false', 'yes'),
(476, 'woo_slider_interval', '6', 'yes'),
(477, 'woo_slider_title', 'true', 'yes'),
(478, 'woo_slider_content', 'true', 'yes'),
(479, 'woo_slider_nextprev', 'true', 'yes'),
(480, 'woo_slider_pagination', 'true', 'yes'),
(481, 'woo_site_layout', 'layout-left-content', 'yes'),
(482, 'woo_wpthumb_notice', '', 'yes'),
(483, 'woo_post_image_support', 'true', 'yes'),
(484, 'woo_pis_resize', 'true', 'yes'),
(485, 'woo_pis_hard_crop', 'true', 'yes'),
(486, 'woo_resize', 'true', 'yes'),
(487, 'woo_auto_img', 'false', 'yes'),
(488, 'woo_thumb_w', '100', 'yes'),
(489, 'woo_thumb_h', '100', 'yes'),
(490, 'woo_thumb_align', 'alignleft', 'yes'),
(491, 'woo_thumb_single', 'false', 'yes'),
(492, 'woo_single_w', '200', 'yes'),
(493, 'woo_single_h', '200', 'yes'),
(494, 'woo_thumb_single_align', 'alignright', 'yes'),
(495, 'woo_rss_thumb', 'false', 'yes'),
(496, 'woo_footer_sidebars', '4', 'yes'),
(497, 'woo_footer_aff_link', '', 'yes'),
(498, 'woo_footer_left', 'false', 'yes'),
(499, 'woo_footer_left_text', '', 'yes'),
(500, 'woo_footer_right', 'false', 'yes');
INSERT INTO `d_wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(501, 'woo_footer_right_text', '', 'yes'),
(502, 'woo_connect', 'false', 'yes'),
(503, 'woo_connect_title', '', 'yes'),
(504, 'woo_connect_content', '', 'yes'),
(505, 'woo_connect_newsletter_id', '', 'yes'),
(506, 'woo_connect_mailchimp_list_url', '', 'yes'),
(507, 'woo_connect_rss', 'true', 'yes'),
(508, 'woo_connect_twitter', '', 'yes'),
(509, 'woo_connect_facebook', '', 'yes'),
(510, 'woo_connect_youtube', '', 'yes'),
(511, 'woo_connect_flickr', '', 'yes'),
(512, 'woo_connect_linkedin', '', 'yes'),
(513, 'woo_connect_delicious', '', 'yes'),
(514, 'woo_connect_googleplus', '', 'yes'),
(515, 'woo_connect_related', 'true', 'yes'),
(525, 'wpcf7', 'a:1:{s:7:\"version\";s:5:\"4.0.1\";}', 'yes'),
(526, 'woo_custom_upload_tracking', 'a:0:{}', 'yes'),
(527, 'widget_woocommerce_widget_cart', 'a:2:{i:2;a:2:{s:5:\"title\";s:15:\"سبد خرید\";s:13:\"hide_if_empty\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(528, 'widget_woocommerce_product_categories', 'a:2:{i:2;a:6:{s:5:\"title\";s:30:\"دسته های محصولات\";s:7:\"orderby\";s:4:\"name\";s:8:\"dropdown\";i:0;s:5:\"count\";i:0;s:12:\"hierarchical\";s:1:\"1\";s:18:\"show_children_only\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(585, 'product_cat_children', 'a:0:{}', 'yes'),
(609, 'woo_framework_template', 'a:20:{i:0;a:3:{s:4:\"name\";s:14:\"Admin Settings\";s:4:\"icon\";s:7:\"general\";s:4:\"type\";s:7:\"heading\";}i:1;a:6:{s:4:\"name\";s:21:\"Super User (username)\";s:4:\"desc\";s:242:\"Enter your <strong>username</strong> to hide the Framework Settings and Update Framework from other users. Can be reset from the <a href=\'http://elearning4u.ir/wp-admin/options.php\'>WP options page</a> under <em>framework_woo_super_user</em>.\";s:2:\"id\";s:24:\"framework_woo_super_user\";s:3:\"std\";s:0:\"\";s:5:\"class\";s:4:\"text\";s:4:\"type\";s:4:\"text\";}i:2;a:5:{s:4:\"name\";s:21:\"Disable SEO Menu Item\";s:4:\"desc\";s:61:\"Disable the <strong>SEO</strong> menu item in the theme menu.\";s:2:\"id\";s:25:\"framework_woo_seo_disable\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"checkbox\";}i:3;a:5:{s:4:\"name\";s:33:\"Disable Sidebar Manager Menu Item\";s:4:\"desc\";s:73:\"Disable the <strong>Sidebar Manager</strong> menu item in the theme menu.\";s:2:\"id\";s:25:\"framework_woo_sbm_disable\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"checkbox\";}i:4;a:5:{s:4:\"name\";s:33:\"Disable Backup Settings Menu Item\";s:4:\"desc\";s:73:\"Disable the <strong>Backup Settings</strong> menu item in the theme menu.\";s:2:\"id\";s:32:\"framework_woo_backupmenu_disable\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"checkbox\";}i:5;a:5:{s:4:\"name\";s:28:\"Disable Buy Themes Menu Item\";s:4:\"desc\";s:68:\"Disable the <strong>Buy Themes</strong> menu item in the theme menu.\";s:2:\"id\";s:32:\"framework_woo_buy_themes_disable\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"checkbox\";}i:6;a:5:{s:4:\"name\";s:24:\"Enable Custom Navigation\";s:4:\"desc\";s:178:\"Enable the old <strong>Custom Navigation</strong> menu item. Try to use <a href=\'http://elearning4u.ir/wp-admin/nav-menus.php\'>WP Menus</a> instead, as this function is outdated.\";s:2:\"id\";s:20:\"framework_woo_woonav\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"checkbox\";}i:7;a:5:{s:4:\"name\";s:25:\"Theme Update Notification\";s:4:\"desc\";s:101:\"This will enable notices on your theme options page that there is an update available for your theme.\";s:2:\"id\";s:35:\"framework_woo_theme_version_checker\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"checkbox\";}i:8;a:3:{s:4:\"name\";s:14:\"Theme Settings\";s:4:\"icon\";s:7:\"general\";s:4:\"type\";s:7:\"heading\";}i:9;a:5:{s:4:\"name\";s:26:\"Remove Generator Meta Tags\";s:4:\"desc\";s:81:\"This disables the output of generator meta tags in the HEAD section of your site.\";s:2:\"id\";s:31:\"framework_woo_disable_generator\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"checkbox\";}i:10;a:5:{s:4:\"name\";s:17:\"Image Placeholder\";s:4:\"desc\";s:151:\"Set a default image placeholder for your thumbnails. Use this if you want a default image to be shown if you haven\'t added a custom image to your post.\";s:2:\"id\";s:27:\"framework_woo_default_image\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:6:\"upload\";}i:11;a:5:{s:4:\"name\";s:29:\"Disable Shortcodes Stylesheet\";s:4:\"desc\";s:76:\"This disables the output of shortcodes.css in the HEAD section of your site.\";s:2:\"id\";s:32:\"framework_woo_disable_shortcodes\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"checkbox\";}i:12;a:5:{s:4:\"name\";s:39:\"Output \"Tracking Code\" Option in Header\";s:4:\"desc\";s:112:\"This will output the <strong>Tracking Code</strong> option in your header instead of the footer of your website.\";s:2:\"id\";s:32:\"framework_woo_move_tracking_code\";s:3:\"std\";s:5:\"false\";s:4:\"type\";s:8:\"checkbox\";}i:13;a:3:{s:4:\"name\";s:8:\"Branding\";s:4:\"icon\";s:4:\"misc\";s:4:\"type\";s:7:\"heading\";}i:14;a:5:{s:4:\"name\";s:20:\"Options panel header\";s:4:\"desc\";s:50:\"Change the header image for the WooThemes Backend.\";s:2:\"id\";s:34:\"framework_woo_backend_header_image\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:6:\"upload\";}i:15;a:5:{s:4:\"name\";s:18:\"Options panel icon\";s:4:\"desc\";s:56:\"Change the icon image for the WordPress backend sidebar.\";s:2:\"id\";s:26:\"framework_woo_backend_icon\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:6:\"upload\";}i:16;a:5:{s:4:\"name\";s:20:\"WordPress login logo\";s:4:\"desc\";s:51:\"Change the logo image for the WordPress login page.\";s:2:\"id\";s:31:\"framework_woo_custom_login_logo\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:6:\"upload\";}i:17;a:3:{s:4:\"name\";s:9:\"Admin Bar\";s:4:\"icon\";s:6:\"header\";s:4:\"type\";s:7:\"heading\";}i:18;a:5:{s:4:\"name\";s:27:\"Disable WordPress Admin Bar\";s:4:\"desc\";s:32:\"Disable the WordPress Admin Bar.\";s:2:\"id\";s:31:\"framework_woo_admin_bar_disable\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"checkbox\";}i:19;a:5:{s:4:\"name\";s:46:\"Enable the WooFramework Admin Bar enhancements\";s:4:\"desc\";s:130:\"Enable several WooFramework-specific enhancements to the WordPress Admin Bar, such as custom navigation items for \'Theme Options\'.\";s:2:\"id\";s:36:\"framework_woo_admin_bar_enhancements\";s:3:\"std\";s:0:\"\";s:4:\"type\";s:8:\"checkbox\";}}', 'yes'),
(613, '_transient_timeout_wc_rating_count_35', '1446976598', 'no'),
(614, '_transient_wc_rating_count_35', '0', 'no'),
(615, '_transient_timeout_wc_average_rating_35', '1446976598', 'no'),
(616, '_transient_wc_average_rating_35', '', 'no'),
(1351, 'post-ui-tabs_settings', 'a:2:{s:4:\"skin\";s:9:\"cupertino\";s:12:\"rw_feed_html\";i:1;}', 'yes'),
(1453, 'pod_title', 'آموزش مجازی', 'yes'),
(1454, 'pod_tagline', 'ساختن برای ماندن', 'yes'),
(1455, 'pod_disabled_enclose', '', 'yes'),
(1456, 'pod_itunes_summary', '', 'yes'),
(1457, 'pod_itunes_author', 'Jim Collins', 'yes'),
(1458, 'pod_itunes_image', 'http://www.4shared.com/folder/uCIYllXA/Chapter1.html', 'yes'),
(1459, 'pod_itunes_cat1', 'Education', 'yes'),
(1460, 'pod_itunes_cat2', 'Education||Training', 'yes'),
(1461, 'pod_itunes_cat3', 'Government & Organizations||Local', 'yes'),
(1462, 'pod_itunes_keywords', '', 'yes'),
(1463, 'pod_itunes_explicit', '', 'yes'),
(1464, 'pod_itunes_new-feed-url', '', 'yes'),
(1465, 'pod_itunes_ownername', '', 'yes'),
(1466, 'pod_itunes_owneremail', '', 'yes'),
(1467, 'pod_formats', 's:57:\"a:2:{s:14:\"default-format\";s:5:\"clean\";s:3:\"mp3\";s:0:\"\";}\";', 'yes'),
(1468, 'pod_player_flashvars', 'autostart: \\\'no\\\', bg: \\\'e5e5e5\\\'', 'yes'),
(1469, 'pod_audio_width', '290', 'yes'),
(1470, 'pod_player_use_video', 'yes', 'yes'),
(1471, 'pod_player_location', '', 'yes'),
(1472, 'pod_player_text_above', 'Sucsesses built to last', 'yes'),
(1473, 'pod_player_text_before', '', 'yes'),
(1474, 'pod_player_text_below', '', 'yes'),
(1475, 'pod_player_text_link', 'below', 'yes'),
(1476, 'pod_player_width', '400', 'yes'),
(1477, 'pod_player_height', '300', 'yes'),
(1478, 'pod_video_flashvars', '', 'yes'),
(1479, 'pod_accept_fail', 'no', 'yes'),
(1480, 'default-format', 's:29:\"a:1:{s:7:\"default\";s:2:\"no\";}\";', 'yes'),
(1507, 'pod_disable_enclose', '', 'yes'),
(1508, 'pod_cat', '1 selected', 'yes'),
(1510, 'pod_use_native_player', 'yes', 'yes'),
(1511, 'pod_player_audiovars', 'src', 'yes'),
(1512, 'pod_player_videovars', '', 'yes'),
(1524, 'powerpress_general', 'a:9:{s:16:\"process_podpress\";i:0;s:14:\"display_player\";i:1;s:15:\"player_function\";i:1;s:12:\"podcast_link\";i:1;s:18:\"player_width_audio\";s:3:\"290\";s:12:\"player_width\";s:3:\"400\";s:13:\"player_height\";s:3:\"300\";s:9:\"timestamp\";i:1418807560;s:15:\"advanced_mode_2\";s:1:\"0\";}', 'yes'),
(1525, 'powerpress_feed', 'a:5:{s:12:\"itunes_image\";s:52:\"http://www.4shared.com/folder/uCIYllXA/Chapter1.html\";s:12:\"itunes_cat_1\";s:5:\"04-00\";s:12:\"itunes_cat_2\";s:5:\"04-05\";s:12:\"itunes_cat_3\";s:5:\"06-01\";s:15:\"itunes_subtitle\";s:30:\"ساختن برای ماندن\";}', 'yes'),
(1668, '_transient_timeout_wc_products_will_display_121419053651', '1511405894', 'no'),
(1669, '_transient_wc_products_will_display_121419053651', '1', 'no'),
(1672, '_transient_timeout_wc_products_will_display_141419053651', '1511405904', 'no'),
(1673, '_transient_wc_products_will_display_141419053651', '1', 'no'),
(1676, '_transient_timeout_wc_products_will_display_131419053651', '1511638905', 'no'),
(1677, '_transient_wc_products_will_display_131419053651', '1', 'no'),
(1680, '_transient_timeout_wc_products_will_display_151419053651', '1511658159', 'no'),
(1681, '_transient_wc_products_will_display_151419053651', '1', 'no'),
(1684, '_transient_timeout_wc_products_will_display_171419053651', '1511658166', 'no'),
(1685, '_transient_wc_products_will_display_171419053651', '1', 'no'),
(1692, '_transient_timeout_wc_products_will_display_161419053651', '1511658169', 'no'),
(1693, '_transient_wc_products_will_display_161419053651', '1', 'no'),
(1756, 'theme_mods_superstore', 'a:2:{i:0;b:0;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1431719643;s:4:\"data\";a:7:{s:19:\"wp_inactive_widgets\";a:1:{i:0;s:8:\"search-2\";}s:7:\"primary\";a:5:{i:0;s:25:\"woocommerce_widget_cart-2\";i:1;s:32:\"woocommerce_product_categories-2\";i:2;s:14:\"recent-posts-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";}s:8:\"footer-1\";a:0:{}s:8:\"footer-2\";a:0:{}s:8:\"footer-3\";a:0:{}s:8:\"footer-4\";a:0:{}s:8:\"homepage\";N;}}}', 'yes'),
(1785, '_transient_timeout_wc_products_will_display_111419053651', '1509317723', 'no'),
(1786, '_transient_wc_products_will_display_111419053651', '1', 'no'),
(1855, '_transient_timeout_wc_uf_pid_8795275fa8736fb2a7f3ad62bb8cf5a5', '1451632993', 'no'),
(1856, '_transient_wc_uf_pid_8795275fa8736fb2a7f3ad62bb8cf5a5', 'a:0:{}', 'no'),
(2060, '_transient_timeout_wc_term_counts', '1453208780', 'no'),
(2061, '_transient_wc_term_counts', 'a:4:{i:8;s:1:\"1\";i:10;s:1:\"0\";i:9;s:0:\"\";i:6;s:0:\"\";}', 'no'),
(2908, 'woo_pagenav_show', 'true', 'yes'),
(2909, 'woo_body_attachment', 'scroll', 'yes'),
(2910, 'woo_font_page_title', 'a:5:{s:4:\"size\";s:3:\"1.4\";s:4:\"unit\";s:2:\"em\";s:4:\"face\";s:17:\"Arial, sans-serif\";s:5:\"style\";s:4:\"bold\";s:5:\"color\";s:7:\"#3E3E3E\";}', 'yes'),
(2911, 'woo_exclude_cats_home', '', 'yes'),
(2912, 'woo_exclude_cats_blog', '', 'yes'),
(2913, 'woo_business_display_slider', 'true', 'yes'),
(2914, 'woo_business_display_features', 'true', 'yes'),
(2915, 'woo_business_display_testimonials', 'true', 'yes'),
(2916, 'woo_business_display_blog', 'true', 'yes'),
(2917, 'woo_featured', 'false', 'yes'),
(2918, 'woo_featured_entries', '3', 'yes'),
(2919, 'woo_featured_slide_group', '0', 'yes'),
(2920, 'woo_featured_videotitle', 'true', 'yes'),
(2921, 'woo_featured_order', 'DESC', 'yes'),
(2922, 'woo_featured_animation', 'fade', 'yes'),
(2923, 'woo_featured_nextprev', 'true', 'yes'),
(2924, 'woo_featured_pagination', 'false', 'yes'),
(2925, 'woo_featured_hover', 'true', 'yes'),
(2926, 'woo_featured_action', 'true', 'yes'),
(2927, 'woo_featured_speed', '7', 'yes'),
(2928, 'woo_featured_animation_speed', '0.6', 'yes'),
(2929, 'woo_homepage_notice', '', 'yes'),
(2930, 'woo_homepage_enable_product_categories', 'true', 'yes'),
(2931, 'woo_homepage_enable_featured_products', 'true', 'yes'),
(2932, 'woo_homepage_enable_recent_products', 'true', 'yes'),
(2933, 'woo_homepage_enable_testimonials', 'true', 'yes'),
(2934, 'woo_homepage_enable_content', 'true', 'yes'),
(2935, 'woo_homepage_product_categories_limit', '4', 'yes'),
(2936, 'woo_homepage_featured_products_limit', '4', 'yes'),
(2937, 'woo_homepage_recent_products_title', '', 'yes'),
(2938, 'woo_homepage_recent_products_limit', '4', 'yes'),
(2939, 'woo_homepage_content_type', 'posts', 'yes'),
(2940, 'woo_homepage_page_id', '0', 'yes'),
(2941, 'woo_homepage_number_of_posts', '5', 'yes'),
(2942, 'woo_homepage_posts_category', '0', 'yes'),
(2943, 'woo_homepage_posts_sidebar', 'true', 'yes'),
(2944, 'woo_placeholder_url', '', 'yes'),
(2945, 'woocommerce_header_cart_link', 'true', 'yes'),
(2946, 'woocommerce_header_search_form', 'true', 'yes'),
(2947, 'woocommerce_hide_nav', 'false', 'yes'),
(2948, 'woocommerce_archives_fullwidth', 'false', 'yes'),
(2949, 'woocommerce_product_columns', '3', 'yes'),
(2950, 'woocommerce_products_per_page', '12', 'yes'),
(2951, 'woocommerce_archives_infinite_scroll', 'true', 'yes'),
(2952, 'woocommerce_related_products', 'true', 'yes'),
(2953, 'woocommerce_related_products_maximum', '3', 'yes'),
(2954, 'woocommerce_products_fullwidth', 'false', 'yes'),
(2955, 'woo_enable_lightbox', 'false', 'yes'),
(2956, 'woo_ad_top', 'false', 'yes'),
(2957, 'woo_ad_top_adsense', '', 'yes'),
(2958, 'woo_ad_top_image', 'http://www.woothemes.com/ads/468x60b.jpg', 'yes'),
(2959, 'woo_ad_top_url', 'http://www.woothemes.com', 'yes'),
(2960, 'woo_contact_panel', 'false', 'yes'),
(2961, 'woo_contact_title', '', 'yes'),
(2962, 'woo_contact_address', '', 'yes'),
(2963, 'woo_contact_number', '', 'yes'),
(2964, 'woo_contact_fax', '', 'yes'),
(2965, 'woo_contact_twitter', '', 'yes'),
(2966, 'woo_contact_subscribe_and_connect', 'false', 'yes'),
(2967, 'woo_contactform_map_coords', '', 'yes'),
(2968, 'woo_maps_scroll', 'false', 'yes'),
(2969, 'woo_maps_single_height', '250', 'yes'),
(2970, 'woo_maps_default_mapzoom', '9', 'yes'),
(2971, 'woo_maps_default_maptype', 'G_NORMAL_MAP', 'yes'),
(2972, 'woo_maps_callout_text', '', 'yes'),
(3197, 'theme_mods_classic', 'a:2:{i:0;b:0;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1446854128;s:4:\"data\";a:2:{s:19:\"wp_inactive_widgets\";a:1:{i:0;s:8:\"search-2\";}s:9:\"sidebar-1\";a:5:{i:0;s:25:\"woocommerce_widget_cart-2\";i:1;s:32:\"woocommerce_product_categories-2\";i:2;s:14:\"recent-posts-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";}}}}', 'yes'),
(5524, 'finished_splitting_shared_terms', '1', 'yes'),
(5525, 'db_upgraded', '', 'yes'),
(5529, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:6:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:7:\"upgrade\";s:8:\"download\";s:57:\"https://downloads.wordpress.org/release/wordpress-4.7.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:57:\"https://downloads.wordpress.org/release/wordpress-4.7.zip\";s:10:\"no_content\";s:68:\"https://downloads.wordpress.org/release/wordpress-4.7-no-content.zip\";s:11:\"new_bundled\";s:69:\"https://downloads.wordpress.org/release/wordpress-4.7-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:3:\"4.7\";s:7:\"version\";s:3:\"4.7\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"4.7\";s:15:\"partial_version\";s:0:\"\";}i:1;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:57:\"https://downloads.wordpress.org/release/wordpress-4.7.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:57:\"https://downloads.wordpress.org/release/wordpress-4.7.zip\";s:10:\"no_content\";s:68:\"https://downloads.wordpress.org/release/wordpress-4.7-no-content.zip\";s:11:\"new_bundled\";s:69:\"https://downloads.wordpress.org/release/wordpress-4.7-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:3:\"4.7\";s:7:\"version\";s:3:\"4.7\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"4.7\";s:15:\"partial_version\";s:0:\"\";s:9:\"new_files\";s:1:\"1\";}i:2;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:65:\"https://downloads.wordpress.org/release/fa_IR/wordpress-4.6.1.zip\";s:6:\"locale\";s:5:\"fa_IR\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:65:\"https://downloads.wordpress.org/release/fa_IR/wordpress-4.6.1.zip\";s:10:\"no_content\";b:0;s:11:\"new_bundled\";b:0;s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"4.6.1\";s:7:\"version\";s:5:\"4.6.1\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"4.7\";s:15:\"partial_version\";s:0:\"\";s:9:\"new_files\";s:1:\"1\";}i:3;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-4.5.4.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-4.5.4.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-4.5.4-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-4.5.4-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"4.5.4\";s:7:\"version\";s:5:\"4.5.4\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"4.7\";s:15:\"partial_version\";s:0:\"\";s:9:\"new_files\";s:1:\"1\";}i:4;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-4.4.5.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-4.4.5.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-4.4.5-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-4.4.5-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"4.4.5\";s:7:\"version\";s:5:\"4.4.5\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"4.7\";s:15:\"partial_version\";s:0:\"\";s:9:\"new_files\";s:1:\"1\";}i:5;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-4.3.6.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-4.3.6.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-4.3.6-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-4.3.6-new-bundled.zip\";s:7:\"partial\";s:69:\"https://downloads.wordpress.org/release/wordpress-4.3.6-partial-1.zip\";s:8:\"rollback\";s:70:\"https://downloads.wordpress.org/release/wordpress-4.3.6-rollback-1.zip\";}s:7:\"current\";s:5:\"4.3.6\";s:7:\"version\";s:5:\"4.3.6\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"4.7\";s:15:\"partial_version\";s:5:\"4.3.1\";s:9:\"new_files\";s:0:\"\";}}s:12:\"last_checked\";i:1481942451;s:15:\"version_checked\";s:5:\"4.3.1\";s:12:\"translations\";a:0:{}}', 'yes'),
(5530, 'can_compress_scripts', '0', 'yes'),
(5531, '_site_transient_update_plugins', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1481942453;s:8:\"response\";a:5:{s:19:\"akismet/akismet.php\";O:8:\"stdClass\":6:{s:2:\"id\";s:2:\"15\";s:4:\"slug\";s:7:\"akismet\";s:6:\"plugin\";s:19:\"akismet/akismet.php\";s:11:\"new_version\";s:3:\"3.2\";s:3:\"url\";s:38:\"https://wordpress.org/plugins/akismet/\";s:7:\"package\";s:54:\"https://downloads.wordpress.org/plugin/akismet.3.2.zip\";}s:25:\"powerpress/powerpress.php\";O:8:\"stdClass\":6:{s:2:\"id\";s:4:\"4269\";s:4:\"slug\";s:10:\"powerpress\";s:6:\"plugin\";s:25:\"powerpress/powerpress.php\";s:11:\"new_version\";s:5:\"7.0.3\";s:3:\"url\";s:41:\"https://wordpress.org/plugins/powerpress/\";s:7:\"package\";s:59:\"https://downloads.wordpress.org/plugin/powerpress.7.0.3.zip\";}s:32:\"links-dropdown-widget/plugin.php\";O:8:\"stdClass\":6:{s:2:\"id\";s:5:\"47372\";s:4:\"slug\";s:21:\"links-dropdown-widget\";s:6:\"plugin\";s:32:\"links-dropdown-widget/plugin.php\";s:11:\"new_version\";s:3:\"1.1\";s:3:\"url\";s:52:\"https://wordpress.org/plugins/links-dropdown-widget/\";s:7:\"package\";s:68:\"https://downloads.wordpress.org/plugin/links-dropdown-widget.1.1.zip\";}s:23:\"wp-jalali/wp-jalali.php\";O:8:\"stdClass\":6:{s:2:\"id\";s:3:\"788\";s:4:\"slug\";s:9:\"wp-jalali\";s:6:\"plugin\";s:23:\"wp-jalali/wp-jalali.php\";s:11:\"new_version\";s:5:\"5.0.1\";s:3:\"url\";s:40:\"https://wordpress.org/plugins/wp-jalali/\";s:7:\"package\";s:58:\"https://downloads.wordpress.org/plugin/wp-jalali.5.0.1.zip\";}s:43:\"persian-woocommerce/woocommerce-persian.php\";O:8:\"stdClass\":7:{s:2:\"id\";s:5:\"47669\";s:4:\"slug\";s:19:\"persian-woocommerce\";s:6:\"plugin\";s:43:\"persian-woocommerce/woocommerce-persian.php\";s:11:\"new_version\";s:5:\"2.6.3\";s:3:\"url\";s:50:\"https://wordpress.org/plugins/persian-woocommerce/\";s:7:\"package\";s:62:\"https://downloads.wordpress.org/plugin/persian-woocommerce.zip\";s:14:\"upgrade_notice\";s:39:\"رفع باگ امنیتی پلاگین\";}}s:12:\"translations\";a:1:{i:0;a:7:{s:4:\"type\";s:6:\"plugin\";s:4:\"slug\";s:9:\"wp-jalali\";s:8:\"language\";s:5:\"fa_IR\";s:7:\"version\";s:5:\"5.0.0\";s:7:\"updated\";s:19:\"2015-09-23 18:16:23\";s:7:\"package\";s:76:\"https://downloads.wordpress.org/translation/plugin/wp-jalali/5.0.0/fa_IR.zip\";s:10:\"autoupdate\";b:1;}}s:9:\"no_update\";a:5:{s:36:\"contact-form-7/wp-contact-form-7.php\";O:8:\"stdClass\":6:{s:2:\"id\";s:3:\"790\";s:4:\"slug\";s:14:\"contact-form-7\";s:6:\"plugin\";s:36:\"contact-form-7/wp-contact-form-7.php\";s:11:\"new_version\";s:3:\"4.6\";s:3:\"url\";s:45:\"https://wordpress.org/plugins/contact-form-7/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/plugin/contact-form-7.4.6.zip\";}s:9:\"hello.php\";O:8:\"stdClass\":6:{s:2:\"id\";s:4:\"3564\";s:4:\"slug\";s:11:\"hello-dolly\";s:6:\"plugin\";s:9:\"hello.php\";s:11:\"new_version\";s:3:\"1.6\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/hello-dolly/\";s:7:\"package\";s:58:\"https://downloads.wordpress.org/plugin/hello-dolly.1.6.zip\";}s:11:\"put/put.php\";O:8:\"stdClass\":6:{s:2:\"id\";s:5:\"21715\";s:4:\"slug\";s:3:\"put\";s:6:\"plugin\";s:11:\"put/put.php\";s:11:\"new_version\";s:5:\"1.1.0\";s:3:\"url\";s:34:\"https://wordpress.org/plugins/put/\";s:7:\"package\";s:52:\"https://downloads.wordpress.org/plugin/put.1.1.0.zip\";}s:27:\"woocommerce/woocommerce.php\";O:8:\"stdClass\":6:{s:2:\"id\";s:5:\"25331\";s:4:\"slug\";s:11:\"woocommerce\";s:6:\"plugin\";s:27:\"woocommerce/woocommerce.php\";s:11:\"new_version\";s:5:\"2.6.9\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/woocommerce/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/plugin/woocommerce.2.6.9.zip\";}s:41:\"wp-multibyte-patch/wp-multibyte-patch.php\";O:8:\"stdClass\":6:{s:2:\"id\";s:5:\"24017\";s:4:\"slug\";s:18:\"wp-multibyte-patch\";s:6:\"plugin\";s:41:\"wp-multibyte-patch/wp-multibyte-patch.php\";s:11:\"new_version\";s:5:\"2.8.1\";s:3:\"url\";s:49:\"https://wordpress.org/plugins/wp-multibyte-patch/\";s:7:\"package\";s:67:\"https://downloads.wordpress.org/plugin/wp-multibyte-patch.2.8.1.zip\";}}}', 'yes'),
(5532, '_site_transient_update_themes', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1481942458;s:7:\"checked\";a:8:{s:11:\"boemia.free\";s:5:\"1.2.1\";s:7:\"classic\";s:3:\"1.6\";s:7:\"default\";s:5:\"1.7.2\";s:10:\"superstore\";s:5:\"1.0.0\";s:14:\"twentyfourteen\";s:3:\"1.2\";s:14:\"twentythirteen\";s:3:\"1.3\";s:12:\"twentytwelve\";s:3:\"1.5\";s:8:\"woostore\";s:5:\"1.4.2\";}s:8:\"response\";a:3:{s:14:\"twentyfourteen\";a:4:{s:5:\"theme\";s:14:\"twentyfourteen\";s:11:\"new_version\";s:3:\"1.9\";s:3:\"url\";s:44:\"https://wordpress.org/themes/twentyfourteen/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/theme/twentyfourteen.1.9.zip\";}s:14:\"twentythirteen\";a:4:{s:5:\"theme\";s:14:\"twentythirteen\";s:11:\"new_version\";s:3:\"2.1\";s:3:\"url\";s:44:\"https://wordpress.org/themes/twentythirteen/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/theme/twentythirteen.2.1.zip\";}s:12:\"twentytwelve\";a:4:{s:5:\"theme\";s:12:\"twentytwelve\";s:11:\"new_version\";s:3:\"2.2\";s:3:\"url\";s:42:\"https://wordpress.org/themes/twentytwelve/\";s:7:\"package\";s:58:\"https://downloads.wordpress.org/theme/twentytwelve.2.2.zip\";}}s:12:\"translations\";a:0:{}}', 'yes'),
(5535, 'theme_mods_default', 'a:1:{s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1446854190;s:4:\"data\";a:2:{s:19:\"wp_inactive_widgets\";a:1:{i:0;s:8:\"search-2\";}s:18:\"orphaned_widgets_1\";a:3:{i:0;s:14:\"recent-posts-2\";i:1;s:10:\"archives-2\";i:2;s:12:\"categories-2\";}}}}', 'yes'),
(6341, '_transient_timeout_wc_uf_pid_b63dbddf574bce2e9a9d6b0c46f2b961', '1482254228', 'no'),
(6342, '_transient_wc_uf_pid_b63dbddf574bce2e9a9d6b0c46f2b961', 'a:1:{i:0;i:28;}', 'no'),
(6350, '_transient_timeout_wc_uf_pid_c24fbb78bd0d3f314790d904b1447f78', '1482282594', 'no'),
(6351, '_transient_wc_uf_pid_c24fbb78bd0d3f314790d904b1447f78', 'a:1:{i:0;i:28;}', 'no'),
(6352, '_transient_timeout_wc_uf_pid_509dd51daa3cd7826af89109b0a04dcb', '1482282604', 'no'),
(6353, '_transient_wc_uf_pid_509dd51daa3cd7826af89109b0a04dcb', 'a:1:{i:0;i:28;}', 'no'),
(6354, '_transient_timeout_wc_uf_pid_765e477ca47bb44ec37d813919181baa', '1482282611', 'no'),
(6355, '_transient_wc_uf_pid_765e477ca47bb44ec37d813919181baa', 'a:1:{i:0;i:28;}', 'no'),
(6360, '_transient_timeout_wc_uf_pid_9934c5065dd50ff3c0b76783601ca93f', '1482292864', 'no'),
(6361, '_transient_wc_uf_pid_9934c5065dd50ff3c0b76783601ca93f', 'a:1:{i:0;i:28;}', 'no'),
(6373, '_transient_timeout_wc_uf_pid_2636096f6ecbb5809bed71068c0f50c9', '1482359768', 'no'),
(6374, '_transient_wc_uf_pid_2636096f6ecbb5809bed71068c0f50c9', 'a:1:{i:0;i:28;}', 'no'),
(6375, '_transient_timeout_wc_uf_pid_117426d8aa859bcf724f4411bc0e4816', '1482359771', 'no'),
(6376, '_transient_wc_uf_pid_117426d8aa859bcf724f4411bc0e4816', 'a:1:{i:0;i:28;}', 'no'),
(6379, '_transient_timeout_wc_uf_pid_4a4ed1ccf381ddf7239fa33742ba68c0', '1482359775', 'no'),
(6380, '_transient_wc_uf_pid_4a4ed1ccf381ddf7239fa33742ba68c0', 'a:1:{i:0;i:28;}', 'no'),
(6381, '_transient_timeout_wc_uf_pid_3a4580e7a3760fc837fee98dc4676fd8', '1482359779', 'no'),
(6382, '_transient_wc_uf_pid_3a4580e7a3760fc837fee98dc4676fd8', 'a:1:{i:0;i:28;}', 'no'),
(6383, '_transient_timeout_wc_uf_pid_96ba1675bdbbff999d6f0ae20e84c264', '1482359783', 'no'),
(6384, '_transient_wc_uf_pid_96ba1675bdbbff999d6f0ae20e84c264', 'a:1:{i:0;i:28;}', 'no'),
(6385, '_transient_timeout_wc_uf_pid_8ad5f507f49bcdada8d46a343a1ce20b', '1482359787', 'no'),
(6386, '_transient_wc_uf_pid_8ad5f507f49bcdada8d46a343a1ce20b', 'a:1:{i:0;i:28;}', 'no'),
(6396, '_transient_timeout_wc_uf_pid_222d1ffd5a6812727ace773975766d6b', '1482398035', 'no'),
(6397, '_transient_wc_uf_pid_222d1ffd5a6812727ace773975766d6b', 'a:0:{}', 'no'),
(6398, '_transient_timeout_wc_uf_pid_f2a1d57dbd3e999b54fef6bbc0d80d42', '1482398039', 'no'),
(6399, '_transient_wc_uf_pid_f2a1d57dbd3e999b54fef6bbc0d80d42', 'a:1:{i:0;i:28;}', 'no'),
(6403, '_transient_timeout_wc_uf_pid_258eb6e22464eb13e19a11f8c94655df', '1482414389', 'no'),
(6404, '_transient_wc_uf_pid_258eb6e22464eb13e19a11f8c94655df', 'a:0:{}', 'no'),
(6425, '_transient_timeout_wc_uf_pid_a03c5a5103779bd3cb0ba9f0dafb4329', '1482492639', 'no'),
(6426, '_transient_wc_uf_pid_a03c5a5103779bd3cb0ba9f0dafb4329', 'a:0:{}', 'no'),
(6427, '_transient_timeout_wc_uf_pid_029b448aa5532d217d9bb02bf6cc9843', '1482492656', 'no'),
(6428, '_transient_wc_uf_pid_029b448aa5532d217d9bb02bf6cc9843', 'a:0:{}', 'no'),
(6468, '_transient_timeout_wc_uf_pid_80c9038c06abd4e42be95ae255b6249b', '1482668358', 'no'),
(6469, '_transient_wc_uf_pid_80c9038c06abd4e42be95ae255b6249b', 'a:0:{}', 'no'),
(6517, '_transient_timeout_wc_uf_pid_0ba64d87ea5addd61c0e36f80e523e09', '1482879522', 'no'),
(6518, '_transient_wc_uf_pid_0ba64d87ea5addd61c0e36f80e523e09', 'a:0:{}', 'no'),
(6520, '_transient_timeout_wc_uf_pid_4fec0fcb8a0972289142c6150afbf843', '1482883421', 'no'),
(6521, '_transient_wc_uf_pid_4fec0fcb8a0972289142c6150afbf843', 'a:1:{i:0;i:28;}', 'no'),
(6569, '_transient_timeout_wc_uf_pid_2731fe295684c5dee7e51a1a566a075e', '1483065921', 'no'),
(6570, '_transient_wc_uf_pid_2731fe295684c5dee7e51a1a566a075e', 'a:1:{i:0;i:28;}', 'no'),
(6575, '_transient_timeout_wc_uf_pid_c53e3ff18a6109f7cd63049a4c1895e7', '1483091887', 'no'),
(6576, '_transient_wc_uf_pid_c53e3ff18a6109f7cd63049a4c1895e7', 'a:1:{i:0;i:28;}', 'no'),
(6604, '_transient_timeout_wc_uf_pid_58f9c90ae42ba13ecfcaefc2262954f2', '1483202897', 'no'),
(6605, '_transient_wc_uf_pid_58f9c90ae42ba13ecfcaefc2262954f2', 'a:0:{}', 'no'),
(6722, '_transient_timeout_wc_uf_pid_2dbd73d40d117ed1a92c33b43c858062', '1483660233', 'no'),
(6723, '_transient_wc_uf_pid_2dbd73d40d117ed1a92c33b43c858062', 'a:1:{i:0;i:28;}', 'no'),
(6724, '_transient_timeout_wc_uf_pid_d09d4e7b8dc4b6bbbe937ee835667207', '1483660237', 'no'),
(6725, '_transient_wc_uf_pid_d09d4e7b8dc4b6bbbe937ee835667207', 'a:0:{}', 'no'),
(6758, '_transient_timeout_wc_uf_pid_e7531b76d983d668b2e0c32c9e94d50d', '1483764875', 'no'),
(6759, '_transient_wc_uf_pid_e7531b76d983d668b2e0c32c9e94d50d', 'a:1:{i:0;i:28;}', 'no'),
(6779, '_transient_timeout_wc_uf_pid_c78fde75cdfe24b5a0061c77891cc4db', '1483838298', 'no'),
(6780, '_transient_wc_uf_pid_c78fde75cdfe24b5a0061c77891cc4db', 'a:1:{i:0;i:28;}', 'no'),
(6989, '_transient_timeout_wc_uf_pid_9fe891c217d263e2c193dc90a117bc07', '1484715734', 'no'),
(6990, '_transient_wc_uf_pid_9fe891c217d263e2c193dc90a117bc07', 'a:0:{}', 'no'),
(7185, '_transient_timeout_wc_uf_pid_f259575e040f7f7f0ad93104fe30cc52', '1485771092', 'no'),
(7186, '_transient_wc_uf_pid_f259575e040f7f7f0ad93104fe30cc52', 'a:0:{}', 'no'),
(7241, '_transient_timeout_wc_uf_pid_2b784d513b2f09005af9dbbc9e7c766c', '1486123460', 'no'),
(7242, '_transient_wc_uf_pid_2b784d513b2f09005af9dbbc9e7c766c', 'a:0:{}', 'no'),
(7243, '_transient_timeout_wc_uf_pid_eb341a822069d9f771e755f6bac931c1', '1486123466', 'no'),
(7244, '_transient_wc_uf_pid_eb341a822069d9f771e755f6bac931c1', 'a:0:{}', 'no'),
(7362, '_transient_timeout_wc_uf_pid_f19e9d96a6665cca6c163286b1dc7ea9', '1486764382', 'no'),
(7363, '_transient_wc_uf_pid_f19e9d96a6665cca6c163286b1dc7ea9', 'a:0:{}', 'no'),
(7364, '_transient_timeout_wc_uf_pid_c326537a1467ec4bfa03bf4177409b34', '1486764385', 'no'),
(7365, '_transient_wc_uf_pid_c326537a1467ec4bfa03bf4177409b34', 'a:0:{}', 'no'),
(7717, '_transient_timeout_wc_uf_pid_9bcdafe1340a27703be67c2b28c6bea7', '1488540432', 'no'),
(7718, '_transient_wc_uf_pid_9bcdafe1340a27703be67c2b28c6bea7', 'a:0:{}', 'no'),
(7959, '_transient_timeout_wc_uf_pid_d19e86e5caec308b6c2bcda4177b3fd8', '1489717652', 'no'),
(7960, '_transient_wc_uf_pid_d19e86e5caec308b6c2bcda4177b3fd8', 'a:0:{}', 'no'),
(7961, '_transient_timeout_wc_uf_pid_d48f761abfc3f5872db92c9f4a25ee66', '1489717655', 'no'),
(7962, '_transient_wc_uf_pid_d48f761abfc3f5872db92c9f4a25ee66', 'a:0:{}', 'no'),
(10674, '_transient_timeout_wc_rating_count_28', '1510048614', 'no'),
(10675, '_transient_wc_rating_count_28', '0', 'no'),
(10676, '_transient_timeout_wc_average_rating_28', '1510048615', 'no'),
(10677, '_transient_wc_average_rating_28', '', 'no'),
(10959, '_transient_doing_cron', '1481942444.4257919788360595703125', 'yes'),
(10998, '_site_transient_timeout_theme_roots', '1481944255', 'yes'),
(10999, '_site_transient_theme_roots', 'a:8:{s:11:\"boemia.free\";s:7:\"/themes\";s:7:\"classic\";s:7:\"/themes\";s:7:\"default\";s:7:\"/themes\";s:10:\"superstore\";s:7:\"/themes\";s:14:\"twentyfourteen\";s:7:\"/themes\";s:14:\"twentythirteen\";s:7:\"/themes\";s:12:\"twentytwelve\";s:7:\"/themes\";s:8:\"woostore\";s:7:\"/themes\";}', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_postmeta`
--

CREATE TABLE `d_wp_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_wp_postmeta`
--

INSERT INTO `d_wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(5, 15, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:101;s:6:\"height\";i:94;s:4:\"file\";s:19:\"2014/11/favicon.png\";s:5:\"sizes\";a:1:{s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:17:\"favicon-90x90.png\";s:5:\"width\";i:90;s:6:\"height\";i:90;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:11:{s:8:\"aperture\";i:0;s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";i:0;s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";i:0;s:3:\"iso\";i:0;s:13:\"shutter_speed\";i:0;s:5:\"title\";s:0:\"\";s:11:\"orientation\";i:0;}}'),
(4, 15, '_wp_attached_file', '2014/11/favicon.png'),
(6, 15, '_wp_attachment_image_alt', 'elearning4u'),
(7, 16, '_wp_attached_file', '2014/11/elearning-logoo.png'),
(8, 16, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:399;s:6:\"height\";i:102;s:4:\"file\";s:27:\"2014/11/elearning-logoo.png\";s:5:\"sizes\";a:5:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:27:\"elearning-logoo-150x102.png\";s:5:\"width\";i:150;s:6:\"height\";i:102;s:9:\"mime-type\";s:9:\"image/png\";}s:6:\"medium\";a:4:{s:4:\"file\";s:26:\"elearning-logoo-300x76.png\";s:5:\"width\";i:300;s:6:\"height\";i:76;s:9:\"mime-type\";s:9:\"image/png\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:25:\"elearning-logoo-90x90.png\";s:5:\"width\";i:90;s:6:\"height\";i:90;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:27:\"elearning-logoo-150x102.png\";s:5:\"width\";i:150;s:6:\"height\";i:102;s:9:\"mime-type\";s:9:\"image/png\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:27:\"elearning-logoo-300x102.png\";s:5:\"width\";i:300;s:6:\"height\";i:102;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:11:{s:8:\"aperture\";i:0;s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";i:0;s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";i:0;s:3:\"iso\";i:0;s:13:\"shutter_speed\";i:0;s:5:\"title\";s:0:\"\";s:11:\"orientation\";i:0;}}'),
(12, 19, '_form', '<p>نام شما (الزامی)<br />\\n    [text* your-name] </p>\\n\\n<p>آدرس پست الکترونیکی شما (الزامی)<br />\\n    [email* your-email] </p>\\n\\n<p>موضوع<br />\\n    [text your-subject] </p>\\n\\n<p>پیام شما<br />\\n    [textarea your-message] </p>\\n\\n<p>[submit \"ارسال\"]</p>'),
(13, 19, '_mail', 'a:8:{s:7:\"subject\";s:14:\"[your-subject]\";s:6:\"sender\";s:38:\"[your-name] <wordpress@elearning4u.ir>\";s:4:\"body\";s:212:\"از: [your-name] <[your-email]>\\nموضوع: [your-subject]\\n\\nمتن پیام:\\n[your-message]\\n\\n--\\nاین ایمیل از فرم تماس در آموزش مجازی (http://elearning4u.ir) ارسال شده است.\";s:9:\"recipient\";s:20:\"mesbahsoft@gmail.com\";s:18:\"additional_headers\";s:22:\"Reply-To: [your-email]\";s:11:\"attachments\";s:0:\"\";s:8:\"use_html\";i:0;s:13:\"exclude_blank\";i:0;}'),
(14, 19, '_mail_2', 'a:9:{s:6:\"active\";b:0;s:7:\"subject\";s:14:\"[your-subject]\";s:6:\"sender\";s:48:\"آموزش مجازی <wordpress@elearning4u.ir>\";s:4:\"body\";s:151:\"متن پیام:\\n[your-message]\\n\\n--\\nاین ایمیل از فرم تماس در آموزش مجازی (http://elearning4u.ir) ارسال شده است.\";s:9:\"recipient\";s:12:\"[your-email]\";s:18:\"additional_headers\";s:30:\"Reply-To: mesbahsoft@gmail.com\";s:11:\"attachments\";s:0:\"\";s:8:\"use_html\";i:0;s:13:\"exclude_blank\";i:0;}'),
(15, 19, '_messages', 'a:6:{s:12:\"mail_sent_ok\";s:66:\"پیام شما با موفقیت ارسال شد. متشکریم.\";s:12:\"mail_sent_ng\";s:167:\"ارسال پیام شما با شکست مواجه شد. لطفا بعدا امتحان کنید و یا از طریق دیگری با مدیر تماس بگیرید.\";s:16:\"validation_error\";s:137:\"ارسال ناموفق. لطفا زمینه ها الزامی را پر کرده و دوباره دکمه ی ارسال را بزنید.\";s:4:\"spam\";s:167:\"ارسال پیام شما با شکست مواجه شد. لطفا بعدا امتحان کنید و یا از طریق دیگری با مدیر تماس بگیرید.\";s:12:\"accept_terms\";s:60:\"برای ادامه لطفا شرایط را بپذیرید.\";s:16:\"invalid_required\";s:52:\"لطفا زمینه الزامی را پر کنید.\";}'),
(16, 19, '_additional_settings', ''),
(17, 19, '_locale', 'fa_IR'),
(18, 20, '_edit_lock', '1415172801:2'),
(19, 20, '_edit_last', '2'),
(20, 21, '_wp_attached_file', '2014/11/CRM-Sliderr.png'),
(21, 21, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:420;s:6:\"height\";i:217;s:4:\"file\";s:23:\"2014/11/CRM-Sliderr.png\";s:5:\"sizes\";a:5:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:23:\"CRM-Sliderr-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:6:\"medium\";a:4:{s:4:\"file\";s:23:\"CRM-Sliderr-300x155.png\";s:5:\"width\";i:300;s:6:\"height\";i:155;s:9:\"mime-type\";s:9:\"image/png\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:21:\"CRM-Sliderr-90x90.png\";s:5:\"width\";i:90;s:6:\"height\";i:90;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:23:\"CRM-Sliderr-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:23:\"CRM-Sliderr-300x217.png\";s:5:\"width\";i:300;s:6:\"height\";i:217;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:11:{s:8:\"aperture\";i:0;s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";i:0;s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";i:0;s:3:\"iso\";i:0;s:13:\"shutter_speed\";i:0;s:5:\"title\";s:0:\"\";s:11:\"orientation\";i:0;}}'),
(22, 20, '_thumbnail_id', '21'),
(23, 20, 'image', 'http://elearning4u.ir/wp-content/uploads/2014/11/CRM-Sliderr-300x155.png'),
(24, 20, 'slide_layout', 'bottom'),
(25, 20, 'seo_follow', 'false'),
(26, 20, 'seo_noindex', 'false'),
(27, 22, '_edit_lock', '1415174225:2'),
(28, 22, '_edit_last', '2'),
(29, 22, '_wp_page_template', 'default'),
(30, 22, 'seo_follow', 'false'),
(31, 22, 'seo_noindex', 'false'),
(34, 28, '_edit_lock', '1419060527:2'),
(35, 28, '_edit_last', '2'),
(36, 29, '_wp_attached_file', '2014/11/Built_to_Last_book.jpg'),
(37, 29, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:326;s:6:\"height\";i:500;s:4:\"file\";s:30:\"2014/11/Built_to_Last_book.jpg\";s:5:\"sizes\";a:5:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:30:\"Built_to_Last_book-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:30:\"Built_to_Last_book-195x300.jpg\";s:5:\"width\";i:195;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:28:\"Built_to_Last_book-90x90.jpg\";s:5:\"width\";i:90;s:6:\"height\";i:90;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:30:\"Built_to_Last_book-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:11:\"shop_single\";a:4:{s:4:\"file\";s:30:\"Built_to_Last_book-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:11:{s:8:\"aperture\";i:0;s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";i:0;s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";i:0;s:3:\"iso\";i:0;s:13:\"shutter_speed\";i:0;s:5:\"title\";s:0:\"\";s:11:\"orientation\";i:0;}}'),
(38, 28, '_thumbnail_id', '29'),
(39, 28, '_visibility', 'visible'),
(40, 28, '_stock_status', 'instock'),
(41, 28, 'seo_follow', 'false'),
(42, 28, 'seo_noindex', 'false'),
(43, 28, 'total_sales', '0'),
(44, 28, '_downloadable', 'yes'),
(45, 28, '_virtual', 'no'),
(46, 28, '_regular_price', ''),
(47, 28, '_sale_price', ''),
(48, 28, '_tax_status', 'none'),
(49, 28, '_tax_class', 'zero-rate'),
(50, 28, '_purchase_note', ''),
(51, 28, '_featured', 'no'),
(52, 28, '_weight', ''),
(53, 28, '_length', ''),
(54, 28, '_width', ''),
(55, 28, '_height', ''),
(56, 28, '_sku', ''),
(57, 28, '_product_attributes', 'a:0:{}'),
(58, 28, '_sale_price_dates_from', ''),
(59, 28, '_sale_price_dates_to', ''),
(60, 28, '_price', ''),
(61, 28, '_sold_individually', ''),
(62, 28, '_manage_stock', 'no'),
(63, 28, '_backorders', 'no'),
(64, 28, '_stock', ''),
(65, 28, '_downloadable_files', 'a:0:{}'),
(66, 28, '_download_limit', ''),
(67, 28, '_download_expiry', ''),
(68, 28, '_download_type', ''),
(69, 28, '_product_image_gallery', ''),
(72, 36, '_wp_attached_file', '2014/11/SharePoint-Server-2010-logo1.png'),
(73, 36, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:190;s:6:\"height\";i:190;s:4:\"file\";s:40:\"2014/11/SharePoint-Server-2010-logo1.png\";s:5:\"sizes\";a:3:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:40:\"SharePoint-Server-2010-logo1-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}s:14:\"shop_thumbnail\";a:4:{s:4:\"file\";s:38:\"SharePoint-Server-2010-logo1-90x90.png\";s:5:\"width\";i:90;s:6:\"height\";i:90;s:9:\"mime-type\";s:9:\"image/png\";}s:12:\"shop_catalog\";a:4:{s:4:\"file\";s:40:\"SharePoint-Server-2010-logo1-150x150.png\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:9:\"image/png\";}}s:10:\"image_meta\";a:11:{s:8:\"aperture\";i:0;s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";i:0;s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";i:0;s:3:\"iso\";i:0;s:13:\"shutter_speed\";i:0;s:5:\"title\";s:0:\"\";s:11:\"orientation\";i:0;}}'),
(106, 37, '_wp_attached_file', 'woocommerce_uploads/2014/11/END-sharepoint.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_posts`
--

CREATE TABLE `d_wp_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_wp_posts`
--

INSERT INTO `d_wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2014-09-05 04:41:07', '2014-09-05 04:41:07', 'Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2014-09-05 04:41:07', '2014-09-05 04:41:07', '', 0, 'http://localhost/wordpress-4.0/wordpress/?p=1', 0, 'post', '', 1),
(8, 2, '2014-11-01 10:08:27', '0000-00-00 00:00:00', '', 'Woo Logo', '', 'draft', 'closed', 'closed', '', 'woo-wf-woo_logo', '', '', '2014-11-01 10:08:27', '0000-00-00 00:00:00', '', 0, 'http://elearning4u.ir/?post_type=wooframework&p=8', 0, 'wooframework', '', 0),
(9, 2, '2014-11-01 10:08:27', '0000-00-00 00:00:00', '', 'Woo Custom Favicon', '', 'draft', 'closed', 'closed', '', 'woo-wf-woo_custom_favicon', '', '', '2014-11-01 10:08:27', '0000-00-00 00:00:00', '', 0, 'http://elearning4u.ir/?post_type=wooframework&p=9', 0, 'wooframework', '', 0),
(10, 2, '2014-11-01 10:08:27', '0000-00-00 00:00:00', '', 'Woo Body Img', '', 'draft', 'closed', 'closed', '', 'woo-wf-woo_body_img', '', '', '2014-11-01 10:08:27', '0000-00-00 00:00:00', '', 0, 'http://elearning4u.ir/?post_type=wooframework&p=10', 0, 'wooframework', '', 0),
(11, 1, '2014-11-05 05:26:54', '2014-11-05 05:26:54', '', 'فروشگاه', '', 'publish', 'closed', 'open', '', 'shop', '', '', '2014-11-05 05:26:54', '2014-11-05 05:26:54', '', 0, 'http://elearning4u.ir/?page_id=11', 0, 'page', '', 0),
(12, 1, '2014-11-05 05:26:54', '2014-11-05 05:26:54', '[woocommerce_cart]', 'سبد خرید', '', 'publish', 'closed', 'open', '', 'cart', '', '', '2014-11-05 05:26:54', '2014-11-05 05:26:54', '', 0, 'http://elearning4u.ir/?page_id=12', 0, 'page', '', 0),
(14, 1, '2014-11-05 05:26:54', '2014-11-05 05:26:54', '[woocommerce_my_account]', 'حساب من', '', 'publish', 'closed', 'open', '', 'my-account', '', '', '2014-11-05 05:26:54', '2014-11-05 05:26:54', '', 0, 'http://elearning4u.ir/?page_id=14', 0, 'page', '', 0),
(15, 2, '2014-11-05 06:13:12', '2014-11-05 06:13:12', '', 'favicon', '', 'inherit', 'open', 'open', '', 'favicon', '', '', '2014-11-05 06:13:12', '2014-11-05 06:13:12', '', 9, 'http://elearning4u.ir/wp-content/uploads/2014/11/favicon.png', 0, 'attachment', 'image/png', 0),
(16, 2, '2014-11-05 06:18:38', '2014-11-05 06:18:38', '', 'elearning-logoo', '', 'inherit', 'open', 'open', '', 'elearning-logoo', '', '', '2014-11-05 06:18:38', '2014-11-05 06:18:38', '', 8, 'http://elearning4u.ir/wp-content/uploads/2014/11/elearning-logoo.png', 0, 'attachment', 'image/png', 0),
(19, 2, '2014-11-05 07:08:40', '2014-11-05 07:08:40', '<p>نام شما (الزامی)<br />\\n    [text* your-name] </p>\\n\\n<p>آدرس پست الکترونیکی شما (الزامی)<br />\\n    [email* your-email] </p>\\n\\n<p>موضوع<br />\\n    [text your-subject] </p>\\n\\n<p>پیام شما<br />\\n    [textarea your-message] </p>\\n\\n<p>[submit \"ارسال\"]</p>\\n[your-subject]\\n[your-name] <wordpress@elearning4u.ir>\\nاز: [your-name] <[your-email]>\\nموضوع: [your-subject]\\n\\nمتن پیام:\\n[your-message]\\n\\n--\\nاین ایمیل از فرم تماس در آموزش مجازی (http://elearning4u.ir) ارسال شده است.\\nmesbahsoft@gmail.com\\nReply-To: [your-email]\\n\\n0\\n0\\n\\n[your-subject]\\nآموزش مجازی <wordpress@elearning4u.ir>\\nمتن پیام:\\n[your-message]\\n\\n--\\nاین ایمیل از فرم تماس در آموزش مجازی (http://elearning4u.ir) ارسال شده است.\\n[your-email]\\nReply-To: mesbahsoft@gmail.com\\n\\n0\\n0\\nپیام شما با موفقیت ارسال شد. متشکریم.\\nارسال پیام شما با شکست مواجه شد. لطفا بعدا امتحان کنید و یا از طریق دیگری با مدیر تماس بگیرید.\\nارسال ناموفق. لطفا زمینه ها الزامی را پر کرده و دوباره دکمه ی ارسال را بزنید.\\nارسال پیام شما با شکست مواجه شد. لطفا بعدا امتحان کنید و یا از طریق دیگری با مدیر تماس بگیرید.\\nبرای ادامه لطفا شرایط را بپذیرید.\\nلطفا زمینه الزامی را پر کنید.', 'فرم تماس 1', '', 'publish', 'open', 'open', '', '%d9%81%d8%b1%d9%85-%d8%aa%d9%85%d8%a7%d8%b3-1', '', '', '2014-11-05 07:08:40', '2014-11-05 07:08:40', '', 0, 'http://elearning4u.ir/?post_type=wpcf7_contact_form&p=19', 0, 'wpcf7_contact_form', '', 0),
(20, 2, '2014-11-05 07:18:29', '2014-11-05 07:18:29', 'کتاب زبان اصلی، دانلود PDF کتاب، فایل صوتی ترجمه فارسی', 'Built To Last', '', 'publish', 'closed', 'closed', '', 'built-to-last', '', '', '2014-11-05 07:18:59', '2014-11-05 07:18:59', '', 0, 'http://elearning4u.ir/?post_type=slide&#038;p=20', 0, 'slide', '', 0),
(21, 2, '2014-11-05 07:10:54', '2014-11-05 07:10:54', '', 'CRM-Sliderr', '', 'inherit', 'open', 'open', '', 'crm-sliderr', '', '', '2014-11-05 07:10:54', '2014-11-05 07:10:54', '', 20, 'http://elearning4u.ir/wp-content/uploads/2014/11/CRM-Sliderr.png', 0, 'attachment', 'image/png', 0),
(22, 2, '2014-11-05 07:52:52', '2014-11-05 07:52:52', '<div id=\"_mcePaste\" style=\"color: #000000; font-family: BBCNassim; font-size: 18px; font-style: normal; font-variant: normal; font-weight: normal; line-height: normal;\">جهت تماس، مشاوره رایگان، ثبت و پیگیری سفارشات از طریق یکی از راه‌های ارتباطی زیر اقدام نمایید :</div>\\r\\n<ul>\\r\\n	<li style=\"color: #000000; font-family: BBCNassim; padding: 30px; font-size: 18px; font-style: normal; font-variant: normal; font-weight: normal; line-height: normal;\">تماس با شماره‌ی : 02532928502-02532943608\\r\\n(8:30 صبح الی 18 شب / شنبه تا پنجشنبه)</li>\\r\\n	<li style=\"color: #000000; font-family: BBCNassim; padding: 30px; font-size: 18px; font-style: normal; font-variant: normal; font-weight: normal; line-height: normal;\">ارسال ایمیل به : mesbahsoft@gmail.com</li>\\r\\n</ul>\\r\\n[contact-form-7 id=\"19\" title=\"فرم تماس 1\"]', 'ارتباط با ما', '', 'publish', 'open', 'open', '', '%d8%a7%d8%b1%d8%aa%d8%a8%d8%a7%d8%b7-%d8%a8%d8%a7-%d9%85%d8%a7', '', '', '2014-11-05 07:54:58', '2014-11-05 07:54:58', '', 0, 'http://elearning4u.ir/?page_id=22', 0, 'page', '', 0),
(23, 2, '2014-11-05 07:52:52', '2014-11-05 07:52:52', '<div id=\"_mcePaste\" style=\"color: #000000; font-family: BBCNassim; font-size: 18px; font-style: normal; font-variant: normal; font-weight: normal; line-height: normal;\">جهت تماس، مشاوره رایگان، ثبت و پیگیری سفارشات از طریق یکی از راه‌های ارتباطی زیر اقدام نمایید :</div>\\r\\n<div style=\"color: #000000; font-family: BBCNassim; padding: 30px; font-size: 18px; font-style: normal; font-variant: normal; font-weight: normal; line-height: normal;\">- تماس با شماره‌ی : 02532928502-02532943608\\r\\n(8:30 صبح الی 18 شب / شنبه تا پنجشنبه)</div>\\r\\n[contact-form-7 id=\"19\" title=\"فرم تماس 1\"]', 'ارتباط با ما', '', 'inherit', 'open', 'open', '', '22-revision-v1', '', '', '2014-11-05 07:52:52', '2014-11-05 07:52:52', '', 22, 'http://elearning4u.ir/?p=23', 0, 'revision', '', 0),
(24, 2, '2014-11-05 07:54:18', '2014-11-05 07:54:18', '<div id=\"_mcePaste\" style=\"color: #000000; font-family: BBCNassim; font-size: 18px; font-style: normal; font-variant: normal; font-weight: normal; line-height: normal;\">جهت تماس، مشاوره رایگان، ثبت و پیگیری سفارشات از طریق یکی از راه‌های ارتباطی زیر اقدام نمایید :</div>\\n<ul>\\n	<li style=\"color: #000000; font-family: BBCNassim; padding: 30px; font-size: 18px; font-style: normal; font-variant: normal; font-weight: normal; line-height: normal;\">تماس با شماره‌ی : 02532928502-02532943608\\n(8:30 صبح الی 18 شب / شنبه تا پنجشنبه)</li>\\n</ul>\\n[contact-form-7 id=\"19\" title=\"فرم تماس 1\"]', 'ارتباط با ما', '', 'inherit', 'open', 'open', '', '22-autosave-v1', '', '', '2014-11-05 07:54:18', '2014-11-05 07:54:18', '', 22, 'http://elearning4u.ir/?p=24', 0, 'revision', '', 0),
(25, 2, '2014-11-05 07:54:58', '2014-11-05 07:54:58', '<div id=\"_mcePaste\" style=\"color: #000000; font-family: BBCNassim; font-size: 18px; font-style: normal; font-variant: normal; font-weight: normal; line-height: normal;\">جهت تماس، مشاوره رایگان، ثبت و پیگیری سفارشات از طریق یکی از راه‌های ارتباطی زیر اقدام نمایید :</div>\\r\\n<ul>\\r\\n	<li style=\"color: #000000; font-family: BBCNassim; padding: 30px; font-size: 18px; font-style: normal; font-variant: normal; font-weight: normal; line-height: normal;\">تماس با شماره‌ی : 02532928502-02532943608\\r\\n(8:30 صبح الی 18 شب / شنبه تا پنجشنبه)</li>\\r\\n	<li style=\"color: #000000; font-family: BBCNassim; padding: 30px; font-size: 18px; font-style: normal; font-variant: normal; font-weight: normal; line-height: normal;\">ارسال ایمیل به : mesbahsoft@gmail.com</li>\\r\\n</ul>\\r\\n[contact-form-7 id=\"19\" title=\"فرم تماس 1\"]', 'ارتباط با ما', '', 'inherit', 'open', 'open', '', '22-revision-v1', '', '', '2014-11-05 07:54:58', '2014-11-05 07:54:58', '', 22, 'http://elearning4u.ir/?p=25', 0, 'revision', '', 0),
(28, 2, '2014-11-08 07:35:13', '2014-11-08 07:35:13', '[tab name=\"معرفي\"]\\r\\n<strong> خلاصه کتاب مدیریتی (ساختن برای ماندن)</strong>\\r\\n\\r\\nنوشته جیمز کالینز و جری پوراس ...\\r\\n\\r\\nحفظ بقا راز هستي است! تلاش براي ماندن، اساس فعاليت هاي بشر ي است . ماندگاري فلسفه بسياري از تلاش هاي روزانه ما را شكل مي دهد. مي سازيم تا بمانيم.كتاب ساختن براي ماندن، دستاوردهاي يك پژوهش در صدها شركت مورد بررسي را تشريح مي كند .اين پژوهش معتبر به مقايسه شركت هاي آرماني با ديگر شركت ها پرداخته است . مقايسه شركت ها يي كه مديران و كاركنان آنها ساخته اند كه بماند، با شركت هايي كه شايد تلا ش هايشان تنها تلاشي مذبوحانه بوده است.كتاب با پژوهش در شرح حال شركت هاي آرماني دوازده “باور عمومي ” را به چالش مي گيرد.\\r\\n[/tab]\\r\\n[tab name=\"دانلود\"]\\r\\n<a href=\"http://www.4shared.com/folder/uCIYllXA/Chapter1.html\"> دانلود قسمت اول</a>\\r\\n<a href=\"http://www.4shared.com/folder/_Jr7opJB/Chapter2.html\"> دانلود قسمت دوم</a>\\r\\n<a href=\"http://www.4shared.com/folder/iyZSnGER/Chapter_3.html\"> دانلود قسمت سوم </a>\\r\\n<div id=\"cp_widget_1a850810-18e0-4611-b70a-5193aa49f411\">...</div><script type=\"text/javascript\">\\r\\nvar cpo = []; cpo[\"_object\"] =\"cp_widget_1a850810-18e0-4611-b70a-5193aa49f411\"; cpo[\"_fid\"] = \"AgAAvK8mZ7Ps\";\\r\\nvar _cpmp = _cpmp || []; _cpmp.push(cpo);\\r\\n(function() { var cp = document.createElement(\"script\"); cp.type = \"text/javascript\";\\r\\ncp.async = true; cp.src = \"//www.cincopa.com/media-platform/runtime/libasync.js\";\\r\\nvar c = document.getElementsByTagName(\"script\")[0];\\r\\nc.parentNode.insertBefore(cp, c); })(); </script><noscript>Powered by Cincopa <a href=\'http://www.cincopa.com/video-hosting\'>Video Hosting for Business</a> solution.<span>Built To Last</span><span>First Part</span><span>Built To Last</span><span>Sucsesses Built to last, Jim colins</span></noscript>\\r\\n[/tab]\\r\\n[tab name=\"تصاوير\"]\\r\\n[/tab]\\r\\n[tab name=\"ويدئو\"]\\r\\n[/tab]\\r\\n[end_tabset]', 'Built To Last', '', 'publish', 'open', 'closed', '', 'built-to-last', '', '', '2014-12-17 10:12:59', '2014-12-17 10:12:59', '', 0, 'http://elearning4u.ir/?post_type=product&#038;p=28', 10, 'product', '', 0),
(29, 2, '2014-11-08 07:32:54', '2014-11-08 07:32:54', '', 'Built_to_Last_(book)', '', 'inherit', 'open', 'open', '', 'built_to_last_book', '', '', '2014-11-08 07:32:54', '2014-11-08 07:32:54', '', 28, 'http://elearning4u.ir/wp-content/uploads/2014/11/Built_to_Last_book.jpg', 0, 'attachment', 'image/jpeg', 0),
(30, 2, '2014-12-17 10:15:49', '2014-12-17 10:15:49', '[tab name=\"معرفي\"]\\n<strong> خلاصه کتاب مدیریتی (ساختن برای ماندن)</strong>\\n\\nنوشته جیمز کالینز و جری پوراس ...\\n\\nحفظ بقا راز هستي است! تلاش براي ماندن، اساس فعاليت هاي بشر ي است . ماندگاري فلسفه بسياري از تلاش هاي روزانه ما را شكل مي دهد. مي سازيم تا بمانيم.كتاب ساختن براي ماندن، دستاوردهاي يك پژوهش در صدها شركت مورد بررسي را تشريح مي كند .اين پژوهش معتبر به مقايسه شركت هاي آرماني با ديگر شركت ها پرداخته است . مقايسه شركت ها يي كه مديران و كاركنان آنها ساخته اند كه بماند، با شركت هايي كه شايد تلا ش هايشان تنها تلاشي مذبوحانه بوده است.كتاب با پژوهش در شرح حال شركت هاي آرماني دوازده “باور عمومي ” را به چالش مي گيرد.\\n[/tab]\\n[tab name=\"دانلود\"]\\n<a href=\"http://www.4shared.com/folder/uCIYllXA/Chapter1.html\"> دانلود قسمت اول</a>\\n<a href=\"http://www.4shared.com/folder/_Jr7opJB/Chapter2.html\"> دانلود قسمت دوم</a>\\n<a href=\"http://www.4shared.com/folder/iyZSnGER/Chapter_3.html\"> دانلود قسمت سوم </a>\\n<div id=\"cp_widget_1a850810-18e0-4611-b70a-5193aa49f411\">...</div>\\n<script type=\"text/javascript\">// <![CDATA[\\nvar cpo = []; cpo[\"_object\"] =\"cp_widget_1a850810-18e0-4611-b70a-5193aa49f411\"; cpo[\"_fid\"] = \"AgAAvK8mZ7Ps\";\\nvar _cpmp = _cpmp || []; _cpmp.push(cpo);\\n(function() { var cp = document.createElement(\"script\"); cp.type = \"text/javascript\";\\ncp.async = true; cp.src = \"//www.cincopa.com/media-platform/runtime/libasync.js\";\\nvar c = document.getElementsByTagName(\"script\")[0];\\nc.parentNode.insertBefore(cp, c); })(); \\n// ]]></script><noscript>Powered by Cincopa <a href=\'http://www.cincopa.com/video-hosting\'>Video Hosting for Business</a> solution.<span>Built To Last</span><span>First Part</span><span>Built To Last</span><span>Sucsesses Built to last, Jim colins</span></noscript>\\n[/tab]\\n[tab name=\"تصاوير\"]\\n[/tab]\\n[tab name=\"ويدئو\"]\\n[/tab]\\n[end_tabset]', 'Built To Last', '', 'inherit', 'open', 'open', '', '28-autosave-v1', '', '', '2014-12-17 10:15:49', '2014-12-17 10:15:49', '', 28, 'http://elearning4u.ir/?p=30', 0, 'revision', '', 0),
(31, 2, '2014-11-08 09:07:45', '0000-00-00 00:00:00', '', 'Framework Woo Default Image', '', 'draft', 'closed', 'closed', '', 'woo-wf-framework_woo_default_image', '', '', '2014-11-08 09:07:45', '0000-00-00 00:00:00', '', 0, 'http://elearning4u.ir/?post_type=wooframework&p=31', 0, 'wooframework', '', 0),
(32, 2, '2014-11-08 09:07:45', '0000-00-00 00:00:00', '', 'Framework Woo Backend Header Image', '', 'draft', 'closed', 'closed', '', 'woo-wf-framework_woo_backend_header_image', '', '', '2014-11-08 09:07:45', '0000-00-00 00:00:00', '', 0, 'http://elearning4u.ir/?post_type=wooframework&p=32', 0, 'wooframework', '', 0),
(33, 2, '2014-11-08 09:07:45', '0000-00-00 00:00:00', '', 'Framework Woo Backend Icon', '', 'draft', 'closed', 'closed', '', 'woo-wf-framework_woo_backend_icon', '', '', '2014-11-08 09:07:45', '0000-00-00 00:00:00', '', 0, 'http://elearning4u.ir/?post_type=wooframework&p=33', 0, 'wooframework', '', 0),
(34, 2, '2014-11-08 09:07:45', '0000-00-00 00:00:00', '', 'Framework Woo Custom Login Logo', '', 'draft', 'closed', 'closed', '', 'woo-wf-framework_woo_custom_login_logo', '', '', '2014-11-08 09:07:45', '0000-00-00 00:00:00', '', 0, 'http://elearning4u.ir/?post_type=wooframework&p=34', 0, 'wooframework', '', 0),
(36, 2, '2014-11-08 09:52:59', '2014-11-08 09:52:59', '', 'SharePoint-Server-2010-logo1', '', 'inherit', 'open', 'open', '', 'sharepoint-server-2010-logo1', '', '', '2014-11-08 09:52:59', '2014-11-08 09:52:59', '', 0, 'http://elearning4u.ir/wp-content/uploads/2014/11/SharePoint-Server-2010-logo1.png', 0, 'attachment', 'image/png', 0),
(37, 2, '2014-11-08 09:57:56', '2014-11-08 09:57:56', '', 'END sharepoint', '', 'inherit', 'open', 'open', '', 'end-sharepoint', '', '', '2014-11-08 09:57:56', '2014-11-08 09:57:56', '', 0, 'http://elearning4u.ir/wp-content/uploads/woocommerce_uploads/2014/11/END-sharepoint.pdf', 0, 'attachment', 'application/pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_terms`
--

CREATE TABLE `d_wp_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_wp_terms`
--

INSERT INTO `d_wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0),
(2, 'simple', 'simple', 0),
(3, 'grouped', 'grouped', 0),
(4, 'variable', 'variable', 0),
(5, 'external', 'external', 0),
(6, 'کتاب الکترونیکی', 'e-books', 0),
(10, 'پادکست ها', 'podcasts', 0),
(8, 'کتاب صوتی', 'audio-book', 0),
(9, 'کتاب', 'book', 0),
(11, 'Built To Last', 'built-to-last', 0),
(12, 'بیلد تو لست', '%d8%a8%db%8c%d9%84%d8%af-%d8%aa%d9%88-%d9%84%d8%b3%d8%aa', 0),
(13, 'جیمز کالینز', '%d8%ac%db%8c%d9%85%d8%b2-%da%a9%d8%a7%d9%84%db%8c%d9%86%d8%b2', 0),
(14, 'جری پوراس', '%d8%ac%d8%b1%db%8c-%d9%be%d9%88%d8%b1%d8%a7%d8%b3', 0),
(15, 'ساختن برای ماندن', '%d8%b3%d8%a7%d8%ae%d8%aa%d9%86-%d8%a8%d8%b1%d8%a7%db%8c-%d9%85%d8%a7%d9%86%d8%af%d9%86', 0),
(16, 'کتب مدیریتی', '%da%a9%d8%aa%d8%a8-%d9%85%d8%af%db%8c%d8%b1%db%8c%d8%aa%db%8c', 0),
(17, 'شرکت های موفق', '%d8%b4%d8%b1%da%a9%d8%aa-%d9%87%d8%a7%db%8c-%d9%85%d9%88%d9%81%d9%82', 0),
(18, 'شیرپوینت', '%d8%b4%db%8c%d8%b1%d9%be%d9%88%db%8c%d9%86%d8%aa', 0),
(19, 'sharepoint', 'sharepoint', 0),
(20, 'کاتالوگ', '%da%a9%d8%a7%d8%aa%d8%a7%d9%84%d9%88%da%af', 0),
(21, 'catalog', 'catalog', 0),
(22, 'Default', 'default-format', 0),
(23, 'mp3', 'mp3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_term_relationships`
--

CREATE TABLE `d_wp_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_wp_term_relationships`
--

INSERT INTO `d_wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(28, 8, 0),
(28, 11, 0),
(28, 12, 0),
(28, 2, 0),
(28, 13, 0),
(28, 14, 0),
(28, 15, 0),
(28, 16, 0),
(28, 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_term_taxonomy`
--

CREATE TABLE `d_wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_wp_term_taxonomy`
--

INSERT INTO `d_wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'product_type', '', 0, 1),
(3, 3, 'product_type', '', 0, 0),
(4, 4, 'product_type', '', 0, 0),
(5, 5, 'product_type', '', 0, 0),
(6, 6, 'product_cat', 'فایل PDF محصولات ', 0, 0),
(10, 10, 'product_cat', 'فایل توضیحات مربوط به خدمات شرکت', 0, 0),
(8, 8, 'product_cat', 'فایل های صوتی محصولات  ', 0, 1),
(9, 9, 'product_cat', 'نسخه چاپ شده ', 0, 0),
(11, 11, 'product_tag', '', 0, 1),
(12, 12, 'product_tag', '', 0, 1),
(13, 13, 'product_tag', '', 0, 1),
(14, 14, 'product_tag', '', 0, 1),
(15, 15, 'product_tag', '', 0, 1),
(16, 16, 'product_tag', '', 0, 1),
(17, 17, 'product_tag', '', 0, 1),
(18, 18, 'product_tag', '', 0, 0),
(19, 19, 'product_tag', '', 0, 0),
(20, 20, 'product_tag', '', 0, 0),
(21, 21, 'product_tag', '', 0, 0),
(22, 22, 'podcast_format', '', 0, 0),
(23, 23, 'podcast_format', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_usermeta`
--

CREATE TABLE `d_wp_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_wp_usermeta`
--

INSERT INTO `d_wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'first_name', ''),
(2, 1, 'last_name', ''),
(3, 1, 'nickname', 'mesbahsoft_yb2z2p28'),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'comment_shortcuts', 'false'),
(7, 1, 'admin_color', 'fresh'),
(8, 1, 'use_ssl', '0'),
(9, 1, 'show_admin_bar_front', 'true'),
(10, 1, 'd_wp_capabilities', 'a:1:{s:13:\"administrator\";s:1:\"1\";}'),
(11, 1, 'd_wp_user_level', '10'),
(12, 1, 'dismissed_wp_pointers', 'wp350_media,wp360_revisions,wp360_locks,wp390_widgets'),
(13, 1, 'show_welcome_panel', '1'),
(15, 1, 'wp_dashboard_quick_press_last_post_id', '3'),
(16, 1, 'd_wp_dashboard_quick_press_last_post_id', '5'),
(18, 2, 'nickname', 'tayebeh.pardis'),
(19, 2, 'first_name', 'Tayebeh'),
(20, 2, 'last_name', 'Pardis'),
(21, 2, 'description', ''),
(22, 2, 'rich_editing', 'true'),
(23, 2, 'comment_shortcuts', 'false'),
(24, 2, 'admin_color', 'fresh'),
(25, 2, 'use_ssl', '0'),
(26, 2, 'show_admin_bar_front', 'true'),
(27, 2, 'd_wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(28, 2, 'd_wp_user_level', '10'),
(29, 2, 'dismissed_wp_pointers', 'wp350_media,wp360_revisions,wp360_locks,wp390_widgets'),
(30, 3, 'nickname', 'z.banayi'),
(31, 3, 'first_name', 'z'),
(32, 3, 'last_name', 'Banayi'),
(33, 3, 'description', ''),
(34, 3, 'rich_editing', 'true'),
(35, 3, 'comment_shortcuts', 'false'),
(36, 3, 'admin_color', 'fresh'),
(37, 3, 'use_ssl', '0'),
(38, 3, 'show_admin_bar_front', 'true'),
(39, 3, 'd_wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(40, 3, 'd_wp_user_level', '10'),
(41, 3, 'dismissed_wp_pointers', 'wp350_media,wp360_revisions,wp360_locks,wp390_widgets'),
(43, 2, 'd_wp_dashboard_quick_press_last_post_id', '38'),
(44, 1, 'billing_first_name', ''),
(45, 1, 'billing_last_name', ''),
(46, 1, 'billing_company', ''),
(47, 1, 'billing_address_1', ''),
(48, 1, 'billing_address_2', ''),
(49, 1, 'billing_city', ''),
(50, 1, 'billing_postcode', ''),
(51, 1, 'billing_state', ''),
(52, 1, 'billing_country', ''),
(53, 1, 'billing_phone', ''),
(54, 1, 'billing_email', ''),
(55, 1, 'shipping_first_name', ''),
(56, 1, 'shipping_last_name', ''),
(57, 1, 'shipping_company', ''),
(58, 1, 'shipping_address_1', ''),
(59, 1, 'shipping_address_2', ''),
(60, 1, 'shipping_city', ''),
(61, 1, 'shipping_postcode', ''),
(62, 1, 'shipping_state', ''),
(63, 1, 'shipping_country', ''),
(64, 2, 'session_tokens', 'a:1:{s:64:\"52cab4bc814cda90e24af3c93e7c9845b83e36adf5a9ad933e196b29d78f2d69\";i:1430334765;}'),
(65, 2, 'd_wp_user-settings', 'libraryContent=browse&editor=html'),
(66, 2, 'd_wp_user-settings-time', '1419055058'),
(67, 2, '_woocommerce_persistent_cart', 'a:1:{s:4:\"cart\";a:0:{}}'),
(68, 2, 'managenav-menuscolumnshidden', 'a:4:{i:0;s:11:\"link-target\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";}'),
(69, 2, 'metaboxhidden_nav-menus', 'a:5:{i:0;s:8:\"add-post\";i:1;s:11:\"add-product\";i:2;s:12:\"add-post_tag\";i:3;s:15:\"add-product_cat\";i:4;s:15:\"add-product_tag\";}'),
(70, 2, 'closedpostboxes_dashboard', 'a:1:{i:0;s:18:\"dashboard_activity\";}'),
(71, 2, 'metaboxhidden_dashboard', 'a:0:{}'),
(72, 3, 'session_tokens', 'a:1:{s:64:\"cbe77399e33be714b3bbc5d428e476e84035e993be5e0d7a84fb89979b486ff8\";i:1431892370;}'),
(73, 3, 'd_wp_dashboard_quick_press_last_post_id', '38'),
(74, 3, 'billing_first_name', ''),
(75, 3, 'billing_last_name', ''),
(76, 3, 'billing_company', ''),
(77, 3, 'billing_address_1', ''),
(78, 3, 'billing_address_2', ''),
(79, 3, 'billing_city', ''),
(80, 3, 'billing_postcode', ''),
(81, 3, 'billing_state', ''),
(82, 3, 'billing_country', ''),
(83, 3, 'billing_phone', ''),
(84, 3, 'billing_email', ''),
(85, 3, 'shipping_first_name', ''),
(86, 3, 'shipping_last_name', ''),
(87, 3, 'shipping_company', ''),
(88, 3, 'shipping_address_1', ''),
(89, 3, 'shipping_address_2', ''),
(90, 3, 'shipping_city', ''),
(91, 3, 'shipping_postcode', ''),
(92, 3, 'shipping_state', ''),
(93, 3, 'shipping_country', '');

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_users`
--

CREATE TABLE `d_wp_users` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_wp_users`
--

INSERT INTO `d_wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'mesbahsoft_yb2z2p28', '$P$BWhurYL8nRSiPMy6xWl..ZtKK29WgW/', 'mesbahsoft_yb2z2p28', 'mesbahsoft@gmail.com', '', '2014-11-01 09:02:00', '', 0, 'mesbahsoft_yb2z2p28'),
(2, 'tayebeh.pardis', '$P$B1gGldzeUOUhldVqndr15VbfC5thFa/', 'tayebeh-pardis', 'tayebeh.pardis@gmail.com', '', '2014-11-01 09:51:53', '', 0, 'Tayebeh Pardis'),
(3, 'z.banayi', '$P$BzkSyLHJc2Jd9dyv4190CxkGTCpyMR.', 'z-banayi', 'z.banayi@gmail.com', '', '2014-11-01 09:53:07', '', 0, 'z Banayi');

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_woocommerce_attribute_taxonomies`
--

CREATE TABLE `d_wp_woocommerce_attribute_taxonomies` (
  `attribute_id` bigint(20) NOT NULL,
  `attribute_name` varchar(200) NOT NULL,
  `attribute_label` longtext,
  `attribute_type` varchar(200) NOT NULL,
  `attribute_orderby` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_woocommerce_downloadable_product_permissions`
--

CREATE TABLE `d_wp_woocommerce_downloadable_product_permissions` (
  `permission_id` bigint(20) NOT NULL,
  `download_id` varchar(32) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL DEFAULT '0',
  `order_key` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `downloads_remaining` varchar(9) DEFAULT NULL,
  `access_granted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access_expires` datetime DEFAULT NULL,
  `download_count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_woocommerce_ir`
--

CREATE TABLE `d_wp_woocommerce_ir` (
  `id` int(11) NOT NULL,
  `text1` text CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `text2` text CHARACTER SET utf8 COLLATE utf8_persian_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_woocommerce_order_itemmeta`
--

CREATE TABLE `d_wp_woocommerce_order_itemmeta` (
  `meta_id` bigint(20) NOT NULL,
  `order_item_id` bigint(20) NOT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_woocommerce_order_items`
--

CREATE TABLE `d_wp_woocommerce_order_items` (
  `order_item_id` bigint(20) NOT NULL,
  `order_item_name` longtext NOT NULL,
  `order_item_type` varchar(200) NOT NULL DEFAULT '',
  `order_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_woocommerce_tax_rates`
--

CREATE TABLE `d_wp_woocommerce_tax_rates` (
  `tax_rate_id` bigint(20) NOT NULL,
  `tax_rate_country` varchar(200) NOT NULL DEFAULT '',
  `tax_rate_state` varchar(200) NOT NULL DEFAULT '',
  `tax_rate` varchar(200) NOT NULL DEFAULT '',
  `tax_rate_name` varchar(200) NOT NULL DEFAULT '',
  `tax_rate_priority` bigint(20) NOT NULL,
  `tax_rate_compound` int(1) NOT NULL DEFAULT '0',
  `tax_rate_shipping` int(1) NOT NULL DEFAULT '1',
  `tax_rate_order` bigint(20) NOT NULL,
  `tax_rate_class` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_woocommerce_tax_rate_locations`
--

CREATE TABLE `d_wp_woocommerce_tax_rate_locations` (
  `location_id` bigint(20) NOT NULL,
  `location_code` varchar(255) NOT NULL,
  `tax_rate_id` bigint(20) NOT NULL,
  `location_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `d_wp_woocommerce_termmeta`
--

CREATE TABLE `d_wp_woocommerce_termmeta` (
  `meta_id` bigint(20) NOT NULL,
  `woocommerce_term_id` bigint(20) NOT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_wp_woocommerce_termmeta`
--

INSERT INTO `d_wp_woocommerce_termmeta` (`meta_id`, `woocommerce_term_id`, `meta_key`, `meta_value`) VALUES
(1, 6, 'order', '3'),
(2, 6, 'display_type', ''),
(3, 6, 'thumbnail_id', '0'),
(7, 8, 'order', '2'),
(8, 8, 'display_type', ''),
(9, 8, 'thumbnail_id', '0'),
(10, 9, 'order', '1'),
(11, 9, 'display_type', ''),
(12, 9, 'thumbnail_id', '0'),
(13, 10, 'order', '4'),
(14, 10, 'display_type', ''),
(15, 10, 'thumbnail_id', '0'),
(16, 8, 'product_count_product_cat', '1'),
(17, 11, 'product_count_product_tag', '1'),
(18, 12, 'product_count_product_tag', '1'),
(19, 13, 'product_count_product_tag', '1'),
(20, 14, 'product_count_product_tag', '1'),
(21, 15, 'product_count_product_tag', '1'),
(22, 16, 'product_count_product_tag', '1'),
(23, 17, 'product_count_product_tag', '1'),
(24, 10, 'product_count_product_cat', '0'),
(25, 18, 'product_count_product_tag', '0'),
(26, 19, 'product_count_product_tag', '0'),
(27, 20, 'product_count_product_tag', '0'),
(28, 21, 'product_count_product_tag', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `d_wp_commentmeta`
--
ALTER TABLE `d_wp_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `d_wp_comments`
--
ALTER TABLE `d_wp_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Indexes for table `d_wp_links`
--
ALTER TABLE `d_wp_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `d_wp_options`
--
ALTER TABLE `d_wp_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `d_wp_postmeta`
--
ALTER TABLE `d_wp_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `d_wp_posts`
--
ALTER TABLE `d_wp_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`),
  ADD KEY `post_name` (`post_name`(191));

--
-- Indexes for table `d_wp_terms`
--
ALTER TABLE `d_wp_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `d_wp_term_relationships`
--
ALTER TABLE `d_wp_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `d_wp_term_taxonomy`
--
ALTER TABLE `d_wp_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `d_wp_usermeta`
--
ALTER TABLE `d_wp_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `d_wp_users`
--
ALTER TABLE `d_wp_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`);

--
-- Indexes for table `d_wp_woocommerce_attribute_taxonomies`
--
ALTER TABLE `d_wp_woocommerce_attribute_taxonomies`
  ADD PRIMARY KEY (`attribute_id`),
  ADD KEY `attribute_name` (`attribute_name`);

--
-- Indexes for table `d_wp_woocommerce_downloadable_product_permissions`
--
ALTER TABLE `d_wp_woocommerce_downloadable_product_permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `download_order_key_product` (`product_id`,`order_id`,`order_key`,`download_id`),
  ADD KEY `download_order_product` (`download_id`,`order_id`,`product_id`);

--
-- Indexes for table `d_wp_woocommerce_ir`
--
ALTER TABLE `d_wp_woocommerce_ir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `d_wp_woocommerce_order_itemmeta`
--
ALTER TABLE `d_wp_woocommerce_order_itemmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `order_item_id` (`order_item_id`),
  ADD KEY `meta_key` (`meta_key`);

--
-- Indexes for table `d_wp_woocommerce_order_items`
--
ALTER TABLE `d_wp_woocommerce_order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `d_wp_woocommerce_tax_rates`
--
ALTER TABLE `d_wp_woocommerce_tax_rates`
  ADD PRIMARY KEY (`tax_rate_id`),
  ADD KEY `tax_rate_country` (`tax_rate_country`),
  ADD KEY `tax_rate_state` (`tax_rate_state`),
  ADD KEY `tax_rate_class` (`tax_rate_class`),
  ADD KEY `tax_rate_priority` (`tax_rate_priority`);

--
-- Indexes for table `d_wp_woocommerce_tax_rate_locations`
--
ALTER TABLE `d_wp_woocommerce_tax_rate_locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `tax_rate_id` (`tax_rate_id`),
  ADD KEY `location_type` (`location_type`),
  ADD KEY `location_type_code` (`location_type`,`location_code`);

--
-- Indexes for table `d_wp_woocommerce_termmeta`
--
ALTER TABLE `d_wp_woocommerce_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `woocommerce_term_id` (`woocommerce_term_id`),
  ADD KEY `meta_key` (`meta_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `d_wp_commentmeta`
--
ALTER TABLE `d_wp_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_wp_comments`
--
ALTER TABLE `d_wp_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `d_wp_links`
--
ALTER TABLE `d_wp_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_wp_options`
--
ALTER TABLE `d_wp_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11000;
--
-- AUTO_INCREMENT for table `d_wp_postmeta`
--
ALTER TABLE `d_wp_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `d_wp_posts`
--
ALTER TABLE `d_wp_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `d_wp_terms`
--
ALTER TABLE `d_wp_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `d_wp_term_taxonomy`
--
ALTER TABLE `d_wp_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `d_wp_usermeta`
--
ALTER TABLE `d_wp_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `d_wp_users`
--
ALTER TABLE `d_wp_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `d_wp_woocommerce_attribute_taxonomies`
--
ALTER TABLE `d_wp_woocommerce_attribute_taxonomies`
  MODIFY `attribute_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_wp_woocommerce_downloadable_product_permissions`
--
ALTER TABLE `d_wp_woocommerce_downloadable_product_permissions`
  MODIFY `permission_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_wp_woocommerce_ir`
--
ALTER TABLE `d_wp_woocommerce_ir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_wp_woocommerce_order_itemmeta`
--
ALTER TABLE `d_wp_woocommerce_order_itemmeta`
  MODIFY `meta_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_wp_woocommerce_order_items`
--
ALTER TABLE `d_wp_woocommerce_order_items`
  MODIFY `order_item_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_wp_woocommerce_tax_rates`
--
ALTER TABLE `d_wp_woocommerce_tax_rates`
  MODIFY `tax_rate_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_wp_woocommerce_tax_rate_locations`
--
ALTER TABLE `d_wp_woocommerce_tax_rate_locations`
  MODIFY `location_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_wp_woocommerce_termmeta`
--
ALTER TABLE `d_wp_woocommerce_termmeta`
  MODIFY `meta_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
