<?php
/**
 * Theme's main functionality methods.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;
use Somoscuatro\Starter_Theme\Helpers\Filesystem;
use Somoscuatro\Starter_Theme\Blocks\Loader as BlocksLoader;

/**
 * Main theme class.
 */
class Theme {

	use Filesystem;

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

	/**
	 * Enqueues frontend theme styles and scripts.
	 */
	#[Action( 'wp_enqueue_scripts' )]
	public function enqueue_assets(): void {
		// Theme styles.
		wp_enqueue_style( self::PREFIX, $this->get_base_url() . '/dist/styles/main.css', array(), $this->get_filemtime( 'styles/main.css' ) );
	}
}
