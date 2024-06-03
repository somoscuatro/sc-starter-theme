<?php
/**
 * Contains Somoscuatro\Starter_Theme\Attributes\Filter Class.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme\Attributes;

use Attribute;

/**
 * WordPress Filters Management Class.
 */
#[Attribute( Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE )]
class Filter extends Hook {

	/**
	 * Register the Filter Handler.
	 *
	 * @param callable|array $method The Filter Handler.
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
