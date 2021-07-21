<?php require_once('../../../../includes/initialization.php'); ?>
<?php require_once '../../includes/staff_function.php'; ?>
<?php find_selected_fields(); ?>
<?php if(!$current_staff_id){
  redirect_to("../non_teaching.php");
  } ?>
<?php confirm_other_folder_logged_in(); ?>
<?php $upload_dir = "img/profile/"; ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
        <a href="../../../home.php" title="Go to Home" class="tip-bottom">
            <i class="icon-home"></i> Home
        </a>
        <a href="../non_teaching.php" class="current">
            Non Teaching Staff
        </a>
    </div>
    <h1>Staff.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
	<hr>

    <div class="row-fluid">
        <?php $layout_context = $_SESSION['usertype']; ?>
        <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){ ?>
        <?php echo message(); ?>
        <?php } ?>
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>

                <div class="fr">
                    <a href="../non_teaching.php" class="btn btn-warning btn-mini">
                        BACK <i class="icon-arrow-left"></i>
                    </a>
                    <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){ ?>
                    <a href="edit.php?staff=<?php echo urlencode($current_staff_id["id"]);  ?>" class="btn btn-info btn-mini">
                        <i class="icon-wrench"></i>
                    </a>
                    <a href="delete.php?staff=<?php echo urlencode($current_staff_id["id"]); ?>" onclick= "return confirm('Are you Sure you..?!');" class="btn btn-danger btn-mini">
                        <i class="icon-trash"></i>
                    </a>
                    <?php } ?>
                </div><!--FR-->

                <h5>Staff profile</h5>
            </div><!--widget-title-->

         <div class="widget-content nopadding">
              <div class="widget-box">
                <div class="widget-title">
                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab1">Personal</a></li>
                    <li><a data-toggle="tab" href="#tab2">Activities</a></li>
                    <li><a data-toggle="tab" href="#tab3">Contacts</a></li>
                    <li><a data-toggle="tab" href="#tab4">Location</a></li>
                  </ul>
                </div><!--widget-title-->
                 <div class="widget-content tab-content">
                    <div id="tab1" class="tab-pane active">
                      <div class="span4">
                        <div class="widget-box">
                          <div class="widget-content nopadding">
                             <img src="<?php echo $upload_dir . $current_staff_id["pic"]; ?>" />
                          </div><!--widget-content nopadding-->
                        </div><!--widget-box-->
                      </div><!--span4-->

                      <div class="span8">
                         <div class="widget-box">
                           <div class="widget-content nopadding">
                             <table class="table">
                                <tbody>
                                  
                                  <tr>
                                    <th>SURNAME :</th>
                                    <td><?php echo htmlentities($current_staff_id["sirname"]);?></td>
                                  </tr>

                                  <tr>
                                    <th>FULL NAME :</th>
                                    <td><?php echo htmlentities($current_staff_id["fullnames"]);?></td>
                                  </tr>

                                  <tr>
                                    <th>ID NUMBER :</th>
                                    <td><?php echo htmlentities($current_staff_id["Idnumber"]);?></td>
                                  </tr>

                                  <tr>
                                    <th>JOINED :</th>
                                    <td><?php echo htmlentities($current_staff_id["joined"]);?></td>
                                  </tr>

                                  <tr>
                                    <th>AGE :</th>
                                    <td><?php echo htmlentities($current_staff_id["age"]);?></td>
                                  </tr>

                                  <tr>
                                    <th>GENDER :</th>
                                    <td><?php echo htmlentities($current_staff_id["gender"]);?></td>
                                  </tr>

                                  <tr>
                                    <th>MARITAL STATUS :</th>
                                    <td><?php echo htmlentities($current_staff_id["marital"]);?></td>
                                  </tr>

                                </tbody>
                              </table>
                           </div><!--widget-content nopadding-->
                         </div><!--widget-box-->
                      </div><!--span8-->
                    </div><!--tab1" class="tab-pane active-->

                    <div id="tab2" class="tab-pane">
                      <div class="widget-box">
                        <div class="widget-content nopadding">
                          <table class="table">
                            <tbody>
                             

                              <tr>
                                <th>POSITION :</th>
                                <td><?php echo htmlentities($current_staff_id["position"]);?></td>
                              </tr>

                             

                              <tr>
                                <th>UNIVERSITY/COLLEGE :</th>
                                <td><?php echo htmlentities($current_staff_id["education"]);?></td>
                              </tr>


                              <tr>
                                <th>HOBIES/TALENTS :</th>
                                <td><?php echo htmlentities($current_staff_id["hobies"]);?></td>
                              </tr>

                            </tbody>
                          </table>
                        </div><!--widget-content nopadding-->
                      </div><!--widget-box-->
                    </div><!--tab2" class="tab-pane-->

                    <div id="tab3" class="tab-pane">
                      <div class="widget-box">
                       <div class="widget-content nopadding">
                          <table class="table">
                            <tbody>
                              <tr>
                                <th>MOBILE NUMBER :</th>
                                <td><?php echo htmlentities($current_staff_id["phone"]);?></td>
                              </tr>

                              <tr>
                                <th>PHONE NUMBER :</th>
                                <td><?php echo htmlentities($current_staff_id["altphone"]);?></td>
                              </tr>

                              <tr>
                                <th>EMAIL ADDRESS :</th>
                                <td><?php echo htmlentities($current_staff_id["email"]);?></td>
                              </tr>

                              <tr>
                                <th>NEXT OF KIN :</th>
                                <td><?php echo htmlentities($current_staff_id["next_kin"]);?></td>
                              </tr>
                            </tbody>
                          </table>  
                       </div><!--widget-content nopadding-->
                      </div><!--widget-box-->
                    </div><!--tab3" class="tab-pane-->

                    <div id="tab4" class="tab-pane">
                      <div class="widget-box">
                         <div class="widget-content nopadding">
                           <table class="table">
                            <tbody>
                            <tr>
                                <th>LOCAL ADDRESS :</th>
                                <td><?php echo htmlentities($current_staff_id["address"]);?></td>
                              </tr>
                              <tr>
                                <th>NATIONALITY :</th>
                                <td><?php echo htmlentities($current_staff_id["nationality"]);?></td>
                              </tr>

                              <tr>
                                <th>COUNTY :</th>
                                <td><?php echo htmlentities($current_staff_id["county"]);?></td>
                              </tr>

                              <tr>
                                <th>RESIDENTIAL AREA :</th>
                                <td><?php echo htmlentities($current_staff_id["residence"]);?></td>
                              </tr>
                            </tbody>
                          </table>  
                         </div><!--widget-content nopadding-->
                      </div><!--widget-box-->
                    </div><!--tab4" class="tab-pane-->
                 </div><!--widget-content tab-content-->
              </div><!--widget-box-->
              <div class="widget-box">
                <div class="widget-content">
                <h5>BACKGROUND INFORMATION</h5>
                <hr>
                  <?php echo nl2br(htmlentities($current_staff_id["background"])); ?>
                </div><!--widget-content nopadding-->
              </div><!--widget-box-->
          </div><!--widget-content nopadding-->
      </div><!--widget-box-->
    </div><!--row-fluid-->                        
  </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include'../../../../includes/system/footer.php'; ?>
