<?php
class ControllerIndex{
	
	private $_system;
	private $_hat;
	private $_shoe;
	
	function __construct()
	{


		require_once 'libs/config.php';
		$this->_system 		= System::singleton();
		new Check();
		$this->_hat 		= new Hat();
		$this->_shoe 		= new Shoe();
		
		$detect 			= new Mobile_Detect();
		
		$data["baseHref"]	= $this->_system->GetBaseRef();
		$data["skin"]		= $this->_system->get('skin');
		$data['env']		= $this->_system->getEnviroment();
		$data['urlWMS']		= $this->_system->get('urlWMSdbmanager');
		$data['token']		= session_id();
		$data['update']		= $_SESSION['update'];
		
		$data['isMobile'] = ($detect->isMobile() === true && $detect->isTablet() === false)? '1' : '0';
		
		$this->_hat->pintaHat('home');
	
		$this->_system->fShow($this->_system->get('skin')."/tpl_dbmanager.php",$data);
		
		$this->_shoe->pintaShoe();
		
	}
 
	
}
		
new ControllerIndex();

?>