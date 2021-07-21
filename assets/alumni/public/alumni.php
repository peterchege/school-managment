<?php require_once('../../../includes/initialization.php'); ?>
<?php require_once '../includes/alumni_function.php'; ?>
<?php confirm_folder_logged_in(); ?>
<?php include '../../../includes/system/head.php'; ?>
<?php check_profile_login_time(); ?>
<?php echo navigation(); ?>
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="../../home.php" title="Go to Home" class="tip-bottom">
                    <i class="icon-home"></i> Home
                </a>
                <a href="alumni.php" class="current">Alumni </a>
            </div>
            <h1>Alumni.</h1>
        </div><!--content-header-->

        <div class="container-fluid"><hr/>
            <div class="row-fluid">
                <div class="span12">
                    <?php $layout_context = $_SESSION['usertype']; ?>
                    <?php if($layout_context == 'Admin'){ ?>
                        <?php echo message(); ?>
                    <?php } ?>
                    <div class="widget-box">
                        <div class="widget-content">
                            <div class="controls controls-row">
                                <form method="POST" class="form-horizontal">
                                    <select name="cat" class="span6 m-wrap">
                                        <option></option>
                                        <option>TRANSFERED</option>
                                        <option>ALUMNI</option>
                                    </select>
                                    <select name="year" class="span3 m-wrap">
                                        <option></option>
                                        <option>2007</option>
                                        <option>2008</option>
                                        <option>2009</option>
                                        <option>2011</option>
                                        <option>2012</option>
                                        <option>2013</option>
                                        <option>2014</option>
                                        <option>2015</option>
                                        <option>2016</option>
                                        <option>2017</option>
                                        <option>2018</option>
                                        <option>2019</option>
                                        <option>2020</option>
                                        <option>2021</option>
                                        <option>2022</option>
                                        <option>2023</option>

                                    </select>

                                    <button type="submit" name="select" class="span2 m-wrap btn btn-primary">
                                        <span><i class="icon-upload-alt"></i></span> SUBMIT
                                    </button>
                                </form>
                            </div><!--controls controls-row-->
                        </div><!--widget-content-->
                    </div><!--widget-box-->

                    <?php if(isset($_POST['select'])){?>
                        <div class="widget-box">
                            <div class="widget-title">
                            <span class="icon">
                                <i class="icon-th"></i>
                            </span>
                            <span class="icon_right">
                                <a href="" class="btn btn-mini btn-default">
                                    <i class="icon-refresh"></i> REFRESH
                                </a>
                            </span>
                                <h5>Students table</h5>
                            </div>

                            <!--all students table-->
                            <div class="widget-content nopadding">
                                <table class="table table-bordered data-table">
                                    <thead>
                                    <tr>
                                        <th>REGISTRATION #</th>
                                        <th>SURNAME</th>
                                        <th>FULL NAMES</th>
                                        <th>GENDER</th>
                                        <th>YEAR</th>
                                        <th>PROFILE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $category = mysqli_sec($_POST['cat']);
                                    $year = mysqli_sec($_POST['year']);
                                    ?>
                                    <?php if(!empty($category) && empty($year)){?>
                                        <?php $alumni_category_set = find_alumni_by_cat($category); ?>
                                        <?php while($alumni_category = mysqli_fetch_assoc($alumni_category_set)){?>
                                            <tr>
                                                <td><?php echo htmlentities($alumni_category['registration']); ?></td>
                                                <td><?php echo htmlentities($alumni_category['surname']); ?></td>
                                                <td><?php echo htmlentities($alumni_category['fullnames']); ?></td>
                                                <td><?php echo htmlentities($alumni_category['gender']); ?></td>
                                                <td><?php echo htmlentities($alumni_category['year']); ?></td>
                                                <td>
                                                    <a href="alumni/profile.php?alumni=<?php echo urlencode($alumni_category["id"]); ?>">
                                                    <span class="icon">
                                                        profile <i class="icon-user"></i>
                                                    </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }//end of the category while ?>
                                        <?php mysqli_free_result($alumni_category_set); ?>
                                    <?php }elseif(empty($category) && !empty($year)){?>
                                        <?php $alumni_year_set = find_alumni_by_year($year); ?>
                                        <?php while($alumni_year = mysqli_fetch_assoc($alumni_year_set)){?>
                                            <tr>
                                                <td><?php echo htmlentities($alumni_year['registration']); ?></td>
                                                <td><?php echo htmlentities($alumni_year['surname']); ?></td>
                                                <td><?php echo htmlentities($alumni_year['fullnames']); ?></td>
                                                <td><?php echo htmlentities($alumni_year['gender']); ?></td>
                                                <td><?php echo htmlentities($alumni_year['year']); ?></td>
                                                <td>
                                                    <a href="alumni/profile.php?alumni=<?php echo urlencode($alumni_year["id"]); ?>">
                                                    <span class="icon">
                                                        profile <i class="icon-user"></i>
                                                    </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }//end of the category while ?>
                                        <?php mysqli_free_result($alumni_year_set); ?>
                                    <?php }elseif(!empty($category) && !empty($year)){?>
                                        <?php $found_alumni_set = find_alumni_by_cat_and_year($category, $year); ?>
                                        <?php while($found_alumni = mysqli_fetch_assoc($found_alumni_set)){?>
                                            <tr>
                                                <td><?php echo htmlentities($found_alumni['registration']); ?></td>
                                                <td><?php echo htmlentities($found_alumni['surname']); ?></td>
                                                <td><?php echo htmlentities($found_alumni['fullnames']); ?></td>
                                                <td><?php echo htmlentities($found_alumni['gender']); ?></td>
                                                <td><?php echo htmlentities($found_alumni['year']); ?></td>
                                                <td>
                                                    <a href="alumni/profile.php?alumni=<?php echo urlencode($found_alumni["id"]); ?>">
                                                    <span class="icon">
                                                        profile <i class="icon-user"></i>
                                                    </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }//end of the category while ?>
                                        <?php mysqli_free_result($found_alumni_set); ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div><!--widget-content nopadding-->
                        </div><!--widget-box-->
                    <?php }else{?>
                        <div class="widget-box">
                            <div class="widget-title">
                            <span class="icon">
                                <i class="icon-th"></i>
                            </span>
                            <span class="icon_right">
                                <a href="" class="btn btn-mini btn-default">
                                    <i class="icon-refresh"></i> REFRESH
                                </a>
                            </span>
                                <h5>Students table</h5>
                            </div>

                            <div class="widget-content nopadding">
                                <table class="table table-bordered data-table">
                                    <thead>
                                    <tr>
                                        <th>REGISTRATION #</th>
                                        <th>SURNAME</th>
                                        <th>FULL NAMES</th>
                                        <th>GENDER</th>
                                        <th>YEAR</th>
                                        <th>PROFILE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $selected_students_set = find_all_alumni(); ?>
                                    <?php while($selected_students = mysqli_fetch_assoc($selected_students_set)){?>
                                        <tr>
                                            <td><?php echo htmlentities($selected_students['registration']); ?></td>
                                            <td><?php echo htmlentities($selected_students['surname']); ?></td>
                                            <td><?php echo htmlentities($selected_students['fullnames']); ?></td>
                                            <td><?php echo htmlentities($selected_students['gender']); ?></td>
                                            <td><?php echo htmlentities($selected_students['year']); ?></td>
                                            <td>
                                                <a href="alumni/profile.php?alumni=<?php echo urlencode($selected_students["id"]); ?>">
                                                    <span class="icon">
                                                        profile <i class="icon-user"></i>
                                                    </span>
                                                </a>
												
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php mysqli_free_result($selected_students_set); ?>
                                    </tbody>
                                </table>
                            </div><!--widget-content nopadding-->
                        </div><!--widget-box-->
                    <?php }//end of the category while ?>
                </div><!--span12-->
            </div><!--row-fluid-->
        </div><!--container-fluid-->
    </div><!--content-->
<?php include '../../../includes/system/alt_footer.php'; ?>