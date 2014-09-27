<?php

use Vibius\Container\Container;

class ContainerTest extends PHPUnit_Framework_TestCase{

	public function setUp(){
		
		$this->container = new Container( 'Container test instance', false, true);
	}

	public function matchInstances($expected, $actual){
		
		$this->assertEquals($expected, $actual);
	}

	public function testOpenContainerInstanceByName(){

		$container = new Container();
		$container->name = 'instanceName';
		$container->secure = true;

		$this->matchInstances($container, Container::open('instanceName', false, true));
	}

	public function testAddToContainer(){
		
		$this->assertEquals('value', $this->container->add('key', 'value'));
	}

	/**
	 *
	 *  @expectedException Exception
	 *  @expectedExceptionMessage Item already exists in storage (key)
	 */
	public function testAddSameItemTwice(){

		$this->container->add('key','value');

		$this->container->add('key','value');
	}

	public function testGetFromContainer(){
		
		$this->container->add('key','value');
		
		$this->assertEquals('value', $this->container->get('key'));
	}

	/**
	 *
	 *  @expectedException Exception
	 *  @expectedExceptionMessage Item does not exist in storage (key)
	 */
	public function testGetNonExistentItemFromContainer(){
		
		$this->container->get('key');
	}

	/**
	 *
	 *  @expectedException Exception
	 *  @expectedExceptionMessage You can't override items in secure instance of container (Container test instance)
	 */
	public function testOverrideContainerItem(){
		
		$this->container->add('key','value');
		
		$this->container->override('key','value 2');
	}

	/**
	 *
	 *  @expectedException Exception
	 *  @expectedExceptionMessage You can't remove items from secure instance of container (Container test instance)
	 */
	public function testRemoveContainerItem(){
		
		$this->container->add('key','value');

		$this->container->remove('key');
	}	

	public function testHasMethodCheckIfExists(){

		$key = 'key';

		$this->container->add($key, 'value');

		if( !$this->container->exists($key) ){
			throw new Exception("Item does not exist in storage ($key)");
		}
	}

}