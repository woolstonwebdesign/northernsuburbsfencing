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

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */



// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'woolsto1_nsf' );



/** MySQL database username */

define( 'DB_USER', 'woolsto1_app' );



/** MySQL database password */

define( 'DB_PASSWORD', 'Ky6UgxRdp5M5' );



/** MySQL hostname */

define( 'DB_HOST', 'localhost' );



/** Database Charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );



/** The Database Collate type. Don't change this if in doubt. */

define( 'DB_COLLATE', '' );



/**#@+

 * Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define('AUTH_KEY',         'oK9nhIMP7b7Km4sSfDdj5QS6WzEy7gLuB2pSAf3k3z6w3NFPkdkNZcOCsBNMmn2Y');

define('SECURE_AUTH_KEY',  'UnHsMWs10a8urVXcuDBa27GqcaV66LqS30yKWbO6SgJOmattdrFQ92UCV9BGefCP');

define('LOGGED_IN_KEY',    'nL9nXSAJhLd1nJQbZe7tdDc5L40r5A9iexWz9nbSWhkFPVMZzfYnDA8T1tp9MLQm');

define('NONCE_KEY',        'UFVN6pXdZu5SdJYZrY8ZtR4qz3s409iNSfOihuaU6S5K1X1IuPHqdpfzVuUR2t8Y');

define('AUTH_SALT',        'Xs4IezqOo4bQ9d4PHBHUMebws0xMqlLmUv5CM8Ur79VRKpVzsEbyEEbSh25jfblf');

define('SECURE_AUTH_SALT', 'KZEuudzZw0VqoUMCrniVfbH7TMXe4XuSfFHusLtKBfaE30AxtWPBEE84sOU94IUc');

define('LOGGED_IN_SALT',   'uRwiJgvL8YsvEO8OHsvcdQEsU2FyIYtKJWIySHGX0o4pQTWGH9VM0xxcXtQEG1YW');

define('NONCE_SALT',       'h2xR3fODnJJ3RNzKcgGQJN60hktNTGT5NmzQ4pbmfkJtyhcFzpSPilao1guBKNUv');



/**

 * Other customizations.

 */

define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');
define('WC_MAX_LINKED_VARIATIONS', 50);



/**

 * Turn off automatic updates since these are managed externally by Installatron.

 * If you remove this define() to re-enable WordPress's automatic background updating

 * then it's advised to disable auto-updating in Installatron.

 */

define('AUTOMATIC_UPDATER_DISABLED', true);





/**#@-*/



/**

 * WordPress Database Table prefix.

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

 * @link https://wordpress.org/support/article/debugging-in-wordpress/

 */

define( 'WP_DEBUG', false );



/* That's all, stop editing! Happy publishing. */



/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}



/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

