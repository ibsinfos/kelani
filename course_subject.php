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
                            Subject and Course Management
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Subject and Course Management
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- cours subject mng -->
                <form method="post" action="controller/course_subjectController.php" data-toggle="validator">
                    <div class="row">
                        <div class="col-lg-4">
                        	<label>Academic Year</label><br/>
                            <select name="cmbAcademicYear" required>
                            <option value='0'>        --Select Academic Year--</option>
                                <?php
                                include_once 'dbconfig.php';
                                $query = 'SELECT id, `year` FROM acadamicyear';
                                $result = getData($query);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='".$row['id']."'>".$row['year']."</option>";
                                    }
                                }
                                ?>
                            </select><br />
                            
                            <label>Course Name</label><br/>
                            <select name="cmbCourse" required>
                            <option value='0'>        --Select Course--</option>
                                <?php
                                include_once 'dbconfig.php';
                                $query = 'SELECT id,`Name` FROM course_tbl';
                                $result = getData($query);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='".$row['id']."'>".$row['Name']."</option>";
                                    }
                                }
                                ?>
                            </select><br />

                            <label>Part</label><br/>
                            <select name="cmbPart_DD" required>
                            <option value='0'>        --Select Part--</option>
                                <?php
                                include_once 'dbconfig.php';
                                $query = 'SELECT id, `name` FROM part_tbl';
                                $result = getData($query);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                    }
                                }
                                ?>
                            </select><br />

                            <label>Subject Name</label><br/>
                            <select name="cmbSubject" required>
                            <option value='0'>        --Select Subject--</option>
                                <?php
                                include_once 'dbconfig.php';
                                $query = 'SELECT * FROM subject_tbl';
                                $result = getData($query);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='".$row['id']."'>".$row['subjectname']."</option>";
                                    }
                                }
                                ?>
                            </select><br />

                            <label>Fee</label><br/>
                            <input type="text" name="txtFee" size="10" maxlength="10" required/><br/>
                            <input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">
                        
                        <div>
                            <input type="submit" value="Add" name="btnAdd"/>
                            <input type="submit" value="Update" name="btnUpdate"/>
                            <input type="submit" value="Delete" name="btnDelete"/>
                            <input type="reset" value="Clear" name="btnClear"/>
                        </div>
                        
                        </div>
                    
                        <div class="col-lg-8 selecttable">
                        <?php
						include_once 'dbconfig.php'; //Connect to database
						$query = "SELECT s.`subjectname` AS SubjectName,c. `Name` AS CourseName, p.`name` AS Part, sc.Price,a.`year` AS AcademicYear FROM subject_tbl AS s,course_tbl AS c , subject_course_tbl AS sc, part_tbl AS p,acadamicyear AS a WHERE a.id = sc.AcadamicYear_id AND sc.Subject_tbl_id=s.id AND sc.Course_tbl_id = c.id AND sc.Part_table_id = p.id";
						$result = getData($query);
						echo "<table width='100%'>"; // start a table tag in the HTML
						echo "<tr>
								<th>COURSE</th>
								<th>YEAR</th>
								<th>PART</th>
								<th>SUBJECT</th>
								<th>FEE</th>
								<th>&nbsp;</th>
							  </tr>";
						while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
						
							echo "<tr><td>" . $row['CourseName']. "</td><td>" . $row['AcademicYear']. "</td><td>" . $row['Part']. "</td><td>" . $row['SubjectName']. "</td><td>" . $row['Price'] . "</td><td><input type='button' value='Edit'></td></tr>";  //$row['index'] the index here is a field name
						}
						echo "</table>"; //Close the table in HTML
						connection_close(); //Make sure to close out the database connection
						?>
                        </div>
                    </div>
                                        
                    <div class="row">
                    <div class="col-lg-12">


                    
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