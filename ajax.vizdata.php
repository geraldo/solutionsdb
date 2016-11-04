<?php

class ControllerIndex{
	private $_system;
	private $_hat;
	private $_shoe;
	function __construct()
	{
		header('Content-Type: application/json');
		require_once 'libs/config.php'; //Archivo con configuraciones.
		$this->_system = System::singleton();//contiene objeto system
		$_POST 		= json_decode(file_get_contents('php://input'), true);
		require_once 'libs/apps/vizdata/class.vizdata.php';
		$vizdata 	= new Vizdata();
		$what   	= (empty($_POST['what'])) 			? null 		: $_POST['what'];
		$token   	= (empty($_POST['token'])) 			? null 		: $_POST['token'];
		if($token===session_id()){
			if($what==="DBWATER_LIST_VOLUMENES"){
				$data		= array();
				$volumenes 	= $vizdata->dbWaterListVolumenes($data);
				echo json_encode($volumenes);	
			}/*else if($what==="DBWATER_TOWN_INFO"){
				$id_town     	= (empty($_POST['id'])) 			? 0 	: $this->_system->nohacker($_POST['id']);
				$town_name      = (empty($_POST['town_name'])) 		? null 	: $this->_system->nohacker($_POST['town_name']);
				$initialDate    = (empty($_POST['initialDate'])) 	? null 	: $this->_system->nohacker($_POST['initialDate']);
				$finalDate    	= (empty($_POST['finalDate'])) 		? null 	: $this->_system->nohacker($_POST['finalDate']);
				$town			= $dataviz->dbWaterTownInfo($id_town,$town_name,$initialDate,$finalDate);
				echo json_encode($town); */
		}else{
			echo json_encode(array("status"=>"Failed","message"=>"Cross site injection detected","code"=>501));
		}

		//test JSON without security

		/*$data		= array();
		$volumenes 	= $vizdata->dbWaterListVolumenes($data);
		echo json_encode($volumenes);*/	
	}
}
		
new ControllerIndex();

?>