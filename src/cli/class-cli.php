<?php
/**
 * CLI management class.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

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
			\WP_CLI::add_command( 'export-acf-blocks-fields', __NAMESPACE__ . '\Commands\Export_Acf_Blocks_Fields' );
		}
	}
}
