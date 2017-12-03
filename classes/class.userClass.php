<?php
class userClass
{
	private $userId;
	private $userName;
	function __construct($userId, $userName) 
	{
		$this->userId= $userId;
		$this->userName = $userName;
	}
	
	function getUserName() 
	{
		return $this->userName;
	}
	
	function getUserId() 
	{
		return $this->userId;
	}
	
}
?>