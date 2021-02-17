<?php
namespace Gt\PropFunc\Test\Helper;

use Gt\PropFunc\MagicProp;

/**
 * @property-read int $constructedAt;
 * @property string $name
 */
class ExampleGetterSetter {
	use MagicProp;

	public function __construct() {
		$this->constructedAt = time();
	}
}
