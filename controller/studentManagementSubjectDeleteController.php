<?php
require_once ("../dbconfig.php");

	/* Set connection */
    $con = connection();
	
	//Subjects Results Delete---------------------------------------------------------------------

	$query = "DELETE FROM TempALSubject_tbl";
	$result= $con->query($query);
			
    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../student_management.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../student_management.php');
    }
?>


