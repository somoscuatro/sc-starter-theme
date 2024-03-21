<?php
/**
 * WordPress Filters management class.
 *
 * @package starter-theme
 */

namespace Somoscuatro\Starter_Theme\Attributes;

use Attribute;

/**
 * WordPress Filters management class.
 */
#[Attribute( Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE )]
class Filter {

	/**
	 * Class constructor.
	 *
	 * @param string  $hook_name The hook name.
	 * @param integer $priority The hook priority.
	 * @param integer $accepted_args The number of arguments accepted.
	 */
	public function __construct(
		public string $hook_name,
		public int $priority = 10,
		public int $accepted_args = 1,
	) { }

	/**
	 * Register the Filter handler.
	 *
	 * @param callable|array $method The Filter handler.
	 */
	public function register( callable|array $method ): void {
		add_filter(
			$this->hook_name,
			$method,
			$this->priority,
			$this->accepted_args
		);
	}
}
