<?php
/**
 * Contains Somoscuatro\Starter_Theme\Attributes\Hook Class.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme\Attributes;

/**
 * WordPress Hooks Management Class.
 */
class Hook {

	/**
	 * Class Constructor.
	 *
	 * @param string  $hook_name The Hook Name.
	 * @param integer $priority The Hook Priority.
	 * @param integer $accepted_args The Number of Arguments Accepted.
	 */
	public function __construct(
		public string $hook_name,
		public int $priority = 10,
		public int $accepted_args = 1,
	) { }

	/**
	 * Register the Filter Handler.
	 *
	 * @param callable|array $method The Filter Handler.
	 */
	public function register( callable|array $method ): void {}
}
