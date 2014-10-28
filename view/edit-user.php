<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

      <form  role="form" method="post" action="../controllers/edit-user-reviewed.php">
        <h2>Edit Profile</h2>
        <div class="form-group">
        <label for="email" class="col-lg-2 control-label">Email</label>  
        <input type="email" name="email" class="form-control" value="<?php echo $_SESSION['email'];?>">
      </div>
      <div class="form-group">
        <label for="password" class="col-lg-2 control-label">Gorilla Password</label>  
        <input type="password" name="gpass" class="form-control" placeholder="Gorilla Password">
      </div>
      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Firstname</label>  
        <input type="text" name="name" class="form-control" value="<?php echo $_SESSION['name'];?>">
      </div>
      <div class="form-group">
        <label for="lastname" class="col-lg-2 control-label">Lastname</label>  
        <input type="text" name="lastname" class="form-control" value="<?php echo $_SESSION['lastname'];?>">
      </div>
      
       <div class="form-group">
        <label for="realm-username" class="col-lg-2 control-label">User name</label>  
        <input type="text" name="realm-username" class="form-control" value="<?php echo $_SESSION['username'];?>">
      </div>
      
        <button class="btn btn-small btn-success" type="submit" style="margin-top:10px">Save</button>
      </form>

    </div> <!-- /container -->

        </div>
