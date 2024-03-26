<?php
/**
 * Gutenberg Blocks loader.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme\Blocks;

use Somoscuatro\Starter_Theme\Attributes\Action;
use Somoscuatro\Starter_Theme\Attributes\Filter;

use WP_Block_Editor_Context;

/**
 * Gutenberg Blocks loader.
 */
class Loader {

	/**
	 * The theme prefix.
	 *
	 * @var string
	 */
	protected string $theme_prefix;

	/**
	 * The class constructor.
	 *
	 * @param string $theme_prefix The theme prefix.
	 */
	public function __construct( $theme_prefix ) {
		$this->theme_prefix = $theme_prefix;
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
				( new $full_class_path() )->init( $this->theme_prefix );
			}
		}
	}
}
