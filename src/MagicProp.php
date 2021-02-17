<?php
namespace Gt\PropFunc;

trait MagicProp {
	/** @var array<string,mixed> */
	protected array $magicPropValue = [];
	/** @var array<string,bool> */
	protected array $magicPropSetFlag = [];

	/** @return mixed */
	public function __get(string $name) {
		$method = $this->getMagicPropMethod($name, "get");
		if(!method_exists($this, $method)) {
			throw new PropertyDoesNotExistException($name);
		}
		return call_user_func([$this, $method]);
	}

	/** @param mixed $value */
	public function __set(string $name, $value):void {
		if(property_exists($this, $name)) {
			$this->$name = $value;
			return;
		}

		$setMethod = $this->getMagicPropMethod($name, "set");
		if(method_exists($this, $setMethod)) {
			call_user_func([$this, $setMethod], $value);
			return;
		}

		$setOnceMethod = $this->getMagicPropMethod($name, "setonce");
		if(method_exists($this, $setOnceMethod)) {
			if(isset($this->magicPropSetFlag[$name])) {
				throw new PropertySetMoreThanOnceException($name);
			}

			call_user_func([$this, $setOnceMethod], $value);
			return;
		}

		$getMethod = $this->getMagicPropMethod($name);
		if(method_exists($this, $getMethod)) {
			throw new PropertyReadOnlyException($name);
		}
		else {
			throw new PropertyDoesNotExistException($name);
		}
	}

	public function __isset(string $name):bool {
		if(property_exists($this, $name)) {
			return isset($this->$name);
		}

		$method = $this->getMagicPropMethod($name);
		return method_exists($this, $method);
	}

	public function __unset(string $name):void {
		if(property_exists($this, $name)) {
			unset($this->$name);
			return;
		}

		unset($this->magicPropValue[$name]);
	}

	private function getMagicPropMethod(
		string $name,
		string $action = "get"
	):string {
		return "__prop_{$action}_{$name}";
	}
}
