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
$(document).ready(function(e) {
		$("#txtEmployeeID").focus();

});
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
          <h1 class="page-header"> Employee Attendance </h1>
          <ol class="breadcrumb">
            <li> <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> <i class="fa fa-bar-chart-o"></i> Employee Attendance </li>
          </ol>
        </div>
      </div>
      <!-- /.row -->
        <?php
        require_once("./config.php");
        $stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'empatt'");
        $stmt->execute();
        $permissions = $stmt->fetchAll();
        if ($permissions[0]['R']) {
        ?>
      <form method="post" id="empatt" name="spform" action="controller/employee_attendsController.php">
        <div class="row">
          <div class="col-lg-4">
              <div class="form-group">
                  <label class="control-label col-md-4">Employee ID</label>
            <input class="form-control col-md-8" type="text" name="txtEmployeeID" size="50"/>
            <input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">

            </div>
<!--              <div class="form-group">-->
<!--                  <label class="control-label col-md-4">Name</label>-->
<!--            <input class="form-control col-md-8" type="text" name="txtName" readonly/>-->
<!--            </div>-->
          </div>
          <div class="col-lg-4 selecttable" id="loadtbl">
            <label>Attendance  History</label>
            <br/>
              <?php include './employee_attends_list.php'; ?>
          </div>

          <div class="col-lg-4">
            <table>
              <tr>
                <td>DATE&nbsp;</td>
                <td align="right"><?php echo date("Y-m-d"); ?></td>
              </tr>
              <tr>
                <td>TIME&nbsp;</td>
                <td align="right"><?php date_default_timezone_set("Asia/Colombo"); echo $today = date("H:i:s");?></td>
              </tr>
            </table>
            <input type="hidden" value="<?php echo date('Y-m-d'); ?>" id="dtpDate" name="dtpDate">
            <input type="hidden" value="<?php date_default_timezone_set('Asia/Colombo'); echo $today = date('H:i:s');?>" name="dtpTime">
          </div>
        </div>
        <!-- /.row -->
        
        <div class="row" style="padding-left: 15px;">
            <?php if ($permissions[0]['W']) {
            ?>
          <input type="submit" value="Add" name="btnAdd" class="btn btn-primary"/>
            <?php } ?>
          <input type="reset" value="Clear"  name="btnClear" class="btn btn-default"/>
            <div id='msg'></div>
        </div>
        <!-- /.row -->
      </form>
      <div class="row" style="padding-left: 15px;"> <a href="employee_attendsView.php">View Employee Attendance</a> </div>
        <?php } else {
            ?>
            <h1>You Do Not Have Permissions To This Page...!</h1>
            <?php
        } ?>
    </div>
    <!-- /.container-fluid --> 
    
  </div>
  <!-- /#page-wrapper --> 
  
</div>
<!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>
<script type="text/javascript">
    $('document').ready(function () {
        $("#empatt").validate({
            submitHandler: submitForm
        });
        function submitForm() {
            var data = $("#empatt").serialize();
            $.ajax({
                type: 'POST',
                url: 'controller/employee_attendsController.php',
                data: data,
                beforeSend: function () {
                    $("#msg").fadeOut();
                },
                success: function (response) {
                    console.log(response);
                    if (response) {
                        $("#msg").fadeIn(function () {
                            $("#msg").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Successfully Inserted...!</div>');
                        });
                        $('#msg').fadeOut(4000);
                        $('#loadtbl').load('employee_attends_list.php');
                        $("#empatt")[0].reset();


                    }
                    else {
                        $("#msg").fadeIn(1000, function () {
                            $("#msg").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                        });
                        $('#msg').fadeOut(4000);
                    }
                }
            });
            return false;
        }
    });
</script>
</body>
</html>