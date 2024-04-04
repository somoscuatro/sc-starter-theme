<?php
/**
 * Dependency Injection Container.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme\Dependency_Injection;

/**
 * Dependency Injection Container.
 */
class Container implements Container_Interface {

	/**
	 * Dependencies.
	 *
	 * @var array
	 */
	private $dependencies = array();

	/**
	 * Adds a dependency.
	 *
	 * @param string   $key The dependency key.
	 * @param callable $factory The dependency instantiator.
	 */
	public function add( string $key, callable $factory ): void {
		$this->dependencies[ $key ] = $factory;
	}

	/**
	 * Retrieves a dependency.
	 *
	 * @param string $key The dependency key.
	 *
	 * @return object The dependency instance.
	 *
	 * @throws \Exception If the dependency does not exist.
	 */
	public function get( string $key ): object {
		if ( ! $this->has( $key ) ) {
			throw new \Exception( esc_html( sprintf( 'Dependency "%s" not found.', $key ) ) );
		}

		$factory = $this->dependencies[ $key ];

		return $factory( $this );
	}

	/**
	 * Checks if a dependency exists.
	 *
	 * @param string $key The dependency key.
	 *
	 * @return bool
	 */
	public function has( $key ): bool {
		return isset( $this->dependencies[ $key ] );
	}
}
