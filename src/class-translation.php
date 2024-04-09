<?php
/**
 * Contains Somoscuatro\Starter_Theme\Translation Class.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;
use Somoscuatro\Starter_Theme\Helpers\Filesystem;

/**
 * Translations Management Class.
 */
class Translation {

	use Filesystem;

	/**
	 * Loads the Theme Translation Domain.
	 */
	#[Action( 'after_setup_theme' )]
	public function load_text_domain(): void {
		load_theme_textdomain( 'sc-starter-theme', $this->get_base_path() . '/languages' );
	}
}
