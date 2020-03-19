<?php
/** 
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information by
 * visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'elearning4u_wp');

/** MySQL database username */
define('DB_USER', 'wordpress_3');

/** MySQL database password */
define('DB_PASSWORD', '!BvtQ4H39s');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^7a1M^Jq5zZ^jzvleNmf)7qmt(4TB)TwXs(b4DT%&%*woHZtLG0m$ziBzGs)MuZP');
define('SECURE_AUTH_KEY',  'CYSHVCtCD&g6irypi6yij$xGWzXdm6%%nYV(v549cLhvqFxvZq37P8SlvtfEJLzf');
define('LOGGED_IN_KEY',    'b@MxUIhbt*w9B@e64Phx8GzqzEe5S1Qrmtd!myPVr1KsG9ot5F18wdNT#os2&7r)');
define('NONCE_KEY',        'EBXEp27uK^q3y*mJ8iuIk8y7iIZhuaSN%6EL6vf!&Hs)472IVxlYkXpI32eJ21l9');
define('AUTH_SALT',        'QC8m6J^%AQP)@t*0N9SuCjz95Ortg1ciHfazjS06cusLAWcqsjXmEBhYQYNg2KFm');
define('SECURE_AUTH_SALT', 'fkpSX0%4SC)dCjyUZ&VDpKbijSwy8ywhx4Jl!XkRDPVcE3HSWUsj8hwekmpJMgPw');
define('LOGGED_IN_SALT',   'xGEfLbUM*8em!5vZz1uAoTde2yvKR&%^il)2iCv2U5ilkDCVQT#CE8T!)WwhXQS*');
define('NONCE_SALT',       'c(IAPP4fbTj%e*N941#XVlT^t%bG)sjLXT6bkEDPDeh7vbBhDV)NqHRyrmOZvHe6');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'd_wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'fa_IR');

define ('FS_METHOD', 'direct');

define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

//--- disable auto upgrade
define( 'AUTOMATIC_UPDATER_DISABLED', true );



?>
