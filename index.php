<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/configs/db_connect/connection.php';?>
<?php include 'includes/functions.php'; ?>
<?php include'includes/validation_functions.php'; ?>
<?php 
    $username = "";
    if(isset($_POST["login"])){

        //perform validations 
        $required_fields= array('username', 'password');
        validate_presences($required_fields);

        //check out if there was errors
        if(empty($errors)){
            //Attempt login  
            $username=$_POST["username"];
            $password=$_POST["password"];
            $found_user = attempt_login($username, $password);

            //check whether the query took place 
            if($found_user){
            //success
            //Marked user as logged in
            $_SESSION["user_id"] = $found_user["id"];
            $_SESSION["username"] = $found_user["username"];
            $_SESSION['names'] = $found_user["fullnames"];
            $_SESSION["usertype"] = $found_user["usertype"];
            $_SESSION['last_time'] = time();
            redirect_to("term.php");
            }else{
            //there was an error in query performance
            $_SESSION['error_message']= 'Username/password not found!';
            }
        }

    }else{

    }
?>

<?php include'includes/login/header.php'; ?>
<!--Account type-->
<?php echo message(); ?>
<?php echo form_errors($errors); ?>


<div class="control-group">
    <div class="controls">
        <div class="main_input_box">
            <span class="add-on bg_lg">
            <i class="icon-user"></i>
            </span><input type="text" name="username" placeholder="Username" value="<?php echo htmlentities($username); ?>">
        </div>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <div class="main_input_box">
            <span class="add-on bg_ly">
            <i class="icon-lock"></i>
            </span><input type="password" name="password" placeholder="Password" />
        </div>
    </div>
</div>
                
<div class="form-actions">
    <span class="pull-right">
        <button type="submit" name="login" class="btn btn-success">
            Login <i class="icon-signin"></i>
        </button>
    </span>
</div>
</form><!--do not delete this--><!--form id="loginform" class="form-vertical" action="index.html"-->
<?php include'includes/login/footer.php'; ?>