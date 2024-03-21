<?php
/**
 * Theme's main functionality methods.
 *
 * @package somoscuatro-theme
 */

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Hook;

/**
 * Main theme class.
 */
class Theme {

	/**
	 * Initialisation method.
	 */
	public function init(): void {
		( new Hook() )->register_hooks();
	}
}
