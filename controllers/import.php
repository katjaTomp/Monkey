<?php
require('../includes/utilities.php');

if($_SESSION['login']!=TRUE){header("Location:../view/signin.html");}
//import.php imports the xml into DW
if($_SERVER["REQUEST_METHOD"]=='POST'){

	
	$username=$_SESSION['username'];


	if(empty($username) || empty($_POST['rlmpass']) || empty($_POST["environment"]) || empty($_POST["brand"]) || empty($_POST["component"])) {
		echo '<p> Error!!</p>';
} 
else {
	
	$password=$_POST['rlmpass'];
	$environment=$_POST['environment'];
	$brand=$_POST['brand'];
	$component=$_POST['component'];
	
	$filename =$_POST['file_id'];
	$filepath = '../uploads/'.$_POST['file_id'];
	
	$folder = ($component == 'asset' ? 'library' : 'slots');
		
	if($brand == 'adidas') {				
		$url = 'https://' . $environment . '.store.adidasgroup.demandware.net/on/demandware.servlet/webdav/Sites/Impex/src/upload/'. $folder .'/';
		
		$locals=array('GB'=>'GB','DE'=>'DE','NL'=>'NL','FR'=>'FR','IT'=>'IT','ES'=>'ES','BE'=>'BE','IE'=>'IE','AT'=>'AT','DK'=>'DK','FI'=>'FI','SE'=>'SE','PL'=>'PL','SK'=>'SK','CZ'=>'CZ','RU'=>'RU');
		$locales=array_intersect($_POST, $locals);
		//$locales = array('DE', 'NL', 'GB', 'FR', 'IT', 'ES', 'BE', 'IE', 'AT', 'DK', 'FI', 'SE', 'PL', 'SK', 'CZ');
	}
	else {
		$url = 'https://' . $environment . '.reebok.adidasgroup.demandware.net/on/demandware.servlet/webdav/Sites/Impex/src/upload/'. $folder .'/';
		$locals = array('DE', 'NL', 'GB', 'FR', 'IT', 'ES', 'BE', 'IE', 'AT', 'DK', 'FI', 'SE');
		
	}
}

if(!file_exists($filepath)) {
	echo 'Gorilla didn\'t find this file ';
		
}

// Prepare the file we are going to upload

$filesize = filesize($filepath);
$content = file_get_contents($filepath);


// The URL where we will upload to, this should be the exact path where the file
// is going to be placed
$remoteUrl = $url;

// Initialize cURL and set the options required for the upload. We use the remote
// path we specified together with the filename. This will be the result of the
// upload.

// I'm setting each option individually so it's easier to debug them when
// something goes wrong. When your configuration is done and working well
// you can choose to use curl_setopt_array() instead.

// Set the authentication mode and login credentials
//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);



foreach($locales as $name=>$value):
	$ch = curl_init();

	$pos = strrpos($filename, "."); 
	$adjustedFilename = substr($filename, 0, $pos) . '-' . $brand . '-' . $value . substr($filename, $pos);  	

	curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password );
	curl_setopt($ch, CURLOPT_URL, $remoteUrl . $adjustedFilename);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Gorilla/0.1');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: ' . mime_content_type($filepath),'Content-Length: ' . $filesize));
	curl_setopt($ch, CURLOPT_VERBOSE, false);	
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	if(curl_exec($ch)) {
		//add entry into the history DB

		$history=new History('xml',$username);
		$history->updateHistory($username,'xml');
		$history->updateActions($username,'xml',$filename,$environment);
		header('Location: success.php');


		//$cli->log($adjustedFilename . " uploaded.");
	} else {
		echo '<p>problem</p>';
		echo curl_error ( $ch );
		exit;
	}
	curl_close($ch);	
endforeach;

}
?>