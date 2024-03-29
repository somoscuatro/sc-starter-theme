<?php
/**
 * Initialize theme.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

use Somoscuatro\Starter_Theme\CLI\CLI;
use Somoscuatro\Starter_Theme\Attributes\Hook;
use Somoscuatro\Starter_Theme\Dependency_Injection\Container as Dependencies;
use Somoscuatro\Starter_Theme\Theme;
use Somoscuatro\Starter_Theme\Timber;

if ( ! defined( 'ABSPATH' ) ) {
	// phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	header( $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found' );
	exit;
}

// Setup autoload.
require_once __DIR__ . '/autoload.php';

// Register dependencies.
$dependencies = new Dependencies();
$dependencies->add( 'Theme', fn ( $dependencies ) => new Theme( $dependencies ) );
$dependencies->add( 'Timber', fn () => new Timber() );

// Register WordPress hooks.
( new Hook( $dependencies ) )->register_hooks();

// Register CLI commands.
( new CLI() )->register_commands();
