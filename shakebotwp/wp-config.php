<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'Shakebot');
/*define('DB_NAME', 'avirgile_shake');*/

/** MySQL database username */
/*define('DB_USER', 'avirgile_shake');*/
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');
/*define('DB_PASSWORD', 'Shakebot447');*/

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD', 'direct');

define('WP_HOME','http://192.168.1.74/shakebot/shakebotwp/');
define('WP_SITEURL','http://192.168.1.74/shakebot/shakebotwp/');

/*define('WP_HOME','http://shakebot.biz/shakebotwp/');
define('WP_SITEURL','http://shakebot.biz/shakebotwp/');*/
define( 'WP_AUTO_UPDATE_CORE', false );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '.za8hxdpRUS#0|7vM~P+YGwpRP{@e_fHa6Qc-/(.7u-|yvU5wP#did:NT)m>mgM!');
define('SECURE_AUTH_KEY',  ')dtDyr-RQova5EP2_Q=]%mWG5Z+g%m!|1g `f0Uf+wC8wfvD-#96@mp<fzqOU.%H');
define('LOGGED_IN_KEY',    '$wS%WL/)}:cna+2uK5dF}(1=F8W[4TL?tFDO2:<N@Hh;[y@YASH,.*>CxhqWP2+~');
define('NONCE_KEY',        'eEEycIK7HlD^2JVgJY140|F;hEP)1xHO6Kt ofH]e57Y?p5^$u!.z~cCe?ogre>3');
define('AUTH_SALT',        '.r}fIZV=~3m%j5hX=<=E>|b0u9k%V31[2B2eE9}W)%rwP^f%j;5T/1J)VB@WL/hV');
define('SECURE_AUTH_SALT', '-NldFD|)C(U=K9+WsR^};Z-L41C1JrhTFv~ZD3;:aaWA7-m1(8fRZ-kJ;vNb|gLc');
define('LOGGED_IN_SALT',   '//B=Y>#2<V;79Ul:1`qb(<vM,~ 2:5SJ6vq;W|yBzM.mhSk[kER+XVbks|tIR-y6');
define('NONCE_SALT',       'i+xV=>aALt;]|W+ei9D}Akz~wM@A$+.nKJ-#V67UhWdS#v.]1SMjb[Fm;%#MU!4Y');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');