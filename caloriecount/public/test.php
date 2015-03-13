<?php require_once("../include/session.php"); ?>
<?php require_once("../include/db_connect.php"); ?>
<?php require_once("../include/functions.php"); ?>

<?

$ftime = gettime();
//$timeformatted = date("D, d M Y", $time);

    // if (isset($_GET['time'])) {
    //   $gettime = htmlspecialchars($_GET['time']);
    //   $fdate = fdate($gettime);
    //   $adate = date("D, d M Y", $gettime);
    // } else{
    // $date = time();
    // $fdate = date("Ymd");
    // $adate = date("D, d M Y");
    // };


?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>test</title>
  <meta name="description" content="testpage in php">
  <meta name="author" content="hansjan">

  <!-- <link rel="stylesheet" href="css/styles.css?v=1.0"> -->
</head>

<body>

<?php

echo $ftime['formatteddate'] . "<br>"; 
echo $ftime['utctimestamp'] . "<br>"; 
echo $ftime['datemath'] . "<br>"; 

?>


<?php

$db = dbdate($_SESSION['userid'], $ftime['utctimestamp']);

  while ($dbdata = mysqli_fetch_assoc($db)){
    echo $dbdata['name'] . "<br>";
}

?>





</body>
</html>

<?php
  // 5. Close database connection
  if (isset($connection)) {
    mysqli_close($connection);
  }
?>
