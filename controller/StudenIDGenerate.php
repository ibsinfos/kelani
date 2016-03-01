<?php
require_once ("../dbconfig.php");
	$con = connection();
	$branch = $_POST['branch'];	
	$query = "SELECT (RIGHT(DATE_FORMAT(NOW(), '%Y'),2)) AS Yr";
	$result= $con->query($query);
	if (mysqli_num_rows($result) > 0){
		while ($row = mysqli_fetch_assoc($result)) {
			$yr1 = $row['Yr'];
		}
	}
	$YR2 = $yr1.$branch; 	
	
	$query = "SELECT LPAD((MAX(RIGHT(Student_id,4)) + 1),5,'0')  AS Student_id FROM student_tb WHERE Student_id LIKE CONCAT('%','".$YR2."','%');";
	$result= $con->query($query);
	//echo $query;
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while ($row = mysqli_fetch_assoc($result)) {
					if($row['Student_id'] == null || $row['Student_id'] == ""){
						echo $YR2.'00001';
					}
					else{
						echo $YR2.$row['Student_id'];
					}
			}
	}
	
?>