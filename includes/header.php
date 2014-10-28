<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo (isset($pageTitle))? $pageTitle: 'Home'?></title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap-version-1.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/offcanvas.css" rel="stylesheet">
     <link href="../css/uploader.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          
          <a class="navbar-brand" href="#">&#35;Gorilla FrameWork</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
            <li><a href="about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="">Overview</a></li>
            <?php if($_SESSION['xml']=='xml') echo '<li><a href="../controllers/upload.php">XML Uploader</a></li>';?>
            <li><a href="./Dashboard Template for Bootstrap_files/Dashboard Template for Bootstrap.html">Analytics</a></li>
            <li><a href="./Dashboard Template for Bootstrap_files/Dashboard Template for Bootstrap.html">Export</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="../controllers/edit-user.php">Edit My Profile</a></li>
            <?php if($_SESSION['type']=='admin') echo '<li><a href="../controllers/users-browse.php">Edit Users Profiles</a></li>';?>
            <?php if($_SESSION['login']==true) echo '<li><a href="../controllers/logout.php">Log out</a></li>';?>
          </ul>
        </div>
        <!--Testing content goes below-->


        

     

    

