<?php
/**
 * Hooks management class.
 *
 * @package sc-starter-theme
 */

namespace Somoscuatro\Starter_Theme\Attributes;

use ReflectionAttribute;
use ReflectionClass;

use Somoscuatro\Starter_Theme\Dependency_Injection\Container_Interface as Dependencies;

/**
 * Hooks management class.
 */
class Hook {

	/**
	 * Dependencies container.
	 *
	 * @var Dependencies
	 */
	private $dependencies;

	/**
	 * The names of the classes that contain hooks handlers.
	 *
	 * @var array
	 */
	private array $hooked_classes = array();

	/**
	 * Class constructor.
	 *
	 * @param Dependencies $dependencies DI container.
	 */
	public function __construct( Dependencies $dependencies ) {
		$this->dependencies   = $dependencies;
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
						$instances[ $class_name ] = new $class_name( $this->dependencies );
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
