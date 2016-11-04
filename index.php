<?php

class ControllerIndex{
	private $_system;
	private $_hat;
	private $_shoe;
	function __construct()
	{

		require_once 'libs/config.php';
		$this->_system 		= System::singleton();
		$this->_hat 		= new Hat();
		$this->_shoe 		= new Shoe();
		
		$data["baseHref"]	= $this->_system->GetBaseRef();
		$data["skin"]		= $this->_system->get('skin');
		$data['env']		= $this->_system->getEnviroment();
		$data['token']		= session_id();		//token for cross site injection
		
	
		$this->_hat->pintaHat('login');
		
		$array_bg 			= array();
		$directory 			= $this->_system->get('background');
		$dirint 			= dir($directory);
		while (($archivo = $dirint->read()) !== false){
			if (preg_match("/gif/i", $archivo) || preg_match("/jpg/i", $archivo) || preg_match("/png/i", $archivo)){
				array_push($array_bg, $directory.$archivo);
			}
        }
		$dirint->close();
		$data['background'] = $array_bg;
	
		$this->_system->fShow($this->_system->get('skin')."/tpl_login.php",$data);
		
		$this->_shoe->pintaShoe();

	}
 	
}
		
new ControllerIndex();

?>