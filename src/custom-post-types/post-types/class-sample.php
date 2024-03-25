<?php
/**
 * Sample Custom Post Type functionality.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme\Custom_Post_Types\Post_Types;

use Somoscuatro\Starter_Theme\Custom_Post_Types\Custom_Post_Type;

/**
 * Sample Custom Post Type functionality.
 */
class Sample extends Custom_Post_Type {

	/**
	 * Custom Post Type singular name.
	 *
	 * @var string
	 */
	protected string $singular_name = 'Sample';

	/**
	 * Custom Post Type plural name.
	 *
	 * @var string
	 */
	protected string $plural_name = 'Samples';

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$args = array(
			// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
			'menu_icon'    => 'data:image/svg+xml;base64,' . base64_encode(
				'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"> <path fill-rule="evenodd" d="M10.5 3.798v5.02a3 3 0 0 1-.879 2.121l-2.377 2.377a9.845 9.845 0 0 1 5.091 1.013 8.315 8.315 0 0 0 5.713.636l.285-.071-3.954-3.955a3 3 0 0 1-.879-2.121v-5.02a23.614 23.614 0 0 0-3 0Zm4.5.138a.75.75 0 0 0 .093-1.495A24.837 24.837 0 0 0 12 2.25a25.048 25.048 0 0 0-3.093.191A.75.75 0 0 0 9 3.936v4.882a1.5 1.5 0 0 1-.44 1.06l-6.293 6.294c-1.62 1.621-.903 4.475 1.471 4.88 2.686.46 5.447.698 8.262.698 2.816 0 5.576-.239 8.262-.697 2.373-.406 3.092-3.26 1.47-4.881L15.44 9.879A1.5 1.5 0 0 1 15 8.818V3.936Z" clip-rule="evenodd" /> </svg>'
			),
			'has_archive'  => false,
			'supports'     => array( 'title', 'editor', 'revisions' ),
			'show_in_rest' => true,
		);

		$this->args = wp_parse_args( $this->args, $args );
	}
}