<?php
function dashboard_header(){
	$layout_context = '';
	if(isset($layout_context)){
		$layout_context = $_SESSION['usertype'];
	}
	$header = "<!DOCTYPE html>";
	$header .= "<html lang=\"en\">";
	$header .= "<head><title>Sacred Heart " .$layout_context. "</title>";
	$header .= "<meta charset=\"UTF-8\">";
	$header .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
	$header .= "<link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">";
	$header .= "<link rel=\"stylesheet\" href=\"css/bootstrap-responsive.min.css\">";
	$header .= "<link rel=\"stylesheet\" href=\"css/fullcalendar.css\" />";
	$header .= "<link rel=\"stylesheet\" href=\"css/uniform.css\" />";
	$header .= "<link rel=\"stylesheet\" href=\"css/select2.css\" />";
	$header .= "<link rel=\"stylesheet\" href=\"css/matrix-style.css\" />";
	$header .= "<link rel=\"stylesheet\" href=\"css/matrix-media.css\" />";
	$header .= "<link href=\"font-awesome/css/font-awesome.css\" rel=\"stylesheet\" />";
	$header .= "<link rel=\"stylesheet\" href=\"css/jquery.gritter.css\" />";
	$header .= "<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>";
	$header .= "</head><body>";

	$header .= "<!--Header-part-->";
	$header .= "<div id=\"header\">";
	$header .= "<h1><a href=\"home.php\">Sacred Heart</a></h1>";
	$header .= "</div>";
	$header .= "<!--close-Header-part-->"; 
	$header .= "<!--top-Header-menu-->";
	$header .= "<div id=\"user-nav\" class=\"navbar navbar-inverse\">";
	$header .= "<ul class=\"nav\">";
	$header .= "<li class=\"dropdown\" id=\"profile-messages\">";
	$header .= "<a title=\"\" href=\"#\""; 
	$header .= "data-toggle=\"dropdown\" data-target=\"#profile-messages\"";
	$header .= "class=\"dropdown-toggle\">";
	$header .= "<i class=\"icon icon-user\">";
	$header .= "</i><span class=\"text\"> Welcomes ".$layout_context."</span><b class=\"caret\"></b></a>";
	$header .= "<ul class=\"dropdown-menu\">";
	if($layout_context == 'Admin'){
		$header .= "<li class=\"divider\"></li>";
		$header .= "<li><a href=\"users/public/users.php\"><i class=\"icon-check\"></i>";
		$header .= " Manage Users</a></li>";
	}
	$header .= "<li class=\"divider\"></li>";
	$header .= "<li><a href=\"logout.php\"><i class=\"icon-key\"></i> Log Out</a></li>";
	$header .= "</ul></li>";

	$header .= "<!--//Not needed"; 
	$header .= "<li class=\"dropdown\" id=\"menu-messages\">";
	$header .= "<a href=\"#\" data-toggle=\"dropdown\" data-target=\"#menu-messages\""; 
	$header .= "class=\"dropdown-toggle\">";
	$header .= "<i class=\"icon icon-envelope\"></i>"; 
	$header .= "<span class=\"text\"> Messages</span>"; 
	$header .= "<span class=\"label label-important\">5</span><b class=\"caret\"></b></a>";
	$header .= "<ul class=\"dropdown-menu\">";
	$header .= "<li><a class=\"sAdd\" title=\"\" href=\"#\">";
	$header .= "<i class=\"icon-plus\"></i> new message</a></li>";
	$header .= "<li class=\"divider\"></li>";
	$header .= "<li><a class=\"sInbox\" title=\"\" href=\"#\">";
	$header .= "<i class=\"icon-envelope\"></i> inbox</a></li>";
	$header .= "<li class=\"divider\"></li>";
	$header .= "<li><a class=\"sOutbox\" title=\"\" href=\"#\">";
	$header .= "<i class=\"icon-arrow-up\"></i> outbox</a></li>";
	$header .= "<li class=\"divider\"></li>";
	$header .= "<li><a class=\"sTrash\" title=\"\" href=\"#\">";
	$header .= "<i class=\"icon-trash\"></i> trash</a></li>";
	$header .= "</ul></li>";
	$header .= "-->";

	$header .= "<li class=\"\"><a title=\"\" href=\"logout.php\">";
	$header .= "<i class=\"icon icon-signout\"></i>"; 
	$header .= "<span class=\"text\"> Logout</span></a></li>";
	$header .= "</ul></div>";


	return $header;
	}

	function confirm_query($string){
	 	if(!$string){
	 		die("Problem in the query");
	 	}
 	}

 	function find_all_events(){
		global $connection;

		$query = "SELECT * FROM events";
		$events_set= mysqli_query($connection, $query);
		confirm_query($events_set);
		return $events_set;
	}
	function find_all_notification(){
		global $connection;

		$query = "SELECT * FROM notifications";
		$notifications_set= mysqli_query($connection, $query);
		confirm_query($notifications_set);
		return $notifications_set;
	}

	function find_all_available_students(){
		global $connection;

		$query = "SELECT * FROM students";
		$students_set= mysqli_query($connection, $query);
		confirm_query($students_set);
		return $students_set;
	}

	function find_all_new_students(){
		global $connection;

		$query = "SELECT * FROM students ";
		$query .= "WHERE status = 'New'";
		$students_set= mysqli_query($connection, $query);
		confirm_query($students_set);
		return $students_set;
	}

	function find_all_students(){
		global $connection;

		$query = "SELECT * FROM students";
		$students_set= mysqli_query($connection, $query);
		confirm_query($students_set);
		return $students_set;
	}

	function find_all_structure(){
		global $connection;

		$query = "SELECT * FROM fee_structure";
		$structure_set= mysqli_query($connection, $query);
		confirm_query($structure_set);
		return $structure_set;
	}

	function find_all_payments(){
		global $connection;

		$query = "SELECT * FROM fee_payments";
		$payments_set= mysqli_query($connection, $query);
		confirm_query($payments_set);
		return $payments_set;
	}

	function find_all_paid(){
		global $connection;

		$query = "SELECT * FROM fee_payments ";
		$query .= "WHERE status = 'FULL PAID'";
		$paid_set= mysqli_query($connection, $query);
		confirm_query($paid_set);
		return $paid_set;
	}

	function find_all_unpaid(){
		global $connection;

		$query = "SELECT * FROM fee_payments ";
		$query .= "WHERE status = 'WITH BALANCE'";
		$paid_set= mysqli_query($connection, $query);
		confirm_query($paid_set);
		return $paid_set;
	}

function find_all_classes(){
	global $connection;

	$query = "SELECT * FROM classes";
	$classes_set = mysqli_query($connection, $query);
	confirm_query($classes_set);

	return $classes_set;
}

function find_all_students_for_class($class){
	global $connection;

	$safe_class = mysqli_real_escape_string($connection, $class);

	$query = "SELECT * FROM students WHERE class = '{$safe_class}'";
	$class_set = mysqli_query($connection, $query);
	confirm_query($class_set);

	return $class_set;
}

function find_structure_of_students_by_class($school, $term){
	global $connection;

	$safe_school = mysqli_real_escape_string($connection, $school);
	$safe_term = mysqli_real_escape_string($connection, $term);

	$query = "SELECT * FROM fee_structure ";
	$query .= "WHERE school= '{$safe_school}' AND term = '{$safe_term}'";
	$structure_set= mysqli_query($connection, $query);
	confirm_query($structure_set);
	return $structure_set;

}

function find_payments_of_students_by_class($class, $term){
	global $connection;

	$safe_class = mysqli_real_escape_string($connection, $class);
	$safe_term = mysqli_real_escape_string($connection, $term);

	$query = "SELECT * FROM fee_payments ";
	$query .= "WHERE class= '{$safe_class}' AND term = '{$safe_term}'";
	$structure_set= mysqli_query($connection, $query);
	confirm_query($structure_set);
	return $structure_set;

}