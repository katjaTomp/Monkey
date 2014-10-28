<?php

require('../includes/utilities.php');

if($_SESSION['login']!=TRUE){header("Location:../view/signin.html");}

include('../includes/header.php');
include('../view/history-browser.html');
if($_GET['module']=='xml'){
	$q="SELECT user_name,filename,datetime,environment FROM actions WHERE module_name='xml' ORDER by datetime DESC";
	$pdo=new PDOAccess();
	$stmt=$pdo->getPDO()->prepare($q);
	if($stmt->execute()){
		while($actions=$stmt->fetch()){

	

			echo '<tr>';
  		    echo '<th data-field="username">'.$actions['user_name'].'</th>';
   			echo '<th data-field="datetime">'.$actions['datetime'].'</th>';
   			echo '<th data-field="filename">'.$actions['filename'].'</th>';
   			echo '<th data-field="environment">'.$actions['environment'].'</th>';
    		echo '</tr>';
		
	}
}
	else {
		 echo 'no actions have been logged for this module';
	}
	// add more if cases for the rest of the modules
}


//include('../includes/footer.php');
?>