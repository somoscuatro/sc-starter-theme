<?php
/**
 * Gutenberg Blocks loader.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme\Blocks;

use DI\Container;

/**
 * Gutenberg Blocks loader.
 */
class Loader {

	/**
	 * The PHP DI Container.
	 *
	 * @var Container
	 */
	private $container;

	/**
	 * Class constructor.
	 *
	 * @param Container $container The PHP DI Container.
	 */
	public function __construct( Container $container ) {
		$this->container = $container;
	}

	/**
	 * Loads custom Gutenberg blocks.
	 */
	public function load(): void {
		foreach ( glob( __DIR__ . '/*' ) as $block_dir ) {
			if ( ! is_dir( $block_dir ) ) {
				continue;
			}

			$class = implode(
				'_',
				array_map(
					'ucwords',
					explode( '-', basename( $block_dir ) )
				)
			);

			$full_class_path = sprintf( __NAMESPACE__ . '\%s\%s', $class, $class );
			if ( method_exists( $full_class_path, 'init' ) ) {
				( new $full_class_path( $this->container ) )->init();
			}
		}
	}
}
