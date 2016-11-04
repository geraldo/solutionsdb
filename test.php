<?php

class ControllerIndex{
	private $_system;
	function __construct()
	{

		require_once 'libs/config.php'; //Archivo con configuraciones.
		$this->_system = System::singleton();//contiene objeto system

		require_once 'libs/apps/users/class.users.php'; //Archivo con configuraciones.
			
		$users	= new Users();
		$users->testCript("12345");
		echo "<pre>";
		print_r($users->getUser(null,"leo@leandrolopez.com"));
		echo "</pre>";
	}
 	
}
		
new ControllerIndex();
?>