<?php
/**
 * Assets management class.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;
use Somoscuatro\Starter_Theme\Dependency_Injection\Container_Interface as Dependencies;

use Somoscuatro\Starter_Theme\Helpers\Filesystem;

/**
 * Assets management class.
 */
class Asset {

	use Filesystem;

	/**
	 * Dependencies container.
	 *
	 * @var Dependencies
	 */
	protected $dependencies;

	/**
	 * Class constructor.
	 *
	 * @param Dependencies $dependencies Dependencies container.
	 */
	public function __construct( Dependencies $dependencies ) {
		$this->dependencies = $dependencies;
	}

	/**
	 * Enqueues frontend theme styles and scripts.
	 */
	#[Action( 'wp_enqueue_scripts' )]
	public function enqueue_assets(): void {
		$theme        = $this->dependencies->get( 'Theme' );
		$theme_prefix = $theme->get_prefix();

		// Custom fonts.
		wp_enqueue_style( $theme_prefix . '-fonts-preload', $this->get_base_url() . '/dist/styles/fonts.css', false, $this->get_filemtime( 'styles/fonts.css' ) );

		// Theme styles.
		wp_enqueue_style( $theme_prefix . '-main-styles', $this->get_base_url() . '/dist/styles/main.css', array( $theme_prefix . '-fonts-preload' ), $this->get_filemtime( 'styles/main.css' ) );
	}

	/**
	 * Enqueues editor theme styles and scripts.
	 */
	#[Action( 'admin_enqueue_scripts' )]
	public function enqueue_admin_assets() {
	}

	/**
	 * Enqueues wp-login theme styles and scripts.
	 */
	#[Action( 'login_enqueue_scripts' )]
	public function enqueue_login_assets() {
	}
}
