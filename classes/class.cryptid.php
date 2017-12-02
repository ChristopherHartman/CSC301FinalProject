<?php

abstract class Cryptid 
{
	private $name;
	private $description;
	function __construct($name, $description) 
	{
		$this->name = $name;
		$this->description = $description;
	}
	
	function get($key) 
	{
		return $this->$key;
	}
	
	function set($key, $value) 
	{
		$this->$key = $value;
	}
}
<?