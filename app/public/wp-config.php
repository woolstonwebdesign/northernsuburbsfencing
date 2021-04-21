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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define('AUTH_KEY',         'bsoiYVYAT41MvWXtuvfiD+uprKnmzRUE3fTuMqCxqZIMUlYlq4W9ahm5HEa7X7eB/1MhapzXM+lzmqFot7RG5w==');
define('SECURE_AUTH_KEY',  '6MW4KOZ5eMlmaAghTrzNZHlkXBNtNCA0o5NG7RvrgdkhDrVH/s9CfTWIs2Op7c5MycG5FU+p4HU5o7M5aTximg==');
define('LOGGED_IN_KEY',    'Ow/sSrv4DQpY+b+VEy9HEGrw4KzwHyFGHJuKh+ieR9Z63UvEKpkDe+86XFzoLOqi2T2AkBPFbyQkJyw5bCKcUg==');
define('NONCE_KEY',        'apbLjAqh6KG9DUb1pz8/O9mUClvKHY1u74XAFRBj0gEspIDeJsjjCgH87YlP4NVeMJMA5TRBZ6P6INXakgpfag==');
define('AUTH_SALT',        'U3yM+pB74QjVH+sNMXsBQG31gsFM7+EO/mqWsX+E3QRfLBcrBdHLniJrF/OCaafn8bUFFbyUlAYG4a8NtXKWQA==');
define('SECURE_AUTH_SALT', 'bILSA3Kv+OeQede+SrEWqn/hg7P2YOgkRZg4udJsPRMjy6lTvPtiH+YgJ7il1yYTq+dkcYTDbgPs9GvCKUIPWw==');
define('LOGGED_IN_SALT',   'N3B4lkqAsH6VkNgHa2GiyJhPVYmiIPWD+6LQHiVkh1l/2olQktQcWIJZOc6VJLbmXK8cknNRsgtg+cbwirgicw==');
define('NONCE_SALT',       'bBnrYWI1Ne4GfXu1gR1L12hIZnliz+iM61UoehdrLKY/S4LHOyQRH/Q8CAF7lkTekVFbac31KSJO+wb6xKS2bQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';
define('WC_MAX_LINKED_VARIATIONS', 100);
define('WP_DEBUG', true);



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
