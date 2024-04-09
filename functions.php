<?php
/**
 * Initialize theme.
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

// Setup autoload.
require_once __DIR__ . '/autoload.php';

// Setup dependencies.
$container = new Container();

// Register WordPress hooks.
( new Hook( $container ) )->register_hooks();

// Register CLI commands.
( new CLI( $container ) )->register_commands();
