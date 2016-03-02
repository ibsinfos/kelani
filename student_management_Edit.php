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

        var i = 1;
        function addRow() {
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

        function display(SubjectCode, SubjectName, GradeValeu) {

            var ajax = new XMLHttpRequest(),
                url = 'controller/studentManagementSubjectController.php?Subject=' + encodeURIComponent(SubjectCode) + '&Name=' + encodeURIComponent(SubjectName) + '&Grade=' + encodeURIComponent(GradeValeu);
            ajax.open("GET", url, true);
            ajax.send();
        }

        function deleteRow() {
            var tbl = document.getElementById("table1");
            var lastRow = tbl.rows.length;
            var iteration = lastRow - 1;
            var row = tbl.insertRow(lastRow);
            var d = row.parentNode.parentNode.rowIndex;
            document.getElementById('table1').deleteRow(d);
            deleteRowQuery(d);
        }

        function deleteRowQuery(SubjectCode) {

            var ajax = new XMLHttpRequest(),
                url = 'controller/studentManagementSubjectDeleteController.php';
            ajax.open("GET", url, true);
            ajax.send();
        }

    </script>


</head>

<body>

<?php
include_once './inc/top.php';
include_once 'dbconfig.php';

if (isset($_GET['Studentid'])) {
    $txtStudentId = $_GET['Studentid'];
} else {
    $txtStudentId = '';
}
if (isset($txtStudentId)) {

    $search = $txtStudentId;
    $query = "SELECT S.`Branch_tbl_Branch_id`, S.`Student_id`, S.`Old_student_id`, S.`FullName`, S.`Name`, S.`NIC`, S.`DOB`, S.`Gender`, S.`Address1`,S.`Address2`,S.`Nationality`,S.`TP_Home`,S.`TP_Office`,S.`TP_mob`, S.`Email`, S.`Reg_Date`, S.`Signature`, S.`Picture`, S.`District_tbl_District_ID`, S.`Polling_devition_tbl_Polling_ID`, S.`Course_tbl_Course_ID`, S.`Medium` AS OMedium, S.`ExamCenter_tbl_id`, S.`OLQulification_tbl_Index_no`, S.`ALQulification_tbl_Index_no`,
O.`Index_no`, O.`Year` AS OYear, O.`Pass`, O.`English_grade`, A.`Year`	AS AYear, A.`Medium`, A.`Center_no`, A.`District_tbl_District_ID`, A.`District_rank`, A.`Island_rank`, A.`Z_core`, A.`GeneralTestMarks`, A.`ALStream`, OT.QulificationID, OT.`Name` AS OTName, OT.`Institute`, OT.`Subject` AS OTSubject, OT.`Grade` AS OTGrade, OT.`Year` AS OTYear
	FROM student_tb AS S LEFT OUTER JOIN olqulification_tbl AS O ON S.OLQulification_tbl_Index_no = O.Index_no LEFT OUTER JOIN alqulification_tbl A ON S.ALQulification_tbl_Index_no = A.Index_no LEFT OUTER JOIN otherqulification_tbl OT ON S.Student_id = OT.Student_tb_Student_id WHERE S.Student_id = '$search'";
    $result = getData($query);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            //Student Details
            $Branch_id_ = $row['Branch_tbl_Branch_id'];
            $SubjectID_ = $row['Student_id'];
            $Old_student_id_ = $row['Old_student_id'];
            $FullName_ = $row['FullName'];
            $Name_ = $row['Name'];
            $NIC_ = $row['NIC'];
            $DOB_ = $row['DOB'];
            $Gender_ = $row['Gender'];
            $Address1_ = $row['Address1'];
            $Address2_ = $row['Address2'];
            $Nationality_ = $row['Nationality'];
            $TP_Home_ = $row['TP_Home'];
            $TP_Office_ = $row['TP_Office'];
            $TP_mob_ = $row['TP_mob'];
            $Email_ = $row['Email'];
            $Reg_Date_ = $row['Reg_Date'];
            $Picture_ = $row['Picture'];
            $Signature_ = $row['Signature'];
            $District_ID_ = $row['District_tbl_District_ID'];
            $Polling_ID_ = $row['Polling_devition_tbl_Polling_ID'];
            $Medium_ = $row['OMedium'];
            $ExamCenter_tbl_id_ = $row['ExamCenter_tbl_id'];
            $OLIndex_no_ = $row['OLQulification_tbl_Index_no'];
            $ALIndex_no_ = $row['ALQulification_tbl_Index_no'];

            //O/L
            $Year_ = $row['OYear'];
            $Pass_ = $row['Pass'];
            $English_grade_ = $row['English_grade'];

            //A/L
            $ALYear_ = $row['AYear'];
            $Center_no_ = $row['Center_no'];
            $District_rank_ = $row['District_rank'];
            $Island_rank_ = $row['Island_rank'];
            $Z_core_ = $row['Z_core'];
            $GeneralTestMarks_ = $row['GeneralTestMarks'];
            $AMedium_ = $row['Medium'];
            $District_tbl_District_ID = $row['District_tbl_District_ID'];
            $ALStream_ = $row['ALStream'];

            //Other Details
            $OTName_ = $row['OTName'];
            $Institute_ = $row['Institute'];
            $OTSubject_ = $row['OTSubject'];
            $OTGrade_ = $row['OTGrade'];
            $OTYear_ = $row['OTYear'];
            $QulificationID_ = $row['QulificationID'];
        }
    } else {
        //Student Details
        $Branch_id_ = '';
        $SubjectID_ = '';
        $Old_student_id_ = '';
        $FullName_ = '';
        $Name_ = '';
        $NIC_ = '';
        $DOB_ = '';
        $Gender_ = '';
        $Address1_ = '';
        $Address2_ = '';
        $Nationality_ = '';
        $TP_Home_ = '';
        $TP_Office_ = '';
        $TP_mob_ = '';
        $Email_ = '';
        $Reg_Date_ = '';
        $Picture_ = '';
        $Signature_ = '';
        $District_ID_ = '';
        $Polling_ID_ = '';
        $Medium_ = '';
        $ExamCenter_tbl_id_ = '';
        $OLIndex_no_ = '';
        $ALIndex_no_ = '';

        //O/L
        $Year_ = '';
        $Pass_ = '';
        $English_grade_ = '';

        //A/L
        $ALYear_ = '';
        $Center_no_ = '';
        $District_rank_ = '';
        $Island_rank_ = '';
        $Z_core_ = '';
        $GeneralTestMarks_ = '';
        $AMedium_ = '';
        $District_tbl_District_ID = '';
        $ALStream_ = '';

        //Other Details
        $OTName_ = '';
        $Institute_ = '';
        $OTSubject_ = '';
        $OTGrade_ = '';
        $OTYear_ = '';
        $QulificationID_ = '';
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
                        Student Management
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-bar-chart-o"></i> Student Management
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

                <form method="post" action="controller/studentManagementControllerEdit.php" target="_parent"
                      data-toggle="validator">
                    <!-- student mng -->
                    <div class="row">
                        <div class="row">
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

                                                    <label>Branch</label><br/>
                                                    <select name="cmbBranch">
                                                        <?php
                                                        include_once 'dbconfig.php';
                                                        $query = 'SELECT Branch_id,City FROM branch_tbl';
                                                        $result = getData($query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            // output data of each row
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $selected = $row['Branch_id'] == $Branch_id_ ? 'selected' : '';
                                                                echo "<option " . $selected . " value='" . $row['Branch_id'] . "'>" . $row['City'] . "</option>";
                                                            }
                                                        }
                                                        ?>

                                                    </select><br/>
                                                    <label>Student ID</label><br/>

                                                    <input type="text" name="txtStudentId" size="40"
                                                           value="<?php echo $SubjectID_ ?>"/><br/>
                                                    <label>Old Student ID</label><br/>
                                                    <input type="text" name="txtOldStudentId" size="40"
                                                           value="<?php echo $Old_student_id_ ?>"/><br/>
                                                    <label>Full Name</label><br/>
                                                    <textarea rows="3" cols="41"
                                                              name="txaFullname"><?php echo $FullName_ ?></textarea><br/>
                                                    <label>Name with initials</label><br/>
                                                    <input type="text" name="txtNamewithInitians" size="40"
                                                           value="<?php echo $Name_ ?>"/><br/>
                                                    <label>NIC No</label><br/>
                                                    <input type="text" name="txtNic" size="40"
                                                           value="<?php echo $NIC_ ?>"/><br/>
                                                    <label>Birthday</label><br/>
                                                    <input type="date" name="dtpBirthday"
                                                           value="<?php echo $DOB_ ?>"/><br/>
                                                    <label>Gender</label><br/>
                                                    <label>
                                                        <input type="radio" name="rbGender" value="M"
                                                               id="gender_0" <?php echo ($Gender_ == 'M') ? 'checked' : '' ?>/>
                                                        Male
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="rbGender" value="F"
                                                               id="gender_1" <?php echo ($Gender_ == 'F') ? 'checked' : '' ?>/>Female
                                                    </label>
                                                    <br/>
                                                    <label>Nationality</label><br/>
                                                    <select name="cmbNationality">
                                                        <option <?php echo $Nationality_ == "SriLankan" ? 'selected' : '' ?>
                                                            value="SriLankan">Sri Lankan
                                                        </option>
                                                        <option <?php echo $Nationality_ == "other" ? 'selected' : '' ?>
                                                            value="other">Other
                                                        </option>
                                                    </select><br/>

                                                    <label>District</label><br/>
                                                    <select name="cmbDistrict">
                                                        <?php
                                                        include_once 'dbconfig.php';
                                                        $query = 'SELECT District_ID,`Name` FROM district_tbl';
                                                        $result = getData($query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            // output data of each row
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $selected = $row['District_ID'] == $District_ID_ ? 'selected' : '';
                                                                echo "<option " . $selected . " value='" . $row['District_ID'] . "'>" . $row['Name'] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select><br/>
                                                    <label>Polling Division</label><br/>
                                                    <select name="cmbPollingDivision">
                                                        <?php
                                                        include_once 'dbconfig.php';
                                                        $query = 'SELECT Polling_ID, `Name` FROM polling_devition_tbl';
                                                        $result = getData($query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            // output data of each row
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $selected = $row['Polling_ID'] == $Polling_ID_ ? 'selected' : '';
                                                                echo "<option " . $selected . " value='" . $row['Polling_ID'] . "'>" . $row['Name'] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select><br/>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label>Home Address</label><br/>
                                                    <textarea rows="3" cols="41" name="txaHomeAddress"
                                                              value=""><?php echo $Address1_ ?></textarea><br/>
                                                    <label>Office Address</label><br/>
                                                    <textarea rows="3" cols="41" name="txaOfficeAddress"
                                                              value=""><?php echo $Address2_ ?></textarea><br/>
                                                    <label>Telephone Home</label><br/>
                                                    <input type="text" name="txtTelephoneHome" maxlength="10" size="40"
                                                           value="<?php echo $TP_Home_ ?>"/><br/>
                                                    <label>Telephone Office</label><br/>
                                                    <input type="text" name="txtTelephoneOffice" maxlength="10"
                                                           size="40" value="<?php echo $TP_Office_ ?>"/><br/>
                                                    <label>Telephone Mobile</label><br/>
                                                    <input type="text" name="txtTelephoneMobile" maxlength="10"
                                                           size="40" value="<?php echo $TP_mob_ ?>"/><br/>
                                                    <label>Email</label><br/>
                                                    <input type="email" name="txtEmail" size="40"
                                                           value="<?php echo $Email_ ?>">
                                                    <label>Registration Date</label><br/>
                                                    <input type="date" name="dtpRegDate"
                                                           value="<?php echo $Reg_Date_ ?>"/><br/>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label>Photo</label><br/>
                                                    <img id="blah1" class="imgPhoto"
                                                         src="<?php echo $Picture_ == '1' ? 'img/photo.png' : $Picture_ ?>"
                                                         alt="your image" name="imgImageStu"/>
                                                    <br>
                                                    <input type='file' style="border:none !important;"
                                                           onChange="readURL(this);" id="fileUpload" name="ImageStu"/>
                                                    <br/>

                                                    <br/>
                                                    <label>Signature</label><br/>
                                                    <img id="blah2" class="imgsignature"
                                                         src="<?php echo $Signature_ == '1' ? 'img/signature.jpg' : $Signature_ ?>"
                                                         alt="your image" name="imgImageSig"/>
                                                    <br>
                                                    <input type='file' style="border:none !important;"
                                                           onChange="readURLSignature(this);" name="ImageSig"/><br/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="submitfooter">
                                                    <input type="button" name="btnNext_PD" value="Next"
                                                           style="float:right" class="btn btn-info"
                                                           data-toggle="collapse" data-target="#collapse1,#collapse2"/>
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
                                                        <option <?php echo $Medium_ == "S" ? 'selected' : '' ?>
                                                            value="S">Sinhala
                                                        </option>
                                                        <option <?php echo $Medium_ == "E" ? 'selected' : '' ?>
                                                            value="E">English
                                                        </option>
                                                    </select><br/>
                                                    <label>Center for Examination and Seminar</label><br/>
                                                    <select name="cmbCenters">
                                                        <?php
                                                        include_once 'dbconfig.php';
                                                        $query = 'SELECT id,`name` FROM examcenter_tbl';
                                                        $result = getData($query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            // output data of each row
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $selected = $row['id'] == $ExamCenter_tbl_id_ ? 'selected' : '';
                                                                echo "<option " . $selected . " value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select><br/>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="submitfooter">
                                                    <input type="button" name="btnNext_DD" value="Next"
                                                           style="float:right" class="btn btn-info"
                                                           data-toggle="collapse" data-target="#collapse2,#collapse3"/>
                                                    <input type="button" name="btnPrevious_DD" value="Previous"
                                                           style="float:right" class="btn btn-info"
                                                           data-toggle="collapse" data-target="#collapse2,#collapse1"/>
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
                                                <h3>O/L QUALIFICATIONS</h3>
                                                <hr/>
                                                <div class="col-lg-4">
                                                    <label>Index No</label><br/>
                                                    <input type="text" name="txtOLindexNo" size="50"
                                                           value="<?php echo $OLIndex_no_ ?>"/><br/>
                                                    <label>Year</label><br/>
                                                    <input type="text" name="txtOLyear" size="50"
                                                           value="<?php echo $Year_ ?>"/><br/>
                                                    <label>Has passed 06 subjects (including Maths) from G.C.E O/L with
                                                        03 Credit passes</label><br/>
                                                    <label>
                                                        <input type="radio" name="rbOLpass" value="1"
                                                               id="gender_0" <?php echo ($Pass_ == '1') ? 'checked' : '' ?>/>
                                                        Yes
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="rbOLpass" value="0"
                                                               id="gender_1" <?php echo ($Pass_ == '0') ? 'checked' : '' ?>/>No
                                                    </label><br/>
                                                    <label>English Grade</label><br/>
                                                    <select name="cmbEnglishGrade">
                                                        <option <?php echo $English_grade_ == "A" ? 'selected' : '' ?>
                                                            value="A">A
                                                        </option>
                                                        <option <?php echo $English_grade_ == "B" ? 'selected' : '' ?>
                                                            value="B">B
                                                        </option>
                                                        <option <?php echo $English_grade_ == "C" ? 'selected' : '' ?>
                                                            value="C">C
                                                        </option>
                                                        <option <?php echo $English_grade_ == "F" ? 'selected' : '' ?>
                                                            value="F">F
                                                        </option>
                                                    </select>
                                                    <br/><br/>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <h3>A/L QUALIFICATIONS</h3>
                                                <hr/>
                                                <div class="col-lg-4">
                                                    <label>Index No</label><br/>
                                                    <input type="text" name="txtALindexNo" size="50"
                                                           value="<?php echo $ALIndex_no_ ?>"/><br/>
                                                    <label>Year</label><br/><input type="text" name="txtALyear" size="4"
                                                                                   maxlength="4"
                                                                                   value="<?php echo $ALYear_ ?>"/>
                                                    <br/>
                                                    <label>Medium</label><br/>
                                                    <select name="cmbALmedium">
                                                        <option <?php echo $AMedium_ == "S" ? 'selected' : '' ?>
                                                            value="S">Sinhala
                                                        </option>
                                                        <option <?php echo $AMedium_ == "E" ? 'selected' : '' ?>
                                                            value="E">English
                                                        </option>
                                                    </select><br/>
                                                    <label>Center No</label><br/>
                                                    <input type="text" name="txtALCenterNo" size="50"
                                                           value="<?php echo $Center_no_ ?>"/><br/>

                                                    <label>District</label><br/>
                                                    <select name="cmbALdistrict">
                                                        <?php
                                                        include_once 'dbconfig.php';
                                                        $query = 'SELECT District_ID,`Name` FROM district_tbl';
                                                        $result = getData($query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            // output data of each row
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $selected = $row['District_ID'] == $District_tbl_District_ID ? 'selected' : '';
                                                                echo "<option " . $selected . " value='" . $row['District_ID'] . "'>" . $row['Name'] . "</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select><br/>

                                                    <label>District Rank</label><br/>
                                                    <input type="text" name="txtALdistrictRank" size="50"
                                                           value="<?php echo $District_rank_ ?>"/><br/>
                                                    <label>Island Rank</label><br/>
                                                    <input type="text" name="txtALislandRank" size="50"
                                                           value="<?php echo $Island_rank_ ?>"/><br/>
                                                    <label>Z-Score</label><br/>
                                                    <input type="text" name="txtALzscore" size="50"
                                                           value="<?php echo $Z_core_ ?>"/><br/>
                                                    <label>General Test</label><br/>
                                                    <input type="text" name="txtALgeneralTest" size="50"
                                                           value="<?php echo $GeneralTestMarks_ ?>"/><br/>
                                                    <label>A/L Stream</label><br/>
                                                    <select name="cmbALStream">
                                                        <option <?php echo $ALStream_ == "A" ? 'selected' : '' ?>
                                                            value="A">Art
                                                        </option>
                                                        <option <?php echo $ALStream_ == "B" ? 'selected' : '' ?>
                                                            value="B">Bio
                                                        </option>
                                                        <option <?php echo $ALStream_ == "C" ? 'selected' : '' ?>
                                                            value="C">Commerce
                                                        </option>
                                                        <option <?php echo $ALStream_ == "M" ? 'selected' : '' ?>
                                                            value="M">Maths
                                                        </option>
                                                    </select><br/>
                                                </div>
                                                <div class="col-lg-4" id="Subject">
                                                    <table width="100%">
                                                        <tr>
                                                            <th>SUBJECTS</th>
                                                            <th>GRADE</th>
                                                            <th>ADD</th>
                                                        </tr>
                                                        <tr>
                                                            <td><select name="cmbALsubject" style="width: 250px;"
                                                                        id="cmbALsubject">
                                                                    <?php
                                                                    include_once 'dbconfig.php';
                                                                    $query = 'SELECT SubjectID, `Name` FROM alsubject_tbl';
                                                                    $result = getData($query);
                                                                    if (mysqli_num_rows($result) > 0) {
                                                                        // output data of each row
                                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                                            echo "<option value='" . $row['SubjectID'] . "'>" . $row['Name'] . "</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <br/></td>

                                                            <td>
                                                                <select name="cmbALgrade" style="width: 150px;"
                                                                        id="cmbALgrade">
                                                                    <option value="A">A</option>
                                                                    <option value="B">B</option>
                                                                    <option value="C">C</option>
                                                                    <option value="F">F</option>
                                                                </select><br/></td>

                                                            <td>
                                                                <input type="button" value="Add" onClick="addRow();"/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <?php
                                                    include_once 'dbconfig.php'; //Connect to database
                                                    $query = "SELECT S.Name, ALS.`ALSubject_tbl_SubjectID`, ALS.`Grade` FROM `alqulification_tbl_has_alsubject_tbl` AS ALS INNER JOIN alsubject_tbl AS S ON ALS.ALSubject_tbl_SubjectID = S.SubjectID WHERE ALS.`ALQulification_tbl_Index_no` = '" . $ALIndex_no_ . "';";
                                                    $result = getData($query);
                                                    echo "<table width='100%'>"; // start a table tag in the HTML
                                                    while ($row = mysqli_fetch_array($result)) {//Creates a loop to loop through results
                                                        echo "<tr><td>" . $row['ALSubject_tbl_SubjectID'] . "</td><td>" . $row['Name'] . "</td><td>" . $row['Grade'] . "</td></tr>";
                                                    }
                                                    echo "</table>"; //Close the table in HTML
                                                    connection_close();
                                                    ?>
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
                                                            <td><input type="button" value="Clear"
                                                                       onClick="deleteRow();"/></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="submitfooter">

                                                    <input type="button" name="btnNext_EQ" value="Next"
                                                           style="float:right" class="btn btn-info"
                                                           data-toggle="collapse" data-target="#collapse3,#collapse4"/>
                                                    <input type="button" name="btnPrevious_EQ" value="Previous"
                                                           style="float:right" class="btn btn-info"
                                                           data-toggle="collapse" data-target="#collapse3,#collapse2"/>
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
                                                    <h3>Education</h3>
                                                    <hr/>
                                                    <label>Diploma / Certificate</label><br/>
                                                    <input type="hidden" name="txtCourseID"
                                                           value="<?php echo $QulificationID_; ?>" size="40"/>
                                                    <input type="text" name="txtDiplomaName_OQ" size="50"
                                                           value="<?php echo $OTName_ ?>"/><br/>
                                                    <label>Institute</label><br/>
                                                    <input type="text" name="txtInstitute_OQ" size="50"
                                                           value="<?php echo $Institute_ ?>"/><br/>
                                                    <label>Subject</label><br/>
                                                    <input type="text" name="txtSubject_OQ" size="50"
                                                           value="<?php echo $OTSubject_ ?>"/><br/>
                                                    <label>Grade</label><br/>
                                                    <input type="text" name="txtGrade_OQ" size="50"
                                                           value="<?php echo $OTGrade_ ?>"/><br/>
                                                    <label>Year</label><br/>
                                                    <input type="text" name="txtYear_OQ" size="50"
                                                           value="<?php echo $OTYear_ ?>"/><br/>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="submitfooter">
                                                    <?php
                                                    if ($permissions[0]['D']) {
                                                        ?>
                                                        <input type="submit" name="btnDelete" value="Delete"
                                                               class="btn btn-danger"/>
                                                    <?php } else { ?>
                                                        <input type="submit" name="btnDelete" value="Delete"
                                                               class="btn btn-danger" disabled/>
                                                    <?php } ?>
                                                    <input type="reset" value="Clear" class="btn btn-default"/>
                                                    <?php if ($permissions[0]['W']) { ?>
                                                        <input type="submit" name="btnFinishDD" value="Update"
                                                               style="float:right" class="btn btn-primary"/>
                                                    <?php } else { ?>
                                                        <input type="submit" name="btnFinishDD" value="Update"
                                                               style="float:right" class="btn btn-primary" disabled/>
                                                    <?php } ?>
                                                    <input type="button" name="btnPrevious_EQ" value="Previous"
                                                           style="float:right" class="btn btn-info"
                                                           data-toggle="collapse" data-target="#collapse4,#collapse3"
                                                           class="btn btn-default"/>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--END OTHER QUALIFICATION-->
                            </div>


                        </div>
                    </div>
                    <!-- /student mng -->
                </form>
            <?php } ?>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>

</body>
</html>