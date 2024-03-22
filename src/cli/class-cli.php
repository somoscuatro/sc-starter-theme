<?php
/**
 * CLI management class.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme\CLI;

/**
 * CLI management class.
 */
class CLI {

	/**
	 * Registers CLI commands.
	 */
	public function register_commands(): void {
		// phpcs:ignore Generic.Commenting.DocComment.MissingShort
		/** @disregard P1011 */
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
		}
	}
}
