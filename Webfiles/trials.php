<?php	

class trials{
			
	private $mysqli;
	
	public function __construct($host, $username, $password, $db){
	
		$this->mysqli = new mysqli($host, $username, $password, $db);
		
		if ($this->mysqli->connect_errno) {
			//die("Connect failed: %s\n", $this->mysqli->connect_error);
			}
	}
	
	public function add($userID,$time,$script){
		
		$password = ""; 
		for ($i = 0; $i < 7; $i++){
			$password .= chr(rand(33, 126));
		}
		
		if($query = $this->mysqli->prepare("INSERT INTO trials (userID,time,script,password) VALUES (?,?,?,?)")){
			$query ->bind_param('iiis',$userID,$time,$script,$password);
			$query->execute();
		
			if($query->errno){
				//die("Update query failed: ".$query->error); 
			}
		
			return $password;
		
		}else{
		
			echo "error: ".$this->mysqli->error;
			}
	}
	
	public function allTrials(){
		$trials = array();
		if($res = $this->mysqli->query("SELECT * FROM trials")){
			while ($row = $res->fetch_assoc()) {
				array_push($trials,$row);
			}
		
		}else if($this->mysqli->errno){
			//die("Select query failed: ".$this->mysqli->error);
		}
		return $trials;
		
	}
	
	
	public function removeAuth($id){
			if($query = $this->mysqli->prepare("UPDATE trials SET isAuthed = 1 WHERE id= ?")){
			$query->bind_param("i",$id);
			$query->execute();
			if($query->errno){
				//die("Update query failed: ".$query->error);
			}
		}else{
			//die("Update failed: "+$query->error);
		}
	}
	
	
	public function getUser($userID,$password){
		
		if($query = $this->mysqli->prepare("SELECT id FROM trials WHERE userID=? AND password=? AND isAuthed = 0 AND authFlag =0 LIMIT 1")){
			$query->bind_param("is",$userID,$password);
			$query->execute();
			$query->bind_result($id); 
			
			while($query->fetch()){
				return $id;
			}
			
		}else{
			//die("Problem preparing query: ".$this->mysqli->error);
		}
	
	}
	
	public function auth($userID,$password){
		$id = $this->getUser($userID,$password);
		$ip = $_SERVER['REMOTE_ADDR'];
		if(!$this->mysqli->query("UPDATE trials SET authFlag=1, ip = '$ip' WHERE id=".$id)){
			//die("Updating failed: ".$this->mysqli->error);
		}
			
	}
	
	
	public function getActive(){
		$trials = array();
		if($res = $this->mysqli->query("SELECT id,userID,script,time FROM trials WHERE isAuthed=0 AND authFlag=1")){
			while ($row = $res->fetch_assoc()) {
				array_push($trials,$row);
			}
		
		}else if($this->mysqli->errno){
			//die("Select query failed: ".$this->mysqli->error);
		}
		return $trials;
	
	}
	
	public function getAuthed(){
		$trials = array();
		if($res = $this->mysqli->query("SELECT id,userID,script,time FROM trials WHERE isAuthed=1 AND authFlag=1")){
			while ($row = $res->fetch_assoc()) {
				array_push($trials,$row);
			}
		
		}else if($this->mysqli->errno){
			//die("Select query failed: ".$this->mysqli->error);
		}
		return $trials;
	
	}
	
		
}






?>
