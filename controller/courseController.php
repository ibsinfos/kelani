<?php
require_once ("../dbconfig.php");

if (isset($_POST["btnAdd"])) {

    $con = connection();
    $stmt=$con->prepare('INSERT INTO course_tbl VALUES (?,?,now(),?,?)');
    $stmt->bind_param('issi', $ID,$NAME,$USER,$STATUS);

    $NAME = $_POST['txtCourseName'];
    $USER = $_POST['ssUser'];
    $STATUS = '1';
    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../course.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../course.php');
    }




}

elseif(isset($_POST["btnUpdate"])) {
	
	var_dump($_POST);
	die();
    echo "<script type='text/javascript'>alert('Update');</script>";
}

elseif(isset($_POST["btnDelete"])) {
	$id = $_POST['txtCourseID'];
	$url = "../course.php?edit=".$id;
	$delurl = "../course.php?del=".$id;
    echo "<script type='text/javascript'>";
	
	echo "var id = $id ;";
	echo "var cnf = confirm('Are you sure?');";
	echo "if(cnf){window.location='$delurl';}else{window.location='$url';}";
	
	echo "</script>";
}



function idgenarate(){

    $query1="SELECT MAX(Course_ID) FROM course_tbl";

}

?>


