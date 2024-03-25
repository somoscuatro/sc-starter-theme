<?php
/**
 * Media management class.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;
use Somoscuatro\Starter_Theme\Attributes\Filter;

/**
 * Media management class.
 */
class Media {

	/**
	 * Allows SVG images in media uploader.
	 *
	 * @param array $mimes The supported mime types.
	 *
	 * @return array The modified mime types.
	 */
	#[Filter( 'upload_mimes' )]
	public function add_svg_support( array $mimes ): array {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	/**
	 * Disables WordPress default image sizes.
	 *
	 * @param array $sizes The WordPress image sizes.
	 *
	 * @return array The modified sizes.
	 */
	#[Filter( 'intermediate_image_sizes' )]
	public function disable_wp_default_image_sizes( array $sizes ): array {
		$targets = array( 'thumbnail', 'medium', 'medium_large', 'large', '1536x1536', '2048x2048' );

		foreach ( $sizes as $size_index => $size ) {
			if ( in_array( $size, $targets, true ) ) {
				unset( $sizes[ $size_index ] );
			}
		}

		return $sizes;
	}

	/**
	 * Registers custom images sizes.
	 */
	#[Action( 'init' )]
	public function register_image_sizes(): void {
		add_image_size( 'xs', 60 );
		add_image_size( 'xs@2x', 120 );
		add_image_size( 'xs@3x', 180 );

		add_image_size( 'sm', 240 );
		add_image_size( 'sm@2x', 480 );
		add_image_size( 'sm@3x', 720 );

		add_image_size( 'md', 420 );
		add_image_size( 'md@2x', 840 );
		add_image_size( 'md@3x', 1260 );

		add_image_size( 'lg', 680 );
		add_image_size( 'lg@2x', 1360 );
		add_image_size( 'lg@3x', 2040 );

		add_image_size( 'xl', 1024 );
		add_image_size( 'xl@2x', 2048 );
		add_image_size( 'xl@3x', 3072 );
	}

}
