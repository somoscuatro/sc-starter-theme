<?php
/**
 * Class for ACF Gutenberg Blocks.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme\Blocks;

use Somoscuatro\Starter_Theme\Dependency_Injection\Container_Interface as Dependencies;

/**
 * Class for ACF Gutenberg Blocks.
 */
class Block {

	/**
	 * Dependencies container.
	 *
	 * @var Dependencies
	 */
	protected static $dependencies;

	/**
	 * The Timber context.
	 *
	 * @var array
	 */
	protected $context = array();

	/**
	 * The prefix used for ACF Blocks.
	 *
	 * @var string
	 */
	public static $acf_block_prefix = '';

	/**
	 * Class constructor.
	 *
	 * We set the constructor as final to prevent be overridden by child classes.
	 * This is necessary to ensure safe usage of new static().
	 *
	 * @see https://phpstan.org/blog/solving-phpstan-error-unsafe-usage-of-new-static
	 *
	 * @param Dependencies $dependencies Dependencies container.
	 */
	final public function __construct( Dependencies $dependencies ) {
		static::$dependencies = $dependencies;
	}

	/**
	 * Registers activation hook callback.
	 *
	 * The Timber context is not yet fully ready when the class is instantiated
	 * via the hooks loader with PHP Attributes.
	 *
	 * The hooks loader instantiates each class having hooks when looking for PHP
	 * Action and Filter Attributes. This happens very early in the WordPress
	 * loading process, before the Timber context is fully initialized.
	 *
	 * By the time the constructor is called, the Timber context is not yet fully
	 * ready, so we CANNOT set the Timber context in the constructor.
	 *
	 * @see Somoscuatro\Theme\Attributes\Hook::register_hooks()
	 */
	public function init() {
		$timber = static::$dependencies->get( 'Timber' );

		$this->context = $timber->context();
		$this->register_acf_block();
		$this->register_assets();
	}

	/**
	 * Dummy method to get ACF Block fields.
	 *
	 * This method needs to be overridden by each Gutenberg block class.
	 */
	public function get_acf_fields(): array {
		return array();
	}

	/**
	 * Registers the ACF Block.
	 */
	public function register_acf_block(): void {
		register_block_type( __DIR__ . '/' . str_replace( '_', '-', str_replace( 'block_', '', static::$acf_block_prefix ) ) );

		if ( function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group( $this->get_acf_fields() );
		}
	}

	/**
	 * Registers block assets.
	 */
	public function register_assets(): void {}

	/**
	 * Block render callback proxy.
	 *
	 * In the block.json file for ACF, the renderCallback parameter has to be a
	 * string that points to a callback. So, we need a static proxy method to take
	 * care of block rendering. To get the right block name when we're rendering,
	 * we've got to create the block class using new static(). new self() won't do
	 * the trick because the block name we get won't come from the blocks
	 * extending this class.
	 *
	 * @param array   $block The Gutenberg block.
	 * @param string  $content The content of the block.
	 * @param boolean $is_preview True if in preview mode.
	 */
	public static function render_callback( array $block, string $content = '', $is_preview = false ) {
		( new static( static::$dependencies ) )->render( $block, $content, $is_preview );
	}

	/**
	 * Renders block Twig template.
	 *
	 * @param array   $block The Gutenberg block.
	 * @param string  $content The content of the block.
	 * @param boolean $is_preview True if in preview mode.
	 */
	public function render( array $block, string $content = '', $is_preview = false ) {
		$this->context = $this->set_context( $this->context, $block, $is_preview );

		$block_dirname       = strtolower( explode( '\\', $block['render_callback'] )[3] );
		$block_template_path = __DIR__ . '/' . str_replace( '_', '-', $block_dirname ) . '/template.twig';

		$timber = static::$dependencies->get( 'Timber' );
		$timber->render( $block_template_path, $this->context );
	}

	/**
	 * Sets block context.
	 *
	 * @param array   $context The Timber context.
	 * @param array   $block The Gutenberg block.
	 * @param boolean $is_preview True if in preview mode.
	 *
	 * @return array The modified Timber context.
	 */
	public function set_context( array $context, array $block, bool $is_preview ): array {
		unset( $block['data'] );
		$context['block'] = $block;

		$fields = get_fields();

		if ( $fields ) {
			$context = $this->add_acf_fields_to_context( static::$acf_block_prefix, $context, $fields );
		}

		$context['is_preview'] = $is_preview;

		$theme = static::$dependencies->get( 'Theme' );

		return apply_filters( $theme->get_prefix() . '_block_context', $context, $block ) ?? $context;
	}

	/**
	 * Adds ACF fields to Timber context.
	 *
	 * @param string $block_prefix The ACF block prefix.
	 * @param array  $context The Timber context.
	 * @param array  $fields The ACF fields.
	 *
	 * @return array The Timber context with ACF fields.
	 */
	public function add_acf_fields_to_context( string $block_prefix, array $context, array $fields ): array {
		$unprefixed_acf_fields = json_decode( str_replace( $block_prefix . '_', '', wp_json_encode( $fields ) ), true );

		return array_merge( $context, $unprefixed_acf_fields );
	}
}
