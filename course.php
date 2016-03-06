<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kelani | Course Management</title>
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
include_once 'dbconfig.php'; //Connect to database

if(isset($_GET['edit'])){
	 $id = trim($_GET['edit']);
	 $query = "SELECT * FROM course_tbl WHERE id='".$id."'";
	 $result = getData($query);
	 $row = mysqli_fetch_array($result);
	 $name = $row['Name'];
	 $id = $row['id'];
}
?>
    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-">
                        <h1 class="page-header">
                            Course Management
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Course Management
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- cours mng -->
                <?php
                require_once("./config.php");
                $stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'coumng'");
                $stmt->execute();
                $permissions = $stmt->fetchAll();
                if ($permissions[0]['R']) {
                    ?>
                <form method="post" action="controller/courseController.php" target="_parent" id="coumng" data-toggle="validator">
                    <div class="row">
                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="control-label col-md-4">Course Name</label>
                                <input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">
                                <input class="form-control col-md-8" type="text" name="txtCourseName"  value="<?php if(isset($_GET['edit'])){ echo $name;} ?>" size="40" maxlength="40" required/><br/>
                                <input type="hidden" name="txtCourseID"  value="<?php if(isset($_GET['edit'])){ echo $id;} ?>" size="40"/>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if ($permissions[0]['W']) { ?>
                                        <input name="btnAdd" type="submit" value="Add" class="btn btn-primary"/>
                                        <input name="btnUpdate" onclick="" type="submit" value="Update" class="btn btn-primary"/>
                                    <?php } else {
                                        ?>
                                        <input name="btnAdd" type="submit" value="Add" class="btn btn-primary" disabled/>
                                        <input name="btnUpdate" onclick="" type="submit" value="Update" class="btn btn-primary" disabled/>
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
                                    <input name="btnClear" type="reset" value="Clear" class="btn btn-default"/>
                                </div>
                                <div id='msg'></div>
                            </div>


                        </div>
                        <div class="col-lg-8 selecttable" id="courselist">
                            <?php include './course_list.php'; ?>
                        </div>
                    </div>

                </form>
                <?php } else {
                    ?>
                    <h1>You Do Not Have Permissions To This Page...!</h1>
                    <?php
                } ?>
                <!-- /cours mng -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>

<script type="text/javascript">
    $('document').ready(function () {
        $("#coumng").validate({
            submitHandler: submitForm
        });
        function submitForm() {
            var data = $("#coumng").serialize();
            $.ajax({
                type: 'POST',
                url: 'controller/courseController.php',
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
                        $('#courselist').load('course_list.php');
                        $("#coumng")[0].reset();


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