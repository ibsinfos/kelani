<?php
require_once ("../dbconfig.php");
if (isset($_POST["btnAdd"])) {

    $con = connection();
    $stmt=$con->prepare('INSERT INTO attendanceemployee_tbl VALUES (?,?,?,?)');
    $stmt->bind_param('ssss', $STUDENT,$DATE,$TIME,$USER);

    $STUDENT = $_POST['txtEmployeeID'];
	$DATE = $_POST['dtpDate'];
	$TIME = $_POST['dtpTime'];
	$USER = $_POST['ssUser'];
	
    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../employee_attends.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../employee_attends.php');
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

