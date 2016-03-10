<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kelani | User Privileges</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<!--**************-->
    <script type="text/javascript" src="jq/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="jq/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="jq/jquery.dataTables.min.js"></script>


    <link href="jq/dataTables.bootstrap.min.css" rel="stylesheet">


<!--**************-->

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

<script type="text/javascript">

    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>  
    
</head>
<body>

<?php
include_once './inc/top.php';
include_once 'dbconfig.php'; //Connect to database


if(isset($_GET['edit'])){
    $id = trim($_GET['edit']);
    $query = "SELECT UserLevel_tbl_id, Form_tbl_FormID, R, W, D FROM privileges_tbl WHERE UserLevel_tbl_id='".$id."'";
    $result = getData($query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            var_dump(mysqli_fetch_assoc($result)); exit();
            $userlevel_ = $row['UserLevel_tbl_id'];
            $form_ = $row['Form_tbl_FormID'];
            $cbr_ = $row['R'];
            $cbw_ = $row['W'];
            $cbd_ = $row['D'];

            $btnStatus = 'enabled';
            $btnAddStatus = 'disabled';
        }
    }
    else{
        $userlevel_ = "";
        $form_ = "";
        $cbr_ = "";
        $cbw_ = "";
        $cbd_ = "";

        $btnStatus = 'disabled';
        $btnAddStatus = 'enabled';
    }
//	var_dump($_POST);
//	die();

}
else{
    $userlevel_ = "";
    $form_ = "";
    $cbr_ = "";
    $cbw_ = "";
    $cbd_ = "";

    $btnStatus = 'disabled';
    $btnAddStatus = 'enabled';
}
?>
?>

    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            User Privileges
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> User Privileges
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">





				
                </div>
            <!-- /.container-fluid -->

        </div></div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>
</body></html>