<?php

class ControllerIndex{
	private $_system;
	function __construct()
	{


		require_once 'libs/config.php';
		$this->_system = System::singleton();
		new Check();
		
		$data["baseHref"]	= $this->_system->GetBaseRef();
		$data["skin"]		= $this->_system->get('skin');
		$data['env']		= $this->_system->getEnviroment();
		$data['urlWMS']		= $this->_system->get('urlWMSdbwater');
		$data['token']		= session_id();
		$data['update']		= 1;
		//$data['update']		= $_SESSION['update'];
		$detect 			= new Mobile_Detect();
		$data['isMobile'] 	= ($detect->isMobile() === true && $detect->isTablet() === false)? '1' : '0';
	
		$this->_system->fShow($this->_system->get('skin')."/tpl_dbwater.php",$data);
		
	}
 
	
}
		
new ControllerIndex();

?>