<?php
class Vizdata {

	private $_system;	
				
	public function __construct(){
		$this->_system = System::singleton();
	}	

	public function getDatosMunicipio(){
		$query 		= "SELECT * FROM carto.service_diari";
		$rs 		= $this->_system->pdo_select("bd1",$query);
		if(count($rs)>0){
			$records = array();
			foreach ($rs as $row) {
				$record	= array(
							"id"				=> $row['id'],
							"service_code"		=> $row['service_code'],
							"data"				=> $row['data'],
							"sum_suministrat"	=> $row['sum_suministrat'],
							"sum_aportat"		=> $row['sum_aportat'],
							"sum_rebuig"		=> $row['sum_rebuig']
				);
				$records[] = $record;
			}
			$retorno 	= array("status"=>"Accepted","message"=>$records);
		}else{
			$retorno	= array("status"=>"Failed","message"=>"no data","code"=>401);
		}
		return $retorno;		
	}

	public function dbWaterListVolumenesXXX($data){
		$query 		= "SELECT * FROM carto.service_diari ORDER BY data ASC";
		$rs 		= $this->_system->pdo_select("bd1",$query);
		$retorno	= array();
		if(count($rs)>0){
			foreach($rs as $row){
				$item = array(
						"id"				=> $row['id'],
						"service_code"		=> $row['service_code'],
						"data"				=> $row['data'],
						"sum_suministrat"	=> $row['sum_suministrat'],
						"sum_aportat"		=> $row['sum_aportat'],
						"sum_rebuig"		=> $row['sum_rebuig']
				);
				array_push($retorno, $item);
			}
		}
		return array("status"=>"Accepted","message"=>$retorno,"total"=>count($rs),"code"=>200);
	}

	public function dbWaterListVolumenes($data){
			$query 		= "SELECT * FROM web_results.service_volume_days('08MDR',8)";
			$rs 		= $this->_system->pdo_select("bd1",$query);
			$retorno	= array();
			if(count($rs)>0){
				foreach($rs as $row){
					$item = array(
						"data"				=> $row['day'],
						"sum_suministrat"	=> $row['supplied'],
						"sum_aportat"		=> $row['distributed'],
						"sum_rebuig"		=> $row['wasted']
					);
					array_push($retorno, $item);
				}
			}
			return array("status"=>"Accepted","message"=>$retorno,"total"=>count($rs),"code"=>200);
		}
	}

?>