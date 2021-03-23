<?php
namespace Gt\PropFunc\Test\Helper;

use Gt\PropFunc\MagicProp;

/**
 * @property-read int $constructedAt
 * @property-read string $ucName
 * @property-read int $id
 * @property int $age
 * @property-read string $writeMeOnce
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

	protected function __prop_get_constructedAt():int {
		return $this->constructedAt;
	}

	protected function __prop_get_ucName():string {
		return strtoupper($this->name);
	}

	protected function __prop_get_age():int {
		return time() - $this->constructedAt;
	}

	protected function __prop_set_age(int $seconds):void {
		$this->constructedAt = time() - $seconds;
	}

	protected function __prop_get_id():int {
		return $this->id;
	}
}
