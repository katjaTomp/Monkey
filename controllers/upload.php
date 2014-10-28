<?php
require('../includes/utilities.php');

if($_SESSION['login']!=TRUE){header("Location:../view/signin.html");}

if($_SERVER['REQUEST_METHOD']=='POST'){


$target_dir = $_SERVER['DOCUMENT_ROOT'].'/monkey/uploads/';
$target_dir = $target_dir .basename($_FILES["xml"]["name"]);

	if($_FILES['xml']['type']=='text/xml'){
		try{
			move_uploaded_file($_FILES["xml"]["tmp_name"],$target_dir);
	
			header('Location: importer.php?file='.$_FILES["xml"]["name"]);
	} 
		catch(Exception $e){
   			echo "<p>Sorry, there was an error uploading your file. Please,try again later.</p>";
	}
}
	else{
		echo '<p style="margin-left:200px;"> Please, upload only xml files.</p>';
	}

}

$pageTitle="Upload XML";

include('../includes/header.php');
include('../view/upload.html');
include('../includes/footer.php');
?>