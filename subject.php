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
</head>
<body>

<?php
include_once './inc/top.php';
include_once 'dbconfig.php';

if(isset($_GET['edit'])){
    $id = trim($_GET['edit']);
    $query = "SELECT id, subjectname, Subjectcode FROM subject_tbl WHERE id='" . $id . "'";
    $result = getData($query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $IDX = $row['id'];
            $NAME = $row['subjectname'];
            $CODE = $row['Subjectcode'];
            $btnStatus = 'enabled';
            $btnAddStatus = 'disabled';
        }
    }
    else{
        $IDX = '';
        $NAME = '';
        $CODE = '';
        $btnStatus = 'disabled';
        $btnAddStatus = 'enabled';
    }
}
else{
    $IDX = '';
    $NAME = '';
    $CODE = '';
    $btnStatus = 'disabled';
    $btnAddStatus = 'enabled';
}

?>
<div id="wrapper">
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-">
                    <h1 class="page-header">
                        Subject Management
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-bar-chart-o"></i> Subject Management
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <!-- cours subject mng -->
            <?php
            require_once("./config.php");
            $stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'submng'");
            $stmt->execute();
            $permissions = $stmt->fetchAll();
            if ($permissions[0]['R']) {
                ?>
                <form method="post" action="controller/subjectController.php" id="submng" data-toggle="validator">
                    <div class="row">
                        <div class="col-lg-4">

                            <div class="form-group">
                            <label class="control-label col-md-4">Subject Code</label><br/>
                            <input class="form-control col-md-8" type="text" name="txtSubjectCode" size="10" maxlength="10" value="<?php echo $CODE; ?>" required/><br/>
                            <label class="control-label col-md-4">Subject Name</label><br/>
                            <input class="form-control col-md-8" type="text" name="txtSubjectName" size="100" maxlength="100" value="<?php echo $NAME; ?>" required/><br/>
                            </div>

                            <input type="hidden" name="idx" value="<?php echo $IDX; ?>" /><br/>

                            <input type="hidden"
                                   value="<?php echo ($_SESSION['user_session'] == 'loged') ? $_SESSION['username'] : 'User'; ?>"
                                   name="ssUser">
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
                        <div class="col-lg-8" id="sbj_div">
                            <?php include './subject_list.php'; ?>

                        </div>
                    </div>
                </form>
            <?php } else {
                ?>
                <h1>You Do Not Have Permissions To This Page...!</h1>
                <?php
            } ?>
            <!-- /cours subject mng -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>

<script type="text/javascript">
    $('document').ready(function () {
        $("#submng").validate({
            submitHandler: submitForm
        });
        function submitForm() {
            var data = $("#submng").serialize();
            $.ajax({
                type: 'POST',
                url: 'controller/subjectController.php',
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
                        $('#sbj_div').load('subject_list.php');
                        $("#submng")[0].reset();


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