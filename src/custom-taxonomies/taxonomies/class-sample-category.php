<?php
/**
 * Sample Category custom Taxonomy.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme\Custom_Taxonomies\Taxonomies;

use Somoscuatro\Starter_Theme\Custom_Taxonomies\Custom_Taxonomy;

/**
 * Sample Category custom Taxonomy.
 */
class Sample_Category extends Custom_Taxonomy {

	/**
	 * Taxonomy singular name.
	 *
	 * @var string
	 */
	protected string $singular_name = 'Sample Category';

	/**
	 * Taxonomy plural name.
	 *
	 * @var string
	 */
	protected string $plural_name = 'Sample Categories';

	/**
	 * Custom Post Types using this taxonomy.
	 *
	 * @var array
	 */
	protected array $post_types = array( 'sample' );
}
