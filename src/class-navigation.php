<?php

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;

class Navigation {

	#[Action( 'after_setup_theme' )]
	public function register_nav_menus() {
		register_nav_menu( 'site_header_primary', __( 'Site Header Primary', 'sc-starter-theme' ) );
		register_nav_menu( 'site_footer_primary', __( 'Site Footer Primary', 'sc-starter-theme' ) );
		register_nav_menu( 'site_footer_legals', __( 'Site Footer Legals', 'sc-starter-theme' ) );
	}
}
