<?php
require_once('../trials-header.php');
if($_GET['token'] != $token || $_POST['token'] != $token){
	die("Token mismatch");
}

$method = isset($_GET['method']) ? $_GET['method'] : $_POST['method'];
if(isset($method)){
	switch($method){
	
		case "addAuth":
			if(isset($_POST['userID']) && isset($_POST['time']) && isset($_POST['script'])){
				$password = $trials->add($_POST['userID'],$_POST['time'], $_POST['script']); 
				echo 'user ID : '.$_POST['userID']. ' with Password: '.$password. ' added </br>';
			}else{
				echo 'Failed, missing data';
			}
			
			
		break;
		
		case "removeAuth":
			
			if(isset($_GET['id']) || isset($_POST['id'])){
				$id = (isset($_GET['id'])) ? $_GET['id'] : $_POST['id'];
				$trials->removeAuth($id);
			}
			
		break;
		
		case "getAuth":
		
			echo json_encode($trials->getActive());

		break;
	
	}

}
