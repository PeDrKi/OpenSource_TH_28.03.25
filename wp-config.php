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
define( 'DB_NAME', 'epunews' );

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
define( 'AUTH_KEY',         '#J0j&L488tIp2q&2V1TZ{qvct4bETS-1iJa~mpG&uk!B;~CXvl s5gMN !h1>%O:' );
define( 'SECURE_AUTH_KEY',  'p7fv+w?z*f}8Rh(3-|wI~nnrhl*sM40,Sqy/OxB%5z[>m2m{xp7%R%O/LmU!P0oG' );
define( 'LOGGED_IN_KEY',    '=MCy/-s<;k7Dq1A?~8_6#vWx3%t]PA]/@HvV1:QXf4[Y*T(@*e)WmD =a9v/8S^?' );
define( 'NONCE_KEY',        '*_cgd<~iT)V|`9>`%3&F2B84;cI60; V@&#(SpTW}_LQ4VV$Mt{Abe GZd:x3{+#' );
define( 'AUTH_SALT',        'MzK8Myrbb)XEPTaVV.OHF)9C|W aD>uF$lz72vD;%i}?KqV18|J-K3x!L~t8t-wj' );
define( 'SECURE_AUTH_SALT', 't!#N/eX%UNXp%3k_80mQ8c-KC}B|^8uG1`,b&R#d{ofyd;Tz0=6/~eRBM~|>uiLV' );
define( 'LOGGED_IN_SALT',   'M.G@:@I.=hE?qaE,O+?FsnT1*EQ$E.a1C<Vtz5~vi[)N}8kqf[7~}<gl?#&,~Lj]' );
define( 'NONCE_SALT',       '3~A6iRCMPcgOElTr)[1onj:x0|mP!l.S1jyk~hwX B`*<hMS|WDZqs<r/NUE$jlB' );

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
$table_prefix = 'pdk_';

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
