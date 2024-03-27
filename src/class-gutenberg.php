<?php
/**
 * Gutenberg customization.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;
use Somoscuatro\Starter_Theme\Attributes\Filter;

use WP_Block_Editor_Context;

/**
 * Gutenberg customization.
 */
class Gutenberg {

	/**
	 * Registers Gutenberg custom category.
	 *
	 * @param array[]                 $block_categories     Array of categories for block types.
	 * @param WP_Block_Editor_Context $block_editor_context The current block editor context.
	 */
	#[Filter( 'block_categories_all', accepted_args: 2 )]
	public static function add_custom_block_category( array $block_categories, WP_Block_Editor_Context $block_editor_context ): array {
		if ( ! ( $block_editor_context instanceof WP_Block_Editor_Context ) ) {
			return $block_categories;
		}

		return array_merge(
			$block_categories,
			array(
				array(
					'slug'  => 'somoscuatro',
					'title' => esc_html__( 'Somoscuatro Custom Blocks', 'sc-starter-theme' ),
				),
			)
		);
	}

	/**
	 * Removes unwanted default WordPress Gutenberg block types.
	 *
	 * @return array The modified allowed block types.
	 */
	#[Filter( 'allowed_block_types_all', accepted_args: 0 )]
	public static function allowed_block_types(): array {
		$block_types = \WP_Block_Type_Registry::get_instance()->get_all_registered();

		// To disable the default WordPress Gutenberg blocks, include their names in
		// the array below.
		$blocks_to_remove = array(
			// phpcs:ignore Squiz.PHP.CommentedOutCode.Found
			// 'core/archives' => null,
		);

		return array_keys( array_diff_key( $block_types, $blocks_to_remove ) );
	}

	/**
	 * Removes default Gutenberg blocks assets.
	 *
	 * Because we are using Tailwind CSS to style blocks (including default
	 * WordPress blocks), we need to remove the default WordPress assets for
	 * blocks.
	 */
	#[Action( 'wp_enqueue_scripts' )]
	public static function remove_default_blocks_assets(): void {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_script( 'wp-block-library' );
	}
}
