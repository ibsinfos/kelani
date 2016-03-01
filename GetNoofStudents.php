<?php
	include 'dbconfig.php';

	$Subject = $_POST['subjectID'];
	$tDate = $_POST['dtDate'];
	$query = "	SELECT 	COUNT(A.StudentId) AS SCount, IFNULL(SSC.Price,0) AS Price
				FROM 	student_subject_course_tbl AS SSC INNER JOIN attendance_tbl A ON SSC.Student_tb_Student_id = A.StudentId
				WHERE 	A.`Date` = '$tDate'
						AND id = '$Subject'
				GROUP BY SSC.Price;";
	$result = getData($query);
	$data= array();
	$i = 0;
	//echo $query;
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			$data[] =array("sCount"=>$row['SCount'],"price"=>$row['Price']);
			$i++;
		}
	}
	//mysqli_query("query here") or die(mysqli_error($con));
	//echo $con->error;
	//var_dump($_POST);
	//die();
	echo json_encode($data);
	connection_close();
?>