<?php
// ** MySQL settings ** //

#print_r($_SERVER); die();


$is_local_env	= (strpos($_SERVER['HTTP_HOST'], "localhost") !== false);
/* LOCAL ENVIRONMENT */	/* $_SERVER['HTTP_HOST'}  localhost:8080,   [SERVER_NAME] => localhost */

if ($is_local_env) {
	define('DB_NAME', 'wp_hacia_el_este');
	define('DB_USER', 'root');
	define('DB_PASSWORD', '');
	define('DB_HOST', 'localhost');
	
/* PRODUCTION ENVIRONMENT TO_DO: */
}else {
	define('DB_NAME', 'database_name_here');
	define('DB_USER', 'username_here');
	define('DB_PASSWORD', 'password_here');
	define('DB_HOST', 'localhost');
}

define('WP_DEBUG', $is_local_env);
$table_prefix  = 'hee_';

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
define('WPLANG', '');
define('WP_POST_REVISIONS', 3 );


if (strpos($_SERVER["SCRIPT_FILENAME"], 'load-latest-db.php')) return;


/**#@+ * Authentication Unique Keys and Salts.
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 */
define('AUTH_KEY',         '~H0m4U<;m>Z3`/E86N)U0[A[mCryzezuEoO}lnZG G]~8!c:WyIR?m?YN.AvM=Fc');
define('SECURE_AUTH_KEY',  'LG+CP}N(ZBW}NybkQY$XhR&o!qI{pv56hL-b~7*l7=kOD3bx$x<-GZ6F|w+AEv?,');
define('LOGGED_IN_KEY',    '5w}+bCvGxG<iFYgy6+1jD/lTQ>{CHnZdh5w[lcesMYD3Y|4y.;W0/Z5B|Erdxa`(');
define('NONCE_KEY',        'X9RuAVWFa;%e-m|-btsM4#Ua~CRC8gt$PuIHc-r6Q,i%ehjNH`;Dh6-DTbSGtF:.');
define('AUTH_SALT',        'nL-L_SF3G(Kcs,tyMfF(a_{2UVbL];+[onD?)OF{kp!hH{s_^ mls-m?,c<_x94i');
define('SECURE_AUTH_SALT', '@vp+U)cM#z@-DtoJ3DcfIVW(cXM6pbA.K~/m~I+spRv>2LUcXgnL%iueE:*6 QBo');
define('LOGGED_IN_SALT',   'kb0CS<Fa0w8>|ZQ_PB@Dz0dV-.,4oopvQfSRc|D|CoCNiw*ZlD1|U-?)^DH2jIF9');
define('NONCE_SALT',       '`S<2VcyyeBGa|<jwu{!pc?oM+QAfb?a(MK-!N;+-fE.;+d-q~!Tpqzv>QdLihH_6');
/**#@-*/




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
