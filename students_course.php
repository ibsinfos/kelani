<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kelani | Student Course Subjects</title>
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
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(e) {

            $('#cmbAcadamicYear').change(function(){
                var ThisValcmbAcadamicYear = $(this).find('option:selected').attr('data-year');
                $('input[name=cmbAcadamicYearYear]').val(ThisValcmbAcadamicYear);

            });
            $('#cmbPart').change(function(){
                var ThisValcmbPart = $(this).find('option:selected').text();
                $('input[name=cmbPartName]').val(ThisValcmbPart);

            });

            var ThisValcmbAcadamicYear = $('#cmbAcadamicYear').find('option:selected').attr('data-year');
            $('input[name=cmbAcadamicYearYear]').val(ThisValcmbAcadamicYear);
            var ThisValcmbPart = $('#cmbPart').find('option:selected').text();
            $('input[name=cmbPartName]').val(ThisValcmbPart);

            $('#cmbPart').click(function(e){
                Subjectload();
            });
            $('#cmbPart').change(function(e){
                Subjectload();
            });

            function Subjectload(){
                var e = document.getElementById("cmbAcadamicYear");
                var Year = e.options[e.selectedIndex].value;
                e = document.getElementById("cmbCourse");
                var Course = e.options[e.selectedIndex].value;
                e = document.getElementById("cmbPart");
                var Part = e.options[e.selectedIndex].value;
                $.ajax({
                    type:'POST',
                    url:"subjectLoadScript.php",
                    data:{year:Year,course:Course,part:Part},
                    success: function(data){
                        document.getElementById("Subject").innerHTML = data;
                    }
                });
            }

        });

        function showDetails()
        {
            var Student_ = document.getElementById("txtStudentID").value;
            window.location = 'students_course_Edit.php?Studentid='+Student_;
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
?>

<div id="wrapper">
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Student Course Subjects
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-bar-chart-o"></i> Student Course Subjects
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
                            //var_dump($permissions[0]['W']); die();
                            if ($permissions[0]['R']) {
                                ?>
            <form method="post" action="controller/students_courseController.php" data-toggle="validator" id="subcou">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                        <label class="control-label col-md-4">Student ID</label><br />
                        <input class="form-control col-md-8" type="text" name="txtStudentID" size="50" value="<?php echo $txtStudentId ?>" id="txtStudentID" readonly/><br/>
                        </div>

                        <div class="form-group">
                        <label class="control-label col-md-4">Name</label><br />
                        <input class="form-control col-md-8" type="text" name="txtName" value="<?php echo $txtNamewithInitians ?>" readonly/><br/>
                        <input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">
                        </div>

                        <div class="form-group">
                        <!--acadamic year-->
                        <label class="control-label col-md-4">Acadamic Year</label><br/>
                        <select class="form-control col-md-8" id="cmbAcadamicYear" name="cmbAcadamicYear" >
                            <?php
                            include_once 'dbconfig.php';
                            $query = 'SELECT DISTINCT sc.AcadamicYear_id, a.`year` FROM subject_course_tbl sc, acadamicyear a WHERE sc.AcadamicYear_id=a.id';
                            $result = getData($query);
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='".$row['AcadamicYear_id']."' data-year=".$row['year'].">".$row['year']."</option>";
                                }
                            }
                            ?>
                        </select>
                        <input type="hidden" name="cmbAcadamicYearYear" value=""/>
                        <br />
                        </div>

                        <div class="form-group">
                        <!--select course-->
                        <label class="control-label col-md-4">Course</label><br/>
                        <select class="form-control col-md-8" id="cmbCourse" name="cmbCourse">
                            <?php
                            include_once 'dbconfig.php';
                            $query = 'SELECT DISTINCT sc.Course_tbl_id, c.`Name` FROM subject_course_tbl sc, course_tbl c WHERE sc.Course_tbl_id=c.id';
                            $result = getData($query);
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='".$row['Course_tbl_id']."'>".$row['Name']."</option>";
                                }
                            }
                            ?>
                        </select><br />
                        </div>

                        <div class="form-group">
                        <!--load part-->
                        <label class="control-label col-md-4">Part</label><br/>
                        <select class="form-control col-md-8" id="cmbPart" name="cmbPart">
                            <?php
                            include_once 'dbconfig.php';
                            $query = 'SELECT DISTINCT sc.Part_table_id, p.`name` FROM subject_course_tbl sc, Part_tbl p WHERE sc.Part_table_id=p.id';
                            $result = getData($query);
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='".$row['Part_table_id']."' data-part-name=".$row['name'].">".$row['name']."</option>";
                                }
                            }
                            ?>
                        </select>
                        <input type="hidden" name="cmbPartName" value=""/>
                        <br />

                            <input type="hidden" name="cbSubjectPrice" value=""/>

                        </div>

                    </div>

                    <div id="Subject" class="col-lg-8">

                        <!--Load Subjects-->
                    </div>


                <!-- /.row -->
                <div class="row" style="padding-left: 15px;">
                    <div class="col-lg-12">
                    <?php if ($permissions[0]['W']){?>
                        <input type="submit" value="Add" name="btnAdd" class="btn btn-primary"/>
                        <input type="button" value="Chanege" name="btnUpdate" class="btn btn-primary" onclick="showDetails();"/>
                    <?php } else { ?>
                        <input type="submit" value="Add" name="btnAdd" class="btn btn-primary" disabled/>
                        <input type="button" value="Chanege" name="btnUpdate" class="btn btn-primary" onclick="showDetails();" disabled/>
                    <?php } ?>
                    <?php if ($permissions[0]['D']){?>
                    <input type="submit" value="Delete" name="btnDelete" class="btn btn-danger"/>
                    <?php } else { ?>
                        <input type="submit" value="Delete" name="btnDelete" class="btn btn-danger" disabled/>
                    <?php } ?>
                    <input type="reset" value="Clear" name="btnClear" class="btn btn-default"/>
                    </div>
                <div class="col-lg-12">
                <!-- /.row -->
            </form>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">

                    <?php
                    include_once 'dbconfig.php'; //Connect to database
                    $query = "SELECT ssc.Student_tb_Student_id, ssc.AcadamicYear, c.`Name` AS Course, ssc.Part, s.subjectname, ssc.Price, ssc.Grade, s.id,Subject_Course_tbl_Course_tbl_id,Subject_Course_tbl_Part_table_id,Subject_Course_tbl_Subject_tbl_id
 FROM student_subject_course_tbl ssc, subject_tbl s, course_tbl c
 WHERE ssc.Subject_Course_tbl_Course_tbl_id = c.id AND ssc.Subject_Course_tbl_Subject_tbl_id = s.id AND Student_tb_Student_id = '$txtStudentId'";
                    $result = getData($query);
                    echo "<table width='100%' class='table table-bordered table-hover'>"; // start a table tag in the HTML
                    echo "<tr>
                        <th>STUDENT ID</th>
                        <th>ACADAMIC YEAR</th>
                        <th>COURSE</th>
                        <th>PART</th>
                        <th>SUBJECT</th>
                        <th>PRICE</th>
						<th>&nbsp;</th>
                        </tr>";
                    while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                        echo "<tr><td>" .$row['Student_tb_Student_id']. "</td><td>" .$row['AcadamicYear']. "</td><td>" .$row['Course']. "</td><td>" .$row['Part']. "</td><td>" . $row['subjectname'] . "</td><td>" . $row['Price'] .
                            "</td>

							</tr>";  //$row['index'] the index here is a field name
                    }
                    echo "</table>"; //Close the table in HTML
                    connection_close(); //Make sure to close out the database connection
                    ?>
                </div>
            </div>
            <!-- /.row -->
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
</body>
</html>