<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kelani | Student View</title>
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

	function LoadStudent(){
		var StudentID_ = document.getElementsByName('txtStudentID')[0].value;		

		$.ajax({
			type:'POST',
			url:"controller/studentViewController.php",
			data:{studentID:StudentID_},
			success: function(data){
				document.getElementById("Student123").innerHTML = data;
			}
		});
	}
	function LoadStudentbyOld(){
		var OldStudentID_ = document.getElementsByName('txtOldStudentID')[0].value;		

		$.ajax({
			type:'POST',
			url:"controller/studentViewController.php",
			data:{OldstudentID:OldStudentID_},
			success: function(data){
				document.getElementById("Student123").innerHTML = data;
			}
		});
	}
	function LoadStudentbyNIC(){
		var NIC_ = document.getElementsByName('txtNIC')[0].value;		

		$.ajax({
			type:'POST',
			url:"controller/studentViewController.php",
			data:{NIC:NIC_},
			success: function(data){
				document.getElementById("Student123").innerHTML = data;
			}
		});
	}	
</script>

</head><body>

<?php
include_once './inc/top.php';
include_once 'dbconfig.php'; //Connect to database

if(isset($_GET['edit'])){
	 $id = trim($_GET['edit']);
	 $query = "SELECT * FROM student_tb WHERE Student_id='".$id."'";
	 $result = getData($query);
	 $row = mysqli_fetch_array($result);
	 $name = $row['Name'];
	 $id = $row['Student_id'];   
}

?>
    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Student View
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Student View
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
					<div>
                    <form method="post" action="student_management_Edit.php" target="_parent" data-toggle="validator" id="stuviw">
                    	<table width='100%'>
                            <tr>
                                <td>
                                    <label>Student ID</label><br/><input type="search" name="txtStudentID" id="txtStudID" onKeyUp="LoadStudent();" size="13" value="<?php if(isset($_GET['edit'])){ echo $id;} ?>" />
                                </td>
                                <td>
                                   <label>Old Student ID</label><br/><input type="search" name="txtOldStudentID" id="txtOldStudentID" onKeyUp="LoadStudentbyOld();" size="13" value="<?php if(isset($_GET['edit'])){ echo $id;} ?>" />
                                </td>
                                <td>
                                   <label>NIC</label><br/><input type="search" name="txtNIC" id="txtNIC" onKeyUp="LoadStudentbyNIC();" size="13" value="<?php if(isset($_GET['edit'])){ echo $id;} ?>" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    </div>
                <div class="row">
                    <div class="col-lg-12" id = "Student123">
                    <?php
                        include_once 'dbconfig.php'; //Connect to database
                        $query = "SELECT * FROM  student_tb WHERE Student_status = '1' ORDER BY CreateDate DESC LIMIT 10";
                        $result = getData($query);
                        echo "<table width='100%'>"; // start a table tag in the HTML
                        echo "<tr>
                        <th>Student ID</th>
                        <th>Old Student ID</th>
                        <th>Name</th>
                        <th>NIC</th>
                        <th>Mobile No</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
                        </tr>";
                        while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                            echo "<tr><td>" . $row['Student_id']. "</td><td>" . $row['Old_student_id']. "</td><td>" . $row['Name']. "</td><td>" . $row['NIC'] . "</td><td>" . $row['TP_mob'] . "</td><td>" . $row['Email'] . "</td><td><a href='student_management_Edit.php?Studentid=".$row['Student_id']."'>View</a></td><td> 
									<a href='students_course.php?Studentid=".$row['Student_id']."'>Cource</a></td>
									<td><a href='students_payment_view.php?Studentid=".$row['Student_id']."'>Payment</a></td>
									<td><a href='students_attends_view.php?Studentid=".$row['Student_id']."'>Attendance</a></td></tr>";  //$row['index'] the index here is a field name
                        }
                        echo "</table>"; //Close the table in HTML
                        connection_close(); //Make sure to close out the database connection
                        ?>
                        
                    </div>    
                </div>
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>
</body>
</html>