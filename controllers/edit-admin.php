<?php


require('../includes/utilities.php');
if($_SESSION['login']!=TRUE){header("Location:../view/signin.html");}



if($_SERVER['REQUEST_METHOD']=='POST'){

if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){ header("Location: ../controllers/edit_admin.php?error=true");}

$user=array('email'=>$_POST['email'],'passgorilla'=>sha1($_POST['gpass']),'name'=>$_POST['name'],'lastname'=>$_POST['lastname'],'username'=>$_POST['realm-username'],'active'=>$_POST['status']);
$module=array('header'=>$_POST['header'],'config'=>$_POST['config'],'user'=>$_POST['user'],'xml'=>$_POST['xml'],'footer'=>$_POST['footer'],'screen'=>$_POST['screen']);

//update the user table in DB
foreach($user as $name=> $value){
	if($value!==''){ 
		$query="UPDATE user SET $name ='$value' WHERE id= ".$_POST['id'];
		
        $stmt = $pdo->prepare($query);
        $stmt->execute(); 
	}
}
//update the access table
foreach($module as $name=>$value){
	//if the module checkbox is  unchecked 
	if($value=='') {
			    $user_id=$_POST['id'];
	 			$query="DELETE FROM access WHERE (module_name='$name'and user_id=$user_id)";
				$stmt=$pdo->prepare($query);
				$stmt->execute();

		}
	//if the module is checked	
	if($value!=''){
		
           	try{
            	$user_id=$_POST['id'];
	 			$query="INSERT INTO access (id,module_name,user_id) VALUES ($user_id,'$value',$user_id)";
				$stmt=$pdo->prepare($query);
				$stmt->execute();
		
			}
			catch(Exception $e){}

			}
		
			}
		
	
	

header('Location: success.php');
}

$pageTitle="Edit profile";

include('../includes/header.php');
include('../view/edit-admin.php');

?>