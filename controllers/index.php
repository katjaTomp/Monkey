<?php

//index.php is the framework's homepage 

require('../includes/utilities.php');

if($_SESSION['login']!=TRUE){header("Location:../view/signin.html");}




include('../includes/header.php');
include('../view/index.html');
include('../includes/footer.php');
?>