<?php

$logtime = gettime();
    $totalintake = 0;

?>


<!-- explanation -->
<p>
here is an overview of what you have eaten on <?php echo $logtime['formatteddate']; ?>
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
      
$logtimedb = dbdate('10', $logtime['utctimestamp']);

  while ($logdata = mysqli_fetch_assoc($logtimedb)){

   		?>
        <li>
        	<?php 
          $totalcalories =  ($logdata["calories"] *  $logdata["amount"]);
          $totalintake = ($totalintake + $totalcalories);

        		echo 
        		$logdata["name"] . " " .
        		$totalcalories . " kcal" .
        		' change entry <a href="log/log_change.php?id=' . 
        		$logdata["id"] . 
        		'">  [change] </a> '
        		; 

        	?>
        </li>
     		<?php
           	};

           if (empty($logdata)) {
$message = "no log entries found";
              $past = $logdata['timestamp']; };
        	?>
	</ul>


    <?php
        mysqli_free_result($logtimedb);
    ?>

total amount of calories: <?php echo $totalintake; ?>

add new log entry: <a href="log/log_add.php<?php if(isset($past)){echo "?time=" . $past; }; ?>"> click here</a>
