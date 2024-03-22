<?php
/**
 * Initialize theme.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

use Somoscuatro\Starter_Theme\Attributes\Hook;

if ( ! defined( 'ABSPATH' ) ) {
	// phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	header( $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found' );
	exit;
}

// Setup autoload.
require_once __DIR__ . '/autoload.php';

// Register WordPress hooks.
( new Hook() )->register_hooks();
