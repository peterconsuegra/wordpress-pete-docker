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



define('WP_HOME','http://example1.test');
define('WP_SITEURL','http://example1.test');
define('DB_NAME', 'db_B6wqQVTbEm');
define('DB_USER', 'root');
define('DB_PASSWORD', 'rootpassword');
define('DB_HOST', 'mysql');

define('AUTH_KEY',         '1O6z4jFkp3coAtLyWBHQqG7ZTugYIhXmlds5VMRbnafJK09EePvi2CNUSrx8wD');
define('SECURE_AUTH_KEY',  'MZjRDN0fPOypm7WzTQUcCktAoVi5nqJxlXsLe6w3gH91FK4vu8SrGBhdaEYIb2');
define('LOGGED_IN_KEY',    'Lz9d8PYorByu6V2knQc3CFJxvjalbIUpwOsgtiGMTqXe75ZRW4EhK0SDNHAm1f');
define('NONCE_KEY',        'YFsX5SdV0x9H6qpCbhjMal1meOfWz4wuANinGZgoRT2UIvrtLDk3JcKy8BQ7EP');
define('AUTH_SALT',        'DLqhHjgVv0OkftTZzWxpUaFByG9NbmecdosIXP6MriRYwC57QSEK83214JunlA');
define('SECURE_AUTH_SALT', 'bYQsuqxUaIkNZPL57Aorv9BgVThKjd2MmJeHF40yGDf3X8REpinWt1OwlCczS6');
define('LOGGED_IN_SALT',   '3QP8Vtg0MRlsDZSnEGmbofXhrAqi5YF7BOTdLKpH6xuUcN9yW4Ikz21aeJwCvj');
define('NONCE_SALT',       'OSDXusnRwCALbV4fxpHat8lWGY1ygPTJFNmEdM7o3Q5vq6K2kBr0hjiZzIcUe9');
 






 
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

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';
define('WP_MEMORY_LIMIT', '256M');
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

