<?php


require('../includes/utilities.php');

if($_SESSION['login']!=TRUE){header("Location:../view/signin.html");}

if($_SERVER['REQUEST_METHOD']=='POST'){



$post=array('email'=>$_POST['email'],'passgorilla'=>sha1($_POST['gpass']),'name'=>$_POST['name'],'lastname'=>$_POST['lastname'],'username'=>$_POST['realm-username']);

foreach($post as $name=> $value){
	if($value!==''){ 
		$query="UPDATE user SET $name ='$value' WHERE id=".$_SESSION['id'];
		
        $stmt = $pdo->prepare($query);
        $stmt->execute(); 
	}
}
header('Location: success.php');

}

$pageTitle="Edit Users";
include('../includes/header.php');
include('../view/edit-user.php');

?>