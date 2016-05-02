<?php
date_default_timezone_set('Europe/Andorra');

require_once('utils/class.System.php');
$config = System::singleton();
$config->set('carpetaTpl', 'tpl/');									//carpeta de las plantillas
$config->set('carpetaLogs', 'logs/');								//carpeta de los logs
$config->set('carpetaIncludes', 'includes/');						//carpeta de los includes
$config->set('basedirContenidos','contenidos/');					//carpeta para los contenidos generados por los usuarios
$config->set('skin','default');										//carpeta tpl que usa el proyecto

$env = 'dev';	
//$env = 'prod';	
$config->set('environment', $env);									//entorno dev (desarrollo) o prod (producción)
$config->set('path',$_SERVER['DOCUMENT_ROOT']);
$config->SetbaseRef("host");

$config->set('_servidor_bd1', 'localhost');							//url mysql del servidor 1
$config->set('_database_bd1', 'bd');								//bd del servidor 1
$config->set('_user_bd1', 'us');										//user mysql del servidor 1
$config->set('_password_bd1', 'pwd');									//passw del servidor 1

$config->set('_servidor_bd2', 'localhost');							//url mysql del servidor 2
$config->set('_database_bd2', 'bd');								//bd del servidor 2
$config->set('_user_bd2', '');										//user mysql del servidor 2
$config->set('_password_bd2', '');									//passw del servidor 1

$config->set('background', 'contenidos/bg/');
$_SESSION['lang']		= 'es';
require_once 'includes/'.$_SESSION['lang']."/constants_common.php";
//WMS url service
$config->set('urlWMS','hots/wms');
?>
