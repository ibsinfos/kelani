<?php
	include 'dbconfig.php'; //Comnnect to database
	$STUDENTID = $_POST['studentid'];
	$query = "  SELECT st.`Name`, s.subjectname
				FROM student_subject_course_tbl ssc, subject_tbl s, student_tb st
				WHERE ssc.Subject_Course_tbl_Subject_tbl_id = s.id AND ssc.Student_tb_Student_id = st.Student_id AND ssc.Student_tb_Student_id = '$STUDENTID' AND ssc.Status = '1';";
	$result =getData($query);
	$data= array();
	$i = 0;

	if(mysqli_num_rows($result)>0){
	while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results

		$data[] =array("name"=>$row['Name'],"subject"=>$row['subjectname']);
		$i++;
	}
	echo json_encode($data);
	}
	//echo "</table>"; //Close the table in HTML
	
	connection_close(); //Make sure to close out the database connection
?>