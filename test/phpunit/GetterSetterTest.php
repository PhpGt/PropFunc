<?php
namespace Gt\PropFunc\Test;

use Gt\PropFunc\PropertyDoesNotExistException;
use Gt\PropFunc\PropertyReadOnlyException;
use PHPUnit\Framework\TestCase;
use Gt\PropFunc\Test\Helper\ExampleGetterSetter;
use StdClass;

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

	public function testUnsetReadOnly() {
		$sut = new ExampleGetterSetter();
		self::expectException(PropertyReadOnlyException::class);
		unset($sut->constructedAt);
	}

	public function testUnsetMagic() {
		$sut = new ExampleGetterSetter();
		$sut->age = 123;
		self::assertEquals(123, $sut->age);
		unset($sut->age);
		self::assertEquals(time() - $sut->constructedAt, $sut->age);
	}

	public function testGetUcName() {
		$sut = new ExampleGetterSetter();
		$sut->name = "test";
		self::assertEquals("TEST", $sut->ucName);
	}

	public function testGetNonExistentProperty() {
		$sut = new ExampleGetterSetter();
		self::expectException(PropertyDoesNotExistException::class);
		$sut->nothing;
	}

	public function testSetNonExistentProperty() {
		$sut = new ExampleGetterSetter();
		self::expectException(PropertyDoesNotExistException::class);
		$sut->nothing = "something";
	}

	public function testSetReadOnlyProperty() {
		$sut = new ExampleGetterSetter();
		self::expectException(PropertyReadOnlyException::class);
		/** @var StdClass $sut Suppress the IDE-error on line below! */
		$sut->ucName = "SOMETHING";
	}

	public function testExistingPropertyOverridden() {
		$sut = new ExampleGetterSetter();
		self::assertIsInt($sut->id);
	}

	public function testExistingPropertyReadOnly() {
		$sut = new ExampleGetterSetter();
		self::expectException(PropertyReadOnlyException::class);
		$sut->id = 123;
	}
}
