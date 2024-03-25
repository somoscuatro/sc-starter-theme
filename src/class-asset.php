<?php
/**
 * Assets management class.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;

use Somoscuatro\Starter_Theme\Helpers\Filesystem;

/**
 * Assets management class.
 */
class Asset {

	use Filesystem;

	/**
	 * Enqueues frontend theme styles and scripts.
	 */
	#[Action( 'wp_enqueue_scripts' )]
	public function enqueue_assets(): void {
		// Theme styles.
		wp_enqueue_style( Theme::PREFIX, $this->get_base_url() . '/dist/styles/main.css', array(), $this->get_filemtime( 'styles/main.css' ) );
	}

	/**
	 * Enqueues editor theme styles and scripts.
	 */
	#[Action( 'admin_enqueue_scripts' )]
	public function enqueue_admin_assets() {}

}
