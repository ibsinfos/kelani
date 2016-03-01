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

		function UpdateSubjectGrade(){

			var Student_Id_ = document.getElementById("txtStudentID").value;			
			var AcadamicYear_ = document.getElementById("cmbAcadamicYear").value;
			var Course_id_ = document.getElementById("cmbCourse").value;
			var Part_id_ = document.getElementById("cmbPartName").value;
			var Subject_id_ = document.getElementById("txtSubject").value;
			var Grage_ = document.getElementById("cmbGrade").value;
			var Status_ = document.getElementById("cmbStatus").value;
			
			$.ajax({
			type:'POST',
			url:"controller/students_courseController_Edit.php",
			data:{studentID:Student_Id_,AcadamicYr:AcadamicYear_,CourseI:Course_id_,PartI:Part_id_,SubjectI:Subject_id_,GradeI:Grage_,StatusI:Status_},
			success: function(data){
				document.getElementById("Student123").innerHTML = data;
				document.getElementById("txtSubj").value = '';
				document.getElementById("txtSubject").value = '';
				document.getElementById("cmbGrade").value = 'O';
				document.getElementById("cmbStatus").value = '1';
			}
			});
		}

</script>
</head><body>

<?php
include_once './inc/top.php';
include_once 'dbconfig.php';
    // this page outputs the contents of the textarea if posted	
if(isset($_GET['Studentid'])){
	 $txtStudentId = $_GET['Studentid'];
	 $query = "SELECT * FROM student_tb WHERE Student_id='".$txtStudentId."'";
	 $result = getData($query);
	 $row = mysqli_fetch_array($result);
	 $txtNamewithInitians = $row['Name'];
	 $txtStudentId = $row['Student_id'];   
}
else{
	$txtStudentId = '';
	$txtNamewithInitians = '';
}

if(isset($_GET['Student_id'])){
 
		 $txtStudentId = $_GET['Student_id'];
		 $AcadamicYear = $_GET['AcadamicYear'];
		 $Course_id = $_GET['Course_id'];
		 $query = "SELECT `Name` AS courseName FROM course_tbl WHERE id='".$Course_id."'";
		 $result = getData($query);
		 $row = mysqli_fetch_array($result);
		 $Course_ = $row['courseName'];
		 $Part_id = $_GET['Part_id'];		 
		 $query = "SELECT name AS partname FROM part_tbl WHERE id='".$Part_id."'";
		 $result = getData($query);
		 $row = mysqli_fetch_array($result);
		 $Part = $row['partname'];
		 $query = "SELECT * FROM student_tb WHERE Student_id='".$txtStudentId."'";
		 $result = getData($query);
		 $row = mysqli_fetch_array($result);
		 $txtNamewithInitians = $row['Name'];
		 $Subject_id = $_GET['Subject_id'];	
 		 $query = "SELECT subjectname FROM subject_tbl WHERE id='".$Subject_id."'";
		 $result = getData($query);
		 $row = mysqli_fetch_array($result);
		 $subjectname = $row['subjectname'];
		 $Grade = $_GET['GradeS'];
		 $Status_ = $_GET['Status'];
		 
	}
	else{
		 $AcadamicYear = '';
		 $Course_id = '';		
		 $Course_ = '';
		 $Part_id = '';		 		 
		 $Part = '';		
		 $txtNamewithInitians = '';
		 $Subject_id = '';	 		
		 $subjectname = '';
		 $Grade = 'O';
		 $Status_ = '1';
	}
?>

    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Student Subjects Update
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Student Subjects
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <form method="post" action="controller/students_courseController_Edit.php" data-toggle="validator">
                <div class="row">
                    <div class="col-lg-4">
                        <label>Student ID</label><br />
                        <input type="text" name="txtStudentID" size="50" value="<?php echo $txtStudentId ?>" id="txtStudentID" disabled/><br/>
                        <label>Name</label><br />
                        <input type="text" name="txtName" value="<?php echo $txtNamewithInitians ?>" disabled/><br/>  
                    </div>
                    
                    <div class="col-lg-4">
                    <!--acadamic year-->
                        <label>Acadamic Year</label><br/>
                        <input type="text" name="cmbAcadamicYear" value="<?php echo $AcadamicYear ?>" disabled id="cmbAcadamicYearYear"/>
                        <input type="hidden" name="txtAcadamicYearYear" value="<?php echo $AcadamicYear ?>" id="cmbAcadamicYear"/>
                        <br />
                        
                        <!--select course-->
                        <label>Course</label><br/>
                        <input type="hidden" name="cmbCourse" value="<?php echo $Course_id ?>" id="cmbCourse"/>
                        <input type="text" name="txtCour" value="<?php echo $Course_ ?>" disabled/>
                    </div>
                    
                    <div class="col-lg-4">
                    <!--load part-->
                        <label>Part</label><br/>     
                        <input type="text" name="cmbPart" value="<?php echo $Part ?>" disabled/>
                        <input type="hidden" name="cmbPartName" value="<?php echo $Part_id ?>" id="cmbPartName"/>
                        <br />  
                        
                    </div>
                                       
                </div>
                
                <div class="row">
                <div class="col-lg-4">
                
                <label>Subject</label><br />
                <input type="text" name="txtSubj" size="50" value="<?php echo $subjectname ?>" id="txtSubj" disabled/>
                <input type="hidden" name="txtSubject" size="50" value="<?php echo $Subject_id ?>" id="txtSubject" />
                </div>
                <div class="col-lg-4">
                <label>Grade</label><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label>Status</label><br />        
                <select name='cmbGrade' style='width:80px;' id="cmbGrade">
							<option <?php echo $Grade == "O" ? 'selected' : '' ?> value='O'>O</option>
							<option <?php echo $Grade == "A plus" ? 'selected' : '' ?> value='A plus'>A plus</option>
							<option <?php echo $Grade == "A" ? 'selected' : '' ?> value='A'>A</option>
							<option <?php echo $Grade == "A minus" ? 'selected' : '' ?> value='A minus'>A minus</option>
							<option <?php echo $Grade == "B plus" ? 'selected' : '' ?> value='B plus'>B plus</option>
							<option <?php echo $Grade == "B" ? 'selected' : '' ?> value='B'>B</option>
							<option <?php echo $Grade == "B minus" ? 'selected' : '' ?> value='B minus'>B minus</option>
							<option <?php echo $Grade == "C plus" ? 'selected' : '' ?> value='C plus'>C plus</option>
							<option <?php echo $Grade == "C" ? 'selected' : '' ?> value='C'>C</option>
							<option <?php echo $Grade == "C minus" ? 'selected' : '' ?> value='C minus'>C minus</option>
							<option <?php echo $Grade == "D plus" ? 'selected' : '' ?> value='D plus'>D plus</option>
							<option <?php echo $Grade == "D" ? 'selected' : '' ?> value='D'>D</option>
                            <option <?php echo $Grade == "D minus" ? 'selected' : '' ?> value='D minus'>D minus</option>
							<option <?php echo $Grade == "E plus" ? 'selected' : '' ?> value='E plus'>E plus</option>
							<option <?php echo $Grade == "E" ? 'selected' : '' ?> value='E'>E</option>
							<option <?php echo $Grade == "E minus" ? 'selected' : '' ?> value='E minus'>E minus</option>
							<option <?php echo $Grade == "F" ? 'selected' : '' ?> value='F'>F</option>
							<option <?php echo $Grade == "AB" ? 'selected' : '' ?> value='AB'>AB</option>
							</select>


							<select name=cmbStatus style='width:80px;' id="cmbStatus">
							<option <?php echo $Status_ == "1" ? 'selected' : '' ?> value='1'>Active</option>
							<option <?php echo $Status_ == "0" ? 'selected' : '' ?> value='0'>Deactive</option>
							</select>
                            
                </div>
                </div>
                                
                <!-- /.row -->
                <div class="row" style="padding-left: 15px;">
                    <!--<input type="submit" value="Add" name="btnAdd"/>-->                    
                    <!--<input type="submit" value="Delete" name="btnDelete"/>-->
                    <input type="reset" value="Clear" name="btnClear"/>
                    <input type="button" value="Update" name="btnUpdate" id="btnUpdate" onClick="UpdateSubjectGrade()"/>
                </div>
                <!-- /.row -->
 				</form>
                
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12" id="Student123">
                    
                    <?php
                        include_once 'dbconfig.php'; //Connect to database
                        $query = "SELECT ssc.Student_tb_Student_id, ssc.AcadamicYear, c.`Name` AS Course, ssc.Part, s.subjectname, ssc.Price, ssc.Grade, s.id,Subject_Course_tbl_Course_tbl_id,Subject_Course_tbl_Part_table_id,Subject_Course_tbl_Subject_tbl_id, ssc.Status 
 FROM student_subject_course_tbl ssc, subject_tbl s, course_tbl c 
 WHERE ssc.Subject_Course_tbl_Course_tbl_id = c.id AND ssc.Subject_Course_tbl_Subject_tbl_id = s.id AND Student_tb_Student_id = '$txtStudentId'";
                        $result = getData($query);
                        echo "<table width='100%'>"; // start a table tag in the HTML
                        echo "<tr>
                        <th>STUDENT ID</th>
                        <th>ACADAMIC YEAR</th>
                        <th>COURSE</th>
                        <th>PART</th>
                        <th>SUBJECT</th>
						<th>GRADE</th>
                        <th>PRICE</th>
						<th>STATUS</th>
						<th>&nbsp;</th>
                        </tr>";
                        while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                            echo "<tr><td>" .$row['Student_tb_Student_id']. "</td><td>" .$row['AcadamicYear']. "</td><td>" .$row['Course']. "</td><td>" .$row['Part']. "</td><td>" . $row['subjectname'] . "</td><td>" . $row['Grade'] . 
							"</td><td>" . $row['Price'] . 
							"</td>
							<td>" . $row['Status'] . 
							"</td>
							<td>
							<a href='students_course_Edit.php?Student_id=" .$row['Student_tb_Student_id']. "&AcadamicYear=" .$row['AcadamicYear']. "&Course_id=" .$row['Subject_Course_tbl_Course_tbl_id']. "&Part_id=" .$row['Subject_Course_tbl_Part_table_id']. "&Subject_id=" .$row['Subject_Course_tbl_Subject_tbl_id']. "&GradeS=".$row['Grade']."&Status=".$row['Status']."'>View</a>
							</td>
							</tr>";  //$row['index'] the index here is a field name
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