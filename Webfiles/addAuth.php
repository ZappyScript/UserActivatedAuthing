<?php
require_once('trials-header.php');
if($token != $_GET['token']){
	die("Token mismatch!");
}
if(isset($_POST['submit'])){
	$password = $trials->add($_POST['userID'],$_POST['time'], $_POST['script']); 
	echo 'user ID : '.$_POST['userID']. ' with Password: '.$password. ' added </br>';
			}
			
?>		
	<form method="Post">
		<label>User ID:</label><input type="text" size="" maxlength="" name="userID"></br>
		<label>Time:</label><input type="text" size="" maxlength="" name="time"></br>
		<label>Script ID:</label><input type="text" size="" maxlength="" name="script"></br>
		<input type="submit" name="submit" value="submit">
	</form>
 
 
