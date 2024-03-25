<?php
/**
 * Theme's main functionality methods.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;
use Somoscuatro\Starter_Theme\Attributes\Filter;

use Somoscuatro\Starter_Theme\Blocks\Loader as BlocksLoader;
use Somoscuatro\Starter_Theme\Custom_Post_Types\Loader as CustomPostTypeLoader;
use Somoscuatro\Starter_Theme\Custom_Taxonomies\Loader as CustomTaxonomyLoader;

/**
 * Main theme class.
 */
class Theme {

	/**
	 * Theme naming prefix.
	 *
	 * @var string
	 */
	const PREFIX = 'starter_theme';

	/**
	 * Initialisation method.
	 */
	#[Action( 'init' )]
	public function init(): void {
		( new BlocksLoader( self::PREFIX ) )->load();
		( new CustomPostTypeLoader( self::PREFIX ) )->load();
		( new CustomTaxonomyLoader( self::PREFIX ) )->load();
	}

	/**
	 * Registers theme support for additional features.
	 */
	#[Action( 'after_setup_theme' )]
	public function theme_support(): void {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
	}

	/**
	 * Adds page slug to body classes.
	 *
	 * @param array $classes The body classes.
	 *
	 * @return array The modified body classes.
	 */
	#[Filter( 'body_class' )]
	public static function body_class( array $classes ): array {
		if ( is_single() || ( is_page() && ! is_front_page() ) ) {
			if ( ! in_array( basename( get_permalink() ), $classes, true ) ) {
				$classes[] = basename( get_permalink() );
			}
		}
		if ( is_page() && has_post_parent() ) {
			global $post;
			if ( ! in_array( basename( get_permalink( $post->post_parent ) ), $classes, true ) ) {
				$classes[] = basename( get_permalink( $post->post_parent ) );
			}
		}
		if ( is_404() ) {
			$classes[] = '404';
		}

		return $classes;
	}
}
