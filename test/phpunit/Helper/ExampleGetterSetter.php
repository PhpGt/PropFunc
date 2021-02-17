<?php
namespace Gt\PropFunc\Test\Helper;

use Gt\PropFunc\MagicProp;

/**
 * @property-read int $constructedAt
 * @property-read string $ucName
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
}
