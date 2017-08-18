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
define('AUTH_KEY',         'g )-Lh%>0@OSTy@>z/PUXnW^=,L.IrD823U[TOp35=>2,M<+}Wgb=ba%+>I3A;~E');
define('SECURE_AUTH_KEY',  '9NM:+AaW=H)s92-Gt?Trr<jIUs@HH?58R)-{)QcccH8z`hU1{+@VA~[,{{,.IASu');
define('LOGGED_IN_KEY',    '0tCACe2G6i2wUyih((-5N:?an$h0jJL|GZZ.&W(JxI=z1hw-92UttWc!|k.o:nQd');
define('NONCE_KEY',        '0lV-<IZ:&-PqWKD>>)_8A1(7Vo7t}xi2tEOf~v8d;OL}[{^~-&@D+{G<n#@7T|J?');
define('AUTH_SALT',        'j87U=>]vZc>R~V(nA8<d0@</`.2Dkl.erI]n@l7j+V=GAvSBgD9RxiA|Ga}e4Xv ');
define('SECURE_AUTH_SALT', 'gC_b|kxvhinOzVS2;AyCZJQ35f+>R-K co%z15^N!![zl4l3vMY+sbn{sr2Ns%gC');
define('LOGGED_IN_SALT',   'Oc_ALjN{B-B|^G-Dq3W.>[%>ZLf}a^^nGfcx#%!p~!_(JvJ=ze26M8 :hah8#f,4');
define('NONCE_SALT',       'S_mME*?N3k{?~<P42tU1ODs86^VcO=9z!$`,AHy0gF_W1L80?PNSY$N7=1~Fc9{e');

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
