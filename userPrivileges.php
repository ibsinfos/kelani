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
                    <div class="col-lg-6">
                    <form method="post" action="controller/userController.php" target="_self" data-toggle="validator" id="usrmng">
                        <label>User Level</label><br/>
                        <select name="cmbUserLevel" id="cmbUserLevel">
                        <option value='0'>        --Select UserLevel--</option>
                        		<?php
                                include_once 'dbconfig.php';
                                $query = 'SELECT * FROM userlevel_tbl;';
                                $result = getData($query);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='".$row['id']."'>".$row['lavel_name']."</option>";
                                    }
                                }
                                ?>
                        </select>
                        <br />
                        

                    <div>
                        <input name="btnAdd" type="submit" value="Add"/>
                        <input name="btnUpdate" onclick="" type="submit" value="Update"/>
                        <input name="btnDelete" type="submit" value="Delete"/>
                        <input name="btnClear" type="reset" value="Clear"/>
                    </div>
                    </form>
                    </div>
					
                    <div class="col-lg-6 selecttable">
                        <?php
                        include_once 'dbconfig.php'; //Connect to database
                        $query = "SELECT * FROM privileges_tbl";
                        $result = getData($query);
                        echo "<table width='100%'>"; // start a table tag in the HTML
                        echo "<tr>
                        <th>FORM</th>
                        <th>R</th>
                        <th>W</th>
                        <th>D</th>
                        </tr>";
                        while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                            echo "<tr><td>" . $row['Form_tbl_FormID']. "</td><td>" . $row['R']. "</td><td>" . $row['W']. "</td><td>" . $row['D'] . "</td></tr>";  //$row['index'] the index here is a field name
                        }
                        echo "</table>"; //Close the table in HTML
                        connection_close(); //Make sure to close out the database connection
                        ?>
                    </div>
                </div>
                <!-- /.row -->



				
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>
</body></html>