<?php

session_start();

function message(){
	if(isset($_SESSION["message"])){
		$output = "<div class=\"alert alert-success\">";
		$output .= htmlentities($_SESSION["message"]);
		$output .= "</div>";

		//clear message after use
		$_SESSION["message"] = null;
		return $output;

	}elseif(isset($_SESSION["error_message"])){
		$output = "<div class=\"alert alert-danger\">";
		$output .= htmlentities($_SESSION["error_message"]);
		$output .= "</div>";

		//clear message after use
		$_SESSION["error_message"] = null;
		return $output;
	}

}



function errors(){
	if(isset($_SESSION["errors"])){
		$errors = $_SESSION["errors"];
		
		//clear message after use
		$_SESSION["errors"] = null;
		return $errors;

	}
}


?>
