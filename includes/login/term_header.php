<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $layout_context = '';
    if(isset($layout_context)){
    $layout_context = $_SESSION['usertype'];
    }
    ?>
    <title>Sacred Heart <?php echo $layout_context; ?></title><meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="assets/css/matrix-login.css" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<body>
