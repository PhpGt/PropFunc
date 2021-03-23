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

	public string $name;
	private int $id;

	public function __construct() {
		$this->__prop["constructedAt"] = time();
		$this->id = rand(1000,9999);
	}

	protected function __prop_get_constructedAt():int {
		return $this->__prop["constructedAt"];
	}

	protected function __prop_get_ucName():string {
		return strtoupper($this->name);
	}

	protected function __prop_get_age():int {
		if(isset($this->__prop["age"])) {
			return $this->__prop["age"];
		}

		return time() - $this->constructedAt;
	}

	protected function __prop_set_age(int $seconds):void {
		$this->__prop["age"] = $seconds;
	}

	protected function __prop_get_id():int {
		return $this->id;
	}
}
