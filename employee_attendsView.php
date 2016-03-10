<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kelani</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">



<!-- Bootstrap Core CSS -->

<link href="./css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="./css/sb-admin.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="./css/plugins/morris.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="./font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- Custom Css -->
<link href="./css/formcss.css" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="js/jquery.js"></script>
    <script type="text/javascript">
        function LoadLect(){

            var Employee = document.getElementById("txtEmployeeID").value;
            var FromDate  = document.getElementById("dtpFromDate").value;
            var ToDate  = document.getElementById("dtpToDate").value;

            $.ajax({
                type:'POST',
                url:"controller/employee_attendsViewController.php",
                data:{empID:Employee, dtFromDate:FromDate, dtToDate:ToDate},
                success: function(data){
                    document.getElementById("LectView").innerHTML = data;
                }
            });
        }
    </script>

</head>

<body>

<?php
include_once './inc/top.php';
?>

<div id="wrapper">
  <div id="page-wrapper">
    <div class="container-fluid"> 
      
      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header"> Employee Attendance View </h1>
          <ol class="breadcrumb">
            <li> <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> <i class="fa fa-bar-chart-o"></i> Employee Attendance View </li>
          </ol>
        </div>
      </div>
      <!-- /.row -->
        <?php
        require_once("./config.php");
        $stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'empath'");
        $stmt->execute();
        $permissions = $stmt->fetchAll();
        if ($permissions[0]['R']) {
            ?>
      <form method="post" id="empath" action="">
        <div class="row">
          <div class="col-lg-4">
              <div class="form-group">
            <label class="control-label col-md-4">Employee ID</label>
            <input class="form-control col-md-8" type="text" name="txtEmployeeID" id="txtEmployeeID" onChange="LoadLect()" size="50"/>
            </div>
              <div class="form-group">
            <label class="control-label col-md-4">From Date</label>
            <input class="form-control col-md-8" type="date" name="dtpFromDate" id="dtpFromDate" data-date-format="DD/MM/YYYY" onChange="LoadLect()"/>

            </div>
              <div class="form-group">
            <label class="control-label col-md-4">To Date</label>
            <input class="form-control col-md-8" type="date" name="dtpToDate" id="dtpToDate" data-date-format="DD/MM/YYYY" onChange="LoadLect()"/>
              </div>
          </div>

            <label class="control-label col-md-4">Attendance  History</label>
          <div class="col-lg-8" id="LectView">

          </div>
          <div class="col-lg-4"> </div>
        </div>
        <!-- /.row -->
      </form>
        <?php } else {
            ?>
            <h1>You Do Not Have Permissions To This Page...!</h1>
            <?php
        } ?>
      <div class="row"> </div>
    </div>
    <!-- /.container-fluid --> 
    
  </div>
  <!-- /#page-wrapper --> 
  
</div>
<!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>
</body>
</html>