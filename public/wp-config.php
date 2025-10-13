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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'genuingmlvoe' );

/** Database username */
define( 'DB_USER', 'genuingmlvoe' );

/** Database password */
define( 'DB_PASSWORD', 'Leviathan474' );

/** Database hostname */
define( 'DB_HOST', 'genuingmlvoe.mysql.db' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

// $url = parse_url(getenv("JAWSDB_URL"));

// define('DB_NAME', substr($url["path"], 1));
// define('DB_USER', $url["user"]);
// define('DB_PASSWORD', $url["pass"]);
// define('DB_HOST', $url["host"]);
// define('DB_CHARSET', 'utf8');
// define('DB_COLLATE', '');
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
define( 'AUTH_KEY',          '8,Fz;kVy.w>~1THNhVE!eR)23-*7q9tT}Q=[Y#wrOA(:,=K6jnt>+9G{4hC6a(&<' );
define( 'SECURE_AUTH_KEY',   'Yt%a8]6p)1CvvLJv.$t@ybO+D+~%-1/]QG_DpmC4Rx|LVHCEqka$in^!,GLweqLl' );
define( 'LOGGED_IN_KEY',     '8oT0^zpE{}#`-:E%U_w=_T?|a +M.fHB<4zBph?*!c;;ha^:=`2o}7?y?S}Lc+9x' );
define( 'NONCE_KEY',         '9 mI3k{tmR`4;/&:{@L}Iu_NdUo$1C=~c,vyI[mgo}Rrx=3L4V[1$s$+S~<W0BZR' );
define( 'AUTH_SALT',         'G*d.s^gU&~O&#|(aKkk$F]2DXX0=^P#F;k*[L8x(*UB4x(Klq4gMM%lN1SpwEmU8' );
define( 'SECURE_AUTH_SALT',  ' $jE8vi^AUZw1xTfS  @`SFk,EGA8n/5>1~xWB6xkorANV!lbCCYd!>Wm`Uh_P`4' );
define( 'LOGGED_IN_SALT',    '*`6pj2k:[j4PbmO0~XP! b*I;cG5}gPNN>+ $Bmuo<7X6M:_PO=H(Z9#rbf$czY<' );
define( 'NONCE_SALT',        '}AD &k0186K0ZI*~x@HMvYC*f5P<,:$bH%]r+#mY<YK&@vTgXW7FCoBE0F(5n|m)' );
define( 'WP_CACHE_KEY_SALT', '7$PssZ[rkOl/@78=S ,#?0fC]TmQ%!]QKwZRdTyn,6H=| de$TU3G[R;IiJL9l1m' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
