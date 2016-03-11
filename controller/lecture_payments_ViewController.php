<?php
require_once ("../dbconfig.php");
	
	$Lect = $_POST['lectID'];
	$ToDate = $_POST['dtToDate'];
	$FromDate = $_POST['dtFromDate'];

	$con = connection();
	
//    $query = "SELECT  lp.`date`, s.subjectname, e.`Name`, lp.numberStudent, lp.subjectAmount, lp.commission, lp.salary, lp.allowance, lp.total, lp.PayedDate
//			  FROM 	  lecturerpayment_tbl lp
//					  INNER JOIN student_subject_course_tbl ssc ON lp.Student_Subject_Course_tbl_id = ssc.id
//					  INNER JOIN employee_tb e ON e.Emp_id = lp.Employee_tb_Emp_id
//					  INNER JOIN subject_course_tbl sc ON ssc.Subject_Course_tbl_Subject_tbl_id = sc.Subject_tbl_id
//					  INNER JOIN subject_tbl s ON sc.Subject_tbl_id = s.id
//			  WHERE   lp.`date` BETWEEN '$FromDate' AND '$ToDate'
//					  AND Employee_tb_Emp_id = CASE IFNULL('$Lect','ALL') WHEN 'ALL' THEN Employee_tb_Emp_id ELSE '$Lect' END;";

$query = "SELECT 	lp.`date`, e.`Name`, lp.numberStudent, lp.subjectAmount, lp.commission, lp.salary, lp.allowance, lp.total, lp.PayedDate ,ay.`year`, c.`Name` AS cname, p.`name` AS pname, s.subjectname AS sname
FROM 	lecturerpayment_tbl lp
		INNER JOIN employee_tb e ON e.Emp_id = lp.Employee_tb_Emp_id
        INNER JOIN acadamicyear ay ON ay.id = lp.Subject_Course_tbl_AcadamicYear_id
        INNER JOIN course_tbl c ON c.id = lp.Subject_Course_tbl_Course_tbl_id
        INNER JOIN part_tbl p ON p.id = lp.Subject_Course_tbl_Part_table_id
        INNER JOIN subject_tbl s ON s.id = lp.Subject_Course_tbl_Subject_tbl_id
			  WHERE   lp.`date` BETWEEN '$FromDate' AND '$ToDate'
					  AND Employee_tb_Emp_id = CASE IFNULL('$Lect','ALL') WHEN 'ALL' THEN Employee_tb_Emp_id ELSE '$Lect' END;";

	$result= $con->query($query);
		
	if (mysqli_num_rows($result) > 0){

		echo "<table width='100%' class='table table-bordered table-hover'>"; // start a table tag in the HTML
		echo "<tr>
						<th>SUBJECT</th>
						<th>COURSE</th>
						<th>PART</th>
						<th>SUBJECT</th>
						<th>DATE</th>
                        <th>EMPLOYEE NAME</th>
                        <th>AMOUNT</th>
                        <th>STUDENTS</th>
                        <th>COMMISSION(%)</th>
                        <th>SALARY</th>
						<th>ALLOWANCE</th>
						<th>TOTAL</th>
						<th>PAID  DATE</th>
                        </tr>";
		while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
			echo "<tr><td>" . $row['year']. "</td><td>" . $row['cname']. "</td><td>" . $row['pname']. "</td><td>" . $row['sname']. "</td><td>" . $row['date']. "</td><td>" . $row['Name']. "</td><td>" . $row['subjectAmount'] . "</td><td>" . $row['numberStudent'] . "</td><td>" . $row['commission'] . "</td><td>" . $row['salary'].  "</td><td>" . $row['allowance']. "</td><td>" . $row['total']. "</td><td>" . $row['PayedDate']."</td></tr>";  //$row['index'] the index here is a field name
		}
		echo "</table>"; //Close the table in HTML
		connection_close(); //Make sure to close out the database connection

	}

?>

