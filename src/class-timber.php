<?php
/**
 * Timber management class.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;
use Somoscuatro\Starter_Theme\Attributes\Filter;

use Timber\Timber as TimberLibrary;
use Twig\TwigFunction;
use Twig\Environment as TwigEnvironment;

/**
 * Timber management class.
 */
class Timber {

	/**
	 * Timber initialization.
	 *
	 * @throws \Exception If Timber class does not exist.
	 */
	#[Action( 'after_setup_theme', 9 )]
	public function init(): void {
		TimberLibrary::init();

		if ( ! class_exists( 'Timber' ) ) {
			throw new \Exception( 'Timber not found.' );
		}

		TimberLibrary::$dirname = array(
			'templates',
			'templates/parts',
		);
	}

	/**
	 * Adds additional variables to global context.
	 *
	 * @param array $context Timber context.
	 *
	 * @return array Global context data.
	 */
	#[Filter( 'timber/context' )]
	public function add_to_global_context( array $context ): array {
		$context['homepage_url'] = get_home_url();

		$context = $this->get_menus( $context );

		return $context;
	}

	/**
	 * Adds registered menus to Timber global context.
	 *
	 * As documented in
	 * https://timber.github.io/docs/v2/guides/menus/#set-up-all-menus-globally
	 * Timber allows to add the registered menu to the global context. For unknown
	 * reasons, this is not fully working for us since the current menu item is
	 * not set (always false) and WordPress current item classes (e.g.
	 * current-menu-item) are not added.
	 *
	 * @param array $context The Timber global context.
	 *
	 * @return array The updated Timber global context.
	 */
	public function get_menus( array $context ): array {
		foreach ( array_keys( get_registered_nav_menus() ) as $location ) {
			if ( ! has_nav_menu( $location ) ) {
				continue;
			}

			$context[ $location ] = TimberLibrary::get_menu( $location );
		}

		return $context;
	}

	/**
	 * Adds custom functions to Twig.
	 *
	 * @param TwigEnvironment $twig The Twig Environment.
	 *
	 * @return TwigEnvironment The modified Twig Environment.
	 */
	#[Filter( 'timber/twig' )]
	public function extend_timber_functions( TwigEnvironment $twig ): TwigEnvironment {
		$twig->addFunction(
			new TwigFunction( 'enqueue_script', array( $this, 'enqueue_script' ) )
		);

		$twig->addFunction(
			new TwigFunction( 'get_static_asset', array( $this, 'get_static_asset' ) )
		);

		$twig->addFunction(
			new TwigFunction( 'get_image_srcset', array( $this, 'get_image_srcset' ) )
		);

		return $twig;
	}

	/**
	 * Enqueue block scripts.
	 *
	 * @param string $handle The script handle.
	 */
	public function enqueue_script( string $handle ): void {
		wp_enqueue_script( $handle );
	}

	/**
	 * Get static asset URL.
	 *
	 * @param string $rel_file_path The asset file path relative to the theme dir.
	 *
	 * @return string The asset URL.
	 */
	public function get_static_asset( string $rel_file_path ): string {
		return esc_url( get_stylesheet_directory_uri() ) . "/$rel_file_path";
	}

	/**
	 * Gets images source sets.
	 *
	 * @param array        $sizes The WordPress image sizes.
	 * @param array|string $allowed_sizes The image sizes to generate for this particular image.
	 *
	 * @return array The image source set.
	 */
	public function get_image_srcset( array $sizes, array|string $allowed_sizes = array( 'xs', 'sm', 'md', 'lg', 'xl' ) ): array {
		$srcset = array();

		$min_widths = array(
			'xl' => '1440px',
			'lg' => '1280px',
			'md' => '1024px',
			'sm' => '768px',
			'xs' => '',
		);

		foreach ( $min_widths as $image_size => $min_width ) {
			if ( isset( $sizes[ $image_size ] ) && in_array( $image_size, $allowed_sizes, true ) ) {
				$srcset[] = array(
					'srcset'    => $sizes[ $image_size ],
					'srcset@2x' => $sizes[ $image_size . '@2x' ],
					'srcset@3x' => $sizes[ $image_size . '@3x' ],
					'media'     => '(min-width: ' . $min_width . ')',
					'width'     => $sizes[ $image_size . '-width' ],
					'height'    => $sizes[ $image_size . '-height' ],
				);
			}
		}

		return $srcset;
	}
}
