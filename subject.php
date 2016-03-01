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
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Subject Management
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- cours subject mng -->
                        <form method="post" action="controller/subjectController.php" id="submng" data-toggle="validator">
                            <div class="row selecttable">
                                <div class="col-lg-4">
                                    <label>Subject Name</label><br/>
                                    <input type="text" name="txtSubjectName" size="10" max="10" required/><br/>
                                    <label>Subject Code</label><br/>
                                    <input type="text" name="txtSubjectCode" size="100" maxlength="100" required/><br/>
                                    <input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">
                                
                                    <input name="btnAdd" type="submit" value="Add"/>
                                    <input name="btnUpdate" onclick="" type="submit" value="Update"/>
                                    <input name="btnDelete" type="submit" value="Delete"/>
                                    <input name="btnClear" type="reset" value="Clear"/>
                                </div>
                                <div class="col-lg-8">
                                    <?php
                                    include_once 'dbconfig.php'; //Comnnect to database
                                    $query = "SELECT subjectname, Subjectcode FROM subject_tbl;";
                                    $result =getData($query);
                                    echo "<table width='100%'>"; // start a table tag in the HTML
                                    echo "<tr><th>CODE</th><th>SUBJECT NAME</th><th>&nbsp;</th></tr>";
                                    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                                        echo "<tr><td>" . $row['Subjectcode'] . "</td><td>" . $row['subjectname'] . "</td><td><input type='button' value='Edit'></td></tr>";  //$row['index'] the index here is a field name
                                    }
                                    echo "</table>"; //Close the table in HTML
                                    connection_close(); //Make sure to close out the database connection
                                    ?>
                                </div>
                            </div>
                        </form>
                <!-- /cours subject mng -->


               

                

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>
</body></html>