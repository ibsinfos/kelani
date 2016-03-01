<?php
require_once ("../dbconfig.php");
	$con = connection();
		 $Student_Id = $_POST['studentID'];;
		 $AcadamicYear = $_POST['AcadamicYr'];
		 $Course_id = $_POST['CourseI'];
		 $Part_id = $_POST['PartI'];
		 $Subject_id = $_POST['SubjectI'];
		 $Grade = $_POST['GradeI'];
		 $Status = $_POST['StatusI']; 
		
		 $query = "UPDATE student_subject_course_tbl SET Grade = '".$Grade."', Status = '".$Status."' WHERE Student_tb_Student_id = '".$Student_Id."' AND AcadamicYear = '".$AcadamicYear."' AND Subject_Course_tbl_Course_tbl_id = '".$Course_id."' AND Subject_Course_tbl_Part_table_id = '".$Part_id."' AND Subject_Course_tbl_Subject_tbl_id = '".$Subject_id."'";
		 $result= $con->query($query);
		 
    $query = "SELECT ssc.Student_tb_Student_id, ssc.AcadamicYear, c.`Name` AS Course, ssc.Part, s.subjectname, ssc.Price, ssc.Grade, ssc.Status, s.id, Subject_Course_tbl_Course_tbl_id, Subject_Course_tbl_Part_table_id, Subject_Course_tbl_Subject_tbl_id 
 FROM student_subject_course_tbl ssc, subject_tbl s, course_tbl c 
 WHERE ssc.Subject_Course_tbl_Course_tbl_id = c.id AND ssc.Subject_Course_tbl_Subject_tbl_id = s.id AND Student_tb_Student_id = '$Student_Id'";
		$result = getData($query);
		echo "<table width='100%'>"; // start a table tag in the HTML
		echo "<tr>
		<th>STUDENT ID</th>
		<th>ACADAMIC YEAR</th>
		<th>COURSE</th>
		<th>PART</th>
		<th>SUBJECT</th>
		<th>GRADE</th>
		<th>PRICE</th>
		<th>STATUS</th>
		<th>&nbsp;</th>
		</tr>";
		while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
			echo "<tr><td>" .$row['Student_tb_Student_id']. "</td><td>" .$row['AcadamicYear']. "</td><td>" .$row['Course']. "</td><td>" .$row['Part']. "</td><td>" . $row['subjectname'] . "</td><td>" . $row['Grade'] . 
			"</td><td>" . $row['Price'] . 
			"</td>
			<td>" . $row['Status'] . 
			"</td>
			<td>
			<a href='students_course_Edit.php?Student_id=" .$row['Student_tb_Student_id']. "&AcadamicYear=" .$row['AcadamicYear']. "&Course_id=" .$row['Subject_Course_tbl_Course_tbl_id']. "&Part_id=" .$row['Subject_Course_tbl_Part_table_id']. "&Subject_id=" .$row['Subject_Course_tbl_Subject_tbl_id']. "&GradeS=".$row['Grade']."&Status=".$row['Status']."'>View</a>
			</td>
			</tr>";  //$row['index'] the index here is a field name
		}
		echo "</table>";

?>

