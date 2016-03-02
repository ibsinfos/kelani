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
                $stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'alsubj'");
                $stmt->execute();
                $permissions = $stmt->fetchAll();
                if ($permissions[0]['R']) {
                    ?>
                <form method="post" action="controller/expencesController.php" target="_parent" data-toggle="validator">
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
                    <div><?php if ($permissions[0]['W']) { ?>
                            <input name="btnAdd" type="submit" value="Add" class="btn btn-primary"/>
                        <?php } else {
                            ?>
                            <input name="btnAdd" type="submit" value="Add" class="btn btn-primary" disabled/>
                            <?php
                        }?>
                        <input name="btnClear" type="reset" value="Clear" class="btn-default btn"/>
                    </div>
                    
                    </div>
					
                    <div class="col-lg-8 selecttable">
                        <?php
                        include_once 'dbconfig.php'; //Connect to database
                        $query = "SELECT * FROM kelanidb.otherexpenses_tbl";
                        $result = getData($query);
                        echo "<table width='100%'>"; // start a table tag in the HTML
                        echo "<tr>
                        <th># NO</th>
                        <th>INVOICE NUMBER</th>
                        <th>SUPPLIER</th>
						<th>DATE</th>
                        <th>TIME</th>
                        <th>DESCRIPTION</th>
                        <th align='right'>AMOUNT</th>
                        </tr>";
                        while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                            echo "<tr><td>" . $row['esp']. "</td><td>" . $row['InvoiceNumber']. "</td><td>" . $row['SuplierName']. "</td><td>" . $row['Date'] . "</td><td>" . $row['Time'] . "</td><td>" . $row['Des'] . "</td><td align='right'>" . $row['Amount'] . "</td></tr>";  //$row['index'] the index here is a field name
                        }
                        echo "</table>"; //Close the table in HTML
                        connection_close(); //Make sure to close out the database connection
                        ?>
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
</body></html>