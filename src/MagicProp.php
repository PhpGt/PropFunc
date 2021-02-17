<?php
namespace Gt\PropFunc;

trait MagicProp {
	protected array $magicPropValue = [];

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

		$method = $this->getMagicPropMethod($name, "set");
		if(!method_exists($this, $method)) {
			$getterMethod = $this->getMagicPropMethod($name, "get");
			if(method_exists($this, $getterMethod)) {
				throw new PropertyReadOnlyException($name);
			}
			else {
				throw new PropertyDoesNotExistException($name);
			}
		}

		call_user_func([$this, $method], $value);
	}

	public function __isset(string $name):bool {
		if(property_exists($this, $name)) {
			return isset($this->$name);
		}

		$method = $this->getMagicPropMethod($name, "get");
		return method_exists($this, $method);
	}

	public function __unset(string $name):void {
		if(property_exists($this, $name)) {
			unset($this->$name);
			return;
		}

		unset($this->magicPropValue[$name]);
	}

	private function getMagicPropMethod(string $name, string $action):string {
		return "__prop_{$action}_{$name}";
	}
}
