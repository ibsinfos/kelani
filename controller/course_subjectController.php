<?php
require_once ("../dbconfig.php");

if (isset($_POST["btnAdd"])) {

    $con = connection();
    $stmt=$con->prepare('INSERT INTO subject_course_tbl VALUES (?,?,?,?,?,?,?,?)');
    $stmt->bind_param('iiiidssi', $ACADAMICYEAR,$COURSEID,$PART,$SUBJECTID,$FEE,$DATE,$USER,$STATUS);
	


	$ACADAMICYEAR = $_POST['cmbAcademicYear'];
    $SUBJECTID  = $_POST['cmbSubject'];
    $COURSEID  = $_POST['cmbCourse'];
    $PART = $_POST['cmbPart_DD'];
    $FEE = $_POST['txtFee'];
    $DATE = $_POST['dtpDate'];
    $USER = $_POST['ssUser'];
    $STATUS = '1';
    $stmt->execute();
    var_dump($_POST);
    die();
    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../course_subject.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../course_subject.php');
    }
}

elseif(isset($_POST["btnUpdate"])) {

    $con = connection();
    if (($_POST['cmbAcademicYear_']) != '') {
        $ACADAMICYEAR = $_POST['cmbAcademicYear_'];
        $COURSEID  = $_POST['cmbCourse_'];
        $PART = $_POST['cmbPart_DD_'];
        $SUBJECTID  = $_POST['cmbSubject_'];
        $FEE = $_POST['txtFee'];
        $DATE = $_POST['dtpDate'];
        $USER = $_POST['ssUser'];
//        var_dump($_POST);
//        die();

        $query = " UPDATE subject_course_tbl SET Price = '" . $FEE . "', CreateUser = '" . $USER . "', CreateDate = '" . $DATE . "' WHERE AcadamicYear_id = '" . $ACADAMICYEAR . "' AND Course_tbl_id = '" . $COURSEID . "' AND Part_table_id = '" . $PART . "' AND Subject_tbl_id = '" . $SUBJECTID . "' ";

//	    mysqli_query("query here") or die(mysqli_error($con));
//	    echo $con->error;

        $result = $con->query($query);
    }

    if ($stmt->affected_rows > 0) {
        echo "<script type='text/javascript'>alert('Successfully Update');</script>";
        header('Location:../course_subject.php');
    } else {
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../course_subject.php');
    }
}

elseif(isset($_POST["btnDelete"])) {
    echo "<script type='text/javascript'>alert('Delete');</script>";
}

?>


