<?php
/**
 * List of classes to be hooked.
 *
 * @package sc-starter-theme
 */

use Somoscuatro\Starter_Theme\Acf;
use Somoscuatro\Starter_Theme\Asset;
use Somoscuatro\Starter_Theme\Media;
use Somoscuatro\Starter_Theme\Navigation;
use Somoscuatro\Starter_Theme\Theme;
use Somoscuatro\Starter_Theme\Timber;
use Somoscuatro\Starter_Theme\Translation;

/**
 * List of classes with hooks
 */
return array(
	Theme::class,

	Acf::class,
	Asset::class,
	Media::class,
	Navigation::class,
	Timber::class,
	Translation::class,
);
