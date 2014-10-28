<?php

class Access{

private $id;


function __construct(){}
/**
* The methods checks if the logged in user has access to header module
*
* params user id
* @return boolean
*/

function accessHeader($id){

    $q='SELECT module_name FROM access WHERE id=:id AND module_name=:module';
	$query_params=array(':id'=>$_SESSION['id'],':module'=>'header');
	$pdo=new PDOAccess();
	$stmt=$pdo->getPDO()->prepare($q);
	$stmt->execute($query_params); 
  	if($row=$stmt->fetch()){
      return true;
    }
return false;
}



/**
* The methods checks if the logged in user has access to xml uploader module
*
* params user id
* @return boolean
*/
function accessXML($id){

 	$q='SELECT module_name FROM access WHERE id=:id AND module_name=:module';
	$query_params=array(':id'=>$id,':module'=>'xml');
	$pdo=new PDOAccess();
	$stmt=$pdo->getPDO()->prepare($q);
	$stmt->execute($query_params); 
  	if($row=$stmt->fetch()){
      return true;
    }
return false;
}

/**
* The methods checks if the logged in user has access to config module
*
* params user id
* @return boolean
*/

function accessConfig($id){

 	$q='SELECT module_name FROM access WHERE id=:id AND module_name=:module';
	$query_params=array(':id'=>$id,':module'=>'xml');
	$pdo=new PDOAccess();
	$stmt=$pdo->getPDO()->prepare($q);
	$stmt->execute($query_params); 
  	if($row=$stmt->fetch()){
      return true;
    }
return false;
}

}
?>