<?php
require_once('trials-header.php');

if(isset($_GET['userID']) && isset($_GET['password'])){
	$trials->auth($_GET['userID'],$_GET['password']); 
	echo 'If a user with that password holds a trial, it will be flagged for activation for ASAP. Thanks.';
}
 
 
?>