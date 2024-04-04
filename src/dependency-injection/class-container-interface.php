<?php
/**
 * Dependency Injection Container interface.
 *
 * @package sc-starter-theme
 */

declare(strict_types=1);

namespace Somoscuatro\Starter_Theme\Dependency_Injection;

/**
 * Dependency Injection Container interface.
 */
interface Container_Interface {

	/**
	 * Adds a dependency.
	 *
	 * @param string   $key The dependency key.
	 * @param callable $factory The dependency instantiator.
	 */
	public function add( string $key, callable $factory ): void;

	/**
	 * Retrieves a dependency.
	 *
	 * @param string $key The dependency key.
	 *
	 * @return object The dependency instance.
	 */
	public function get( string $key ): object;

	/**
	 * Checks if a dependency exists.
	 *
	 * @param string $key The dependency key.
	 *
	 * @return bool
	 */
	public function has( $key ): bool;
}
