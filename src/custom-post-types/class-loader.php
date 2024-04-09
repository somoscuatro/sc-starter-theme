<?php
/**
 * Contains Somoscuatro\Starter_Theme\Custom_Post_Types\Loader Class.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme\Custom_Post_Types;

use DI\Container;

/**
 * Custom Post Type Loader.
 */
class Loader {

	/**
	 * The PHP DI Container.
	 *
	 * @var Container
	 */
	protected $container;

	/**
	 * Class Constructor.
	 *
	 * @param Container $container The PHP DI Container.
	 */
	public function __construct( Container $container ) {
		$this->container = $container;
	}

	/**
	 * Loads Custom Post Types.
	 */
	public function load(): void {
		foreach ( glob( __DIR__ . '/post-types/*' ) as $cpt_file ) {
			if ( ! is_file( $cpt_file ) ) {
				continue;
			}

			$class = implode(
				'_',
				array_map(
					'ucwords',
					explode(
						'-',
						str_replace( array( 'class-', '.php' ), '', basename( $cpt_file ) )
					)
				)
			);

			$full_class_path = sprintf( __NAMESPACE__ . '\Post_Types\%s', $class );

			if ( method_exists( $full_class_path, 'init' ) ) {
				( new $full_class_path() )->init( $this->container );
			}
		}
	}
}
