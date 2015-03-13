<?php require_once("../../include/session.php"); ?>
<?php require_once("../../include/db_connect.php"); ?>
<?php require_once("../../include/functions.php"); ?>
<?php loggedin_check(); ?>
<?php


    if (isset($_GET['time'])) {
      $gettime = htmlspecialchars($_GET['time']);
      $fdate = date("Ymd", $gettime);
      $adate = date("D, d M Y", $gettime);
    } else{
    $date = time();
    $fdate = date("Ymd");
    $adate = date("D, d M Y");
    };
    $totalintake = 0;
    $userid = $_SESSION['userid'];
    logbyid($userid);


?>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>view calorie intake</title>
  <meta name="description" content="database practise with php">
  <meta name="author" content="hansjan">
  <!-- <link rel="stylesheet" href="css/styles.css?v=1.0"> -->
</head>

<body>

<!-- explanation -->
<p>
here is an overview of what you have eaten on <?php echo $adate; ?>
</p>
<?php 
//output error message as plain text
if (isset($message)){
		echo "$message";
};
	?>

<br>

	<ul>
    	<?php
    		while($log = mysqli_fetch_assoc($result)) {
        if(date("Ymd", $log['timestamp']) == $fdate){
   		?>
        <li>
        	<?php 
          $totalcalories =  ($log["calories"] *  $log["amount"]);
          $totalintake = ($totalintake + $totalcalories);

        		echo 
        		$log["name"] . " " .
        		$totalcalories . " kcal" .
        		' change entry <a href="log_change.php?id=' . 
        		$log["id"] . 
        		'">  [change] </a> '
        		; 

        	?>
        </li>
     		<?php
           	} else {
              echo "no log entries found";
            };	
          };
        	?>
	</ul>


    <?php
        mysqli_free_result($result);
    ?>

total amount of calories: <?php echo $totalintake; ?>

add new log entry: <a href="log_add.php">click here</a>


</body>
</html>

<?php
  // Close database connection
	if (isset($connection)) {
	  mysqli_close($connection);
	};
?>
