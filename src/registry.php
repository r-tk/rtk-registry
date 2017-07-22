<?php
namespace RF\Registry;

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
		if (!self::check($key)) {
			return $default_value;
		}
		return self::$registry[$key];
	}

	/**
	 * Check if a value is set for this key in the registry
	 *
	 * @static
	 * @param $key mixed
	 * @return bool
	 */
	public static function check($key) {
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