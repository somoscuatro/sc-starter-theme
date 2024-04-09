<?php
/**
 * Contains Somoscuatro\Starter_Theme\Asset Class.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;
use Somoscuatro\Starter_Theme\Helpers\Filesystem;

/**
 * Assets Management Class.
 */
class Asset {

	use Filesystem;

	/**
	 * The Theme Class.
	 *
	 * @var Theme
	 */
	protected $theme;

	/**
	 * Class Constructor.
	 *
	 * @param Theme $theme The Theme Class.
	 */
	public function __construct( Theme $theme ) {
		$this->theme = $theme;
	}

	/**
	 * Enqueues Frontend Theme Styles and Scripts.
	 */
	#[Action( 'wp_enqueue_scripts' )]
	public function enqueue_assets(): void {
		$theme_prefix = $this->theme->get_prefix();

		// Custom Fonts.
		wp_enqueue_style( $theme_prefix . '-fonts-preload', $this->get_base_url() . '/dist/styles/fonts.css', false, $this->get_filemtime( 'styles/fonts.css' ) );

		// Theme Styles.
		wp_enqueue_style( $theme_prefix . '-main-styles', $this->get_base_url() . '/dist/styles/main.css', array( $theme_prefix . '-fonts-preload' ), $this->get_filemtime( 'styles/main.css' ) );
	}

	/**
	 * Enqueues Editor Theme Styles and Scripts.
	 */
	#[Action( 'admin_enqueue_scripts' )]
	public function enqueue_admin_assets() {
	}

	/**
	 * Enqueues wp-login Theme Styles and Scripts.
	 */
	#[Action( 'login_enqueue_scripts' )]
	public function enqueue_login_assets() {
	}
}
