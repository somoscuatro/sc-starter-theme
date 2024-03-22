<?php
/**
 * Theme's main functionality methods.
 *
 * @package somoscuatro-theme
 */

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;
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
	#[Action( 'init' )]
	public function init(): void {
		( new BlocksLoader() )->load();
	}
}
