<?php
namespace  RF\Registry;

use PHPUnit\Framework\TestCase;

class RegistryTest extends TestCase {

	/**
	 * @covers RF\Registry\Registry::get()
	 */
	public function testNonExistValue() {

		$result = Registry::get('some-undefined-key');
		$this->assertNull($result); 

	}

	/**
	 * @covers RF\Registry\Registry::get()
	 */
	public function testUserDefinedNonExistValue() {

		$default_value = 'this-is-a-custom-value';
		$result = Registry::get('some-undefined-key', $default_value);

		$this->assertEquals($result, $default_value); 

	}

	/**
	 * @covers RF\Registry\Registry::set()
	 * @covers RF\Registry\Registry::get()
	 */
	public function testRandomStringKeyValue() {

		$key = 'testRandomStringKeyValue value ' . mt_rand();
		$value = 'testRandomStringKeyValue key ' . mt_rand();

		Registry::set($key, $value);

		$this->assertTrue(
			Registry::check($key)
		);

		$this->assertEquals(
			$value,
			Registry::get($key)
		);

	}

	/**
	 * @covers RF\Registry\Registry::check()
	 */
	public function testCheck() {

		$key = 'check-test-key';
		$value = 'check-test-value';

		$this->assertFalse(
			Registry::check($key)
		);

		Registry::set($key, $value);

		$this->assertTrue(
			Registry::check($key)
		);

	}

	/**
	 * @covers RF\Registry\Registry::check()
	 */
	public function testCheckValueFalse() {

		$key = 'check-test-key';
		$value = false;

		Registry::set($key, $value);

		$this->assertTrue(
			Registry::check($key)
		);

	}

	/**
	 * @covers RF\Registry\Registry::remove()
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

}