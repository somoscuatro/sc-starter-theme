<?php
/**
 * WP CLI Command to export ACF Fields Blocks to JSON file.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme\CLI;

use Somoscuatro\Starter_Theme\Helpers\Filesystem;

/**
 * WP CLI Command to export ACF Fields Blocks to JSON file.
 */
abstract class CLI_Command extends \WP_CLI_Command {

	use Filesystem;

	/**
	 * The Gutenberg Blocks base path.
	 *
	 * @var string
	 */
	protected $blocks_base_path;

	/**
	 * Gets the root namespace.
	 *
	 * @return string The root namespace.
	 */
	protected function get_base_namespace(): string {
		$namespace = explode( '\\', __NAMESPACE__ );

		$root_namespace = array(
			$namespace[0],
			$namespace[1],
		);

		return implode( '\\', $root_namespace );
	}
}
