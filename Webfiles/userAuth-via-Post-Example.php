<?php
require_once('trials-header.php');

if(isset($_POST['submit'])){
	$trials->auth($_POST['userID'],$_POST['password']); 
	echo 'If a user with that password holds a trial, it will be flagged for activation for ASAP. Thanks.';
}
 
 
?>


<form method="Post">
<label>User ID:</label><input type="text" size="" maxlength="" name="userID"></br>
<label>Password:</label><input type="text" size="" maxlength="" name="password"></br>
 <input type="submit" name="submit" value="submit">
</form>