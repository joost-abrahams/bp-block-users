<?php

// Define constants used by BP Block Users test suite
if ( ! defined( 'BPBU_PLUGIN_DIR' ) ) {
	define( 'BPBU_PLUGIN_DIR', dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) );
}

if ( ! defined( 'BPBU_TESTS_DIR' ) ) {
	define( 'BPBU_TESTS_DIR', dirname( dirname( __FILE__ ) ) );
}

/**
 * Determine where the WP test suite lives. Three options are supported:
 *
 * - Define a WP_DEVELOP_DIR environment variable, which points to a checkout
 *   of the develop.svn.wordpress.org repository (this is recommended)
 * - Define a WP_TESTS_DIR environment variable, which points to a checkout of
 *   WordPress test suite
 * - Assume that we are inside of a develop.svn.wordpress.org setup, and walk
 *   up the directory tree
 */
if ( false !== getenv( 'WP_TESTS_DIR' ) ) {
	define( 'WP_TESTS_DIR', getenv( 'WP_TESTS_DIR' ) );
	define( 'WP_ROOT_DIR', WP_TESTS_DIR );
} else {

	// Support WP_DEVELOP_DIR, as used by some plugins
	if ( false !== getenv( 'WP_DEVELOP_DIR' ) ) {
		define( 'WP_ROOT_DIR', getenv( 'WP_DEVELOP_DIR' ) );
	} else {
		define( 'WP_ROOT_DIR', dirname( dirname( dirname( dirname( dirname( dirname( dirname( __DIR__ ) ) ) ) ) ) ) );
	}

	define( 'WP_TESTS_DIR', WP_ROOT_DIR . '/tests/phpunit' );
}

// Based on the tests directory, look for a config file
// Standard develop.svn.wordpress.org setup
if ( file_exists( WP_ROOT_DIR . '/wp-tests-config.php' ) ) {
	define( 'WP_TESTS_CONFIG_PATH', WP_ROOT_DIR . '/wp-tests-config.php' );

// Legacy unit-test.svn.wordpress.org setup
} elseif ( file_exists( WP_TESTS_DIR . '/wp-tests-config.php' ) ) {
	define( 'WP_TESTS_CONFIG_PATH', WP_TESTS_DIR . '/wp-tests-config.php' );

// Environment variable exists and points to tests/phpunit of
// develop.svn.wordpress.org setup
} elseif ( file_exists( dirname( dirname( WP_TESTS_DIR ) ) . '/wp-tests-config.php' ) ) {
	define( 'WP_TESTS_CONFIG_PATH', dirname( dirname( WP_TESTS_DIR ) ) . '/wp-tests-config.php' );

// No test config found.
} else {
	die( "wp-tests-config.php could not be found.\n" );
}

// Determine whether BuddyPress is present.
if ( ! defined( 'BP_TESTS_DIR' ) ) {
	$wp_content_dir = dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) );
	if ( file_exists( $wp_content_dir . '/buddypress/tests/phpunit/bootstrap.php' ) ) {
		define( 'BP_TESTS_DIR', $wp_content_dir . '/buddypress/tests/phpunit' );
	}
}
