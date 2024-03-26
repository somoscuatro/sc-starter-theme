<?php
/**
 * WordPress custom navigation functionality.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;

/**
 * WordPress custom navigation functionality.
 */
class Navigation {

	/**
	 * Register navigation menus.
	 */
	#[Action( 'after_setup_theme' )]
	public function register_nav_menus() {
		register_nav_menu( 'site_header_primary', __( 'Site Header Primary', 'sc-starter-theme' ) );
		register_nav_menu( 'site_footer_primary', __( 'Site Footer Primary', 'sc-starter-theme' ) );
		register_nav_menu( 'site_footer_legals', __( 'Site Footer Legals', 'sc-starter-theme' ) );
	}
}
