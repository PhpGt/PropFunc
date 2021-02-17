<?php
namespace Gt\PropFunc\Test;

use PHPUnit\Framework\TestCase;
use Gt\PropFunc\Test\Helper\ExampleGetterSetter;

class GetterSetterTest extends TestCase {
	public function testIsset() {
		$sut = new ExampleGetterSetter();
		self::assertTrue(isset($sut->constructedAt));
		self::assertFalse(isset($sut->name));
		self::assertFalse(isset($sut->thisPropertyDoesNotExist));
	}

	public function testPropertyExists() {
		$sut = new ExampleGetterSetter();
		self::assertTrue(property_exists($sut, "name"));
	}

	public function testSetName() {
		$sut = new ExampleGetterSetter();
		$sut->name = "Test";
		self::assertEquals("Test", $sut->name);
	}

	public function testUnsetSetName() {
		$sut = new ExampleGetterSetter();
		$sut->name = "Test";
		self::assertTrue(isset($sut->name));
		unset($sut->name);
		self::assertFalse(isset($sut->name));
		$sut->name = "Test";
		self::assertTrue(isset($sut->name));
	}

	public function testGetUcName() {
		$sut = new ExampleGetterSetter();
		$sut->name = "test";
		self::assertEquals("TEST", $sut->ucName);
	}
}
