<?php
	include_once 'dbconfig.php';
	$ACADAMICYEAR = $_POST['year'];
	$COURSE = $_POST['course'];
	$PART = $_POST['part'];
	$query = "SELECT sc.Subject_tbl_id, sc.Price, s.subjectname 
FROM subject_course_tbl sc INNER JOIN subject_tbl s ON sc.Subject_tbl_id=s.id
WHERE AcadamicYear_id = '$ACADAMICYEAR' AND 
	Course_tbl_id = '$COURSE' AND Part_table_id = '$PART' ";
	$result = getData($query);
	//echo $query;
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<input type='checkbox' value='".$row['Subject_tbl_id']."-".$row['Price']."' name='cbSubject[]'>".$row['subjectname']."<br>";
			}
	}
?>