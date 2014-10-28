<?php
//get the modules that are already assigned to the users
$query='SELECT module_name FROM access WHERE user_id='.$_GET['id'];
$stmt=$pdo->prepare($query);
$stmt->execute();

while($row=$stmt->fetch()){
  foreach($row as $value){
    $module[$value]=$value;
  }
}

?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
      
      <form  role="form" method="post" action="../controllers/edit-admin.php">
        <h2>Edit Profile</h2>
        <div class="form-group">
        <label for="email" class="col-lg-2 control-label">Email</label>  
        <input type="email" name="email" class="form-control" value="<?php echo $_GET['email'];?>">
      </div>
      <div class="form-group">
        <label for="password" class="col-lg-2 control-label">Gorilla Password</label>  
        <input type="password" name="gpass" class="form-control" placeholder="Gorilla Password">
      </div>
      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Firstname</label>  
        <input type="text" name="name" class="form-control" value="<?php echo $_GET['name'];?>">
      </div>
      <div class="form-group">
        <label for="lastname" class="col-lg-2 control-label">Lastname</label>  
        <input type="text" name="lastname" class="form-control" value="<?php echo $_GET['lastname'];?>">
      </div>
      <div class="form-group">
        <label for="status" class="col-lg-2" class="col-lg-2 control-label">Status</label>  
          <select name="status" style="width:30%"><?php switch ($_GET['active']) {
            case '1':
              echo '
               <option value="1">Active</option>
               <option value="0">Inactive</option>';
               break;
            
            default:
              echo '
              <option value="0">Inactive</option> 
              <option value="1">Active</option> ';
              break;
          }
              
          echo' </select>' ?>
      </div>
      
       <div class="form-group">
        <label for="realm-username" class="col-lg-2 control-label">User name</label>  
        <input type="text" name="realm-username" class="form-control" value="<?php echo $_GET['username'];?>">
      </div>
      
      <div class="form-group">
        <label for="modules" class="col-lg-2 control-label"> Modules</label>
      </div><br />
        <div class="checkbox">
          <label><input type="checkbox" name="header" value="header" <?php echo ($module['header']=="header"? 'checked': ''); ?>>Header</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="config" value="config" <?php echo ($module['config']=="config"? 'checked': ''); ?>>Configuration Management</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="user" value="user" <?php echo ($module['user']=="user"? 'checked': ''); ?>>Selected User Management</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="xml" value="xml" <?php echo ($module['xml']=="xml"? 'checked': ''); ?>>XML Upload</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="footer" value="footer" <?php echo ($module['footer']=="footer"? 'checked': ''); ?>>Footer Management</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="screen" value="screen" <?php echo ($module['screen']=="screen"? 'checked': ''); ?>>ScreenShot Management</label>
        
      </div>

    
        <input type="hidden" name="id"  value="<?php echo $_GET['id'];?>">
        <button class="btn btn-small btn-success" type="submit" style="margin-top:10px">Save</button>
        <a href="../controllers/users-browse.php" style="margin-top:10px" class="btn btn-small btn-success">Cancel</a>
      </div>
      </form>

    </div> <!-- /container -->

        </div>