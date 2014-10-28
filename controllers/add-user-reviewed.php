<?php

require('../includes/utilities.php');

if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['email']!=''){
	
	//generate the password
	$pass=bin2hex(openssl_random_pseudo_bytes(10));

	$params=array("passgorilla"=>sha1($pass),"email"=>htmlspecialchars(trim($_POST['email'])),"name"=>htmlspecialchars($_POST['name']),"lastname"=>htmlspecialchars($_POST['lastname']),"active"=>1,"username"=>$_POST['realm-username']);
	
	$user=new User();
	$id=$user->create_user($params);
		//insert new entry into access

	$module=array('header'=>$_POST['header'],'config'=>$_POST['config'],'user'=>$_POST['user'],'xml'=>$_POST['xml'],'footer'=>$_POST['footer'],'screen'=>$_POST['screen']);

	$user->assignModules($id,$module);

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




include('../includes/header.php');
include('../view/add-user.html');
include('../includes/footer.php');
?>