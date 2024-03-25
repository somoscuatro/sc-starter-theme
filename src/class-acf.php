<?php
/**
 * ACF custom functionality.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;
use Somoscuatro\Starter_Theme\Helpers\Filesystem;

/**
 * ACF custom functionality.
 */
class ACF {

	use Filesystem;

	/**
	 * The ACF color palette.
	 *
	 * @var array
	 */
	private $acf_color_palette = array();

	/**
	 * The allowed colors palette for ACF Block background.
	 *
	 * @var array
	 */
	private $acf_bg_color_palette = array();

	/**
	 * ACF custom functionality.
	 */
	#[Action( 'init' )]
	public function setup_color_palette(): void {
		$this->acf_color_palette    = $this->get_color_palette();
		$this->acf_bg_color_palette = $this->get_bg_safe_color_palette( $this->acf_color_palette, $this->get_safe_bg_colors_names() );
	}

	/**
	 * Gets color palette from a JSON file.
	 *
	 * @return array The color palette file content.
	 */
	private function get_color_palette(): array {
		if ( ! file_exists( $this->get_base_path() . '/tailwind.colors.json' ) ) {
			return array();
		}

		$tailwind_colors = wp_json_file_decode(
			$this->get_base_path() . '/tailwind.colors.json',
			array( 'associative' => true )
		);

		$colors_palette = array();
		foreach ( $tailwind_colors as $color_name => $color_shades ) {
			foreach ( $color_shades as $color_shade => $hex ) {
				$colors_palette[ $color_name . '-' . $color_shade ] = $hex;
			}
		}

		return $colors_palette;
	}

	/**
	 * Gets the safe background colors name from Tailwind config JSON file.
	 *
	 * @return array The safe background colors name.
	 */
	private function get_safe_bg_colors_names(): array {
		if ( ! file_exists( $this->get_base_path() . '/tailwind.bg-colors-safelist.json' ) ) {
			return array();
		}

		$safe_bg_colors = wp_json_file_decode(
			$this->get_base_path() . '/tailwind.bg-colors-safelist.json',
			array( 'associative' => true )
		);

		if ( ! isset( $safe_bg_colors['colors'] ) ) {
			return array();
		}

		return $safe_bg_colors['colors'];
	}

	/**
	 * Reduces a given color palette to the background safe colors.
	 *
	 * @param array $color_palette The Tailwind color palette.
	 * @param array $safe_bg_colors The safe background colors name.
	 *
	 * @return array The background safe color palette.
	 */
	private function get_bg_safe_color_palette( array $color_palette, array $safe_bg_colors ): array {
		return array_filter(
			$color_palette,
			function ( $color ) use ( $safe_bg_colors ) {
				return in_array( 'bg-' . $color, $safe_bg_colors, true );
			},
			ARRAY_FILTER_USE_KEY
		);
	}

	/**
	 * Restricts the ACF color picker palette.
	 */
	#[Action( 'acf/input/admin_footer' )]
	public function restrict_color_picker_palette(): void {
		$palette = implode( "','", array_values( $this->acf_bg_color_palette ) );
		?>
		<script type="text/javascript">
			(function() {
				acf.add_filter('color_picker_args', function( args, $field ){
					args.palettes = ['<?php echo $palette; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>']
					return args;
				});
			})(jQuery);
			</script>
		<?php
	}
}
