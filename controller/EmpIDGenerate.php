<?php
require_once ("../dbconfig.php");
	$con = connection();
	$branch = $_POST['branch'];	
		
	$query = "SELECT LPAD((IFNULL(MAX(CAST(RIGHT(Emp_id, 3) AS UNSIGNED INT)),0) + 1), 3, 0) AS MAXNO FROM employee_tb  WHERE Emp_id LIKE CONCAT('%','".$branch."','%');";
	$result= $con->query($query);
	//echo $query;
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while ($row = mysqli_fetch_assoc($result)) {
					if($row['MAXNO'] == null || $row['MAXNO'] == ""){
						echo $branch.'00001';
					}
					else{
						echo $branch.$row['MAXNO'];
					}
			}
	}
	
?>