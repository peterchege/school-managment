<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/staff_function.php'; ?>
<?php find_selected_fields(); ?>
<?php if(!$current_teacher_id){
  redirect_to("../teachers.php");
  } ?>
<?php confirm_other_folder_logged_in(); ?>
<?php $upload_dir = "img/profile/"; ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="../teachers.php" class="current">Teaching staff</a> 
    </div>
    <h1>Teachers.</h1>
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
                    <a href="../teachers.php" class="btn btn-warning btn-mini">
                       BACK <i class="icon-arrow-left"></i>
                    </a>
                    <?php if($layout_context == 'Admin' || $layout_context == 'Accountant'){ ?>
                        <a href="edit.php?teacher=<?php echo urlencode($current_teacher_id["id"]);  ?>" class="btn btn-info btn-mini">
                            <i class="icon-edit"></i> EDIT
                        </a>

                        <a href="delete.php?teacher=<?php echo urlencode($current_teacher_id["id"]); ?>" onclick= "return confirm('Are you Sure you..?!');" class="btn btn-danger btn-mini">
                            DELETE <i class="icon-trash"></i>
                        </a>
                    <?php } ?>



            </div>
            <h5>Teacher's profile</h5>

          </div>
          <div class="widget-content nopadding">
          <!--profile picture-->
            <div class="widget-box">
                <div class="widget-title">
                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab1">Personal</a></li>
                    <li><a data-toggle="tab" href="#tab2">Activities</a></li>
                     <li><a data-toggle="tab" href="#tab3">Contacts</a></li>
                    <li><a data-toggle="tab" href="#tab4">Location</a></li>
                  </ul>
                </div>
                <div class="widget-content tab-content">
                   <div id="tab1" class="tab-pane active">
                     
                      <div class="span4">
                        <div class="widget-box">
                          <div class="widget-content nopadding">
                            <img src="<?php echo $upload_dir . $current_teacher_id["pic"]; ?>" />
                          </div>
                        </div>
                      </div><!--span4-->
                      <div class="span8">
                          <div class="widget-box">
                              <div class="widget-title">
                                <div class="icon">
                                  <div class="fr">
                            
                                     <a href="classes.php?teacher=<?php echo urlencode($current_teacher_id["id"]); ?>" class="btn btn-success btn-mini">Teaching Details</a>
                                     
                                    
                                  </div><!--fr-->
                                </div><!--icon-->
                              </div><!--widget-title-->
                              <!--table info -->
                              <div class="widget-content nopadding">

                                <table class="table">
                                  <tbody>
                                    
                                    <tr>
                                      <th>SURNAME :</th>
                                      <td><?php echo htmlentities($current_teacher_id["sirname"]);?></td>
                                    </tr>

                                    <tr>
                                      <th>FULL NAME :</th>
                                      <td><?php echo htmlentities($current_teacher_id["full_names"]);?></td>
                                    </tr>

                                    <tr>
                                      <th>ID NUMBER :</th>
                                      <td><?php echo htmlentities($current_teacher_id["Idnumber"]);?></td>
                                    </tr>

                                    <tr>
                                      <th>JOINED :</th>
                                      <td><?php echo htmlentities($current_teacher_id["joined"]);?></td>
                                    </tr>

                                    <tr>
                                      <th>AGE :</th>
                                      <td><?php echo htmlentities($current_teacher_id["age"]);?></td>
                                    </tr>

                                    <tr>
                                      <th>GENDER :</th>
                                      <td><?php echo htmlentities($current_teacher_id["gender"]);?></td>
                                    </tr>

                                    <tr>
                                      <th>MARITAL STATUS :</th>
                                      <td><?php echo htmlentities($current_teacher_id["marital"]);?></td>
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
                                  <th>WORKING POSITION :</th>
                                  <td><?php echo htmlentities($current_teacher_id["position"]);?></td>
                                </tr>

                                <tr>
                                  <th>TEACHING SUBJECTS :</th>
                                  <td><?php echo htmlentities($current_teacher_id["subject"]);?></td>
                                </tr>

                                <tr>
                                  <th>TEACHING CLASSES :</th>
                                  <td><?php echo htmlentities($current_teacher_id["classes"]);?></td>
                                </tr>


                                <tr>
                                  <th>UNIVERSITY/COLLEGE :</th>
                                  <td><?php echo htmlentities($current_teacher_id["education"]);?></td>
                                </tr>


                                <tr>
                                  <th>HOBIES/TALENTS :</th>
                                  <td><?php echo htmlentities($current_teacher_id["hobies"]);?></td>
                                </tr>

                              </tbody>
                            </table>
        
                          </div>
                      </div><!--widget-box-->
                   </div><!--tab2" class="tab-pane-->

                   <div id="tab3" class="tab-pane">
                     <div class="widget-box">
                       <div class="widget-content nopadding">
                          <table class="table">
                            <tbody>
                              <tr>
                                <th>MOBILE NUMBER :</th>
                                <td><?php echo htmlentities($current_teacher_id["phone"]);?></td>
                              </tr>

                              <tr>
                                <th>PHONE NUMBER :</th>
                                <td><?php echo htmlentities($current_teacher_id["altphone"]);?></td>
                              </tr>

                              <tr>
                                <th>EMAIL ADDRESS :</th>
                                <td><?php echo htmlentities($current_teacher_id["email"]);?></td>
                              </tr>

                              <tr>
                                <th>NEXT OF KIN :</th>
                                <td><?php echo htmlentities($current_teacher_id["next_kin"]);?></td>
                              </tr>



                            </tbody>
                          </table>  

                       </div>
                     </div>
                   </div><!--tab3" class="tab-pane-->

                   <div id="tab4" class="tab-pane">
                     <div class="widget-box">
                       <div class="widget-content nopadding">
                          <table class="table">
                            <tbody>
                            <tr>
                                <th>LOCAL ADDRESS :</th>
                                <td><?php echo htmlentities($current_teacher_id["address"]);?></td>
                              </tr>
                              <tr>
                                <th>NATIONALITY :</th>
                                <td><?php echo htmlentities($current_teacher_id["nationality"]);?></td>
                              </tr>

                              <tr>
                                <th>COUNTY :</th>
                                <td><?php echo htmlentities($current_teacher_id["county"]);?></td>
                              </tr>

                              <tr>
                                <th>RESIDENTIAL AREA :</th>
                                <td><?php echo htmlentities($current_teacher_id["residence"]);?></td>
                              </tr>
                            </tbody>
                          </table>  

                       </div>
                     </div>
                   </div><!--tab4" class="tab-pane-->

                </div><!--widget-content tab-content-->

            </div><!--widget box two-->
            <div class="widget-box">
                <div class="widget-content">
                <h5>BACKGROUND INFORMATION</h5>
                <hr>
                  <?php echo nl2br(htmlentities($current_teacher_id["background"])); ?>
                </div><!--widget-content nopadding-->
              </div><!--widget-box-->
          </div><!--widget-content nopadding-->

          </div><!--content-->
        </div><!--wbox-->
    </div><!--row-fluid-->
  </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include'../../../../includes/system/footer.php'; ?>
