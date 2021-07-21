<?php
$layout_context = '';
if (isset($layout_context)) {
  $layout_context = $_SESSION["usertype"]; 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sacred Heart <?php echo htmlentities($layout_context); ?></title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../css/bootstrap.min.css" />
<link rel="stylesheet" href="../../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../../css/fullcalendar.css" />
<link rel="stylesheet" href="../../css/uniform.css" />
<link rel="stylesheet" href="../../css/select2.css" />
<link rel="stylesheet" href="../../css/matrix-style.css" />
<link rel="stylesheet" href="../../css/matrix-media.css" />
<link href="../../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="../../home.php">Sacred Heart</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" >
      <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle">
        <i class="icon icon-user"></i> <span class="text">Welcome <?php echo htmlentities($layout_context); ?>
        </span><b class="caret"></b>
      </a>
      <ul class="dropdown-menu">
        <li></li>
        <?php if($layout_context == 'Admin'){?>
          <li class="divider"></li>
          <li><a href="../../users/public/users.php"><i class="icon-check"></i>Manage Users</a></li>
        <?php } ?>
        <li class="divider"></li>
        <li><a href="../../logout.php"><i class="icon-key"></i> Log Out</a></li>
      </ul>
    </li>
    <!--//Not needed 
    <li class="dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important">5</span> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a class="sAdd" title="" href="#"><i class="icon-plus"></i> new message</a></li>
        <li class="divider"></li>
        <li><a class="sInbox" title="" href="#"><i class="icon-envelope"></i> inbox</a></li>
        <li class="divider"></li>
        <li><a class="sOutbox" title="" href="#"><i class="icon-arrow-up"></i> outbox</a></li>
        <li class="divider"></li>
        <li><a class="sTrash" title="" href="#"><i class="icon-trash"></i> trash</a></li>
      </ul>
    </li>
    -->
    <li class=""><a title="" href="../../logout.php">
    <i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
