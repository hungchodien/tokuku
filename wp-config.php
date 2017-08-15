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
define('DB_NAME', 'tokuku');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'd[|!<6_m^RE_PsF(STNV@V]kc18zlf(__}|6L W8U;:xe__(*o_k]fBg2i9p{AfX');
define('SECURE_AUTH_KEY',  '{P0U^2CABJq K6~|zUXg^Pcy|}T^(q&o!q,2-M?a*SW-vtEOGFX~X6H3 i<!|We6');
define('LOGGED_IN_KEY',    '(Az[C5F<[W4|82+$*egka{8bBs(Ww@zW]H67fTU#6G{vxWBsR}OY]RHgOLXI!F<F');
define('NONCE_KEY',        '24n55Y2-6gH&Ct~N|PO9{s`AH/fp|~DSXfTEL03[=Bym~3)v?-e 4Mw3)_>BhA6J');
define('AUTH_SALT',        '}eP:$-e|w (X[~e~ :xBQ9xMQBpF^o+00nkK2/w=|XhWW=!xVr/A];x;=F2A<.96');
define('SECURE_AUTH_SALT', 'W7-0GQ+8:n`P-%p?85VuY;/7MOuB Z3|z-/-c[=u$%ViXG_QZpehV$znFR? ,vLD');
define('LOGGED_IN_SALT',   '3WR&#rL>+c_mA|#Ll;-r$tD,f2{Z%^}+IsjM|8RRfWT,+tcY/+Za_h.)G6`$iJ+m');
define('NONCE_SALT',       'nqaxd,1jXgS@ .BpX&n_CkyuE~L`4D^/ 30HGavKi)d/ox(37%ilvIjbi8a$]wd?');

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
