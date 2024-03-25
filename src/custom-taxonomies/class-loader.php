<?php
/**
 * Custom Post Type Loader.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme\Custom_Taxonomies;

/**
 * Custom Post Type Loader.
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
	 * Loads Custom Post Types.
	 */
	public function load(): void {
		foreach ( glob( __DIR__ . '/taxonomies/*' ) as $cpt_file ) {
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

			$full_class_path = sprintf( __NAMESPACE__ . '\Taxonomies\%s', $class );

			if ( method_exists( $full_class_path, 'init' ) ) {
				( new $full_class_path() )->init( $this->theme_prefix );
			}
		}
	}
}
