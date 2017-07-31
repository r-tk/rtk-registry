<?php
namespace RTK\Registry;

class Registry {

	/**
	 * @var array
	 */
	private static $registry = array();

	/**
	 * Add an item to registry
	 *
	 * @static
	 * @param $key mixed
	 * @param $value mixed
	 */
	public static function set($key, $value) {
		$key = strtolower($key);
		self::$registry[$key] = $value;

	}

	/**
	 * Get item value from registry
	 *
	 * @static
	 * @param $key mixed
	 * @param $default_value - return value if $key is not present in registry
	 * @return mixed
	 */
	public static function get($key, $default_value = null) {
		$key = strtolower($key);
		if (!self::has($key)) {
			return $default_value;
		}
		return self::$registry[$key];

	}

	/**
	 * Check if a item has been added to the registry
	 *
	 * @static
	 * @param $key mixed
	 * @return bool
	 */
	public static function has($key) {
		$key = strtolower($key);
		return isset(self::$registry[$key]);

	}

	/**
	 * Remove an item from the registry
	 *
	 * @static
	 * @param $key
	 */
	public static function remove($key) {
		unset(self::$registry[$key]);

	}

}
