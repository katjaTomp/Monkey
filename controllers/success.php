<?php
require('../includes/utilities.php');

if($_SESSION['login']!=TRUE){header("Location:../view/signin.html");}

include('../includes/header.php');
include('../view/success.html');
include('../includes/footer.php');




?>