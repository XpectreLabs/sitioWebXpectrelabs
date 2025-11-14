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
define( 'DB_NAME', 'u855837876_cms' );

/** Database username */
define( 'DB_USER', 'u855837876_xpectrelabs' );

/** Database password */
define( 'DB_PASSWORD', 'Xp3ct123l@bs20' );

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
define( 'AUTH_KEY',         '<rvCw4}Zf+ml;4Av! OK~E3my^GP.8T;2F|C@q*JxnQ]ca}J7ZiGjep()P_q-rv0' );
define( 'SECURE_AUTH_KEY',  'c`y3Cnvu[DNr=wNw%/nKUejQ}KAP6czQr?|z:L?qofpU0H4p{s5$sl,Sz8=hU,pU' );
define( 'LOGGED_IN_KEY',    'L|:62v};ie}?+)jJ/Uz%Jl(-H8WO= T1U+jo#YJvF;t.n)B5=*l}RM3B:D?%@vkQ' );
define( 'NONCE_KEY',        'Wrxlft%)evC?ncSO[>&!}:Tnu;iId}m=vga#-mX?>*F?!e^*T:4JqdU10Tysg#sJ' );
define( 'AUTH_SALT',        '%`&O71PJwO_Ek%S;6GO~(9fT&|^&BfgW|_h>YitM=@As}Jd:)^7sxgt-l!~@J|*B' );
define( 'SECURE_AUTH_SALT', ')9SRGq4WOOH|?U> W1A+E|mP8.46^&6~CHyPgXz^mummV*iQ;~@V&9L!yQ,L34LK' );
define( 'LOGGED_IN_SALT',   '@CFl?K2$| J:}`c!J@%rtESD_,3MyV=, <CFeIou|!,Ftz+p^(xlC$jgs`CpI?t4' );
define( 'NONCE_SALT',       'ACoen.fK7MjFPIa?uvMwsjW7-4da(W}=g|YW(SeWU/h(*?O1z19!W{l~xTE)<YR|' );

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
