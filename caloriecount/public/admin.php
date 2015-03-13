<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connect.php"); ?>
<?php require_once("../include/functions.php"); ?>
<?php loggedin_check(); ?>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>inloggen</title>
  <meta name="description" content="loginpage in php">
  <meta name="author" content="hansjan">

  <!-- <link rel="stylesheet" href="css/styles.css?v=1.0"> -->
</head>

<body>

<?php if (isset($message)){
      echo "$message";
    };

    if (isset($_SESSION['ingelogd'])) {
  echo " status: ingelogd<br>" . $_SESSION['username'];
  } else {
  echo " status: niet ingelogd";

  }
?>
<p>
index page
</p>
</body>
</html>

<?php
  // 5. Close database connection
  if (isset($connection)) {
    mysqli_close($connection);
  }
?>
