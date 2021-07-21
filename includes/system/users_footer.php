<div class="row-fluid">
  <div id="footer" class="span12"> Copyright &copy; <?php echo date('Y');?>. All rights reserved by <a href="http://www.smartechconsulting.biz" target="_blank">Smartech Consulting</a> </div>
</div>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.validate.js"></script> 
<script src="js/jquery.wizard.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.wizard.js"></script>
</body>
</html>

<?php if(isset($connection)){mysqli_close($connection); }?>