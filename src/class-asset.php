<?php
/**
 * Assets management class.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;

/**
 * Assets management class.
 */
class Asset {

	/**
	 * Enqueues editor theme styles and scripts.
	 */
	#[Action( 'admin_enqueue_scripts' )]
	public function enqueue_admin_assets() {}

}
