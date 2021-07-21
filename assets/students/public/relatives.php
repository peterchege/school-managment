<?php require_once'../../../includes/initialization.php'; ?>
<?php require_once '../includes/student_function.php'; ?>
<?php find_selected_fields(); ?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../includes/system/head.php'; ?>
<?php echo navigation(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="../../home.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="students.php" class="current">students</a> </div>
    <h1>Students.</h1>
  </div><!--content-header-->

   <div class="container-fluid">
   <hr/>
    <div class="row-fluid">
      <div class="span12">
          <?php $layout_context = $_SESSION['usertype'] ?>
          <?php if($layout_context == 'Admin'){?>
              <?php echo message(); ?>
          <?php } ?>
          <div class="widget-box">
              <?php if($layout_context == 'Admin'){?>
                  <a href="parents/new_parent.php?student=<?php echo urlencode($current_student_admin["admin"]);  ?>" class="btn btn-mini btn-primary">
                      <i class="icon-plus"></i> ADD
                  </a>
              <?php } ?>
              <a href="profile.php?student=<?php echo urlencode($current_student_admin["admin"]); ?>" class="btn btn-mini btn-success">
                  <i class="icon-user"></i> STUDENT PROFILE
              </a>
        </div>
      </div>
    </div>

    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
          	<span class="icon"><i class="icon-th"></i></span>
            <span class="icon_right"><a href="students.php">
            <i class="icon-arrow-left"></i></a></span>
            <h5>Students relatives</h5>
          </div><!--widget-title-->
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Full Names</th>
                  <th>Phone Number</th>
                  <th>Office Number</th>
                  <th>Email</th>
                  <th>Relation</th>
                  <th>Profile</th>
                  
                </tr>
              </thead>
              <?php $parent_set= find_parents_for_student($_GET["student"]); ?>
              <?php while($parent= mysqli_fetch_assoc($parent_set)){ ?>
              <tbody>
                <tr>
                  <td><?php echo htmlentities($parent["full_names"]); ?></td>
                  <td><?php echo htmlentities($parent["phone"]); ?></td>
                  <td><?php echo htmlentities($parent["altphone"]); ?></td>
                  <td><?php echo htmlentities($parent["email"]); ?></td>
                  <td><?php echo htmlentities($parent["relationship"]); ?></td>
                  <td>
                    <a href="../../parents/public/parents/profile.php?parent=<?php echo urlencode($parent["id"]); ?>">
                      <span class="profile"><i class="icon-user"></i></span>
                      profile
                    </a>
                  </td>
                </tr>
              </tbody>
              <?php } ?>
              <?php mysqli_free_result($parent_set); ?>
            </table>
          </div><!--widget-content nopadding-->
        </div><!--widget-box-->
      </div><!--span12-->
    </div><!--row-fluid--> 
   </div><!--container-fluid-->
</div><!--content-->
<?php include'../../../includes/system/footer.php'; ?>