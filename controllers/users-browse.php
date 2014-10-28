<?php


// browser users only Admin can access
require('../includes/utilities.php');

if($_SESSION['login']!=TRUE){header("Location:../view/signin.html");}

include('../includes/header.php');
include('../view/user-browser.html');

$query='SELECT id,lastname, name, email, active,username FROM user';
$stmt=$pdo->prepare($query);
$stmt->execute();
$row=$stmt->fetch();

   
   

   while($row=$stmt->fetch()){
      
      echo '<tr>';
   	echo '<th data-field="lastname">'.$row['lastname'].'</th>';
   	echo '<th data-field="firstname">'.$row['name'].'</th>';
   	echo '<th data-field="email">'.$row['email'].'</th>';
   	echo '<th data-field="status">'.$row['active'].'</th>';
   	echo '<th data-field="action"><a href="edit-admin-reviewed.php?id='.$row['id'].'&email='.$row['email'].'&name='.$row['name'].'&lastname='.$row['lastname'].'&active='.$row['active'].'&username='.$row['username'].'">Edit</a></th>';
   	echo '</tr>';

	}
echo '</table>';
echo '<form  role="form" method="post" action="add-user.php">';
echo '<button class="btn btn-small btn-success" type="submit" style="margin-top:10px">Add User</button>';
echo '</div>';

?>