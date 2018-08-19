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
define('DB_NAME', 'yourtour_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '5c6OwE1w3shA_/.xd8d},$p9Qo>?1EU=E(|!c@pYT$kYV5duC>r>$U2w:|2LLfzc');
define('SECURE_AUTH_KEY',  '[Z}fJF7}1$e2zf6-2<UMhgC|qziAHePiL_xM9}K7lc={73+~8?vo[jfYNH<GUPU}');
define('LOGGED_IN_KEY',    'Qsy?/(CaFpdj#Ol|1c~(A}#]2@X@[X)}S2J<1KNLCEO(4.gg&c?lK+eb2Zk66c{l');
define('NONCE_KEY',        '/xPpr8mOoRvUDcPBfA+C k^=7BS@q<:vot-|yCTv)@1[fWIR3-jSlGQ;<IzP.r:#');
define('AUTH_SALT',        '6<NxGWw)o,W(-`+jn_1}HFgNDy8%G#axNMUI>P+mnaWKE8<]HZBiordD]U*49v?K');
define('SECURE_AUTH_SALT', '/XEOB{#(~FRg:rH)!hq;A%.{;<`h%2AZ7xO0y#<(U{JrGz[Kv^_t9lmWf|z`~sj.');
define('LOGGED_IN_SALT',   '7pJ6^NE 8;S)Xu3&3^Pf%pDN!7aQ^|eUB1w8K-_O_i;va0?X:gsnoUw6N:!}E+(K');
define('NONCE_SALT',       'J.}$dA=pvIqA.$s6t/n1L[j-jC>shv6W,z@!.4(dHM Z9~ko;$AsM 9[h*6x,TFV');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'yourtour_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
