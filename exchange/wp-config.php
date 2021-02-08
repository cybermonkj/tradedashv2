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
define( 'DB_NAME', 'qb8oAtJROeBx0j' );

/** MySQL database username */
define( 'DB_USER', 'qb8oAtJROeBx0j' );

/** MySQL database password */
define( 'DB_PASSWORD', '5BTGnMhUyb5oyE' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'THP}bGeO>(imEf`z[1(zqb8f9fUQg]Ip|onPmK;Px >ZXpW$y0]Zc5`Jp0UsYy_(' );
define( 'SECURE_AUTH_KEY',   '~b>!Hqo:)~wvLaja)R{g1/(:mSn|FO.,*^^3Jj~K(p!r%iCx^4_fCYG,e9)516=c' );
define( 'LOGGED_IN_KEY',     'Rn8qPs[a`ZjU{a-/` *DERJ4G!YcBi 268*0CpVtt0o5x#m#RP71<ldi)Xu1Q_M#' );
define( 'NONCE_KEY',         ' 8J3?9Fftwklla0noBPE1TNWMqhP ^baUIT*w.y9=$Ue~#%d@jc:`n^_xFD&Bsqg' );
define( 'AUTH_SALT',         ';`>9);}DbNl]/c;/5c/O3B|Pf46KO*9^D?7A ;@Q[QObV5$6rSvd?I3;Coidy?-;' );
define( 'SECURE_AUTH_SALT',  '[ xoG{F`qyM[3DRHLxb%E)dg5 zyW;TU7z$]OO+4|_Zq:N#gA.+~kH`p+f3*]`9F' );
define( 'LOGGED_IN_SALT',    '=d#Q^og]!M.kLui7n^#xCD[3798$<s:eGcE_0-%p%*Txowx0B@9&&axV,hx$c}f#' );
define( 'NONCE_SALT',        'yvMm&7o6{yiclN@>_NK3AN~{vvxXVw 5]buWRy&N2+Tt_tC-5/Mb-`KHWAI}25jq' );
define( 'WP_CACHE_KEY_SALT', '.{N,aQtBM=E0vN>gF2uC/;TN,#-,~al6c[<XpnA2YfVw>~,U`d(tZp@&0r_tVJ2.' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
