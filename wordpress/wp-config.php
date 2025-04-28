<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * This has been slightly modified (to read environment variables) for use in Docker.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */
// IMPORTANT: this file needs to stay in-sync with https://github.com/WordPress/WordPress/blob/master/wp-config-sample.php
// (it gets parsed by the upstream wizard in https://github.com/WordPress/WordPress/blob/f27cb65e1ef25d11b535695a660e7282b98eb742/wp-admin/setup-config.php#L356-L392)
// a helper function to lookup "env_FILE", "env", then fallback
if (!function_exists('getenv_docker')) {
	// https://github.com/docker-library/wordpress/issues/588 (WP-CLI will load this file 2x)
	function getenv_docker($env, $default) {
		if ($fileEnv = getenv($env . '_FILE')) {
			return rtrim(file_get_contents($fileEnv), "\r\n");
		}
		else if (($val = getenv($env)) !== false) {
			return $val;
		}
		else {
			return $default;
		}
	}
}
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv_docker('WORDPRESS_DB_NAME', 'wordpress') );
/** Database username */
define( 'DB_USER', getenv_docker('WORDPRESS_DB_USER', 'root') );
/** Database password */
define( 'DB_PASSWORD', getenv_docker('WORDPRESS_DB_PASSWORD', 'fddqs32') );
/**
 * Docker image fallback values above are sourced from the official WordPress installation wizard:
 * https://github.com/WordPress/WordPress/blob/1356f6537220ffdc32b9dad2a6cdbe2d010b7a88/wp-admin/setup-config.php#L224-L238
 * (However, using "example username" and "example password" in your database is strongly discouraged.  Please use strong, random credentials!)
 */
/** Database hostname */
// define( 'DB_HOST', getenv_docker('WORDPRESS_DB_HOST', 'mysql'));
define( 'DB_HOST', getenv('WORDPRESS_DB_HOST') ?: 'mysql' );
/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', getenv_docker('WORDPRESS_DB_CHARSET', 'utf8') );
/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', getenv_docker('WORDPRESS_DB_COLLATE', '') );
/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

define( 'AUTH_KEY',         getenv_docker('WORDPRESS_AUTH_KEY',         'c92946f0d528cc3a67d3c85d9d2c66857063a01b') );
define( 'SECURE_AUTH_KEY',  getenv_docker('WORDPRESS_SECURE_AUTH_KEY',  'a4cc2f1fd82ca736b200332abcd2bc832c6e6dbd') );
define( 'LOGGED_IN_KEY',    getenv_docker('WORDPRESS_LOGGED_IN_KEY',    'fae146f25b7628f65538142132760a0028d5760e') );
define( 'NONCE_KEY',        getenv_docker('WORDPRESS_NONCE_KEY',        '6af74000ceac5e675856a9f756f7c966f8bdb1bb') );
define( 'AUTH_SALT',        getenv_docker('WORDPRESS_AUTH_SALT',        '51f80b7baa6f7ecec850a6bf523c3dcd4d14e8da') );
define( 'SECURE_AUTH_SALT', getenv_docker('WORDPRESS_SECURE_AUTH_SALT', 'bf8e4c71e02b2520d8711c855875c11e87148a64') );
define( 'LOGGED_IN_SALT',   getenv_docker('WORDPRESS_LOGGED_IN_SALT',   'a67cbdea376e5c9d30316c9628a2e233683fd5d0') );
define( 'NONCE_SALT',       getenv_docker('WORDPRESS_NONCE_SALT',       '720706fd704701ce260736120722bc631eb24176') );





// (See also https://wordpress.stackexchange.com/a/152905/199287)
/**#@-*/
/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = getenv_docker('WORDPRESS_TABLE_PREFIX', 'wp_');
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', !!getenv_docker('WORDPRESS_DEBUG', '') );
/* Add any custom values between this line and the "stop editing" line. */
// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also https://wordpress.org/support/article/administration-over-ssl/#using-a-reverse-proxy
// if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
// 	$_SERVER['HTTPS'] = 'on';
// }
// (we include this by default because reverse proxying is extremely common in container environments)
if ($configExtra = getenv_docker('WORDPRESS_CONFIG_EXTRA', '')) {
	eval($configExtra);
}
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
// if (
// 	isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
// 	strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false
//   ) {
// 	$_SERVER['HTTPS'] = 'off';
//   }

define('SMTP_HOST', 'mailhog');
define('SMTP_PORT', 1025);
define('SMTP_ENCRYPTION', 'none');
define('SMTP_AUTH', false);

define('WP_HOME', getenv('WP_HOME') ?: 'http://localhost:8089');
define('WP_SITEURL', getenv('WP_SITEURL') ?: 'http://localhost:8089');


  
  
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';