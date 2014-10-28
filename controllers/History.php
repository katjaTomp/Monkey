<?php

class History extends User{

private $module;
private $date;
private $user_name;

function __constract($module_name, $user_name){
	$this->module=$module_name;
	$this->user_name=$user_name;
	
}

function updateHistory(){
	$q="Update history Set user_name='".this->user_name"',date=NOW() WHERE module_name='xml'";
	$pdo=new PDOAccess();
	$stmt=$pdo->prepare($q);
	if($stmt->execute()){
		return true;
	}
	else {
		return "there was a problem with updating the history.";
	}


}

/**
* lastModifiedBy returns the user id who has last used the module
*
* params module_name
* @return int or string
*/

function lastModifiedBy($module_name){
	$q="SELECT user_id FROM history WHERE module_name='".$module_name."'";
	$pdo=new PDOAccess();
	$stmt=$pdo->prepare($q);
	$stmt->execute();

	if($row=$stmt->fetch()){
		foreach($row as $name=>$value){
			return $user_id=$value;
		}

	}else{
		return 'No recent modification has been made.';
	}

}

function lastModification($user_id){}



	

}
?>