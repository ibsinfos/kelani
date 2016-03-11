<?php
include_once 'dbconfig.php'; //Connect to database
$query = "SELECT sc.Subject_tbl_id, s.`subjectname` AS SubjectName, sc.Course_tbl_id, c. `Name` AS CourseName, sc.Part_table_id, p.`name` AS Part, sc.Price, sc.AcadamicYear_id, a.`year` AS AcademicYear
FROM subject_tbl AS s,course_tbl AS c , subject_course_tbl AS sc, part_tbl AS p,acadamicyear AS a
WHERE a.id = sc.AcadamicYear_id AND sc.Subject_tbl_id=s.id AND sc.Course_tbl_id = c.id AND sc.Part_table_id = p.id;";
$result = getData($query);
echo "<table width='100%' class='table table-bordered table-hover'>"; // start a table tag in the HTML
echo "<tr>
								<th>COURSE</th>
								<th>YEAR</th>
								<th>PART</th>
								<th>SUBJECT</th>
								<th>FEE</th>
								<th>#EDIT</th>
							  </tr>";
while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results

    echo "<tr><td id='Course_tbl_id'>" . $row['CourseName']. "</td><td id='AcadamicYear_id'>" . $row['AcademicYear']. "</td><td id='Part_table_id'>" . $row['Part']. "</td><td id='Subject_tbl_id'>" . $row['SubjectName']. "</td><td>" . $row['Price'] . "</td><td><a href='course_subject.php?acadamicyear=".$row['AcadamicYear_id']."&course=".$row['Course_tbl_id']."&part=".$row['Part_table_id']."&subject=".$row['Subject_tbl_id']."'>Edit</a></td></tr>";  //$row['index'] the index here is a field name
}
echo "</table>"; //Close the table in HTML
connection_close(); //Make sure to close out the database connection
?>