<?php
namespace  RTK\Registry;

use PHPUnit\Framework\TestCase;

class RegistryTest extends TestCase {

	/**
	 * @covers RTK\Registry\Registry::get()
	 */
	public function testNonExistValue() {

		$result = Registry::get('some-undefined-key');
		$this->assertNull($result); 

	}

	/**
	 * @covers RTK\Registry\Registry::get()
	 */
	public function testUserDefinedNonExistValue() {

		$default_value = 'this-is-a-custom-value';
		$result = Registry::get('some-undefined-key', $default_value);

		$this->assertEquals($result, $default_value); 

	}

	/**
	 * @covers RTK\Registry\Registry::set()
	 * @covers RTK\Registry\Registry::get()
	 */
	public function testRandomStringKeyValue() {

		$key = 'testRandomStringKeyValue value ' . mt_rand();
		$value = 'testRandomStringKeyValue key ' . mt_rand();

		Registry::set($key, $value);

		$this->assertTrue(
			Registry::has($key)
		);

		$this->assertEquals(
			$value,
			Registry::get($key)
		);

	}

	/**
	 * @covers RTK\Registry\Registry::has()
	 */
	public function testHas() {

		$key = 'has-test-key';
		$value = 'has-test-value';

		$this->assertFalse(
			Registry::has($key)
		);

		Registry::set($key, $value);

		$this->assertTrue(
			Registry::has($key)
		);

	}

	/**
	 * @covers RTK\Registry\Registry::has()
	 */
	public function testHasValueFalse() {

		$key = 'has-test-key';
		$value = false;

		Registry::set($key, $value);

		$this->assertTrue(
			Registry::has($key)
		);

	}

	/**
	 * @covers RTK\Registry\Registry::remove()
	 */
	public function testRemove() {

		$key = 'remove-test-key';
		$value = 'remove-test-value';

		Registry::set($key, $value);

		$this->assertNotNull(
			Registry::get($key)
		);

		Registry::remove($key);

		$this->assertNull(
			Registry::get($key)
		);

	}

	/**
	 */
	public function testCaseInsensitive() {

		$key = 'Case-Insensitive-Test-Key';
		$value = 'case-insensitive-test-value';

		Registry::set($key, $value);

		$this->assertTrue(
			Registry::has($key),
			$value
		);
		$this->assertTrue(
			Registry::has(strtoupper($key)),
			$value
		);
		$this->assertTrue(
			Registry::has(strtolower($key)),
			$value
		);

		$this->assertEquals(
			Registry::get($key),
			$value
		);
		$this->assertEquals(
			Registry::get(strtoupper($key)),
			$value
		);
		$this->assertEquals(
			Registry::get(strtolower($key)),
			$value
		);

	}

	/**
	 */
	public function testCaseInsensitiveOverwrite() {

		$key = 'Case-Insensitive-Test-Key';
		$initial_value = 'case-insensitive-overwrite-value-1';
		$overwrite_value = 'case-insensitive-overwrite-value-2';

		Registry::set($key, $initial_value);

		$this->assertEquals(
			Registry::get($key),
			$initial_value
		);

		Registry::set($key, $overwrite_value);

		$this->assertEquals(
			Registry::get($key),
			$overwrite_value
		);

	}

}
