<?php
/**
 * Theme's main functionality methods.
 *
 * @package somoscuatro-theme
 */

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Hook;
use Somoscuatro\Starter_Theme\Blocks\Loader as BlocksLoader;

/**
 * Main theme class.
 */
class Theme {

	/**
	 * Theme naming prefix.
	 *
	 * @var string
	 */
	const PREFIX = 'starter_theme';

	/**
	 * Initialisation method.
	 */
	public function init(): void {
		( new Hook() )->register_hooks();
		( new BlocksLoader() )->load();
	}
}
