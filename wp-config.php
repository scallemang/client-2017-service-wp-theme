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

// ** ENVIRONMENT declaration and configurations ** //

        $server = strtolower( $_SERVER['SERVER_NAME'] );
        $environment = 'production';
        $path_array = explode("/", __FILE__);

        $environments = array(
                "teledent.dev" => "development",
                "teledent.thevariables.com" => "staging",
                "teledent.ca" => "production"
        );

        foreach ($environments as $key => $value) {
                if($key == $server) $environment = $value;
        }

        define('ENVIRONMENT', $environment);

        //define database connection settings
        if(defined('ENVIRONMENT')) {
                switch(ENVIRONMENT) {
                case 'development':

                        define('FS_METHOD','direct');

                        define('DB_HOST', 'localhost');
                        define('DB_NAME', 'teledent_wp');
                        define('DB_USER', 'root');
                        define('DB_PASSWORD', 'root');

                        define('WP_DEBUG', true);
                        define('WP_DEBUG_LOG', false);
                        define('WP_DEBUG_DISPLAY', true);
                        @ini_set('display_errors', true);

                        break;

                case 'staging':

                        define('DB_NAME', 'teledent_thevariables_co');
                        define('DB_USER', 'teledentthevaria');
                        define('DB_PASSWORD', '9x3D2wYy');
                        define('DB_HOST', 'mysql.teledent.thevariables.com');

                        define('WP_DEBUG', true);
                        define('WP_DEBUG_LOG', true);
                        define('WP_DEBUG_DISPLAY', true);
                        @ini_set('display_errors', true);
                        break;


  				case 'production':

                        define('DB_HOST', '');
                        define('DB_NAME', '');
                        define('DB_USER', '');
                        define('DB_PASSWORD', '');

                        define('WP_DEBUG', false);
                        define('WP_DEBUG_LOG', true);
                        define('WP_DEBUG_DISPLAY', false);
                        @ini_set('display_errors', false);
                        break;

        }
}



define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'O`CB`q<qEDr(Lxh,e~prP7l}^7x& {Wss-#17^-<Pm)7#n;8][7l-^z0Q?T5n,IP');
define('SECURE_AUTH_KEY',  ':I3q3|[Ux|*xk/g5O-|LW=f*3oKJtjmaJq;<kqU+l9hO|zYkn&kA1 )|jM*Ma T>');
define('LOGGED_IN_KEY',    'H~P}JpLAa1tm+/O_-1?9`C_D|k:I$vJ>`kF_R6s#5E{kDD!>jlr:xf}vVC U[tmf');
define('NONCE_KEY',        '9+]&Y|_PeftpUWKLo$y)rtc3g~k?H`#^oY%{2zk#P~wE3f2|K2o{Aa>`1-lR,6`#');
define('AUTH_SALT',        '&h2]<1:aDZzOhDZv0p_(L%>,/5XS)A-v@5h[t8zhJNzivm4[yo+bAY=)^S!}Q+F@');
define('SECURE_AUTH_SALT', 'P?O0ir[_ahL-e{R+uX~JuseNu)N|Eh,W2 A|tb:Zw?HE7z&TXT{SXO]hQ~d *6IW');
define('LOGGED_IN_SALT',   'n?4%Ac~^|o(b1pL`=`6yp5y-dF!)(U!0Yt2C6PcF7Uo[a)XL^njc,4<)rA(T$#C,');
define('NONCE_SALT',       '@*nl=bw.H,T#6tLR5Jq0X+<O0[H+rXF=Q#^4 p)82{/MgY+tlVJK${OB[-t`N^-^');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';