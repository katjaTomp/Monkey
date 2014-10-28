<?php


require('../includes/utilities.php');




if($_SERVER['REQUEST_METHOD']=='POST'){

if(!check_email_address($email)){header('Location: ../view/signing.html');}

$user=array('email'=>$_POST['email'],'passgorilla'=>sha1($_POST['gpass']),'name'=>$_POST['name'],'lastname'=>$_POST['lastname'],'username'=>$_POST['realm-username'],'active'=>$_POST['status']);
$module=array('header'=>$_POST['header'],'config'=>$_POST['config'],'user'=>$_POST['user'],'xml'=>$_POST['xml'],'footer'=>$_POST['footer'],'screen'=>$_POST['screen']);

//update the user table in DB
$user= User::updateAdmin($user,$_POST['id']);
//$user->updateAdmin($user,$_POST['id']);

//update the access table
$user->updateAccess($module,$_POST['id']);

header('Location: success.php');
}

$pageTitle="Edit profile";

include('../includes/header.php');
include('../view/edit-admin.php');

?>