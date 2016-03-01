<?php
require_once ("../dbconfig.php");

if (isset($_POST["btnAdd"])) {

    $con = connection();
    $stmt=$con->prepare('INSERT INTO subject_course_tbl VALUES (?,?,?,?,?,now(),?,?)');
    $stmt->bind_param('iiiidsi', $ACADAMICYEAR,$COURSEID,$PART,$SUBJECTID,$FEE,$USER,$STATUS);
	
	//var_dump($_POST);
	//die();
	$ACADAMICYEAR = $_POST['cmbAcademicYear'];
	$SUBJECTID  = $_POST['cmbSubject'];
	$COURSEID  = $_POST['cmbCourse'];
	$PART = $_POST['cmbPart_DD'];
	$FEE = $_POST['txtFee'];
	$USER = $_POST['ssUser'];
    $STATUS = '1';
    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../course_subject.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../course_subject.php');
    }




}

elseif(isset($_POST["btnUpdate"])) {
    echo "<script type='text/javascript'>alert('Update');</script>";
}

elseif(isset($_POST["btnDelete"])) {
    echo "<script type='text/javascript'>alert('Delete');</script>";
}

elseif(isset($_POST["btnClear"])) {
    echo "Yes, Clear";
}

function idgenarate(){

    $query1="SELECT MAX(Course_ID) FROM course_tbl";

}

?>


