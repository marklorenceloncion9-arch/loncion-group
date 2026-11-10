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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         '{(0xP7a(j{#C[75KSm^1:v_NfA;&>AAOX(J/6^k-1c4EL2U-NeZ($ x<jd-H2RTa' );
define( 'SECURE_AUTH_KEY',  'OrU&x/7Qd6R@(G[s%>,KdI9Zm-u6s5>eS]]O(Hs6rtddfh5$p5Oah2clR<_Kk>wq' );
define( 'LOGGED_IN_KEY',    '=4DXVRU^ GB`RF-OIT@eNUi%gaqcXGEN]2439B7IQ&@t,GGjp YVL)tgK>1WTqdR' );
define( 'NONCE_KEY',        'nHdXW^^!MJ@PsHlh_#?{>&W(Ed4`&~K$083VVNNBoKl(N(>C.yi{;GJgrN+A7?mm' );
define( 'AUTH_SALT',        '4DX.a(=GF(sSoM#o0go!.GGf}.(,9u:v,_oUkm?*M~~~16?X>fXPM1ytamShC;#k' );
define( 'SECURE_AUTH_SALT', '.HUi+y7fy&*%MA<|(!6R]AfGvt6{7pHcG:F;29 kxM/6AbCO#7u&b}ekhBwt^-zq' );
define( 'LOGGED_IN_SALT',   '}~QQD6d#hyNK|1lYZ:{}HGvEQ8$:>=S@TNBf<0MJGI%b;tR:Z6> V8A?<H[S2GlU' );
define( 'NONCE_SALT',       't~5j.*vT}=P*u |h!]R1YO!i(MOjma>0ntI_u~PB3XiPz`r0A(&Ml;9b,tVq$4pK' );

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
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
