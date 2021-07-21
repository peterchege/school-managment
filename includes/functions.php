<?php 
	
	function redirect_to($new_location){
 		header("Location:" . $new_location);
 		exit;
 	}



	function form_errors($errors= array()){
		$output = null;

		if(!empty($errors)){
			$output .= "<div class=\"alert alert-warning\">";
			$output .= "<div class=\"errors_header\">Please fix the following errors:</div>";
			$output .= "<ul>";
			foreach($errors as $key => $error){
				$output .= "<li>{$error}</li>";
			 }
			$output .= "</ul>";
			$output .= "</div>";
			 	}
			return $output;
	}


	function mysqli_sec($string){
		global $connection;

		$secure_string = mysqli_real_escape_string($connection, $string);
		return $secure_string;
	}


	function check_query($string){
	 	if(!$string){
	 		die("Problem in the query");
	 	}
 	}

	 function password_encrypt($password){

		$hash_format = "$2y$10$"; //tells php to blowfish with a cost of 10

		$salt_length = 22; //Blowfish salts should be 22-characters or more
		$salt = generate_salt($salt_length);//generate something that is unique.

		$format_and_salt = $hash_format . $salt;
		$hash = crypt($password, $format_and_salt);
		return $hash;
	}

	function generate_salt($length){
		//Not 100% unique
		//md5 returns 32 characters
		$unique_random_string = md5(uniqid(mt_rand(), true));

		//valid characters for a salt are [a-zA-Z0-9./]
		$base64_string = base64_encode($unique_random_string);

		//But not + which is valid in base64 encoding
		$modified_base64_string = str_replace('+', '.', $base64_string);

		//truncate the string to the correct lenght
		$salt = substr($modified_base64_string, 0, $length);

		return $salt;
	}

	function password_check($password, $existing_hash){
		$hash= crypt($password, $existing_hash);
		if($hash === $existing_hash){
			return true;
		}else{
			return false;
		}
	}
	

	function find_user_by_username($username){
		global $connection;

		$safe_username= mysqli_real_escape_string($connection, $username);

		$query= "SELECT * FROM users ";
		$query .= "WHERE username= '{$safe_username}'";
		$username_set = mysqli_query($connection, $query);
		check_query($username_set);
		if($username= mysqli_fetch_assoc($username_set)){
			return $username;
		}else{
			return null;
		}

	}


	function attempt_login($username, $password){
		$user = find_user_by_username($username);
		if($user){
			if(password_check($password, $user["password"])){
				return $user;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	

	function logged_in(){
		return isset($_SESSION["user_id"]);
	}
	

	function confirm_logged_in(){
		if(!logged_in()){
			redirect_to("../index.php");
		}
	}
	
	function confirm_folder_logged_in(){
		if(!logged_in()){
			redirect_to("../../../index.php");
		}
	} 

	function confirm_other_folder_logged_in(){
		if(!logged_in()){
			redirect_to("../../../../index.php");
		}
	}

	function check_login_time()
	{
		if (isset($_SESSION['user_id'])) {
			if ((time() - $_SESSION['last_time']) > 3600) {
				redirect_to('logout.php');
			}
		}
	}

	function check_profile_login_time()
	{
		if (isset($_SESSION['user_id'])) {
			if ((time() - $_SESSION['last_time']) > 3600) {
				redirect_to('../../logout.php');
			}
		}
	}

	function check_profile_folder_login_time()
	{
		if (isset($_SESSION['user_id'])) {
			if ((time() - $_SESSION['last_time']) > 3600) {
				redirect_to('../../../logout.php');
			}
		}
	}

