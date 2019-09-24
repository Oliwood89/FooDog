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
define( 'DB_NAME', 'foodog' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'EkCEHvEWvz7DJeNR0taxnQhFQLaaNU8IrjjqwW01aXdKuDyPvOVkewXb5Jy8XQZT' );
define( 'SECURE_AUTH_KEY',  'JdlanchahClNpjkgILQvL0lIXpOGVGypiVEGh1kyzLeNwbfRz5tXpnAhqMohlgyM' );
define( 'LOGGED_IN_KEY',    'gZgugTAN0vUQ1ET6B98cECpdfIbmm2DL0iwaj7e4Wvp9tI2QHT1w65vlBuIZ4pyZ' );
define( 'NONCE_KEY',        'rn1d9wJE6xkN1n9mwEshtyePRLbBQp5CfntYfYZZmnZTKykeAHuzZ2duHPqwvZiL' );
define( 'AUTH_SALT',        '9Rz9Mae5WIqS6Plg66cEMl61j9rH4eROnISxUP2XOkqm7oxEoW2Ip9CEXxFtCSAe' );
define( 'SECURE_AUTH_SALT', '6YQCCYsbd9FIl2q0gLnZg9D17BWrSGYNNWUfKbCTi92pNlK2IYID80xFbHRKdxYI' );
define( 'LOGGED_IN_SALT',   'e7vUFfMpDerRL0568iCrYSfVkLhTCMLySA2di8rpSs5EQ1ZzQWziW4HPli6c6Z2b' );
define( 'NONCE_SALT',       'v59lfeql0ebJmxXbd52iBmwT8XzWtKV1EbCBJW9qshxG461YyEvbWiwISCiFw2D3' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
