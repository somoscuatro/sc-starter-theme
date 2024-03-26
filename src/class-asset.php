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
		// Custom fonts.
		wp_enqueue_style( Theme::PREFIX . '-fonts-preload', $this->get_base_url() . '/dist/styles/fonts.css', false, $this->get_filemtime( 'styles/fonts.css' ) );

		// Theme styles.
		wp_enqueue_style( Theme::PREFIX, $this->get_base_url() . '/dist/styles/main.css', array( Theme::PREFIX . '-fonts-preload' ), $this->get_filemtime( 'styles/main.css' ) );
	}

	/**
	 * Enqueues editor theme styles and scripts.
	 */
	#[Action( 'admin_enqueue_scripts' )]
	public function enqueue_admin_assets() {}

	/**
	 * Enqueues wp-login theme styles and scripts.
	 */
	#[Action( 'login_enqueue_scripts' )]
	public function enqueue_login_assets() {}
}
