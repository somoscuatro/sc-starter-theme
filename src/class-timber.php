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
			new TwigFunction( 'enqueue_script', __CLASS__ . '::enqueue_script' )
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
	public static function enqueue_script( string $handle ): void {
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

		if ( isset( $sizes['xl'] ) && in_array( 'xl', $allowed_sizes, true ) ) {
			$srcset[] = array(
				'srcset'    => $sizes['xl'],
				'srcset@2x' => $sizes['xl@2x'],
				'srcset@3x' => $sizes['xl@3x'],
				'media'     => '(min-width: 1440px)',
				'width'     => $sizes['xl-width'],
				'height'    => $sizes['xl-height'],
			);
		}

		if ( isset( $sizes['lg'] ) && in_array( 'lg', $allowed_sizes, true ) ) {
			$srcset[] = array(
				'srcset'    => $sizes['lg'],
				'srcset@2x' => $sizes['lg@2x'],
				'srcset@3x' => $sizes['lg@3x'],
				'media'     => '(min-width: 1280px)',
				'width'     => $sizes['lg-width'],
				'height'    => $sizes['lg-height'],
			);
		}

		if ( isset( $sizes['md'] ) && in_array( 'md', $allowed_sizes, true ) ) {
			$srcset[] = array(
				'srcset'    => $sizes['md'],
				'srcset@2x' => $sizes['md@2x'],
				'srcset@3x' => $sizes['md@3x'],
				'media'     => '(min-width: 1024px)',
				'width'     => $sizes['md-width'],
				'height'    => $sizes['md-height'],
			);
		}

		if ( isset( $sizes['sm'] ) && in_array( 'sm', $allowed_sizes, true ) ) {
			$srcset[] = array(
				'srcset'    => $sizes['sm'],
				'srcset@2x' => $sizes['sm@2x'],
				'srcset@3x' => $sizes['sm@3x'],
				'media'     => '(min-width: 768px)',
				'width'     => $sizes['sm-width'],
				'height'    => $sizes['sm-height'],
			);
		}

		if ( isset( $sizes['xs'] ) && in_array( 'xs', $allowed_sizes, true ) ) {
			$srcset[] = array(
				'srcset'    => $sizes['xs'],
				'srcset@2x' => $sizes['xs@2x'],
				'srcset@3x' => $sizes['xs@3x'],
				'media'     => '',
				'width'     => $sizes['xs-width'],
				'height'    => $sizes['xs-height'],
			);
		}

		return $srcset;
	}
}
