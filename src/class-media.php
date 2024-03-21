<?php
/**
 * Media management class.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme;

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
}
