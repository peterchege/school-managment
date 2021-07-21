<?php 
// navigation
function folder_nav(){
	//sidebar-menu
	//home link
	$output = "<div id=\"sidebar\"><a href=\"#\" class=\"visible-phone\">";
	$output .= "<i class=\"icon icon-home\"></i> Dashboard</a>";
	$output .= " <ul>";//Main UL -->
	$output .= "<li ><a href=\"../../../home.php\"><i class=\"icon icon-home\"></i>"; 
	$output .= "<span>Dashboard</span></a>"; 
	$output .= "</li>";

	
	//school admissions
	$output .= "<li class=\"submenu\">";
	$output .= "<a href=\"\">";
	$output .= "<i class=\"icon icon-signal\"></i>"; 
	$output .= "<span>School Admissions</span>";
	$output .= "</a>";
	$output .= "<ul>";
	$output .= "<li><a href=\"../../../admissions/public/interviews.php\">Interviews";
	$output .= "</a></li>";
	$layout_context = $_SESSION['usertype'];
	if($layout_context == 'Admin'){
		$output .= "<li><a href=\"../../../admissions/public/admitted_students.php\">";
		$output .= "Admitted students</a></li>";
	}
	$output .= "</ul></li>";

	//students
	$output .= "<li class=\"submenu\">";
	$output .= "<a href=\"\">";
	$output .= "<i class=\"icon icon-group\"></i>";
	$output .= "<span>Students</span>"; 
	$output .= "</a><ul>";
	$output .= "<li><a href=\"../../../students/public/new_students.php\">New Students</a></li>";
	$output .= "<li><a href=\"../../../students/public/students.php\">All Students </a></li>";
	$output .= "<li><a href=\"../../../students/public/male_students.php\">Male Students</a></li>";
	$output .= "<li><a href=\"../../../students/public/female_students.php\">";
	$output .= "Female Students</a></li>";
	$output .= "</ul></li>";


	
	//Parents
	$output .= "<li><a href=\"../../../parents/public/parents.php\"><i class=\"icon icon-user-md\"></i>";
	$output .= "<span>Parents</span></a></li>";

	//Alumni
	$output .= "<li><a href=\"../../../alumni/public/alumni.php\"><i class=\"icon icon-star-half\"></i>";
	$output .= "<span>Alumni</span></a></li>";

	//staff
	$output .= "<li class=\"submenu\">";
	$output .= "<a href=\"\">";
	$output .= "<i class=\"icon icon-legal\"></i>"; 
	$output .= "<span>Staff</span>"; 
	$output .= "</a><ul>";
	$output .= "<li><a href=\"../../../staff/public/teachers.php\">Teaching</a></li>";
	$output .= "<li><a href=\"../../../staff/public/non_teaching.php\">Non Teaching</a></li>";
	$output .= "</ul></li>";

	//classes
	$output .= "<li class=\"submenu\">";
	$output .= "<a href=\"\">";
	$output .= "<i class=\"icon icon-th-list\"></i>"; 
	$output .= "<span>Classes</span>"; 
	$output .= "<span class=\"label label-important\"></span>";
	$output .= "</a><ul>";
	$output .= "<li><a href=\"../../../classes/public/classes.php\">View All Classes </a></li>";
	$output .= "<li><a href=\"../../../classes/public/action/new_classes.php\">+ Add Class</a></li>";
	$output .= "</ul></li>";

	//transport
	$output .= "<li class=\"submenu\">";
	$output .= "<a href=\"\">";
	$output .= "<i class=\"icon icon-th-list\"></i>"; 
	$output .= "<span>Transportation</span>"; 
	$output .= "</a><ul>";
	$output .= "<li><a href=\"../../../transport/public/transport.php\">Transport </a></li>";
	$output .= "<li><a href=\"../../../transport/public/transport.php\">+Add Transport</a></li>";
	$output .= "</ul></li>";


	//fee modules
	$output .= "<li class=\"submenu\">";
	$output .= "<a href=\"\">";
	$output .= " <i class=\"icon icon-money\"></i>"; 
	$output .= "<span>Accounts</span>"; 
	$output .= "<span class=\"label label-important\"></span>";
	$output .= "</a><ul>";
	$output .= " <li><a href=\"../../../fees/public/fees.php\">Manage fee</a></li>";
	$output .= " <li><a href=\"../../../fees/public/structure.php\">Fee structure</a></li>";
	$output .= " <li><a href=\"../../../fees/public/payments.php\">Payments</a></li>";
	if($layout_context == 'Admin' || $layout_context == 'Accountant') {
		$output .= "<li><a href=\"../../../fees/public/reports.php\">Payments Reports</a></li>";
		$output .= "<li><a href=\"../../../fees/public/expenses.php\">Expenses</a></li>";
	}
	$output .= "</ul></li>";

	//inventories
	$output .= "<li class=\"submenu\"> <a href=\"\">";
	$output .= "<i class=\"icon icon-file\"></i>";
	$output .= "<span>Stock &amp; inventories Modules</span>";
	$output .= "<span class=\"label label-important\"></span></a>";
	$output .= "<ul><li>";
	$output .= "<a href=\"../../../inventories/public/actions.php\">Stocks</a></li>";
	$output .= "</ul></li></ul></div>";
	//sidebar-menu-->

	return $output;

}
//end of navigation 

 
//Query performance 
function confirm_query($string){
 	if(!$string){
 		die("Problem in the query");
 	}
 }
 function find_all_users(){
 	global $connection;

	$query = "SELECT * FROM users";
	$users_set= mysqli_query($connection, $query);
	confirm_query($users_set);
	return $users_set;
 }

 function find_user_by_id($user_id){
	global $connection;

	$safe_user_id= mysqli_real_escape_string($connection, $user_id);

	$query= "SELECT * FROM users ";
	$query .= "WHERE id = {$safe_user_id}";
	$user_set = mysqli_query($connection, $query);
	confirm_query($user_set);
	if($user= mysqli_fetch_assoc($user_set)){
		return $user;
	}else{
		return null;
	}

}

function find_selected_fields(){
	global $current_user_id;
	
	if(isset($_GET["user"])){
		$current_user_id= find_user_by_id($_GET["user"]);
	}else{
		$current_user_id = null;	
	}
}

?>