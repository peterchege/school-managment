<?php
	$errors= array();

	function fieldname_as_text($fieldname){
		$fieldname= str_replace("_", " ", $fieldname);
		$fieldname= ucfirst($fieldname);
		return $fieldname;
	}
	//*presence
	//*check out the presence of a value
	//* can be used on a web form
	function has_presence($value){
		return isset($value) && $value !== "";
		}

	function validate_presences($required_fields){
		global $errors;
		//use an assoc array
		foreach($required_fields as $field){
			$value = trim($_POST[$field]);
			if(!has_presence($value)){
				$errors[$field] = fieldname_as_text($field) . " can't be blank";
			}

		}

	}

	//* string length 
	//max length 
	function has_max_length($value, $max){
		return strlen($value) <= $max;
	}

	//for a form submission case
	function validate_max_length($fields_with_max_lengths){
		global $errors;
		//use an assoc array
		foreach($fields_with_max_lengths as $field => $max){
			$value = trim($_POST[$field]);
			if(!has_max_length($value, $max)){
				$errors[$field] = fieldname_as_text($field) . " is too long";
			}

		}

	}

	//inclusion in aset
	function has_inclusion_in($value, $set){
		return in_array($value, $set);
	}

	//process errors

	


?>
