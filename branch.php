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

                <form method="post" action="controller/branchController.php" target="_parent" data-toggle="validator" id="branch">
                <div class="row">
                    <div class="col-lg-4">
                        <label>Branch ID</label><br/>
                        <input type="text" name="txtBranchID" size="3" maxlength="3" pattern="^[A-Z]{3}$|[A-Z][A-Z][A-Z][0-9]" required/><br/>
                        <label>City</label><br/>
                        <input type="text" name="txtBranchCity" size="45" maxlength="45" required/><br/>
                        <label>Address</label><br/>
                        <textarea rows="3" cols="51" name="txtBranchAddress" maxlength="255"></textarea><br/>
                        <label>Telephone 1</label><br/>
                        <input type="text" name="txtBranchTelephone1" maxlength="10" size="10" pattern="0\d{9}" required/><br/>
                        <label>Telephone 2</label><br/>
                        <input type="text" name="txtBranchTelephone2" maxlength="10" size="10" pattern="0\d{9}"/><br/>
                        <label>Email</label><br/>
                        <input type="email" name="txtBranchEmail" size="100" pattern="^[_A-Za-z0-9-]+(\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*(\.[A-Za-z]{2,})$" maxlength="100"/>
						<input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">
                    <div>
                        <input name="btnAdd" type="submit" value="Add"/>
                        <input name="btnUpdate" onclick="" type="submit" value="Update"/>
                        <input name="btnDelete" type="submit" value="Delete"/>
                        <input name="btnClear" type="reset" value="Clear"/>
                    </div>
                    
                    </div>
					
                    <div class="col-lg-8 selecttable">
                        <?php
                        include_once 'dbconfig.php'; //Connect to database
                        $query = "SELECT * FROM branch_tbl;";
                        $result = getData($query);
                        echo "<table width='100%'>"; // start a table tag in the HTML
                        echo "<tr>
                        <th>Branch ID</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Telephone 1</th>
                        <th>Telephone 2</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
                        </tr>";
                        while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                            echo "<tr><td>" . $row['Branch_id']. "</td><td>" . $row['City']. "</td><td>" . $row['Address']. "</td><td>" . $row['TP1'] . "</td><td>" . $row['TP2'] . "</td><td>" . $row['Email'] . "</td><td><input type='button' value='Edit'></td></tr>";  //$row['index'] the index here is a field name
                        }
                        echo "</table>"; //Close the table in HTML
                        connection_close(); //Make sure to close out the database connection
                        ?>
                    </div>
                </div>
                <!-- /.row -->
				</form>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>
</body></html>