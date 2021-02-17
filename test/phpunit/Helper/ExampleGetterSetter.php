<?php
namespace Gt\PropFunc\Test\Helper;

use Gt\PropFunc\MagicProp;

/**
 * @property-read int $constructedAt
 * @property-read string $ucName
 * @property int $age
 */
class ExampleGetterSetter {
	use MagicProp;

	public string $name;

	public function __construct() {
		$this->magicPropValue["constructedAt"] = time();
	}

	protected function __prop_get_constructedAt():int {
		return $this->magicPropValue["constructedAt"];
	}

	protected function __prop_get_ucName():string {
		return strtoupper($this->name);
	}

	protected function __prop_get_age():int {
		if(isset($this->magicPropValue["age"])) {
			return $this->magicPropValue["age"];
		}

		return time() - $this->constructedAt;
	}

	protected function __prop_set_age(int $seconds):void {
		$this->magicPropValue["age"] = $seconds;
	}
}
