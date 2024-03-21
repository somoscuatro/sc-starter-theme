<?php
/**
 * Translations management class.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;
use Somoscuatro\Starter_Theme\Helpers\Filesystem;

/**
 * Translations management class.
 */
class Translation {

	use Filesystem;

	/**
	 * Loads the theme translation domain.
	 */
	#[Action( 'after_setup_theme' )]
	public function load_text_domain(): void {
		load_theme_textdomain( 'sc-starter-theme', $this->get_base_path() . '/languages' );
	}
}
