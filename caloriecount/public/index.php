<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connect.php"); ?>
<?php require_once("../include/functions.php"); ?>
<?php loggedin_check(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>index</title>
  
  <!-- lars -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/main.css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800,400italic' rel='stylesheet' type='text/css'> 
  <link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>

  <!-- //lars -->


  <meta name="description" content="loginpage in php">
  <meta name="author" content="hansjan">

  <!-- <link rel="stylesheet" href="css/styles.css?v=1.0"> -->
</head>

<body>
<div class="page-wrap">
  <div class="Homepage">

    <div class="Sidebar-wrap">
      <div class="box1">
        <?php include("../include/main/counter.php"); ?>
      </div>
      <div class="box2">
        <?php include("../include/main/sidebar.php"); ?>
      </div>
    </div><!-- sidebar-wrap -->

    <div class="SidebarFix">
      <div class="Content-wrap">
        <div class="Top-bar">
            index page
          <?php 
          echo welcome();       
          ?>
         <a href="logout.php"> log out </a>
         my account
        </div> <!-- top-bar -->

        <div class="Content-entry">
        <?php include("../include/main/log_read.php"); ?>
        </div> <!-- content-entry -->

      </div> <!-- content-wrap -->
    </div> <!-- sidebarfix -->
  </div><!-- Homepage -->
</div><!-- Page-wrap -->


</body>
</html>

<?php
  // 5. Close database connection
  if (isset($connection)) {
    mysqli_close($connection);
  }
?>