<?php
/**
 * Hooks management class.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme\Attributes;

use ReflectionAttribute;
use ReflectionClass;

/**
 * Hooks management class.
 */
class Hook {

	/**
	 * The names of the classes that contain hooks handlers.
	 *
	 * @var array
	 */
	private array $hooked_classes = array();

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->hooked_classes = require __DIR__ . '/hooked-classes.php';
	}

	/**
	 * Registers hooks.
	 */
	public function register_hooks(): void {
		$instances = array();

		foreach ( $this->hooked_classes as $class_name ) {
			$reflection_class = new ReflectionClass( $class_name );

			foreach ( $reflection_class->getMethods() as $method ) {
				$attributes = $method->getAttributes( Filter::class, ReflectionAttribute::IS_INSTANCEOF );

				foreach ( $attributes as $attribute ) {
					// Maybe instantiate class.
					if ( ! array_key_exists( $class_name, $instances ) ) {
						$instances[ $class_name ] = new $class_name();
					}

					// Instantiate hooks.
					$hook_class = $attribute->newInstance();
					$hook_class->register(
						array(
							$instances[ $class_name ],
							$method->getName(),
						)
					);
				}
			}
		}
	}
}
