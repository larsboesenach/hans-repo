<?php

if(isset($_POST['add_week'])){
     $last_week_ts = strtotime($_POST['last_week']);
     $display_week_ts = $last_week_ts + (3600 * 24 * 7);
} else if (isset($_POST['back_week'])) {
     $last_week_ts = strtotime($_POST['last_week']);
     $display_week_ts = $last_week_ts - (3600 * 24 * 7);
} else {
	$dagvandeweek = (date("w") - 1) *  (3600*24);
    $roundedtime =  floor(time() / (3600 * 24)) * 3600 * 24;
    $display_week_ts = $roundedtime - $dagvandeweek;
}
//problem with wintertijd/zomertijd
if (($display_week_ts - 1445810400) === 0){
	$display_week_ts = $display_week_ts + 3600;

}
if (($display_week_ts - 1427670000) === 0){
	$display_week_ts = $display_week_ts - 3600;
}

$week_start = date('d-m-Y', $display_week_ts);

?>
<form name="move_weeks" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="last_week" value="<? echo $week_start; ?>" />
<td colspan="7">
<input type="submit" name="back_week" value="<" />
week <?php echo date('W', $display_week_ts); ?>
<input type="submit" name="add_week" value=">" />
</td>
</form>

<?php

for ($i = 0; $i < 7; $i++) {
	echo "<p>";
    $current_day_ts = $display_week_ts + ($i * 3600 *24);
    echo date('D, d-m-Y', $current_day_ts) . " [" . totalcalories($current_day_ts, $_SESSION['userid']) . "]"; 

    if (date("Ymd", $current_day_ts) < date("Ymd")) {
	echo " verleden, " . '<a href="?time=' . $current_day_ts . '">' . "view past log </a>";
} elseif (date("Ymd", $current_day_ts) > date("Ymd")) {
	echo "";
}
if (date("Ymd", $current_day_ts) == date("Ymd")) {
	echo " vandaag, " . '<a href="?time=' . $current_day_ts . '">' . "view log </a>";
}
    echo "</p>";

}
?>