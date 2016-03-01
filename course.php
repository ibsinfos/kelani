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
                $stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'alsubj'");
                $stmt->execute();
                $permissions = $stmt->fetchAll();
                if ($permissions[0]['R']) {
                    ?>
                <form method="post" action="controller/courseController.php" target="_parent" data-toggle="validator">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Course Name</label><br/>
                            <input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">
                            <input type="text" name="txtCourseName"  value="<?php if(isset($_GET['edit'])){ echo $name;} ?>" size="40" required/><br/>
                            <input type="hidden" name="txtCourseID"  value="<?php if(isset($_GET['edit'])){ echo $id;} ?>" size="40"/>
                        </div>
                        <div class="col-lg-8 selecttable">
                            <?php
                           
                            $query = "SELECT * FROM course_tbl";
                            $result =getData($query);
                            echo "<table width='100%'>"; // start a table tag in the HTML
                            echo "<tr><th>COURSE NAME</th><th>&nbsp;</th></tr>";
                            while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                                echo "<tr><td>" . $row['Name'] . "</td><td><a href='course.php?edit=".$row['id']."'>Edit</a></td></tr>";  //$row['index'] the index here is a field name
                            }
                            echo "</table>"; //Close the table in HTML
                            connection_close(); //Make sure to close out the database connection
                            ?>
                        </div>
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
</body></html>