<?php
/**
 * Setup PHP class autoload.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme;

// Autoload Composer's dependencies.
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Registers theme auto-loader.
 *
 * @see https://www.php-fig.org/psr/psr-4/
 *
 * @param string $class The class name.
 */
spl_autoload_register(
	function ( $class_name ) {
		// Only autoload classes from this namespace.
		if ( ! str_contains( $class_name, __NAMESPACE__ ) ) {
			return;
		}

		// Remove namespace from class name.
		$class_file = str_replace( __NAMESPACE__ . '\\', '', $class_name );

		// Convert class name format to file name format.
		$class_file = strtolower( $class_file );
		$class_file = str_replace( '_', '-', $class_file );

		// Convert sub-namespaces into directories.
		$class_path = explode( '\\', $class_file );
		$class_file = array_pop( $class_path );
		$class_path = implode( '/', $class_path );

		$file = realpath( __DIR__ . '/src' . ( $class_path ? "/$class_path" : '' ) . '/class-' . $class_file . '.php' );

		// If the file exists, require it.
		if ( file_exists( $file ) ) {
			require_once $file;
		} else {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			error_log( sprintf( 'File not found: %s', $file ) );
		}
	}
);
