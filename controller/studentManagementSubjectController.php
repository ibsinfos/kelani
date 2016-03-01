<?php
require_once ("../dbconfig.php");

	/* Set connection */
    $con = connection();
	
	//Subjects Results---------------------------------------------------------------------
		session_start();
		
		$SubjectID = $_GET['Subject'];
		$Name = $_GET['Name'];
		$ALSubject_status = '1';	
		$Grade = $_GET['Grade'];	
		
		$stmt=$con->prepare('INSERT INTO TempALSubject_tbl (SubjectID, Name, ALSubject_status, Grade) VALUES(?, ?, ?, ?)');
		$stmt->bind_param('isis', $SubjectID, $Name, $ALSubject_status, $Grade);
			
		$stmt->execute();
		/* close statement and connection */
		$stmt->close();
  

	

//		var_dump($_POST);
//		die(); 
    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../student_management.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../student_management.php');
    }
?>


