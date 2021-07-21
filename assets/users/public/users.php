<?php require_once'../../../includes/initialization.php'; ?>
<?php require_once '../includes/users_function.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
    <a href="../../home.php" title="Go to Home" class="tip-bottom">
    <i class="icon-home"></i> Home</a>
    <a href="users.php" class="current">Users</a> 
    </div>
    <h1>All System Users.</h1>
  </div><!--content-header-->

  <div class="container-fluid">
    <hr/>
    <div class="row-fluid">
      <div class="span12">
      <?php echo message(); ?>
      <?php if (isset($_POST["add"])) { ?>
      <div class="widget-box">
         <div class="widget-title">
            <span class="icon"><i class="icon-user"></i></span>
            <h5>Student profile</h5>
         </div><!--title-->
         <div class="widget-content nopadding">
            <form action="users/new_user.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
              <!--vehicle-->
              <div class="control-group">
                    <label class="control-label">FULL NAMES :</label>
                  <div class="controls">
                      <input type="text" name="fullnames" class="span11" placeholder="Enter users full names.." >
                    </div>
                </div><!--control-group-->


                 <!--pic-->
                  <div class="control-group">
                    <label class="control-label">PROFILE PICTURE :</label>
                    <div class="controls">
                      <input type="file" name="myfile" />
                    </div>

                  </div><!--control-group-->

                <!--route-->
                <div class="control-group">
                  <label class="control-label">USERNAME :</label>
                  <div class="controls">
                     <input type="text" name="username" class="span11" placeholder="Enter the username of the user..." />
                  </div>
                </div><!--control-group-->

                 <!--amount-->
                <div class="control-group">
                  <label class="control-label">ROLE :</label>
                  <div class="controls">
                     <select name="role">
                        <option>Admin</option>
                        <option>Accountant</option>
                        <option>Clerk</option>
                        <option>User</option>
                     </select>
                  </div>
                </div><!--control-group-->

                 <div class="control-group">
                 <label class="control-label">MOBILE NUMBER :</label>
                  <div class="controls">
                     <input type="text" name="mobile" class="span11" placeholder="Enter the users mobile number..." cl/>
                  </div>
                </div><!--control-group-->



                <!--route-->
                <div class="control-group">
                  <label class="control-label">PHONE NUMBER :</label>
                  <div class="controls">
                     <input type="text" name="phone" class="span11" placeholder="Enter the  users phone number..." />
                  </div>
                </div><!--control-group-->

                <!--route-->
                <div class="control-group">
                  <label class="control-label">EMAIL :</label>
                  <div class="controls">
                     <input type="text" name="email" class="span11" placeholder="Enter the users email address..." />
                  </div>
                </div><!--control-group-->

               <div class="control-group">
                  <label class="control-label">PASSWORD :</label>
                  <div class="controls">
                    <input id="password" type="password" name="password" class="span11" placeholder="Enter the users password..." />
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
                    <i class="icon-download-alt"></i> Save
                    </button>

                    <a href="" class="btn btn-default"><i class="icon-refresh"></i></a>
                </div>


            </form>
        </div><!--widget-content-->
       </div><!--widget-box-->
       <?php } ?>
      <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <span class="icon_right">
              <form action="users.php" method="POST" class="form-horizontal">
                <button type="submit" name="add" class="btn btn-mini btn-success">
                  <i class="icon-plus"></i>
                </button>
              </form>
            </span>
             <h5>Users Table</h5>
          </div>

          <!--all students table-->
         <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th>FULL NAMES</th>
                      <th>USERNAME</th>
                      <th>ROLE</th>
                      <th>MOBILE NUMBER</th>
                      <th>EMAIL</th>
                      <th>USER</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $users_set = find_all_users(); ?>
                  <?php while($users = mysqli_fetch_assoc($users_set)){ ?>
                  
                    <tr>
                    
                      <td>
                      <?php echo htmlentities($users["fullnames"]); ?>
                      </td>

                      <td>
                     <?php echo htmlentities($users["username"]); ?>
                      </td>

                      <td>
                      <?php echo htmlentities($users["usertype"]); ?>
                      </td>

                      <td>
                      <?php echo htmlentities($users["mobile"]); ?>
                      </td>

                       <td>
                      <?php echo htmlentities($users["email"]); ?>
                      </td>
                       <td>
        
                        <a href="users/profile.php?user=<?php echo urlencode($users["id"]); ?>">
                          <span class="icon">
                          profile <i class="icon-user"></i>
                          </span>
                        </a>
                    
                      </td>

                      
                    </tr>
                    <?php } ?>
                  <?php mysqli_free_result($users_set); ?>
                    
                  </tbody>
                  
               </table>
            </div><!--widget-content tab-content nopadding-->
          </div>
        </div><!--Widget-Box-->
      </div><!--span12-->
    </div><!--row-fluid-->
   
  </div><!--container-fluid-->
</div><!--content-->
<!--Footer-part-->
<?php include'../../../includes/system/users_footer.php'; ?>