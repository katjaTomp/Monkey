<?php
//script for sing in validation

require('../includes/utilities.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
  
   
  $email=$_POST['email'];
  $password=sha1($_POST['password']);
//check whether the email input is correct

  if(!check_email_address($email)){header('Location: ../view/signing.html');}
  
//sign in query
  $q='SELECT id,type,active,name,lastname,username FROM user WHERE email= :email AND passgorilla= :password';
  $query_params=array(':email'=>$email,':password'=>$password);

  $stmt = $pdo->prepare($q); 
  $stmt->execute($query_params); 
            
    if($row=$stmt->fetch()){
      foreach($row as $colmn=>$value){

        $_SESSION[$colmn]=$value;
     }
    $_SESSION['login']=TRUE;
    $_SESSION['email']=$email;


//access query
  $access=new Access();
  if($access->accessXML($_SESSION['id'])){

    $_SESSION['xml']='xml';
  }
  header('Location: index.php');  
                
  
        
  
  }
}  
        
?>