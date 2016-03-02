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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah1')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }	
	
	function readURLSignature(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah2')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }	
	
	var i=1;
	function addRow()
	{	
        var tbl = document.getElementById("table1");
        var lastRow = tbl.rows.length;
        var iteration = lastRow - 1;
        var row = tbl.insertRow(lastRow);

		var SubjectList = document.getElementById("cmbALsubject");
		var SubjectCode = SubjectList.options[SubjectList.selectedIndex].value;
		var SubjectName = SubjectList.options[SubjectList.selectedIndex].text;
		var GradeList = document.getElementById("cmbALgrade");
		var GradeValeu = GradeList.options[GradeList.selectedIndex].text;
	
		var SubCode = row.insertCell(0);
		var SubName = row.insertCell(1);
		var Grade = row.insertCell(2);
	
		SubCode.innerHTML = SubjectCode;
		SubName.innerHTML = SubjectName;
		Grade.innerHTML = GradeValeu;
		
		display(SubjectCode, SubjectName, GradeValeu);
	}	
	
	function display(SubjectCode, SubjectName, GradeValeu){

		var ajax = new XMLHttpRequest(),
		url = 'controller/studentManagementSubjectController.php?Subject='+ encodeURIComponent(SubjectCode)+'&Name='+ encodeURIComponent(SubjectName)+'&Grade='+ encodeURIComponent(GradeValeu);
		ajax.open("GET", url, true);
		ajax.send();
	}
			
	function deleteRow(){
	  var tbl = document.getElementById("table1");
      var lastRow = tbl.rows.length;
      var iteration = lastRow - 1;
      var row = tbl.insertRow(lastRow);
      var d = row.parentNode.parentNode.rowIndex;
      document.getElementById('table1').deleteRow(d);
	  deleteRowQuery(d);
   }
   	
   	function deleteRowQuery(SubjectCode){

		var ajax = new XMLHttpRequest(),
		url = 'controller/studentManagementSubjectDeleteController.php';
		ajax.open("GET", url, true);
		ajax.send();
	}
	
	$(document).ready(function(e) {
					
		$('#cmbBranch').change(function(e){
			GenerateStuID();
		});

		function GenerateStuID(){
			
			e = document.getElementById("cmbBranch");
			var Branch = e.options[e.selectedIndex].value;

			$.ajax({
				type:'POST',
				url:"controller/StudenIDGenerate.php",
				data:{branch:Branch},
				success: function(data){
					document.getElementById("Student").value = data;
				}
			});
		}
		
	});	
</script>

</head>

<body>

<?php
include_once './inc/top.php';
include_once 'dbconfig.php'; 
$query = "SELECT (IFNULL(MAX(CAST(QulificationID AS UNSIGNED INT)),0) + 1) AS MAXNO FROM otherqulification_tbl;";
$result = getData($query);
$row = mysqli_fetch_array($result);
$QulificationID_ = $row['MAXNO'];
?>



    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Student Management
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Student Management
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				
				<form method="post" id="stumng" action="controller/studentManagementController.php" target="_parent" data-toggle="validator">
                <!-- student mng -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel-group" id="accordion">
                            <!--PERSONAL DETAILS-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                            PERSONAL DETAILS
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                        <div class="col-lg-4">
                                        <input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">
                                            <label>Branch</label><br/>
                                            <select  id="cmbBranch" name="cmbBranch">
                                            	<option value='0'>        --Select Branch--</option>
                                                <?php
                                                include_once 'dbconfig.php';
                                                $query = 'SELECT Branch_id,City FROM branch_tbl';
                                                $result = getData($query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='".$row['Branch_id']."'>".$row['City']."</option>";
                                                    }
                                                }
                                                ?>
                                            </select><br />
                                            <label>Student ID</label><br/>
                                           
                                            <input type="text" name="txtStudentId" size="13"  value="" id="Student" maxlength="13"/><br/>
                                            <label>Old Student ID</label><br/>
                                            <input type="text" name="txtOldStudentId" size="40" maxlength="13"/><br/>
                                            <label>Full Name</label><br/>
                                            <textarea rows="3" cols="41" name="txaFullname" maxlength="255"></textarea><br/>
                                            <label>Name with initials</label><br/>
                                            <input type="text" name="txtNamewithInitians" size="40" maxlength="150"/><br/>
                                            <label>NIC No</label><br/>
                                            <input type="text" name="txtNic" size="40" maxlength="12"/><br/>
                                            <label>Birthday</label><br/>
                                            <input type="date" name="dtpBirthday"/><br/>
                                            <label>Gender</label><br/>
                                            <label>
                                                <input type="radio" name="rbGender" value="M" id="gender_0" /> Male
                                            </label>
                                            <label>
                                                <input type="radio" name="rbGender" value="F" id="gender_1" />Female
                                            </label>
                                            <br />
                                            <label>Nationality</label><br/>
                                            <select name="cmbNationality">
                                                <option value="SriLankan">Sri Lankan</option>
                                                <option value="other">Other</option>
                                            </select><br />

                                            <label>District</label><br/>
                                            <select name="cmbDistrict">
                                                <?php
                                                include_once 'dbconfig.php';
                                                $query = 'SELECT District_ID,`Name` FROM district_tbl';
                                                $result = getData($query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='".$row['District_ID']."'>".$row['Name']."</option>";
                                                    }
                                                }
                                                ?>
                                            </select><br />
                                            <label>Polling Division</label><br/>
                                            <select name="cmbPollingDivision">
                                                <?php
                                                include_once 'dbconfig.php';
                                                $query = 'SELECT Polling_ID, `Name` FROM polling_devition_tbl';
                                                $result = getData($query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='".$row['Polling_ID']."'>".$row['Name']."</option>";
                                                    }
                                                }
                                                ?>
                                            </select><br />
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Home Address</label><br/>
                                            <textarea rows="3" cols="41" name="txaHomeAddress" maxlength="255"></textarea><br/>
                                            <label>Office Address</label><br/>
                                            <textarea rows="3" cols="41" name="txaOfficeAddress" maxlength="255"></textarea><br/>
                                            <label>Telephone Home</label><br/>
                                            <input type="text" name="txtTelephoneHome" maxlength="10" size="40" /><br/>
                                            <label>Telephone Office</label><br/>
                                            <input type="text" name="txtTelephoneOffice" maxlength="10" size="40" /><br/>
                                            <label>Telephone Mobile</label><br/>
                                            <input type="text" name="txtTelephoneMobile" maxlength="10" size="40" /><br/>
                                            <label>Email</label><br/>
                                            <input type="email" name="txtEmail" size="40" maxlength="100" />
                                            <label>Registration Date</label><br/>
                                            <input type="date" name="dtpRegDate"/><br/>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Photo</label><br/>
                                            <img id="blah1" class="imgPhoto" src="img/photo.png" alt="your image" name="imgImageStu" />
                                            <br>
                                            <input type='file' style="border:none !important;" onChange="readURL(this);" id="fileUpload" name="ImageStu"/>
                                        <br />

                                            <br/>
                                            <label>Signature</label><br/>
                                            <img id="blah2" class="imgsignature" src="img/signature.jpg" alt="your image" name="imgImageSig" />
                                            <br>
                                            <input type='file' style="border:none !important;" onChange="readURLSignature(this);" name="ImageSig" /><br />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="submitfooter">
                                            <input type="button" name="btnNext_PD" value="Next" style="float:right" class="btn btn-info" data-toggle="collapse" data-target="#collapse1,#collapse2" />
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!--END PERSONAL DETAILS-->

                            <!--DEGREE DETAILS-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                            DEGREE DETAILS
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label>Medium</label><br/>
                                            <select name="cmbDegreeMedium">
                                                <option value="S">Sinhala</option>
                                                <option value="E">English</option>
                                            </select><br />
                                            <label>Center for Examination and Seminar</label><br/>
                                            <select name="cmbCenters">
                                                <?php
                                                include_once 'dbconfig.php';
                                                $query = 'SELECT id,`name` FROM examcenter_tbl';
                                                $result = getData($query);
                                                if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                                    }
                                                }
                                                ?>
                                            </select><br/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="submitfooter">
                                            <input type="button" name="btnNext_DD" value="Next" style="float:right"  class="btn btn-info" data-toggle="collapse" data-target="#collapse2,#collapse3"/>
                                            <input type="button" name="btnPrevious_DD" value="Previous" style="float:right"  class="btn btn-info" data-toggle="collapse" data-target="#collapse2,#collapse1"/>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                            </div>
                            <!--END DEGREE DETAILS-->

                            <!--EDUCATION QUALIFICATION-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                            EDUCATION QUALIFICATION
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">
									<div class="row">
                                        <div class="col-lg-12">
                                            <h3>O/L QUALIFICATIONS</h3><hr/>
                                            <div class="col-lg-4">
                                                <label>Index No</label><br/>
                                                <input type="text" name="txtOLindexNo" size="50" maxlength="10"/><br/>
                                                <label>Year</label><br/>
                                                <input type="text" name="txtOLyear" size="50" maxlength="4" /><br/>
                                                <label>Has passed 06 subjects (including Maths) from G.C.E O/L with 03 Credit passes</label><br/>
                                                <label>
                                                    <input type="radio" name="rbOLpass" value="1" id="gender_0" /> Yes
                                                </label>
                                                <label>
                                                    <input type="radio" name="rbOLpass" value="0" id="gender_1" />No
                                                </label><br />
                                                <label>English Grade</label><br/>
                                                <select name="cmbEnglishGrade">
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="F">F</option>
                                                </select>
                                                <br /><br />
                                            </div>
                                        </div>
									</div>
									

                                        <div class="row">
                                            <h3>A/L QUALIFICATIONS</h3><hr/>
                                            <div class="col-lg-4">
                                                <label>Index No</label><br/>
                                                <input type="text" name="txtALindexNo" size="50" maxlength="10"/><br/>
                                                <label>Year</label><br/><input type="text" name="txtALyear" size="4" maxlength="4"/>
                                                <br/>
                                                <label>Medium</label><br/>
                                                <select name="cmbALmedium">
                                                    <option value="S">Sinhala</option>
                                                    <option value="E">English</option>
                                                </select><br />
                                                <label>Center No</label><br/>
                                                <input type="text" name="txtALCenterNo" size="50" maxlength="10"/><br/>

                                                <label>District</label><br/>
                                                <select name="cmbALdistrict">
                                                    <?php
                                                    include_once 'dbconfig.php';
                                                    $query = 'SELECT District_ID,`Name` FROM district_tbl';
                                                    $result = getData($query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        // output data of each row
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "<option value='".$row['District_ID']."'>".$row['Name']."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select><br/>

                                                <label>District Rank</label><br/>
                                                <input type="text" name="txtALdistrictRank" size="50" maxlength="5"/><br/>
                                                <label>Island Rank</label><br/>
                                                <input type="text" name="txtALislandRank" size="50" maxlength="5"/><br/>
                                                <label>Z-Score</label><br/>
                                                <input type="text" name="txtALzscore" size="50" maxlength="6"/><br/>
                                                <label>General Test</label><br/>
                                                <input type="text" name="txtALgeneralTest" size="50" maxlength="3"/><br/>
                                                <label>A/L Stream</label><br/>
                                                <select name="cmbALStream">
                                                    <option value="A">Art</option>
                                                    <option value="B">Bio</option>
                                                    <option value="C">Commerce</option>
                                                    <option value="M">Maths</option>
                                                </select><br />
                                            </div>
                                            <div class="col-lg-4" id = "Subject">
                                                <table width="100%">
                                                    <tr>
                                                        <th>SUBJECTS</th><th>GRADE</th><th>ADD</th>
                                                    </tr> 
                                                    <tr>
                                                        <td><select name="cmbALsubject" style="width: 250px;" id = "cmbALsubject">
                                                          <?php
                                                                include_once 'dbconfig.php';
                                                                $query = 'SELECT SubjectID, `Name` FROM alsubject_tbl';
                                                                $result = getData($query);
                                                                if (mysqli_num_rows($result) > 0) {
                                                                    // output data of each row
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        echo "<option value='".$row['SubjectID']."'>".$row['Name']."</option>";
                                                                    }
                                                                }
                                                                ?>
                                                        </select>
                                                          <br />                                                        </td>

                                                  <td>
                                                            <select name="cmbALgrade" style="width: 150px;"  id = "cmbALgrade">
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="F">F</option>
                                                            </select><br />                                                        </td>

                                                        <td>
                                                            <input type="button" value="Add" onClick="addRow();" />                                                        </td>
                                                    </tr>                                                      
                                                </table>
                                                <table width="100%" border="0" id="table1">
                                                  <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                  </tr>                                                
                                                </table>
                                                <table width="100%" border="0">
                                                  <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><input type="button" value="Clear" onClick="deleteRow();" /> </td>
                                                  </tr>                                               
                                                </table>
                                          </div>
                                        </div>

                                        <div class="row">
                                            <div class="submitfooter">
                                                <input type="button" name="btnNext_EQ" value="Next" style="float:right" class="btn btn-info" data-toggle="collapse" data-target="#collapse3,#collapse4"/>
                                                <input type="button" name="btnPrevious_EQ" value="Previous" style="float:right" class="btn btn-info" data-toggle="collapse" data-target="#collapse3,#collapse2"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END EDUCATION QUALIFICATION-->

                            <!--OTHER QUALIFICATION-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                            OTHER QUALIFICATION
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">
									<div class="row">
                                        <div class="col-lg-12">
                                            <h3>Education</h3><hr/>
                                            <label>Diploma / Certificate</label><br/>
                                            <input type="hidden" name="txtCourseID"  value="<?php echo $QulificationID_; ?>" size="40"/>
                                            <input type="text" name="txtDiplomaName_OQ" size="50" maxlength="150"/><br/>
                                            <label>Institute</label><br/>
                                            <input type="text" name="txtInstitute_OQ" size="50" maxlength="150"/><br/>
                                            <label>Subject</label><br/>
                                            <input type="text" name="txtSubject_OQ" size="50" maxlength="100"/><br/>
                                            <label>Grade</label><br/>
                                            <input type="text" name="txtGrade_OQ" size="50" maxlength="45"/><br/>
                                            <label>Year</label><br/>
                                            <input type="text" name="txtYear_OQ" size="50" maxlength="4"/><br/>
                                        </div>
									</div>

                                        <div class="row">
                                            <div class="submitfooter">
                                               
                                                <input type="reset" value="Clear" class="btn-default btn"/>
                                                <input type="submit" name="btnFinishDD" value="Finish" style="float:right" class="btn-primary btn"/>
                                                <input type="button" name="btnPrevious_EQ" value="Previous" style="float:right" class="btn btn-info" data-toggle="collapse" data-target="#collapse4,#collapse3"/>
                                            </div>
                                        </div>

                                    </div>
                                </div>
								</div>
						</div>
                        <!--END OTHER QUALIFICATION-->
                
                        </div>
                </div>
                <!-- /student mng -->
				</form>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>
</body>
</html>