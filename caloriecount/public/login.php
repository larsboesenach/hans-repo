<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connect.php"); ?>
<?php require_once("../include/functions.php"); ?>

<?

if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $password = $_POST['password'];


  if (empty($formerror)) {


    $query = "SELECT * FROM users WHERE (username = '$username') LIMIT 1";
    $finalquery = mysqli_query($connection, $query);
    $result = mysqli_fetch_assoc($finalquery);

    if ($result) {
      $passwordcrypted = password_check($password, $result['password']);
    if ($passwordcrypted) {
      //$message = "inloggen gelukt";
      header ("location: ". " index.php");
      $_SESSION['username'] = $username;
      $_SESSION['userid'] = $result['id'];
      $_SESSION['ingelogd'] = true;
      } else {
        $message = "iets ging fout";
      };
    };
  };
};

?>

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
  echo " status: ingelogd<br> ";
  } else {
  echo " status: niet ingelogd";
  }

  //print_r($result);

?>
  
<form action="login.php" method="post">
  username:
  <input type="text" name="username" value="<?php if(isset($username)){echo $username;}; ?>"><br>
  password: 
  <input type="password" name="password" value=""><br>
  <input type="submit" name="submit" value="submit">
</form>

<a href="register.php"> registreer een account </a>

</body>
</html>

<?php
  // 5. Close database connection
  if (isset($connection)) {
    mysqli_close($connection);
  }
?>
