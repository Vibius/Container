<?php

namespace Vibius\Container;

use Exception;

/**
 * @author Matej Sima <matej.sima@gmail.com>
 * @category Vibius PHP Framework Component
 * @package Vibius\Container
 */
class Container{

    /**
     * @var array Holds intancens under multiple keys
     */
    private static $instance;

    public function __construct($instance = false){
    	if( $instance ){
            $key = $instance;
            if( !isset(self::$instance[$key]) ){
                self::$instance[$key] = new Container;
            }

            return self::$instance[$key];
        }

    }

    /**
     * Method is used to open specific instance of container.
     * @param string $key Identifier for inner storage to find the proper instance to open or create.
     * @return object Instance of Container class picked by $key.
     */
    public static function open($key){
        if( !isset(self::$instance[$key]) ){
            self::$instance[$key] = new Container;
        }

        return self::$instance[$key];
    }

    /**
     * Used to add $value to container which will be stored under $key.
     * @param string $key Identifier for container storage.
     * @param mixed $value Value which will be binded to $key in container storage.
     * @throws Exception Item already exists in storage ($key)
     */
    public function add($key, $value){
        if( $this->exists($key) ){
            throw new Exception("Item already exists in storage ($key)");
        }
        $this->storage[$key] = $value;
        return $this->storage[$key];

    }

    /**
     * @param $key Identifier for container storage, used to retrieve proper value stored under it.
     * @return mixed Value stored under $key in container storage.
     * @throws Exception Item does not exist in storage ($key)
     */
    public function get($key){
        if( !$this->exists($key) ){
            throw new Exception("Item does not exist in storage ($key)");
        }
        return $this->storage[$key];
    }

    /**
     * Used to check if the $key already exists in the storage.
     * @param string $key Identifier for container storage.
     * @return boolean If key was found in the container storage return true.
     */
    public function exists($key){
        if( isset($this->storage[$key]) ){
            return true;
        }
    }

    /**
     * Used to override $key, $value pair if it already exists in the container.
     * @param string $key Identifier for container storage.
     * @param mixed $value Value which will be overriden if $key already exists, as $key in container storage.
     * @throws Exception Item does not exist in storage ($key)
     */
    public function override($key, $value){
        if( !$this->exists($key) ){
            throw new Exception("Item does not exist in storage ($key)");
        }
        $this->storage[$key] = $value;    

    }

    /**
     * Used to remove $key and it's value from container.
     * @param string $key Identifier for container storage.
     * @throws Exception Item does not exist in storage ($key)
     */
    public function remove($key){
        if( !$this->exists($key) ){
            throw new Exception("Item does not exist in storage ($key)");
        }
        unset($this->storage[$key]);    

    }

}