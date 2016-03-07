<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kelani | Expenses</title>
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
</head>
<body>

<?php
include_once './inc/top.php';
include_once 'dbconfig.php'; 
	$con = connection();

	$query = "SELECT LPAD(RIGHT(IFNULL(MAX(esp),0),6)+1,7,'0') AS esp FROM otherexpenses_tbl";
	$result= $con->query($query);
	//echo $query;
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while ($row = mysqli_fetch_assoc($result)) {
					if($row['esp'] == null || $row['esp'] == ""){
						//$invoiceno = 'INV0000001';
						$invoiceno = 'ESP0000001';
					}
					else{
						$invoiceno = 'ESP'.$row['esp'];
					}
			}
	}
	
?>

    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Expenses
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Expenses
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <?php
                require_once("./config.php");
                $stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'expenc'");
                $stmt->execute();
                $permissions = $stmt->fetchAll();
                if ($permissions[0]['R']) {
                    ?>
                <form method="post" action="controller/expencesController.php" target="_parent" data-toggle="validator" id="expenc">
                <div class="row">
                    <div class="col-lg-4">
                        <label>#NO</label><br/>
                        <input type="text" id="num" class="num" name="num" value="<?php echo $invoiceno; ?>" readonly/><br>
                        <label>Date</label><br/>
                        <input type="date" name="dtpDate" size="40" required/><br/>
                        <input type="hidden" value="<?php date_default_timezone_set('Asia/Colombo'); echo $today = date('H:i:s');?>" name="dtpTime">
                        <label>Invoice Number</label><br/>
                        <input type="text" name="txtInvoiceNumber" maxlength="20" size="20"/><br/>
                        <label>Supplier Name</label><br/>
                        <input type="text" name="txtSupplierName" maxlength="100" size="100"/><br/>
                        <label>Description</label><br/>
                        <textarea rows="3" cols="51" name="txaDescription" required></textarea><br/>
                        <label>Amount</label><br/>
                        <input type="text" name="txtAmount" maxlength="10" size="10" required/><br/>
                        <input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">


                        <div class="row">
                            <div class="col-lg-12">

                            <?php if ($permissions[0]['W']) { ?>
                            <input name="btnAdd" type="submit" value="Add" class="btn btn-primary"/>
                        <?php } else {
                            ?>
                            <input name="btnAdd" type="submit" value="Add" class="btn btn-primary" disabled/>
                            <?php
                        }?>
                        <input name="btnClear" type="reset" value="Clear" class="btn-default btn"/>
                        </div>
                            <div id='msg'></div>
                        </div>
                    </div>
                    <div class="col-lg-8 selecttable" id="exlist">
                        <?php include './expences_list.php'; ?>
                    </div>
                    </div>
					

                </div>
                <!-- /.row -->
				</form>
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
        $("#expenc").validate({
            submitHandler: submitForm
        });
        function submitForm() {
            var data = $("#expenc").serialize();
            $.ajax({
                type: 'POST',
                url: 'controller/expencesController.php',
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
                        $('#exlist').load('expences_list.php');
                        $("#expenc")[0].reset();


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