<?php
/**
 * WordPress Action management class.
 *
 * @package starter-theme
 */

namespace Somoscuatro\Starter_Theme\Attributes;

use Attribute;

/**
 * WordPress Actions management class.
 */
#[Attribute( Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE )]
class Action extends Filter {

	/**
	 * Register the Action handler.
	 *
	 * @param callable|array $method The Action handler.
	 */
	public function register( callable|array $method ): void {
		add_action(
			$this->hook_name,
			$method,
			$this->priority,
			$this->accepted_args
		);
	}
}
