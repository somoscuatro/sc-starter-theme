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

	/**
	 * Returns file last modified time.
	 *
	 * @param string $file_path The file path relative to dist folder.
	 *
	 * @return int File last modified time.
	 */
	protected function get_filemtime( string $file_path = '' ): int {
		$version = $file_path
			? filemtime( $this->get_base_path() . '/dist/' . trim( $file_path, '/' ) )
			: filemtime( $this->get_base_path() . '/dist/' );

		return (int) $version;
	}
}
