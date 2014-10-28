<?php
//importer php
require('../includes/utilities.php');

if($_SESSION['login']!=TRUE){header("Location:../view/signin.html");}

include('../includes/header.php');
include('../view/import.php');
include('../includes/footer.php');
?>