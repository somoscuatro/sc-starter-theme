<?php
/**
 * Block's main functionality methods.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme\Blocks\Sample;

use Somoscuatro\Starter_Theme\Blocks\Block;

/**
 * Block main functionality.
 */
class Sample extends Block {

	/**
	 * The prefix used for ACF Blocks.
	 *
	 * @var string
	 */
	public static $acf_block_prefix = 'block_sample';

	/**
	 * Gets the ACF Block fields.
	 *
	 * @return array The ACF Block fields.
	 */
	public function get_acf_fields(): array {
		return array(
			'key'      => 'group_' . static::$acf_block_prefix,
			'title'    => __( 'Block: Sample', 'sc-starter-theme' ),
			'fields'   => array(
				array(
					'key'           => 'field_' . static::$acf_block_prefix . '_text',
					'label'         => __( 'Sample Text', 'somoscuatro-theme' ),
					'name'          => static::$acf_block_prefix . '_text',
					'type'          => 'text',
					'required'      => 1,
					'return_format' => 'string',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/sample',
					),
				),
			),
		);
	}
}
