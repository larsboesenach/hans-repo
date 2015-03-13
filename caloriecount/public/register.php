<?php require_once("../include/db_connect.php"); ?>
<?php require_once("../include/functions.php"); ?>
<?php

//check if the form is submitted
if (isset($_POST['submit'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	$email = htmlspecialchars($_POST['email']);
	$message = "";
	//passwordcheck
	if (!empty($password)){
		$message .= checkvariation($password);
		$passwordcrypted = encrypt_password($password);
	}else {
		$message .= "Geen wachtwoord ingevoerd.<br>";
	};

	//emailcheck
	if (!empty($email)){
		$message .= emailcheck($email);
		}else {
		$message .= "Geen email ingevoerd.<br>";
	};

	//namecheck
	if (!empty($username)){
		$message .= namecheck($username);
		}else {
		$message .= "Geen gebruikersnaam ingevoerd.<br>";
	};
	//when there are no errors, enter values in to database
	if (empty($message)){
		$query = "INSERT INTO users (";
		$query .= " username, password, email";
		$query .= ") VALUES (";
		$query .= "'{$username}', '{$passwordcrypted}', '{$email}'";
		$query .= ")";
		$result = mysqli_query($connection, $query);

		if ($result) {
			$message = "je bent geregistreerd<br>";
			header('location: login.php');
			exit;
			} else {
			$message = "invoer ging fout<br>";
			};
	};
};


?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>register</title>
  <meta name="description" content="registreerpage in php">
  <meta name="author" content="hansjan">

  <!-- <link rel="stylesheet" href="css/styles.css?v=1.0"> -->
</head>

<body>
<!-- password instructions -->
<p>
password should contain 1 capitial letter and 1 number, minimum length is 8 characters. recommended to have ate least 10 characters.
</p>
<?php 
//output error message as plain text
if (isset($message)){
		echo "$message";
};
	?>

<form action="register.php" method="post">
	username:
	<input type="text" name="username" value="<?php if(isset($username)){echo $username;}; ?>"><br>
	password: 
	<input type="password" name="password" value=""><br>
	email:
	<input type="text" name="email" value="<?php if(isset($email)){echo $email;}; ?>"><br>
	<input type="submit" name="submit" value="submit">
</form>

</body>
</html>

<?php
  // 5. Close database connection
	if (isset($connection)) {
	  mysqli_close($connection);
	};
?>
