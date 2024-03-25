<?php
/**
 * Theme's main functionality methods.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme;

use Somoscuatro\Starter_Theme\Attributes\Action;

use Somoscuatro\Starter_Theme\Blocks\Loader as BlocksLoader;
use Somoscuatro\Starter_Theme\Custom_Post_Types\Loader as CustomPostTypeLoader;
use Somoscuatro\Starter_Theme\Custom_Taxonomies\Loader as CustomTaxonomyLoader;

/**
 * Main theme class.
 */
class Theme {

	/**
	 * Theme naming prefix.
	 *
	 * @var string
	 */
	const PREFIX = 'starter_theme';

	/**
	 * Initialisation method.
	 */
	#[Action( 'init' )]
	public function init(): void {
		( new BlocksLoader( self::PREFIX ) )->load();
		( new CustomPostTypeLoader( self::PREFIX ) )->load();
		( new CustomTaxonomyLoader( self::PREFIX ) )->load();
	}

	/**
	 */
	}
}
