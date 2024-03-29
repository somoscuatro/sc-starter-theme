<?php
/**
 * Custom Post Type Loader.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme\Custom_Post_Types;

use Somoscuatro\Starter_Theme\Dependency_Injection\Container_Interface as Dependencies;

/**
 * Custom Post Type Loader.
 */
class Loader {

	/**
	 * Dependencies container.
	 *
	 * @var Dependencies
	 */
	protected $dependencies;

	/**
	 * Class constructor.
	 *
	 * @param Dependencies $dependencies Dependencies container.
	 */
	public function __construct( Dependencies $dependencies ) {
		$this->dependencies = $dependencies;
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
				( new $full_class_path() )->init( $this->dependencies );
			}
		}
	}
}
