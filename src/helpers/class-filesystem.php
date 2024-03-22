<?php
/**
 * Filesystem helpers class.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme\Helpers;

/**
 * Filesystem helpers class.
 */
trait Filesystem {

	/**
	 * Base for asset URLs.
	 *
	 * @var string
	 */
	protected static string $base_url = '';

	/**
	 * Returns the base URL of this theme.
	 *
	 * @return string Return theme URI.
	 */
	protected function get_base_url(): string {
		if ( ! self::$base_url ) {
			self::$base_url = get_stylesheet_directory_uri();
		}
		return self::$base_url;
	}

	/**
	 * The absolute filesystem base path of this theme.
	 *
	 * @return string Return base path URI.
	 */
	protected function get_base_path(): string {
		return dirname( __DIR__, 2 );
	}
}
