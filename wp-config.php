<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'restoran' );

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
define( 'AUTH_KEY',         'PBj aV9rgs%o9?VOA*!+Rl met;J^5xTr{2axrnm5LJDnV3=g-PlEnm.X{q>M~cb' );
define( 'SECURE_AUTH_KEY',  '9&Qt+p* GeI%_PEWH&[z,MXsE2R|9^BlU3#8^a4mTL<;1iqux/&rH:%-,Do3=/4p' );
define( 'LOGGED_IN_KEY',    'u_-UO;?:5Eka(%qmDZDO>{0n^U`X/vH  Bg_6}3:QG]$;5Hy+.Y^+?GhZ4a=+tOA' );
define( 'NONCE_KEY',        '!{UH>VgR[7*=FJc`(K8>6,H?dZ1d5I*%Bs(<;W8Ypa4Jr+AFQEa]Vkh@]0Rr60((' );
define( 'AUTH_SALT',        '-v)EA5E>Rz<?Cm]gLUcR$Z&3>cs:UhzksD1]T(@Pz/XmP_.Y5?Tc^Us/RkJ6WRH@' );
define( 'SECURE_AUTH_SALT', '])=GC)}S-QkAlL=hWl}VezH*XMY}DJ0}s(g@YVyrZaM>3KZiP8%#.<;NFAv!?zcx' );
define( 'LOGGED_IN_SALT',   'jANz(AJCCddZik|2J=vf;F(ve=~!DR:7/rU@kKZ <&wrzAeqyX&Xz@qUtKG!*6n)' );
define( 'NONCE_SALT',       '{g*O<Ul j_[1YE]P~J]*nk)$2}Jz;_TVFmv $0JG3,{!dUIT>`Nv:6LS4`^owDv;' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
