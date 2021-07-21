<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/parent_function.php'; ?>
<?php find_selected_fields(); ?>
<?php 
if(!$current_parent_id)
  {
    redirect_to("../parents.php");
  } 
?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="../parents.php" class="current">Parents</a> 
    </div>
    <h1>Parents.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
	<hr>
  
    <div class="row-fluid">
      <?php $layout_context = $_SESSION['usertype']; ?>
      <?php if($layout_context == 'Admin'){?>
        <?php echo message(); ?>
      <?php } ?>
      <div class="widget-box">
        <div class="widget-title">
          <span class="icon"><i class="icon-user"></i></span>
          <div class="fr">
            <a href="../parents.php" class="btn btn-warning btn-mini"><i class="icon-arrow-left"></i> BACK</a>
            <?php if($layout_context == 'Admin'){?>
            <a href="edit.php?parent=<?php echo urlencode($current_parent_id["id"]);?>" class="btn btn-info btn-mini">
              <i class="icon-edit"></i>
            </a>

            <a href="delete.php?parent=<?php echo urlencode($current_parent_id["id"]); ?>" onclick= "return confirm('Are you Sure you..?!');" class="btn btn-danger btn-mini"><i class="icon-trash"></i>
            </a>
            <?php } ?>
          </div>
          <h5>Parents/Gurdian profile</h5>
        </div>
        <div class="widget-content nopadding">
          <!--profile picture-->


          <div class="widget-box">
            <div class="widget-title">
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab1">Personal</a></li>
                <li><a data-toggle="tab" href="#tab2">Contacts</a></li>
                <li><a data-toggle="tab" href="#tab3">Location</a></li>
              </ul>
            </div>
            <div class="widget-content tab-content">
              <div id="tab1" class="tab-pane active">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th>FULL NAMES :</th>
                      <td><?php echo htmlentities($current_parent_id["full_names"]); ?></td>
                    </tr>
                    <tr>
                      <th>ID NUMBER :</th>
                      <td><?php echo htmlentities($current_parent_id["id_number"]); ?></td>
                    </tr>
                    <tr>
                      <th>RELATIONSHIP :</th>
                      <td><?php echo htmlentities($current_parent_id["relationship"]); ?></td>
                    </tr>
                    <tr>
                      <th>GENDER :</th>
                      <td><?php echo htmlentities($current_parent_id["gender"]); ?></td>
                    </tr>
                    <tr>
                      <th>OCCUPATION :</th>
                      <td><?php echo htmlentities($current_parent_id["occupation"]); ?></td>
                    </tr>
                    <tr>
                      <th>MARITAL STATUS :</th>
                      <td><?php echo htmlentities($current_parent_id["marital"]); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div id="tab2" class="tab-pane">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th>PHONE NUMBER :</th>
                      <td><?php echo htmlentities($current_parent_id["phone"]); ?></td>
                    </tr>
                    <tr>
                      <th>OFFICE NUMBER :</th>
                      <td><?php echo htmlentities($current_parent_id["altphone"]); ?></td>
                    </tr>
                    <tr>
                      <th>EMAIL ADDRESS :</th>
                      <td><?php echo htmlentities($current_parent_id["email"]); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div id="tab3" class="tab-pane">
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <th>LOCAL ADDRESS :</th>
                      <td><?php echo htmlentities($current_parent_id["address"]); ?></td>
                    </tr>
                    <tr>
                      <th>NATIONALITY :</th>
                      <td><?php echo htmlentities($current_parent_id["nationality"]); ?></td>
                    </tr>
                    <tr>
                      <th>COUNTY :</th>
                      <td><?php echo htmlentities($current_parent_id["county"]); ?></td>
                    </tr>
                    <tr>
                      <th>RESIDENTIAL AREA :</th>
                      <td><?php echo htmlentities($current_parent_id["residence"]); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>  
        </div><!--widget-content nopadding-->
      </div><!--widget-box-->
    </div><!--row-fluid-->
  </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include'../../../../includes/system/footer.php'; ?>
