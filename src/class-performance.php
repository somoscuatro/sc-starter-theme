<?php
/**
 * Performance enhancements.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;
use Somoscuatro\Starter_Theme\Attributes\Filter;

/**
 * Performance enhancements.
 */
class Performance {

	/**
	 * Disables WordPress emojis.
	 */
	#[Action( 'init' )]
	public function disable_wp_emojis(): void {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	}


	/**
	 * Cleanups WordPress default assets.
	 */
	#[Action( 'wp_enqueue_scripts' )]
	public function cleanup_wp_default_assets(): void {
		remove_action( 'wp_footer', 'wp_enqueue_stored_styles', 1 );
		wp_dequeue_style( 'classic-theme-styles' );
		wp_dequeue_style( 'classic-theme-styles-inline' );
		wp_dequeue_style( 'global-styles' );
		wp_dequeue_style( 'global-styles-inline' );
		wp_dequeue_style( 'core-block' );
	}

	/**
	 * Adds support for preloading stylesheets.
	 *
	 * @param string $tag    The link tag for the enqueued style.
	 * @param string $handle The style's registered handle.
	 *
	 * @return string The updated link tag.
	 */
	#[Filter( 'style_loader_tag', accepted_args: 2 )]
	public function preload_stylesheets( string $tag, string $handle ): string {
		if ( str_contains( $handle, 'preload' ) ) {
			$tag = str_replace( "rel='stylesheet'", 'rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\'"', $tag );
		}

		return $tag;
	}
}
