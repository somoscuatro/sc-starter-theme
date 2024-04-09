<?php
/**
 * Initialize Theme.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

use Somoscuatro\Starter_Theme\CLI\CLI;
use Somoscuatro\Starter_Theme\Attributes\Hook;

use DI\Container;

if ( ! defined( 'ABSPATH' ) ) {
	// phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	header( $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found' );
	exit;
}

// Setup Autoload.
require_once __DIR__ . '/autoload.php';

// Setup Dependencies.
$container = new Container();

// Register WordPress Hooks.
( new Hook( $container ) )->register_hooks();

// Register CLI Commands.
( new CLI( $container ) )->register_commands();
