<?php
require_once ("../dbconfig.php");

if (isset($_POST["btnAdd"])) {
	if(trim(($_POST['cmbAcadamicYear'])) != ''){
		$con = connection();
		$stmt=$con->prepare('INSERT INTO courseprocess VALUES (?,?,?,?,?,now(),?,?)');
		$stmt->bind_param('iiisssi', $ACADAMICYEAR,$COURSEID,$PART,$SDATE,$EDATE,$USER,$STATUS);
		
		//var_dump($_POST);
		//die();
		
		$ACADAMICYEAR = $_POST['cmbAcadamicYear'];
		$COURSEID  = $_POST['cmbCourse'];
		$PART = $_POST['cmbPart'];
		$SDATE = $_POST['dtpStartDate'];
		$EDATE = $_POST['dtpEndDate'];
		$USER = $_POST['ssUser'];
		$STATUS = '1';
		$stmt->execute();
		//mysqli_query("query here") or die(mysqli_error($con));
		
		//echo $con->error;
	}
	if($stmt->affected_rows > 0){
		echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
		header('Location:../courseProcess.php');
	}else{
		echo "<script type='text/javascript'>alert('Error');</script>";
		header('Location:../courseProcess.php');
	}
	
}

elseif(isset($_POST["btnUpdate"])) {
    $con = connection();
	if(trim(($_POST['cmbAcadamicYear_'])) != ''){
		$ACADAMICYEAR = $_POST['cmbAcadamicYear_'];
		$COURSEID  = $_POST['cmbCourse_'];
		$PART = $_POST['cmbPart_'];
		$SDATE = $_POST['dtpStartDate'];
		$EDATE = $_POST['dtpEndDate'];
	
		$query = "UPDATE courseprocess SET StartDate = '".$SDATE."', EndDate = '".$EDATE."' WHERE AcadamicYear_id = '".$ACADAMICYEAR."' AND Course_tbl_id = '".$COURSEID."' AND Part_tbl_id = '".$PART."'"; 				
		$result= $con->query($query);
//		var_dump($_POST);
//		die();
//	mysqli_query("query here") or die(mysqli_error($con));	
//	echo $con->error;
	}

	if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Update');</script>";
        header('Location:../courseProcess.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../courseProcess.php');
    }
}

elseif(isset($_POST["btnDelete"])) {
    $con = connection();
	if(trim(($_POST['cmbAcadamicYear'])) != ''){
		$ACADAMICYEAR = $_POST['cmbAcadamicYear'];
		$COURSEID  = $_POST['cmbCourse'];
		$PART = $_POST['cmbPart'];
	
		$query = "UPDATE courseprocess SET Status = '0' WHERE AcadamicYear_id = '".$ACADAMICYEAR."' AND Course_tbl_id = '".$COURSEID."' AND Part_tbl_id = '".$PART."'"; 				
		$result= $con->query($query);
	}

	if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Delete');</script>";
        header('Location:../courseProcess.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../courseProcess.php');
    }
}

elseif(isset($_POST["btnClear"])) {
    echo "Yes, Clear";
}

?>


