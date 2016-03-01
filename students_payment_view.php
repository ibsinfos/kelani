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
<script src="js/jquery.js"></script>
<script type="text/javascript">

</script>
</head><body>

<?php
include_once './inc/top.php';
include_once 'dbconfig.php';

if(isset($_GET['Studentid'])){
	 $txtStudentId = $_GET['Studentid'];
	 $query = "SELECT * FROM payment_tbl WHERE Student_tb_Student_id='".$txtStudentId."'";
	 $result = getData($query);
	 $row = mysqli_fetch_array($result);
	 $txtStudentId = $row['Student_tb_Student_id'];   
}
else{
	$txtStudentId = '';
}

?>

    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Student Payment History
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Student Payment History
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               	
                <div class="row">
                    <div class="col-lg-4">
                    <form id="stupyh">
                    <label>Student ID</label><br />
                    <input type="text" name="txtStudentID" size="50" value="<?php echo $txtStudentId ?>" id="txtStudentID" readonly/><br/>
                    </form>  
                    </div>
                    
                    <div class="col-lg-4">
                   
                    
                    </div>
                    
                    <div class="col-lg-4">
               
                    </div>
                                       
                </div>
                
                <div class="row">
                	<div class="col-lg-4">
         
                	</div>
                <div class="col-lg-4">
               
                            
                </div>
                </div>
                
                <!-- /.row -->
 				
                
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12" id="Student123">
                    
                    <?php
                        include_once 'dbconfig.php'; //Connect to database
                        $query = "SELECT p.InvoiceNo, p.`Date`, p.`Time`, p.Total, p.Discount, p.SubTotal, p.Settle, p.Balance, p.DueAmount, s.`Name`
FROM  payment_tbl p, student_tb s
WHERE s.Student_id = p.Student_tb_Student_id AND Student_tb_Student_id='".$txtStudentId."'";
                        $result = getData($query);
                        echo "<table width='100%'>"; // start a table tag in the HTML
                        echo "<tr>
                        <th>INVOICE NO</th>
                        <th>DATE</th>
                        <th>TIME</th>
                        <th>TOTAL</th>
                        <th>DISCOUNT</th>
						<th>SUB TOTAL</th>
                        <th>SETTLE</th>
						<th>BALANCE</th>
						<th>DUE AMOUNT</th>
						<th>NAME</th>
                        </tr>";
                       	while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                            echo "<tr><td>" . $row['InvoiceNo']. "</td><td>" . $row['Date']. "</td><td>" . $row['Time']. "</td><td>" . $row['Total'] . "</td><td>" . $row['Discount'] . "</td><td>" . $row['SubTotal'] . "</td><td>" . $row['Settle'].  "</td><td>" . $row['Balance']. "</td><td>" . $row['DueAmount']. "</td><td>" . $row['Name'].  "</td></tr>";  //$row['index'] the index here is a field name
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