<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/users_function.php'; ?>
<?php find_selected_fields(); ?>
<?php if(!$current_user_id){
  redirect_to("../users.php");
  } ?>
<?php $upload_dir = "img/profile/"; ?>
<?php confirm_other_folder_logged_in(); ?>
<?php include '../../../../includes/system/header.php'; ?>
<?php check_profile_folder_login_time(); ?>
<?php echo navigation_nav(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="../users.php" class="current">Users</a>
    </div>
    <h1>All System Users.</h1>
  </div><!--content-header-->
  <div class="container-fluid">
	<hr>
    <div class="row-fluid">
      <?php echo message(); ?>
      <?php if(isset($_POST["edit"])){ ?>
      <div class="widget-box">
         <div class="widget-title">
            <span class="icon"><i class="icon-user"></i></span>
            <h5>Student profile</h5>
         </div><!--title-->
         <div class="widget-content nopadding">
            <form action="edit_user.php?user=<?php echo urlencode($current_user_id["id"]); ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
              <!--vehicle-->
              <div class="control-group">
                    <label class="control-label">FULL NAMES :</label>
                  <div class="controls">
                      <input type="text" name="fullnames" class="span11" placeholder="Enter users full names.." value="<?php echo htmlentities($current_user_id["fullnames"]); ?>" >
                    </div>
                </div><!--control-group-->


                 <!--pic-->
                  <div class="control-group">
                    <label class="control-label">PROFILE PICTURE :</label>
                    <div class="controls">
                      <img src="<?php echo $upload_dir.$current_user_id["pic"]; ?>" width="100">
                      <input type="file" name="myfile" />
                    </div>

                  </div><!--control-group-->

                <!--route-->
                <div class="control-group">
                  <label class="control-label">USERNAME :</label>
                  <div class="controls">
                     <input type="text" name="username" class="span11" placeholder="Enter the username of the user..." value="<?php echo htmlentities($current_user_id["username"]); ?>">
                  </div>
                </div><!--control-group-->

                 <!--amount-->
                <div class="control-group">
                  <label class="control-label">ROLE :</label>
                  <div class="controls">
                     <select name="role">
                        <option
                          <?php 
                            if($current_user_id["usertype"] == 'Admin'){
                              echo "selected";
                            }

                          ?>
                        >Admin</option>
                        <option
                          <?php 
                            if($current_user_id["usertype"] == 'Accountant'){
                              echo "selected";
                            }

                          ?>
                        >Accountant</option>
                        <option
                        <?php 
                            if($current_user_id["usertype"] == 'User'){
                              echo "selected";
                            }

                          ?>
                        >User</option>
                     </select>
                  </div>
                </div><!--control-group-->

                <!--route-->
                <div class="control-group">
                  <label class="control-label">MOBILE NUMBER :</label>
                  <div class="controls">
                     <input type="text" name="mobile" class="span11" placeholder="Enter the users mobile number..." value="<?php echo htmlentities($current_user_id["mobile"]); ?>">
                  </div>
                </div><!--control-group-->

                <!--route-->
                <div class="control-group">
                  <label class="control-label">PHONE NUMBER :</label>
                  <div class="controls">
                     <input type="text" name="phone" class="span11" placeholder="Enter the  users phone number..." value="<?php echo htmlentities($current_user_id["phone"]); ?>">
                  </div>
                </div><!--control-group-->

                <!--route-->
                <div class="control-group">
                  <label class="control-label">EMAIL :</label>
                  <div class="controls">
                     <input type="calendar" name="email" class="span11" placeholder="Enter the users email address..." value="<?php echo htmlentities($current_user_id["email"]); ?>">
                  </div>
                </div><!--control-group-->

               <div class="control-group">
                  <label class="control-label">PASSWORD :</label>
                  <div class="controls">
                  <input id="password" type="password" name="password" class="span11" placeholder="Enter the users password..."> 
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">CONFIRM PASSWORD</label>
                  <div class="controls">
                    <input id="password2" type="password" name="password2" class="span11" placeholder="Confirm users password..." />
                  </div>
                </div>


                <div class="form-actions">
                    <button name="submit" type="submit" class="btn btn-success">
                    <i class="icon-download-alt"></i> Update
                    </button>

                    <a href="" class="btn btn-default"><i class="icon-refresh"></i></a>
                </div>


            </form>
        </div><!--widget-content-->
       </div><!--widget-box-->
       <?php } ?>
      <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-user"></i></span>
            <div class="fr">
              
              <form action="profile.php?user=<?php echo urlencode($current_user_id["id"]); ?>" method="POST" class="form-horizontal">

                <a href="../users.php" class="btn btn-warning btn-mini">
                  <i class="icon-arrow-left"></i>
                </a>


                <button type="submit" name="edit" class="btn btn-info btn-mini">
                  <i class="icon-edit"></i>
                </button>

                <a href="delete.php?user=<?php echo urlencode($current_user_id["id"]); ?>" id="delete" class="btn btn-danger btn-mini"><i class="icon-trash"></i></a>
              </form>
            </div>
            <h5><?php echo htmlentities($current_user_id["username"]); ?> profile</h5>

          </div>
          <div class="widget-content nopadding">
          <!--profile picture-->
            <div class="widget-box">
                <div class="widget-content tab-content">
                   <div id="tab1" class="tab-pane active">
                     
                      <div class="span4">
                        <div class="widget-box">
                          <div class="widget-content nopadding">
                            <img src="<?php echo $upload_dir . $current_user_id["pic"]; ?>" />
                          </div>
                        </div>
                      </div><!--span4-->
                      <div class="span8">
                          <div class="widget-box">
                              <!--table info -->
                              <div class="widget-content nopadding">

                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <th>FULL NAME :</th>
                                      <td>
                                        <?php echo htmlentities($current_user_id["fullnames"]);?>
                                      </td>
                                    </tr>

                                    <tr>
                                      <th>USERNAME :</th>
                                      <td><?php echo htmlentities($current_user_id["username"]);?></td>
                                    </tr>


                                    <tr>
                                      <th>ROLE :</th>
                                      <td><?php echo htmlentities($current_user_id["usertype"]);?></td>
                                    </tr>

                                    <tr>
                                      <th>MOBILE NUMBER :</th>
                                      <td><?php echo htmlentities($current_user_id["mobile"]);?></td>
                                    </tr>

                                    <tr>
                                      <th>PHONE NUMBER :</th>
                                      <td><?php echo htmlentities($current_user_id["phone"]);?></td>
                                    </tr>

                                    <tr>
                                      <th>EMAIL :</th>
                                      <td><?php echo htmlentities($current_user_id["email"]);?></td>
                                    </tr>
                                  </tbody>
                                 </table>
                                
                              </div><!--widget-content nopadding-->
                          </div><!--widget-box-->
                      </div><!--span8-->
                    
                   </div><!--tab1" class="tab-pane active-->

                </div><!--widget-content tab-content-->

            </div><!--widget box two-->
          </div><!--widget-content nopadding-->

          </div><!--content-->
        </div><!--wbox-->
    </div><!--row-fluid-->
  </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include'../../../../includes/system/footer.php'; ?>
