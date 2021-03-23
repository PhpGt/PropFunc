<?php
namespace Gt\PropFunc\Test\Helper;

use Gt\PropFunc\MagicProp;

/**
 * @property string $internalProperty An example property that is stored
 * internally within the __prop structure.
 * @property-read string $internalReadOnly An example property that is stored
 * internally within the __prop structure, but only exposed as read-only.
 * @property-read int $constructedAt An integer that's automatically created at
 * construct time, stored in a private property but exposed read-only by a
 * magic method.
 * @property-read string $ucName A calculated property that takes the public
 * name property and upper-cases it.
 * @property-read int $id An example property that shows how a private property
 * can be exposed read-only without needing to store any internal __prop values.
 * @property int $age A calculated property based on the constructedAt value.
 * @property-read string $writeMeOnce A write-once property. Any future writes
 * will throw an exception.
 */
class ExampleGetterSetter {
	use MagicProp;

	private int $constructedAt;
	public string $name;
	private int $id;

	public function __construct() {
		$this->constructedAt = time();
		$this->id = rand(1000,9999);
	}

	private function __prop_get_constructedAt():int {
		return $this->constructedAt;
	}

	private function __prop_get_ucName():string {
		return strtoupper($this->name);
	}

	private function __prop_get_age():int {
		return time() - $this->constructedAt;
	}

	private function __prop_set_age(int $seconds):void {
		$this->constructedAt = time() - $seconds;
	}

	private function __prop_get_id():int {
		return $this->id;
	}

	private function __prop_get_internalProperty():?string {
		return $this->__prop["internalProperty"] ?? null;
	}

	private function __prop_set_internalProperty(string $value):void {
		$this->__prop["internalProperty"] = $value;
	}
}
