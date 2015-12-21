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
define('DB_NAME', 'appgam5_vortago');

/** MySQL database username */
define('DB_USER', 'appgam5_vortago');

/** MySQL database password */
define('DB_PASSWORD', 'B)XBCK*Q&kf*');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8_general_ci');

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
define('AUTH_KEY',         '07vj3uylaudi3eegvgz0zsditzu3lgvkresp4erkws9jox0dwy4lfayihm8pqarn');
define('SECURE_AUTH_KEY',  'wf6ezl0bal7s1tmbe87erf5ihqvudezjcddxfi6r6wckgkaxhsq2oh0gp1sv0apx');
define('LOGGED_IN_KEY',    'wvjr9m8u6yxkkmamzu5ehwfdua19hulm6eszqyh9sc9uatnxepr0qwhnbgxmlixj');
define('NONCE_KEY',        'dxjvlbshzctkbc8c6zhmpe8euzxjavetocjnvaqpjcbbsgdprk5oh1mn16djxrmf');
define('AUTH_SALT',        'irh3cvoiyx8jt0cxzvrpj9u8mh429yfeje8vv0u4xqbrelkkawdstxtmg44j8etx');
define('SECURE_AUTH_SALT', 'edeqlqugbfk6t3bf03zwmqgsj9jvue4envdltpdyc3eolnqvkm6bpvrf6tcayiiz');
define('LOGGED_IN_SALT',   'tsf67kzyw05izzhik8ldfnboz2ty5thggbbxo5mqunadml3x4nj6le9wqjrqk25j');
define('NONCE_SALT',       'si6ts5nrlaei55i4gdeclamzvudnaypjldiihmadjwndle0y9rvfgw7qw2f96xzy');

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
