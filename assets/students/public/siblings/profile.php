<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php find_selected_fields(); ?>
<?php 
if(!$current_sibling_id)
  {
    redirect_to("../students.php");
  } 
?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="../students.php" class="current">students</a> 
    </div>
    <h1>Students.</h1>
  </div><!--content-header-->


  <div class="container-fluid">
  <hr>
    <div class="row-fluid">
      <?php $layout_context = $_SESSION['usertype'] ?>
      <?php if($layout_context == 'Admin'){?>
        <?php echo message(); ?>
      <?php } ?>
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon"><i class="icon-user"></i></span>
          <div class="fr">
            <a href="../profile.php?student=<?php echo urlencode($current_sibling_id["admin_number"]); ?>" class="btn btn-mini btn-warning">
              BACK <i class="icon-arrow-left"></i>
            </a>
            <?php if($layout_context == 'Admin'){?>
                <a href="edit.php?sibling=<?php echo urlencode($current_sibling_id["id"]);?>" class="btn btn-mini btn-info">
                  <i class="icon-wrench"></i>
                </a>
    `           <a href="delete.php?sibling=<?php echo urlencode($current_sibling_id["id"]); ?>" onclick= "return confirm('Are you Sure you..?!');" class="btn btn-mini btn-danger">
                    <i class="icon-trash"></i>
                </a>
            <?php } ?>
          </div>
          <h5>sibling profile</h5>
        </div>
        <div class="widget-content nopadding">
          <!--profile picture-->

                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th>FULL NAMES :</th>
                      <td><?php echo htmlentities($current_sibling_id["full_names"]); ?></td>
                    </tr>
                    <tr>
                      <th>AGE :</th>
                      <td><?php echo htmlentities($current_sibling_id["age"]); ?></td>
                    </tr>
                    <tr>
                      <th>GENDER :</th>
                      <td><?php echo htmlentities($current_sibling_id["gender"]); ?></td>
                    </tr>
                    <tr>
                      <th>RELATIONSHIP :</th>
                      <td><?php echo htmlentities($current_sibling_id["relationship"]); ?></td>
                    </tr>

                    <tr>
                      <th>SCHOOL :</th>
                      <td><?php echo htmlentities($current_sibling_id["school"]); ?></td>
                    </tr>
                
                  </tbody>
                </table>

        </div><!--widget-content nopadding-->
      </div><!--widget-box-->
    </div><!--row-fluid-->
  </div><!--container-fluid-->

</div><!--content-->
<!--Footer-part-->
<?php include'../../../../includes/system/footer.php'; ?>