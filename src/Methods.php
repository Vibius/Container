<?php

namespace Vibius\Container;

trait Methods{

	public function add($name, $value){
		return $this->container->add($name, $value);
	}

	public function get($name){
		return $this->container->get($name);
	}

	public function remove($name){
		return $this->container->remove($name);
	}

	public function override($name, $value){
		return $this->container->override($name, $value);
	}

}