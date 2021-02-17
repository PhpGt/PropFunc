<?php
namespace Gt\PropFunc;

trait MagicProp {
	/** @var array<string, mixed> */
	protected array $magicPropMap = [];

	/** @return mixed */
	public function __get(string $name) {
		return $this->magicPropMap[$name];
	}

	/** @param mixed $value */
	public function __set(string $name, $value):void {
		$this->magicPropMap[$name] = $value;
	}

	public function __isset(string $name):bool {
		return isset($this->magicPropMap[$name]);
	}

	public function __unset(string $name):void {
		unset($this->magicPropMap[$name]);
	}
}
