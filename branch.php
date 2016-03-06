<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kelani | Branch</title>
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

if(isset($_GET['edit'])){
    $id = trim($_GET['edit']);
    $query = "SELECT Branch_id, City, Address, TP1, TP2, Email FROM branch_tbl WHERE Branch_id='" . $id . "'";
    $result = getData($query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
           // $IDX = $row['id'];
            //$NAME = $row['subjectname'];
           // $CODE = $row['Subjectcode'];
            $btnStatus = 'enabled';
            $btnAddStatus = 'disabled';
        }
    }
    else{
       // $IDX = '';

        $btnStatus = 'disabled';
        $btnAddStatus = 'enabled';
    }
}
else{
    $IDX = '';
    $btnStatus = 'disabled';
    $btnAddStatus = 'enabled';
}
?>

    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Branch Details
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Branch Details
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <?php
                require_once("./config.php");
                $stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'branch'");
                $stmt->execute();
                $permissions = $stmt->fetchAll();
                if ($permissions[0]['R']) {
                ?>
                <form method="post" action="controller/branchController.php" target="_parent" data-toggle="validator" id="branch">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label class="control-label col-md-4">Branch ID</label><br/>
                        <input class="form-control col-md-8" type="text" name="txtBranchID" size="3" maxlength="3" pattern="^[A-Z]{3}$|[A-Z][A-Z][A-Z][0-9]" required/><br/>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-4">City</label><br/>
                        <input class="form-control col-md-8" type="text" name="txtBranchCity" size="45" maxlength="45" required/><br/>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-4">Address</label><br/>
                        <textarea class="form-control col-md-8" rows="3" cols="51" name="txtBranchAddress" maxlength="255"></textarea><br/>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-4">Telephone 1</label><br/>
                        <input class="form-control col-md-8" type="text" name="txtBranchTelephone1" maxlength="10" size="10" pattern="0\d{9}" required/><br/>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-4">Telephone 2</label><br/>
                        <input class="form-control col-md-8" type="text" name="txtBranchTelephone2" maxlength="10" size="10" pattern="0\d{9}"/><br/>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-4">Email</label><br/>
                        <input class="form-control col-md-8" type="email" name="txtBranchEmail" size="100" pattern="^[_A-Za-z0-9-]+(\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*(\.[A-Za-z]{2,})$" maxlength="100"/>
						</div>
                        <input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">

                        <div class="row">
                            <div class="col-lg-12">
                                <?php if ($permissions[0]['W']) { ?>
                                    <input name="btnAdd" type="submit" value="Add" class="btn btn-primary"<?php echo $btnAddStatus; ?>/>
                                    <input name="btnUpdate" onclick="" type="submit" value="Update" <?php echo $btnStatus; ?>
                                           class="btn btn-primary"/>
                                <?php } else {
                                    ?>
                                    <input name="btnAdd" type="submit" value="Add" class="btn btn-primary" <?php echo $btnAddStatus; ?> disabled/>
                                    <input name="btnUpdate" onclick="" type="submit" value="Update" class="btn btn-primary" <?php echo $btnStatus; ?>
                                           disabled/>
                                    <?php
                                }
                                if ($permissions[0]['D']) {
                                    ?>
                                    <input name="btnDelete" type="submit" value="Delete" class="btn btn-danger" <?php echo $btnStatus; ?>/>
                                <?php } else {
                                    ?>
                                    <input name="btnDelete" type="submit" value="Delete" class="btn btn-danger" <?php echo $btnStatus; ?>/>
                                    <?php
                                } ?>
                                <input name="btnClear" type="reset" value="Clear" class="btn btn-default"/>
                            </div>
                            <div id='msg'></div>
                        </div>
                    
                    </div>
					
                    <div class="col-lg-8 selecttable" id="branchlist">
                        <?php include './branch_list.php'; ?>
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
        $("#branch").validate({
            submitHandler: submitForm
        });
        function submitForm() {
            var data = $("#branch").serialize();
            $.ajax({
                type: 'POST',
                url: 'controller/branchController.php',
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
                        $('#branchlist').load('branch_list.php');
                        $("#branch")[0].reset();
                        //$("#msg").focus();


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