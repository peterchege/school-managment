<?php
function nav(){
    $output = "<div id=\"sidebar\"><a href=\"#\" class=\"visible-phone\">";
    $output .= "<i class=\"icon icon-home\"></i> Dashboard</a>";
    $output .= " <ul>";//Main UL -->
    $output .= "<li ><a href=\"home.php\"><i class=\"icon icon-home\"></i>";
    $output .= "<span>Dashboard</span></a>";
    $output .= "</li>";

    //school admissions
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= "<i class=\"icon icon-signal\"></i>";
    $output .= "<span>School Admissions</span>";
    $output .= "</a>";
    $output .= "<ul>";
    $output .= "<li><a href=\"admissions/public/students/students.php?interview=1\">Interviews</a></li>";
    $layout_context = $_SESSION['usertype'];
    if($layout_context == 'Admin' || $layout_context == 'Accountant'){
        $output .= "<li><a href=\"students/public/admit_students/new_student.php\">Admit students</a></li>";
    }
    $output .= "</ul></li>";

    //students
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= "<i class=\"icon icon-group\"></i>";
    $output .= "<span>Students</span>";
    $output .= "</a><ul>";
    $output .= "<li><a href=\"students/public/new_students.php\">New Students</a></li>";
    $output .= "<li><a href=\"students/public/students.php\">All Students </a></li>";
    $output .= "<li><a href=\"students/public/board.php\">Students Board</a></li>";
    $output .= "</ul></li>";

    //Parents
    $output .= "<li><a href=\"parents/public/parents.php\"><i class=\"icon icon-user-md\"></i>";
    $output .= "<span>Parents</span></a></li>";

    //Alumni
    $output .= "<li><a href=\"alumni/public/alumni.php\"><i class=\"icon icon-star-half\"></i>";
    $output .= "<span>Former Students </span></a></li>";

    //staff
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= "<i class=\"icon icon-legal\"></i>";
    $output .= "<span>Staff</span>";
    $output .= "</a><ul>";
    $output .= "<li><a href=\"staff/public/teachers.php\">Teaching</a></li>";
    $output .= "<li><a href=\"staff/public/non_teaching.php\">Non Teaching</a></li>";
    $output .= "</ul></li>";

    //classes
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= "<i class=\"icon icon-th-list\"></i>";
    $output .= "<span>Classes</span>";
    $output .= "</a><ul>";
    $output .= "<li><a href=\"classes/public/classes.php\">View All Classes </a></li>";
	if($layout_context == 'Admin' || $layout_context == 'Accountant') {
    $output .= "<li><a href=\"classes/public/classes.php\">+ Add Class</a></li>";
	}
    $output .= "</ul></li>";

    //lunch
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= "<i class=\"icon icon-beaker\"></i>";
    $output .= "<span>Lunch</span>";
    $output .= "</a><ul>";
    $output .= "<li><a href=\"lunch/public/lunch.php\">Lunch </a></li>";
    if($layout_context=='Admin' || $layout_context=='Accountant'){
        $output .= "<li><a href=\"lunch/public/payments.php\">Payments</a></li>";
    }
    $output .= "</ul></li>";


    //transport
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= "<i class=\"icon  icon-truck\"></i>";
    $output .= "<span>Transportation</span>";
    $output .= "</a><ul>";
    $output .= "<li><a href=\"transport/public/transport.php\">Transport </a></li>";
    if($layout_context == 'Admin' || $layout_context == 'Accountant') {
        $output .= "<li><a href=\"transport/public/payments.php\">Payments</a></li>";
        $output .= "<li><a href=\"transport/public/report.php\">Reports</a></li>";

    }
    $output .= "</ul></li>";


    //fee modules
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= " <i class=\"icon icon-money\"></i>";
    $output .= "<span>Accounts</span>";
    $output .= "</a><ul>";
	if($layout_context=='Admin' || $layout_context=='Accountant'){
    $output .= " <li><a href=\"fees/public/fees.php\">Manage fee</a></li>";
    $output .= " <li><a href=\"fees/public/structure.php\">Fee structure</a></li>";
    $output .= " <li><a href=\"fees/public/lunch.php\">Lunch structure</a></li>";
    $output .= " <li><a href=\"fees/public/transport.php\">Transport structure</a></li>";
    $output .= " <li><a href=\"fees/public/payments.php\">Payments</a></li>";
    $output .= "<li><a href=\"fees/public/expenses.php\">Expenses</a></li>";
	}
    $output .= "</ul></li>";


    //reports
        $output .= "<li class=\"submenu\">";
        $output .= "<a href=\"\">";
        $output .= " <i class=\"icon icon-filter\"></i>";
        $output .= "<span>Reports</span>";
        $output .= "</a><ul>";
		$output .= " <li><a href=\"reports/public/interview-report.php\">Interview Reports</a></li>";
        $output .= " <li><a href=\"reports/public/daily.php\">Date and status Reports</a></li>";
		if($layout_context == 'Admin' || $layout_context == 'Accountant') {
        $output .= " <li><a href=\"reports/public/date-class.php\">Date and class Reports</a></li>";
        $output .= " <li><a href=\"reports/public/date-type.php\">Date and Fee type</a></li>";
        $output .= " <li><a href=\"reports/public/class.php\">Class Reports</a></li>";
        $output .= " <li><a href=\"reports/public/class-type.php\">Type and Class Reports</a></li>";
        $output .= " <li><a href=\"reports/public/class-term.php\">Class and Term Reports</a></li>";
        $output .= " <li><a href=\"reports/public/class-report.php\">General Class Reports</a></li>";
        $output .= " <li><a href=\"reports/public/term.php\">Termly Reports</a></li>";
        $output .= " <li><a href=\"reports/public/term-type.php\">Termly and Type Reports.</a></li>";
        $output .= " <li><a href=\"reports/public/term-type-status.php\">Type, Termly and Status Reports.</a></li>";
        $output .= " <li><a href=\"reports/public/reports.php\">General Reports</a></li>";
		}
        $output .= "</ul></li>";


    //inventories
    $output .= "<li class=\"submenu\"> <a href=\"\">";
    $output .= "<i class=\"icon icon-file\"></i>";
    $output .= "<span>Stock &amp; inventories Modules</span>";
    $output .= "<span class=\"label label-important\"></span></a>";
    $output .= "<ul><li>";
	if($layout_context == 'Admin' || $layout_context == 'Accountant') {
		$output .= "<a href=\"inventories/public/stocks.php\">Stocks</a></li>";
        $output .= " <li><a href=\"inventories/public/payments.php\">Payments</a></li>";
        $output .= " <li><a href=\"inventories/public/reports.php\">Reports</a></li>";
    }
    $output .= "</ul></li></ul></div>";
    //sidebar-menu-->

    return $output;
}

function navigation(){
    //sidebar-menu
    //home link
    $layout_context = $_SESSION['usertype'];
    $output = "<div id=\"sidebar\"><a href=\"#\" class=\"visible-phone\">";
    $output .= "<i class=\"icon icon-home\"></i> Dashboard</a>";
    $output .= " <ul>";//Main UL -->
    $output .= "<li ><a href=\"../../home.php\"><i class=\"icon icon-home\"></i>";
    $output .= "<span>Dashboard</span></a>";
    $output .= "</li>";

    //school admissions
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= "<i class=\"icon icon-signal\"></i>";
    $output .= "<span>School Admissions</span>";
    $output .= "</a>";
    $output .= "<ul>";
    $output .= "<li><a href=\"../../admissions/public/students/students.php?interview=1\">";
    $output .= "Interviews</a></li>";
    if($layout_context == 'Admin' || $layout_context == 'Accountant') {
        $output .= "<li><a href=\"../../students/public/admit_students/new_student.php\">";
        $output .= "Admit Students";
        $output .= "</a></li>";
    }
    $output .= "</ul></li>";

    //students
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= "<i class=\"icon icon-group\"></i>";
    $output .= "<span>Students</span>";
    $output .= "</a><ul>";
    $output .= "<li><a href=\"../../students/public/new_students.php\">New Students</a></li>";
    $output .= "<li><a href=\"../../students/public/students.php\">All Students </a></li>";
    $output .= "<li><a href=\"../../students/public/board.php\">Students Board</a></li>";
    $output .= "</ul></li>";


    //Parents
    $output .= "<li><a href=\"../../parents/public/parents.php\"><i class=\"icon icon-user-md\"></i>";
    $output .= "<span>Parents</span></a></li>";

    //Alumni
    $output .= "<li><a href=\"../../alumni/public/alumni.php\"><i class=\"icon icon-star-half\"></i>";
    $output .= "<span>Former Students</span></a></li>";

    //staff
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= "<i class=\"icon icon-legal\"></i>";
    $output .= "<span>Staff</span>";
    $output .= "</a><ul>";
    $output .= "<li><a href=\"../../staff/public/teachers.php\">Teaching</a></li>";
    $output .= "<li><a href=\"../../staff/public/non_teaching.php\">Non Teaching</a></li>";
    $output .= "</ul></li>";

    //classes
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= "<i class=\"icon icon-th-list\"></i>";
    $output .= "<span>Classes</span>";
    $output .= "</a><ul>";
    $output .= "<li><a href=\"../../classes/public/classes.php\">View All Classes </a></li>";
	if($layout_context == 'Admin' || $layout_context == 'Accountant') {
    $output .= "<li><a href=\"../../classes/public/classes.php\">+ Add Class</a></li>";
	}
    $output .= "</ul></li>";

    //lunch
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= "<i class=\"icon icon-beaker\"></i>";
    $output .= "<span>Lunch</span>";
    $output .= "</a><ul>";
    $output .= "<li><a href=\"../../lunch/public/lunch.php\">Lunch</a></li>";
    if($layout_context == 'Admin' || $layout_context == 'Accountant') {
        $output .= "<li><a href=\"../../lunch/public/payments.php\">Payments</a></li>";
    }
    $output .= "</ul></li>";

    //transport
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= "<i class=\"icon icon-th-list\"></i>";
    $output .= "<span>Transportation</span>";
    $output .= "</a><ul>";
    $output .= "<li><a href=\"../../transport/public/transport.php\">Transport </a></li>";
    if($layout_context == 'Admin' || $layout_context == 'Accountant') {
        $output .= "<li><a href=\"../../transport/public/payments.php\">Payments</a></li>";
        $output .= "<li><a href=\"../../transport/public/report.php\">Reports</a></li>";
    }
    $output .= "</ul></li>";

    //fee modules
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= " <i class=\"icon icon-money\"></i>";
    $output .= "<span>Accounts</span>";
    $output .= "</a><ul>";
	if($layout_context == 'Admin' || $layout_context == 'Accountant') {
    $output .= " <li><a href=\"../../fees/public/fees.php\">Manage fee</a></li>";
    $output .= " <li><a href=\"../../fees/public/structure.php\">Fee structure</a></li>";
    $output .= " <li><a href=\"../../fees/public/lunch.php\">Lunch structure</a></li>";
    $output .= " <li><a href=\"../../fees/public/transport.php\">Transport structure</a></li>";
    $output .= " <li><a href=\"../../fees/public/payments.php\">Payments</a></li>";
    $output .= "<li><a href=\"../../fees/public/expenses.php\">Expenses</a></li>";
	}
    $output .= "</ul></li>";

    //reports
        $output .= "<li class=\"submenu\">";
        $output .= "<a href=\"\">";
        $output .= " <i class=\"icon icon-filter\"></i>";
        $output .= "<span>Reports</span>";
        $output .= "</a><ul>";
		$output .= " <li><a href=\"../../reports/public/interview-report.php\">Interview Report</a></li>";
        $output .= " <li><a href=\"../../reports/public/daily.php\">Date and Status Reports</a></li>";
		if($layout_context == 'Admin' || $layout_context == 'Accountant') {
        $output .= " <li><a href=\"../../reports/public/date-class.php\">Date and class Reports</a></li>";
        $output .= " <li><a href=\"../../reports/public/date-type.php\">Date and Fee type</a></li>";
        $output .= " <li><a href=\"../../reports/public/class.php\">Class Reports</a></li>";
        $output .= " <li><a href=\"../../reports/public/class-type.php\">Type and Class Reports</a></li>";
        $output .= " <li><a href=\"../../reports/public/class-term.php\">Class and Term Reports</a></li>";
        $output .= " <li><a href=\"../../reports/public/class-report.php\">General Class Reports</a></li>";
        $output .= " <li><a href=\"../../reports/public/term.php\">Termly Reports</a></li>";
        $output .= " <li><a href=\"../../reports/public/term-type.php\">Termly and Type Reports.</a></li>";
        $output .= " <li><a href=\"../../reports/public/term-type-status.php\">Type, Termly and Status Reports.</a></li>";
        $output .= " <li><a href=\"../../reports/public/reports.php\">General Reports</a></li>";
		}
        $output .= "</ul></li>";

    //inventories
    $output .= "<li class=\"submenu\"> <a href=\"\">";
    $output .= "<i class=\"icon icon-file\"></i>";
    $output .= "<span>Stock &amp; inventories Modules</span>";
    $output .= "<span class=\"label label-important\"></span></a>";
    $output .= "<ul><li>";
    $output .= "<a href=\"../../inventories/public/stocks.php\">Stocks</a></li>";
    if($layout_context == 'Admin' || $layout_context == 'Accountant') {
        $output .= " <li><a href=\"../../inventories/public/payments.php\">Payments</a></li>";
        $output .= " <li><a href=\"../../inventories/public/reports.php\">Reports</a></li>";
    }
    $output .= "</ul></li></ul></div>";
    //sidebar-menu-->

    return $output;
}

/**
 * @return string
 */
function navigation_nav(){
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
    $output .= "<li><a href=\"../../../admissions/public/students/students.php?interview=1\">Interviews</a></li>";
    $layout_context = $_SESSION['usertype'];
    if($layout_context == 'Admin' || $layout_context == 'Accountant') {
        $output .= "<li><a href=\"../../../students/public/admit_students/new_student.php\">Admitted students";
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
    $output .= "<span>Former Students </span></a></li>";


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
    $output .= "</a><ul>";
    $output .= "<li><a href=\"../../../classes/public/classes.php\">View All Classes </a></li>";
	if($layout_context == 'Admin' || $layout_context == 'Accountant') {
    $output .= "<li><a href=\"../../../classes/public/classes.php\">+ Add Class</a></li>";
	}
    $output .= "</ul></li>";

    //lunch
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= "<i class=\"icon icon-beaker\"></i>";
    $output .= "<span>Lunch</span>";
    $output .= "</a><ul>";
    $output .= "<li><a href=\"../../../lunch/public/lunch.php\">Lunch</a></li>";
	if($layout_context == 'Admin' || $layout_context == 'Accountant') {
    $output .= "<li><a href=\"../../../lunch/public/payments.php\">Payments</a></li>";
	}
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
        $output .= "<li><a href=\"../../../transport/public/report.php\">Reports</a></li>";
    }
    $output .= "</ul></li>";


    //fee modules
    $output .= "<li class=\"submenu\">";
    $output .= "<a href=\"\">";
    $output .= " <i class=\"icon icon-money\"></i>";
    $output .= "<span>Accounts</span>";
    $output .= "<span class=\"label label-important\"></span>";
    $output .= "</a><ul>";
	if($layout_context == 'Admin' || $layout_context == 'Accountant') {
    $output .= " <li><a href=\"../../../fees/public/fees.php\">Manage fee</a></li>";
    $output .= " <li><a href=\"../../../fees/public/structure.php\">Fee structure</a></li>";
    $output .= " <li><a href=\"../../../fees/public/lunch.php\">Lunch structure</a></li>";
    $output .= " <li><a href=\"../../../fees/public/transport.php\">Transport structure</a></li>";
    $output .= " <li><a href=\"../../../fees/public/payments.php\">Payments</a></li>";
    $output .= "<li><a href=\"../../../fees/public/expenses.php\">Expenses</a></li>";
	}

    $output .= "</ul></li>";

    //Reports
        $output .= "<li class=\"submenu\">";
        $output .= "<a href=\"\">";
        $output .= " <i class=\"icon icon-filter\"></i>";
        $output .= "<span>Reports</span>";
        $output .= "<span class=\"label label-important\"></span>";
        $output .= "</a><ul>";
		$output .= " <li><a href=\"../../../reports/public/interview-report.php\">Interview Reports</a></li>";
        $output .= " <li><a href=\"../../../reports/public/daily.php\">Date and Status Reports</a></li>";
		if($layout_context == 'Admin' || $layout_context == 'Accountant') {
        $output .= " <li><a href=\"../../../reports/public/date-class.php\">Date and Class Reports</a></li>";
        $output .= " <li><a href=\"../../../reports/public/date-type.php\">Date and Fee type</a></li>";
        $output .= " <li><a href=\"../../../reports/public/class.php\">Class Reports</a></li>";
        $output .= " <li><a href=\"../../../reports/public/class-type.php\">Type and Class Reports</a></li>";
        $output .= " <li><a href=\"../../../reports/public/class-term.php\">Class and Term Reports</a></li>";
        $output .= " <li><a href=\"../../../reports/public/class-report.php\">General Class Reports</a></li>";
        $output .= " <li><a href=\"../../../reports/public/term.php\">Termly Reports</a></li>";
        $output .= " <li><a href=\"../../../reports/public/term-type.php\">Termly and Type Reports.</a></li>";
        $output .= " <li><a href=\"../../../reports/public/term-type-status.php\">Type, Termly and Status Reports.</a></li>";
        $output .= " <li><a href=\"../../../reports/public/reports.php\">General Reports</a></li>";
		}
        $output .= "</ul></li>";


    //inventories
    $output .= "<li class=\"submenu\"> <a href=\"\">";
    $output .= "<i class=\"icon icon-file\"></i>";
    $output .= "<span>Stock &amp; inventories Modules</span>";
    $output .= "<span class=\"label label-important\"></span></a>";
    $output .= "<ul><li>";
    $output .= "<a href=\"../../../inventories/public/stocks.php\">Stocks</a></li>";
    if($layout_context == 'Admin' || $layout_context == 'Accountant') {
        $output .= " <li><a href=\"../../../inventories/public/payments.php\">Payments</a></li>";
        $output .= " <li><a href=\"../../../inventories/public/reports.php\">Reports</a></li>";
    }
    $output .= "</ul></li></ul></div>";
    //sidebar-menu-->

    return $output;

}