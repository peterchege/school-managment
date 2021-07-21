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
	$output .= "<li><a href=\"../../../admissions/public/interviews.php\">Interviews</a></li>";
	$layout_context = $_SESSION['usertype'];
	if($layout_context == 'Admin'){
		$output .= "<li><a href=\"../../../admissions/public/admitted_students.php\">Admitted students";
		$output .= "</a></li>";
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
	$output .= "<li><a href=\"../../../students/public/board.php\">Students Board";
	$output .= "</a></li>";
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

	//lunch
	$output .= "<li class=\"submenu\">";
	$output .= "<a href=\"\">";
	$output .= "<i class=\"icon icon-beaker\"></i>";
	$output .= "<span>Lunch</span>";
	$output .= "</a><ul>";
	$output .= "<li><a href=\"../../../lunch/public/lunch.php\">Lunch</a></li>";
	$output .= "<li><a href=\"../../../lunch/public/payments.php\">Payments</a></li>";
	$output .= "</ul></li>";

	//transport
	$output .= "<li class=\"submenu\">";
	$output .= "<a href=\"\">";
	$output .= "<i class=\"icon icon-th-list\"></i>"; 
	$output .= "<span>Transportation</span>"; 
	$output .= "</a><ul>";
	$output .= "<li><a href=\"../../../transport/public/transport.php\">Transport </a></li>";
	if($layout_context == 'Admin' || $layout_context == 'Accountant') {
		$output .= "<li><a href=\"../../../transport/public/payments.php\">Payments</a></li>";
	}
	$output .= "</ul></li>";



	//fee modules
	$output .= "<li class=\"submenu\">";
	$output .= "<a href=\"\">";
	$output .= " <i class=\"icon icon-leaf\"></i>"; 
	$output .= "<span>Fee Modules</span>"; 
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
 function find_all_classes(){
 	global $connection;

	$query = "SELECT * FROM classes";
	$class_set= mysqli_query($connection, $query);
	confirm_query($class_set);
	return $class_set;
 }

function find_all_teachers(){
	global $connection;

	$query = "SELECT * FROM  teaching_staff";
	$teachers_set= mysqli_query($connection, $query);
	confirm_query($teachers_set);
	return $teachers_set;
}


function find_teacher_by_id($teacher_id){
	global $connection;

	$safe_teacher_id= mysqli_real_escape_string($connection, $teacher_id);

	$query= "SELECT * FROM teaching_staff ";
	$query .= "WHERE id = {$safe_teacher_id}";
	$teacher_set = mysqli_query($connection, $query);
	confirm_query($teacher_set);
	if($teacher= mysqli_fetch_assoc($teacher_set)){
		return $teacher;
	}else{
		return null;
	}

}

function find_teaching_details($teacher_id){
	global $connection;

	$safe_teacher_id= mysqli_real_escape_string($connection, $teacher_id);

	$query= "SELECT * FROM teachers_classes ";
	$query .= "WHERE teacher_id = {$safe_teacher_id}";
	$details_set = mysqli_query($connection, $query);
	confirm_query($details_set);
	return $details_set;
}

function find_details_by_id($details_id){
	global $connection;

	$safe_details_id= mysqli_real_escape_string($connection, $details_id);

	$query= "SELECT * FROM teachers_classes ";
	$query .= "WHERE id = {$safe_details_id}";
	$details_set = mysqli_query($connection, $query);
	confirm_query($details_set);
	
	if($details= mysqli_fetch_assoc($details_set)){
		return $details;
	}else{
		return null;
	}
}

function find_all_non_teaching_staff(){
	global $connection;

	$query = "SELECT * FROM  non_teaching";
	$staff_set= mysqli_query($connection, $query);
	confirm_query($staff_set);
	return $staff_set;
}

function find_non_teaching_staff_by_id($Staff_id){
	global $connection;

	$safe_staff_id= mysqli_real_escape_string($connection, $Staff_id);

	$query= "SELECT * FROM non_teaching ";
	$query .= "WHERE id = {$safe_staff_id}";
	$staff_set = mysqli_query($connection, $query);
	confirm_query($staff_set);
	if($staff= mysqli_fetch_assoc($staff_set)){
		return $staff;
	}else{
		return null;
	}
}

function find_selected_fields(){
	global $current_teacher_id;
	global $current_staff_id;

	if(isset($_GET["teacher"])){
		$current_teacher_id= find_teacher_by_id($_GET["teacher"]);
		$current_staff_id= null;
	}elseif (isset($_GET["staff"])) {
		$current_staff_id = find_non_teaching_staff_by_id($_GET["staff"]);
		$current_teacher_id= null;
	}else{
		$current_teacher_id = null;
		$current_staff_id = null;
	}
}

?>