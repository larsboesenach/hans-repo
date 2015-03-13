<?php
function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	};

function loggedin_check(){
		if (!isset($_SESSION['ingelogd'])) {
	  	header("Location: " . 'http://localhost:8888/caloriecount/public/login.php');
		};
};

function check_presence($value) {
	return isset($value) && $value !== "";
};



function checkvariation($password){
  $pattern = "/.*^(?=.{8,50})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/";
   if(preg_match($pattern,$password)){
   	$rating = "";
   	$length = strlen($password);
		if ($length >=10) {
			$rating = "";
		};
   }else{
   	$rating = "Your password is not safe enough<br>";
   };
   	return $rating;
};

function emailcheck($email){
	global $connection;
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$query = "SELECT * FROM users where email = '$email' LIMIT 1";
	$result = mysqli_query($connection, $query);
	$emailresult = mysqli_fetch_assoc($result);
	if ($emailresult) {
 		$error = "emailadress is not available or already in use<br>";
	} else {
 		$error = "";
 };

}else{
	$error = "no valid email adress<br>";
};
return $error;

};


function namecheck($username1){
	global $connection;
	$user = $username1;
	$query = "SELECT * FROM users where username = '$user' LIMIT 1";
	$result = mysqli_query($connection, $query);
	$name = mysqli_fetch_assoc($result);
	if ($name) {
 		$error = "username is not available or already in use<br>";
	} else {
 		$error = "";
 };

return $error;
};

//copied from Lynda.com tutorial
function encrypt_password($password){
  	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	  $salt_length = 22; 					// Blowfish salts should be 22-characters or more
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
		return $hash;
	};
	
function generate_salt($length) {
	  // Not 100% unique, not 100% random, but good enough for a salt
	  // MD5 returns 32 characters
	  $unique_random_string = md5(uniqid(mt_rand(), true));
	  
		// Valid characters for a salt are [a-zA-Z0-9./]
	  $base64_string = base64_encode($unique_random_string);
	  
		// But not '+' which is valid in base64 encoding
	  $modified_base64_string = str_replace('+', '.', $base64_string);
	  
		// Truncate string to the correct length
	  $salt = substr($modified_base64_string, 0, $length);
	  
		return $salt;
	};

	
function password_check($password, $existing_hash) {
		// existing hash contains format and salt at start
	  $hash = crypt($password, $existing_hash);
	  if ($hash === $existing_hash) {
	    return true;
	  } else {
	    return false;
	  }
}
//end of copied parts

function welcome(){
	if (isset($_SESSION['ingelogd'])) {
            echo " status: ingelogd, username: " . $_SESSION['username'];
          } else {
            echo " status: niet ingelogd";
          }
}

function fdate($gettime){
return date("Ymd", $gettime);
}

function logbyid($userid){
	global $connection;
	$query  = "SELECT * ";
    $query .= "FROM log ";
    $query .= "WHERE userid = $userid ";
    return mysqli_query($connection, $query);
};

function dbdate($userid, $date){
	$timemin = floor($date / (3600 * 24)) * 3600 * 24;
	$timemax = $timemin + 86400;

	global $connection;
	$query  = "SELECT * ";
    $query .= "FROM log ";
  	$query .= "WHERE timestamp BETWEEN $timemin ";
    $query .= "AND $timemax ";
    $query .= "AND userid = $userid ";

    return mysqli_query($connection, $query);
};


function totalcalories($current_day_ts, $userid){
	$timemin = floor($current_day_ts / (3600 * 24)) * 3600 * 24;
	$timemax = $timemin + 86400;

	global $connection;
	$totalintake1 = 0;
	$query  = "SELECT * ";
    $query .= "FROM log ";
  	$query .= "WHERE timestamp BETWEEN $timemin ";
    $query .= "AND $timemax ";
    $query .= "AND userid = $userid ";
    $dataq = mysqli_query($connection, $query);

	while ($data = mysqli_fetch_assoc($dataq)){
          $totalcalories1 =  ($data["calories"] *  $data["amount"]);
          $totalintake1 = ($totalintake1 + $totalcalories1);
		};
	return $totalintake1;
	};

function gettime(){

	 if (isset($_GET['time'])) {
      $utctimestamp = htmlspecialchars($_GET['time']);
      $datemath = fdate($utctimestamp);
      $formatteddate = date("D, d M Y", $utctimestamp);
    } else{
    $utctimestamp = time();
     $datemath = date("Ymd");
  	 $formatteddate = date("D, d M Y");
    };
return array("utctimestamp" => "$utctimestamp", "datemath" =>  "$datemath", "formatteddate" =>  "$formatteddate" );
}

?>