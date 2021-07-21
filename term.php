<?php require_once('includes/initialization.php'); ?>
<?php

if(isset($_POST["continue"])){
    //perform validations
    $required_fields= array('term');
    validate_presences($required_fields);
    //check out if there was errors
    if(empty($errors)){
        $term = mysqli_sec($_POST['term']);
		$year = mysqli_sec($_POST['year']);
        $_SESSION['login_term'] = $term;
        redirect_to("assets/home.php");
    }
}
?>
<?php include'includes/login/term_header.php'; ?>
<div id="loginbox">
    <form action="term.php" method="post" class="form-vertical">
        <?php //echo message(); ?>
        <?php echo form_errors($errors); ?>
        <p class="normal_text">Choose Year and Term to enter and click continue to continue...</p>
        <div class="controls">
            <div >
                <span class="add-on bg_db"></i></span><select name="year">
                    <option>SELECT YEAR</option>
                    <option>2017</option>
                    <option>2018</option>
					<option>2019</option>
                    <option>2020</option>
					<option>2021</option>
					<option>2022</option>
					<option>2023</option>
					<option>2024</option>
					<option>2025</option>
					<option>2026</option>
                </select>
            </div>
        </div>
				<div class="controls">
            <div >
             <span class="add-on bg_db"></i></span><select name="term">
                    <option>SELECT TERM</option>
                    <option>ONE</option>
                    <option>TWO</option>
                    <option>THREE</option>
                </select>
            </div>
        </div>
        <div class="form-actions">
            <span class="pull-right">
                <button type="submit" name="continue" class="btn btn-success">
                    <i class="icon-check"></i> Continue..
                </button>
            </span>
        </div>
    </form><!--do not delete this--><!--form id="loginform" class="form-vertical" action="index.html"-->
</div>
<?php include'includes/login/footer.php'; ?>
