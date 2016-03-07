<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kelani | Polling Divisions</title>
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
</head><body>

<?php
include_once './inc/top.php';
?>
    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-">
                        <h1 class="page-header">
                            Polling Divisions
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Polling Divisions
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <?php
                require_once("./config.php");
                $stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'poldiv'");
                $stmt->execute();
                $permissions = $stmt->fetchAll();
                if ($permissions[0]['R']) {
                ?>
                <!-- polling divisions -->
                <form method="post" id="poldiv" action="controller/pollingdivisionsController.php">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">

                            <div class="form-group">
                            <label class="control-label col-md-8">Polling Division</label><br/>
                            <input class="form-control col-md-8" type="text" name="txtPollingDivision" size="100" maxlength="100" required/><br/>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if ($permissions[0]['W']) { ?>
                                        <input name="btnAdd" type="submit" value="Add" class="btn btn-primary"/>
                                        <input name="btnUpdate" onclick="" type="submit" value="Update"
                                               class="btn btn-primary"/>
                                    <?php } else {
                                        ?>
                                        <input name="btnAdd" type="submit" value="Add" class="btn btn-primary" disabled/>
                                        <input name="btnUpdate" onclick="" type="submit" value="Update" class="btn btn-primary"
                                               disabled/>
                                        <?php
                                    }
                                    if ($permissions[0]['D']) {
                                        ?>
                                        <input name="btnDelete" type="submit" value="Delete" class="btn btn-danger"/>
                                    <?php } else {
                                        ?>
                                        <input name="btnDelete" type="submit" value="Delete" class="btn btn-danger"/>
                                        <?php
                                    } ?>
                                    <input type="reset" value="Clear" name="btnClear" class="btn-default btn"/>
                                </div>
                                <div id="msg"></div>
                            </div>

                        </div>
                        <div class="col-lg-8 selecttable" id="sbj_div">
                            <?php include './polling_divisions_list.php'; ?>
                        </div>
                    </div>


                </form>
                <!-- /polling divisions -->



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
        $("#poldiv").validate({
            submitHandler: submitForm
        });
        function submitForm() {
            var data = $("#poldiv").serialize();
            $.ajax({
                type: 'POST',
                url: 'controller/pollingdivisionsController.php',
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
                        $('#sbj_div').load('polling_divisions_list.php');
                        $("#poldiv")[0].reset();


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