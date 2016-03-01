<?php
require_once ("../dbconfig.php");
if (isset($_POST["btnAdd"])) {

    $con = connection();
    $stmt=$con->prepare('INSERT INTO attendance_tbl VALUES (?,?,?,?)');
    $stmt->bind_param('ssss', $STUDENT,$DATE,$TIME,$USER);

    $STUDENT = $_POST['txtStudentID'];
	$DATE = $_POST['dtpDate'];
	$TIME = $_POST['dtpTime'];
	$USER = $_POST['ssUser'];
	
    $stmt->execute();
	
	//mysqli_query("query here") or die(mysqli_error($con));
	//var_dump($_POST);
	//die();
	//echo $con->error;
	
    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../students_attends.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../students_attends.php');
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
?>

