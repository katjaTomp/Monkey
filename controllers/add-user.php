<?php

require('../includes/utilities.php');
if($_SESSION['login']!=TRUE){header("Location:../view/signin.html");}

if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['email']!=''){
	
	//generate the password
	$pass=bin2hex(openssl_random_pseudo_bytes(10));
	if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){ header("Location: add-user.php");}

	else{

		$params=array("passgorilla"=>sha1($pass),"email"=>$_POST['email'],"name"=>htmlspecialchars($_POST['name']),"lastname"=>htmlspecialchars($_POST['lastname']),"active"=>1,"username"=>$_POST['realm-username']);
	
		foreach($params as $name =>$value){
			if($value!=''){
				$colns.=$name.',';
				$values.='"'.$value.'",';
			}
	}
		//construct the sql query params
		$colns=trim($colns,',');
		$values=trim($values,',');

		$query="INSERT INTO user ($colns) VALUES ($values)";
		$stmt=$pdo->prepare($query);
		if($stmt->execute()){
		//retrieve the user id which was automatically created in order to insert the values into access
			$q="SELECT id from user WHERE email=:email";
			$stmt=$pdo->prepare($q);
			$stmt->execute(array(':email'=>$params['email']));
			$row=$stmt->fetch();
			foreach($row as $name=>$value){
				$id=$value;
			}
		//insert new entry into access

			$module=array('header'=>$_POST['header'],'config'=>$_POST['config'],'user'=>$_POST['user'],'xml'=>$_POST['xml'],'footer'=>$_POST['footer'],'screen'=>$_POST['screen']);

			foreach($module as $name=>$value){
				if($value!=""){
			
					$query="INSERT INTO access(id,module_name,user_id)VALUES ($id,'$value',$id)"; 
					$stmt=$pdo->prepare($query);
					$stmt->execute();
			

				}
			}

		//after the user has been created send the email with the user name and password
		$to      = $_POST['email'];
		$subject = 'Gorilla credentials';
		$content="<p>Hi,".$_POST['name'].'</p><p> Your username: '.$_POST['email'].'and your password:'.$pass.'</p><p> Please, after logging in to the system for the first time, make sure to change your password.</p>';
		$headers = 'From: automatically generated' . "\r\n" .
 	   'Reply-To: ddasaf@example.com' . "\r\n" .
 	   'X-Mailer: PHP/' . phpversion();

 		mail($to, $subject, $message, $headers);
	

		header('Location: success.php');
		}
		else {
		echo "<h1>There was a problem!</h1>";
		}
	
	}
}



$pageTitle="Add new user";
include('../includes/header.php');
include('../view/add-user.html');
include('../includes/footer.php');
?>