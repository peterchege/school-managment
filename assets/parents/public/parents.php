<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/parent_function.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php
/**
 * This is a search for the whole parents table
 * seach by full names.
 */
$output = NULL;
//1. confirm that the lookup button has been submitted
if(isset($_POST['lookup'])){
    //take data from the textbox as it has been written
    $search = mysqli_sec($_POST['search']);

    $search_results_set = find_parents_by_search($search);

    //check if the results was found
    if(mysqli_num_rows($search_results_set) > 0){
        //run a while loop
        $output .= "<table class='table table-bordered'>";
        $output .= "<thead>";
        $output .= "<tr>";
        $output .= "<th>";
        $output .= "FULL NAMES";
        $output .= "</th>";
        $output .= "<th>";
        $output .= "PHONE NUMBER";
        $output .= "</th>";
        $output .= "<th>";
        $output .= "OFFICE NUMBER";
        $output .= "</th>";
        $output .= "<th>";
        $output .= "EMAIL ADDRESS";
        $output .= "</th>";
        $output .= "<th>";
        $output .= "RELATIONSHIP";
        $output .= "</th>";
        $output .= "<th>";
        $output .= "PROFILE";
        $output .= "</th>";
        $output .= "</tr>";
        $output .= "</thead>";
        while($search_results = mysqli_fetch_assoc($search_results_set)) {
            $output .= "<tbody>";
            $output .= "<tr>";
            $output .= "<td>";
            $output .= $search_results['full_names'];
            $output .= "</td>";
            $output .= "<td>";
            $output .= $search_results['phone'];
            $output .= "</td>";
            $output .= "<td>";
            $output .= $search_results['altphone'];
            $output .= "</td>";
            $output .= "<td>";
            $output .= $search_results['email'];
            $output .= "</td>";
            $output .= "<td>";
            $output .= $search_results['relationship'];
            $output .= "</td>";
            $output .= "<td>";
            $id = $search_results['id'];
            $output .= "<a href='parents/profile.php?parent=$id'>";
            $output .= "<i class='icon-user'></i> Profile";
            $output .= "</a>";
            $output .= "</td>";
            $output .= "</tr>";
            $output .= "</tbody>";
        }
        mysqli_free_result($search_results_set);
        $output .= "</table>";
    }else{
        $_SESSION['error_message'] = 'No results were found';
    }

}else{
    //the button has not been submitted
    $output .= "<table class='table table-bordered'>";
    $output .= "<thead>";
    $output .= "<tr>";
    $output .= "<th>";
    $output .= "FULL NAMES";
    $output .= "</th>";
    $output .= "<th>";
    $output .= "PHONE NUMBER";
    $output .= "</th>";
    $output .= "<th>";
    $output .= "OFFICE NUMBER";
    $output .= "</th>";
    $output .= "<th>";
    $output .= "EMAIL ADDRESS";
    $output .= "</th>";
    $output .= "<th>";
    $output .= "RELATIONSHIP";
    $output .= "</th>";
    $output .= "<th>";
    $output .= "PROFILE";
    $output .= "</th>";
    $output .= "</tr>";
    $output .= "</thead>";
    $parents_set = find_all_parents();
    while($parents = mysqli_fetch_assoc($parents_set)) {
        $output .= "<tbody>";
        $output .= "<tr>";
        $output .= "<td>";
        $output .= $parents['full_names'];
        $output .= "</td>";
        $output .= "<td>";
        $output .= $parents['phone'];
        $output .= "</td>";
        $output .= "<td>";
        $output .= $parents['altphone'];
        $output .= "</td>";
        $output .= "<td>";
        $output .= $parents['email'];
        $output .= "</td>";
        $output .= "<td>";
        $output .= $parents['relationship'];
        $output .= "</td>";
        $output .= "<td>";
        $id = $parents['id'];
        $output .= "<a href='parents/profile.php?parent=$id'>";
        $output .= "<i class='icon-user'></i> Profile";
        $output .= "</a>";
        $output .= "</td>";
        $output .= "</tr>";
        $output .= "</tbody>";
    }
    mysqli_free_result($parents_set);
    $output .= "</table>";
}
?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="../../home.php" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home
            </a>
            <a href="parents.php" class="current">Parents </a>
        </div>
        <h1>All Parents.</h1>
        <?php echo message(); ?>
    </div><!--content-header-->

    <div class="container-fluid"><hr/>
        <div class="row-fluid">
            <div class="span12">
                <?php $layout_context = $_SESSION['usertype']; ?>
                <?php if($layout_context == 'Admin'){?>
                    <?php echo message(); ?>
                <?php } ?>
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                           <a href="" class="btn btn-mini btn-default">
                               <i class="icon-refresh"></i>
                           </a>
                        </span>

                        <div id="search">
                            <form action="parents.php" method="post">
                                <input type="text" name="search" placeholder="Search parents here..."/>
                                <button name="lookup" type="submit" class="tip-bottom">
                                    <i class="icon-search icon-white"></i>
                                </button>
                            </form>
                        </div>


                        <h5>Parents table</h5>
                    </div>

                    <!--all students table-->
                    <div class="widget-content nopadding">


                        <?php echo $output; ?>

                    </div><!--widget-content tab-content nopadding-->
                </div>
            </div><!--Widget-Box-->
        </div><!--span12-->
    </div><!--row-fluid-->
</div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<!--Footer-part-->
<?php include '../../../includes/system/table_footer.php'; ?>
<!--end-Footer-part-->
<script src="../../js/jquery.min.js"></script>
<script src="../../js/jquery.ui.custom.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/jquery.uniform.js"></script>
<script src="../../js/select2.min.js"></script>
<script src="../../js/jquery.dataTables.min.js"></script>
<script src="../../js/matrix.js"></script>
<script src="../../js/matrix.tables.js"></script>
</body>
</html>


