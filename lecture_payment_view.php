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
function LoadLect(){

		var LecttID_List = document.getElementById("cmbLecturer");
		var LecttID_ = LecttID_List.options[LecttID_List.selectedIndex].value;
				
		var FromDate  = document.getElementById("dtpFromDate").value;
		var ToDate  = document.getElementById("dtpToDate").value;

		$.ajax({
			type:'POST',
			url:"controller/lecture_payments_ViewController.php",
			data:{lectID:LecttID_, dtFromDate:FromDate, dtToDate:ToDate},
			success: function(data){
				document.getElementById("LectView").innerHTML = data;
			}
		});
}
</script>
</head>
<body>

<?php
include_once './inc/top.php';
include_once 'dbconfig.php';
?>

    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Lecture Payment History
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Lecture Payment History
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
               	
                <div class="row">
                <form id="lecpyh">
                    <div class="col-lg-4">
                    <label>Lecturer</label><br/>
                            <select name="cmbLecturer" id="cmbLecturer" onChange="LoadLect()">
                                <?php
                                include_once 'dbconfig.php';
                                $query = "SELECT * FROM employee_tb WHERE Designation_tbl_id = '2'";
                                $result = getData($query);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
									echo "<option value='ALL'>ALL</option>";
                                    while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='".$row['Emp_id']."'>".$row['Name']."</option>";
                                    }
                                }
                                ?>
                            </select><br /> 
                    </div>
                    
                    <div class="col-lg-4">
                   	<label>From Date</label>
            		<br />
            		<input type="date" name="dtpFromDate" size="50" required id="dtpFromDate" data-date-format="DD/MM/YYYY" onChange="LoadLect()"/>
                    </div>
                    
                    <div class="col-lg-4">
               		<label>To Date</label>
            		<br/>
            		<input type="date" name="dtpToDate" size="50" required id="dtpToDate" data-date-format="DD/MM/YYYY" onChange="LoadLect()"/>
                    </div>
               </form>                        
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
                	<div class="col-lg-12" id="LectView">
                    
                    <?php
                        include_once 'dbconfig.php'; //Connect to database
                        $query = "SELECT 	lp.`date`, e.`Name`, lp.numberStudent, lp.subjectAmount, lp.commission, lp.salary, lp.allowance, lp.total, lp.PayedDate ,ay.`year`, c.`Name` AS cname, p.`name` AS pname, s.subjectname AS sname
FROM 	lecturerpayment_tbl lp
		INNER JOIN employee_tb e ON e.Emp_id = lp.Employee_tb_Emp_id
        INNER JOIN acadamicyear ay ON ay.id = lp.Subject_Course_tbl_AcadamicYear_id
        INNER JOIN course_tbl c ON c.id = lp.Subject_Course_tbl_Course_tbl_id
        INNER JOIN part_tbl p ON p.id = lp.Subject_Course_tbl_Part_table_id
        INNER JOIN subject_tbl s ON s.id = lp.Subject_Course_tbl_Subject_tbl_id";
                        $result = getData($query);
                        echo "<table width='100%'>"; // start a table tag in the HTML
                        echo "<tr>
						<th>SUBJECT</th>
						<th>COURSE</th>
						<th>PART</th>
						<th>SUBJECT</th>
						<th>DATE</th>
                        <th>EMPLOYEE NAME</th>
                        <th>AMOUNT</th>	
                        <th>STUDENTS</th>
                        <th>COMMISSION(%)</th>
                        <th>SALARY</th>
						<th>ALLOWANCE</th>
						<th>TOTAL</th>
						<th>PAID  DATE</th>
                        </tr>";
                       	while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                            echo "<tr><td>" . $row['year']. "</td><td>" . $row['cname']. "</td><td>" . $row['pname']. "</td><td>" . $row['sname']. "</td><td>" . $row['date']. "</td><td>" . $row['Name']. "</td><td>" . $row['subjectAmount'] . "</td><td>" . $row['numberStudent'] . "</td><td>" . $row['commission'] . "</td><td>" . $row['salary'].  "</td><td>" . $row['allowance']. "</td><td>" . $row['total']. "</td><td>" . $row['PayedDate']."</td></tr>";  //$row['index'] the index here is a field name
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