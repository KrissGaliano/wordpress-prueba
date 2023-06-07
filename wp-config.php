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
define( 'DB_NAME', 'paginaweb' );

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
define( 'AUTH_KEY',         ']ZD}=T^{lD8L[VX13t@2<va:yC>{V.u$x6qV/Ik8`i*_kY#2Otkf}O#3_a0ID[Z#' );
define( 'SECURE_AUTH_KEY',  ',Vamh3%/6q^_~T?g*Zrg9a;[^[IW96t?$$vjtp(9t@yeUP80VzVlMI:*K]Y1ZemQ' );
define( 'LOGGED_IN_KEY',    'CCVk`VE4bPLBR6R6$jHN|,Xs+;|IfXUA(U%,zh}Prz%_kfeE1_|TJ#FnA~<Q=(Wh' );
define( 'NONCE_KEY',        '9t!{`AJlOco#XWGYMM$2FV+0Hcq1Fq-yeJw{u&.I)_He>}qq1,SlN^=kN] 3%#lW' );
define( 'AUTH_SALT',        '#R~L{.<HlAjU_x_YNA5kIvFQL0&sRu.#F|1LW|&Rm41EC0S(vBMOQ]SfyVx,n[+$' );
define( 'SECURE_AUTH_SALT', 'szEg_S=<%Ou^oK63v]]-4mx}sW:R 2KY>YpuDJmhY~HAx}AR%q|$ra{Kd:}n#)gJ' );
define( 'LOGGED_IN_SALT',   '5[Hb3gw%i*+$f53IT={A j}e8V^B/Uo|$wzuYn&4%(XF6jC:qlvJXj&QP ?v;]4u' );
define( 'NONCE_SALT',       '1k-X4j}bL)|]X(AYurO((VQt$av|9BR?.&mT+BEELY7WEu}a>,]>ll+,WA-trojR' );

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


/*define( 'WP_ALLOW_MULTISITE', true );*/
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
define( 'DOMAIN_CURRENT_SITE', 'localhost' );
define( 'PATH_CURRENT_SITE', '/paginaweb/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
