<?php require_once'../../../../includes/initialization.php'; ?>
<?php require_once '../../includes/student_function.php'; ?>
<?php 
  if(isset($_POS["submit"])){
    
  }

?>
<?php include '../../../../includes/system/header.php'; ?>
<?php echo  navigation_nav(); ?>
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
   <hr/>

    <div class="row-fluid">
    <div class="span12">
       <?php echo message(); ?>
        <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i></span>
            <span class="icon_right"><a href="" class="btn btn-mini btn-success"><i class="icon-plus"></i></a></span>
             <h5>class details</h5>
          </div>

          <!--all students table-->
         <div class="widget-content nopadding">
         
            <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th>CLASS</th>
                      <th>STREAM</th>
                      <th>CLASS TEACHER</th>
                      <th>CHOOSE</th>
                    </tr>
                  </thead>
                  <?php $classes_set = find_all_classes(); ?>
                  <?php while($classes = mysqli_fetch_assoc($classes_set)){ ?>
                  <tbody>
                    <tr>
                      <td>
                      <?php echo htmlentities($classes["class"]); ?>
                      </td>

                      <td>
                      <?php echo htmlentities($classes["stream"]); ?>
                      </td>

                      <td>
                     <?php echo htmlentities($classes["teacher"]); ?>
                      </td> 
                      <td>
                      <form action="set_class.php?class= <?php echo urlencode($classes["id"]); ?>">
                        <button type="submit" name="submit" class="btn btn-mini btn-default"><i class="icon-ok-sign"></i></span> Select</button> 
                      </form>
                      </td>
                    </tr>
            
                  </tbody>

                  <?php } ?>
                  
                  
               </table>
            </div><!--widget-content tab-content nopadding-->
          </div>
        </div><!--Widget-Box-->
      </div><!--span12-->
    </div><!--row-fluid-->
   
  </div><!--container-fluid-->

 </div><!--content-->
<?php include'../../../../includes/system/footer.php'; ?>