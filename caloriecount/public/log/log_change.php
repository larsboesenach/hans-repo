<?php require_once("../../include/session.php"); ?>
<?php require_once("../../include/db_connect.php"); ?>
<?php require_once("../../include/functions.php"); ?>
<?php loggedin_check(); ?>

<?php

//check if the ID is submitted
if (isset($_GET['id'])) {
	//empty error message
	$message = "";
	$id = htmlspecialchars($_GET['id']);


	//when there are no errors, enter values in to database
	if (isset($_POST['submit']) && empty($message)){
		//load data from submitted form
	$name = htmlspecialchars($_POST['name']);
	$tags = htmlspecialchars($_POST['tags']);
	$amount = htmlspecialchars($_POST['amount']);
	$calories = htmlspecialchars($_POST['calories']);
	$type = htmlspecialchars($_POST['type']);
		$updatequery = "UPDATE log SET ";
		$updatequery .= "name = '$name', ";
		$updatequery .=	"tags = '$tags', ";
		$updatequery .= "amount= '$amount', ";
		$updatequery .= "calories = '$calories', ";
		$updatequery .= "type = '$type' ";
		$updatequery .= " WHERE id = $id";
		$updatequery .= " LIMIT 1";
		$update = mysqli_query($connection, $updatequery);

		if ($update) {
			$message .= "input verwerkt<br>";
			} else {
			$message .= "invoer ging fout<br>";
			$message .= "<pre>" . $updatequery . "</pre>";

			};
	};
 	$query  = "SELECT * ";
    $query .= "FROM log ";
    $query .= "WHERE id >= '$id'";
    $query .= " LIMIT 1";
    $result = mysqli_query($connection, $query);
	$data = mysqli_fetch_assoc($result);
	//here I will add input check
	
} else {
	header('location:' . 'log_add.php');
};


?>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>update items to database</title>
  <meta name="description" content="add items to database in php">
  <meta name="author" content="hansjan">

  <!-- <link rel="stylesheet" href="css/styles.css?v=1.0"> -->
</head>

<body>

<!-- instructions -->
<p>
Change item in log
</p>
<?php 

//output error message as plain text
if (isset($message)){
		echo "$message";
};
	?>
<br>

<!-- form -->

<form action="log_change.php?id=<?php echo $id; ?>" method="post">
	name of food:<br>
	<input type="text" name="name" value="<?php echo $data['name']; ?>">(example: banana) <br><br>
	tags, enter with comma:<br>
	<input type="text" name="tags" value="<?php echo $data['tags']; ?>"> (example: organic, fruit) <br><br>
	amount of calories that is in 1 serving of item:<br>
	<input type="text" name="calories" value="<?php echo $data['calories']; ?>"> (example: 1 banana is 90 kcal)<br><br>
	how much did you have?:<br>
	<input type="text" name="amount" value="<?php echo $data['amount']; ?>">(example: Only half a banana, so 0.5)<br><br>
	what kind of input is it?<br>
	<input type="radio" name="type" value="1" <?php if ($data['type'] == "1") {
		echo "CHECKED"; }; ?>> intake <br>
	<input type="radio" name="type" value="2" <?php if ($data['type'] == "2") {
		echo "CHECKED"; }; ?>> excersize <br>
	<input type="submit" name="submit" value="submit">
</form>

</body>
</html>

<?php
  // Close database connection
	if (isset($connection)) {
	  mysqli_close($connection);
	};
?>