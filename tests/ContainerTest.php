<?php

use Vibius\Container\Container;

class ContainerTest extends PHPUnit_Framework_TestCase{

	public function setUp(){
		
		$this->container = new Container( 'Container test instance');
	}

	/**
	 *
	 *  @expectedException Exception
	 *  @expectedExceptionMessage Container instance cannot be opened!
	 */
	public function testOpenTwoPrivateInstancesWithSameName(){
		$container1 = Container::open('privateInstance', true);
		$container2 =  Container::open('privateInstance', true);
	}

	public function matchInstances($expected, $actual){
		
		$this->assertEquals($expected, $actual);
	}

	public function testOpenContainerInstanceByName(){

		$container = new Container();
		$container->name = 'instanceName';
		$container->secure = false;

		$this->matchInstances($container, Container::open('instanceName'));
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

	public function testOverrideContainerItem(){
		
		$this->container->add('key','value');
		
		$this->container->override('key','value 2');
	}

	/**
	 *
	 *  @expectedException Exception
	 *  @expectedExceptionMessage Item does not exist in storage (key 2)
	 */
	public function testOverrideNonExistentContainerItem(){
		
		$this->container->add('key','value');

		$this->container->override('key 2','value 2');
	}

	public function testRemoveContainerItem(){
		
		$this->container->add('key','value');

		$this->container->remove('key');
	}	

	/**
	 *
	 *  @expectedException Exception
	 *  @expectedExceptionMessage Item does not exist in storage (key)
	 */
	public function testRemoveNonExistentContainerItem(){
		
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