<?php
// Stolen shamelessly with some modifications from Mark Jaquith's WordPress
// Skeleton project: https://github.com/markjaquith/WordPress-Skeleton

// Load composer autoloader if it's available
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
	include(__DIR__ . '/../vendor/autoload.php');
}

// ===================================================
// Load database info and local development parameters
// ===================================================
if (file_exists(__DIR__ . '/../local-config.php')) {
	include(__DIR__ . '/../local-config.php');
} else {
	die("Local environment config is missing");
}


// ===================================================
// Load project parameters
// ===================================================
if (file_exists(__DIR__ . '/../project-config.php')) {
	include(__DIR__ . '/../project-config.php');
} else {
	die("Project config is missing");
}


// ===========================================================
// No file edits unless explicitly allowed in local-config.php
// ===========================================================
if (!defined('DISALLOW_FILE_MODS')) {
	define('DISALLOW_FILE_MODS', true);
}

// ========================
// Custom Content Directory
// ========================
if (!defined('WP_HOME')) {
	// Manually configure if not working in domain root
	define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
}

define('WP_SITEURL', WP_HOME . '/wpanel');
define('WP_CONTENT_DIR', __DIR__ . '/content');
define('WP_CONTENT_URL', WP_HOME . '/content');

// ================================================
// You almost certainly do not want to change these
// ================================================
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// ===========
// Hide errors
// ===========
ini_set('display_errors', 0);
define('WP_DEBUG_DISPLAY', false);

// ======================================
// Load a Memcached config if we have one
// ======================================
if (file_exists(__DIR__ . '/memcached.php')) {
	$memcached_servers = include(__DIR__ . '/memcached.php');
}

// ===================
// Bootstrap WordPress
// ===================
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/wpanel/');
}
require_once(ABSPATH . 'wp-settings.php');
