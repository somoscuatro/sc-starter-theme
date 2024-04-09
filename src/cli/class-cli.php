<?php
/**
 * CLI management class.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme\CLI;

use DI\Container;

/**
 * CLI management class.
 */
class CLI {

	/**
	 * The PHP DI Container.
	 *
	 * @var Container
	 */
	private $container;

	/**
	 * Class Constructor.
	 *
	 * @param Container $container The PHP DI Container.
	 */
	public function __construct( Container $container ) {
		$this->container = $container;
	}
	/**
	 * Registers CLI commands.
	 */
	public function register_commands(): void {
		// phpcs:ignore Generic.Commenting.DocComment.MissingShort
		/** @disregard P1011 */
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			$command = $this->container->get( __NAMESPACE__ . '\Commands\Export_ACF_Blocks_Fields' );
			\WP_CLI::add_command( 'export-acf-blocks-fields', $command );
		}
	}
}
