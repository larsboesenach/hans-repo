<?php require_once("../include/functions.php"); ?>
<?php
	session_start();
	$_SESSION["ingelogd"] = null;
	$_SESSION["username"] = null;
	redirect_to("login.php");
?>
