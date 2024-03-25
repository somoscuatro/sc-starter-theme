<?php
/**
 * WordPress Theme Customizer functionality.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;

/**
 * WordPress Theme Customizer functionality.
 */
class Customizer {

	/**
	 * Adds Google Tag Manager controls to the customizer.
	 *
	 * @param \WP_Customize_Manager $wp_customize WP_Customize_Manager instance.
	 */
	#[Action( 'customize_register' )]
	public function add_customizer_gtm_controls( \WP_Customize_Manager $wp_customize ) {
		// Section.
		$wp_customize->add_section(
			'gtm',
			array(
				'title'      => __( 'Google Tag Manager', 'sc-starter-theme' ),
				'priority'   => 35,
				'capability' => 'edit_theme_options',
			)
		);
		$wp_customize->add_setting(
			'gtm_id',
			array(
				'default'    => '',
				'type'       => 'theme_mod',
				'capability' => 'edit_theme_options',
			)
		);
		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				'gtm_id',
				array(
					'label'    => __( 'GTM ID', 'somoscuatro-theme' ),
					'section'  => 'gtm',
					'settings' => 'gtm_id',
					'type'     => 'text',
				),
			),
		);
	}
}
