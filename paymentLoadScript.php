<?php
	include 'dbconfig.php'; //Comnnect to database
	$STUDENTID = $_POST['studentid'];
	
	$query = "SELECT COUNT(P.`Date`) AS TCOUNT FROM payment_tbl P WHERE Student_tb_Student_id = '$STUDENTID' ORDER BY InvoiceNo DESC LIMIT 1;";
	$result =getData($query);
	$rest = "";
	if (mysqli_num_rows($result) > 0) {
			// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {

			$TCount = $row['TCOUNT'];
		}
		if($TCount > 0)
		{
			$query = "	(SELECT st.`Name`, ssc.AcadamicYear, ssc.Part , s.subjectname, ssc.Price,ssc.id 
				FROM student_subject_course_tbl ssc 
					 INNER JOIN subject_tbl s ON ssc.Subject_Course_tbl_Subject_tbl_id = s.id
					 INNER JOIN student_tb st ON ssc.Student_tb_Student_id = st.Student_id
                     INNER JOIN acadamicyear a ON a.`year` = ssc.AcadamicYear
                     INNER JOIN courseprocess cp ON a.id = cp.AcadamicYear_id AND ssc.Subject_Course_tbl_Course_tbl_id = cp.Course_tbl_id AND ssc.Subject_Course_tbl_Part_table_id = cp.Part_tbl_id
                     LEFT OUTER JOIN (SELECT (P.`Date`) AS TDATE,Student_tb_Student_id FROM payment_tbl P                  
					 WHERE Student_tb_Student_id = '$STUDENTID' ORDER BY InvoiceNo DESC LIMIT 1) AS T ON ssc.Student_tb_Student_id = T.Student_tb_Student_id
                     
				WHERE     ssc.Student_tb_Student_id = '$STUDENTID' AND ssc.Status = '1' AND now()<cp.EndDate  AND (MONTH(T.TDATE)<>MONTH(NOW()) OR YEAR(T.TDATE)<>YEAR(NOW()))  )
				UNION ALL
				(SELECT  CASE DueAmount WHEN 0 THEN '' ELSE S.`Name` END AS `Name`, CASE DueAmount WHEN 0 THEN '' ELSE CAST(`Date` AS DATE) END AcadamicYear,'' AS Part, CASE DueAmount WHEN 0 THEN '' ELSE 'DueAmount' END AS subjectname, CASE DueAmount WHEN 0 THEN '' ELSE DueAmount END AS Price, '0' AS id  
                FROM payment_tbl P INNER JOIN student_tb S ON P.Student_tb_Student_id = S.Student_id                 
                WHERE Student_tb_Student_id = '$STUDENTID' ORDER BY InvoiceNo DESC LIMIT 1);";
		}
		else
		{
			$query = "	(SELECT st.`Name`, ssc.AcadamicYear, ssc.Part , s.subjectname, ssc.Price, ssc.id 
				FROM student_subject_course_tbl ssc 
					 INNER JOIN subject_tbl s ON ssc.Subject_Course_tbl_Subject_tbl_id = s.id
					 INNER JOIN student_tb st ON ssc.Student_tb_Student_id = st.Student_id
                     INNER JOIN acadamicyear a ON a.`year` = ssc.AcadamicYear
                     INNER JOIN courseprocess cp ON a.id = cp.AcadamicYear_id AND ssc.Subject_Course_tbl_Course_tbl_id = cp.Course_tbl_id AND ssc.Subject_Course_tbl_Part_table_id = cp.Part_tbl_id
                     
				WHERE     ssc.Student_tb_Student_id = '$STUDENTID' AND ssc.Status = '1' AND now()<cp.EndDate)
				;";
		}
	}

		
	$result =getData($query);
	$data= array();
	$i = 0;
	$total = 0;
	if(mysqli_num_rows($result)>0){

		while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
			//$row['index'] the index here is a field name
			
			$total +=$row['Price'];
			$data[] =array("year"=>$row['AcadamicYear'],"part"=>$row['Part'],"subject"=>$row['subjectname'],"price"=>$row['Price'],"name"=>$row['Name'],"total"=>$total, "id" => $row['id']);
			$i++;
		}
		
		$query = "SELECT SUM(ssc.Price) AS Price FROM student_subject_course_tbl ssc WHERE ssc.Student_tb_Student_id = '$STUDENTID' AND ssc.Status = '1';";
		$result =getData($query);
		if (mysqli_num_rows($result) > 0) {
				// output data of each row
			while ($row = mysqli_fetch_assoc($result)) {

				$PresentForPayment = $row['Price'];
			}
		}
		
		$query = "SELECT CASE WHEN (CAST(NOW() AS DATE) < CAST(CP.EndDate AS DATE)) THEN SUBSTRING_INDEX(CAST(DATEDIFF(now(),P.`Date`)/30 AS CHAR),'.',1) ELSE 	
					 SUBSTRING_INDEX(CAST(DATEDIFF(CAST(CP.EndDate AS DATE),P.`Date`)/30 AS CHAR),'.',1) END AS NoOfMonths 
					 FROM payment_tbl P LEFT OUTER JOIN student_subject_course_tbl ssc on P.Student_tb_Student_id = ssc.Student_tb_Student_id
                     INNER JOIN acadamicyear a ON a.`year` = ssc.AcadamicYear
                     INNER JOIN courseprocess cp ON a.id = cp.AcadamicYear_id AND ssc.Subject_Course_tbl_Course_tbl_id = cp.Course_tbl_id AND ssc.Subject_Course_tbl_Part_table_id = 					 cp.Part_tbl_id
					 WHERE P.Student_tb_Student_id = '$STUDENTID' ORDER BY InvoiceNo
				  	 DESC LIMIT 1;";
		$result =getData($query);
		if (mysqli_num_rows($result) > 0) {
				// output data of each row
			while ($row = mysqli_fetch_assoc($result)) {

				$NoOfMonths = $row['NoOfMonths'];
			}
			if($NoOfMonths < 0)
			{
			 	$NoOfMonths = 0;
			}
			$Count = 1;
			while ($Count < $NoOfMonths) {
				$query = "SELECT  S.`Name`, CAST(`Date` AS DATE) + interval $Count month AcadamicYear,'' AS Part, 'DueAmount' AS subjectname, $PresentForPayment AS Price  FROM 
					payment_tbl P LEFT OUTER JOIN student_tb S 
					ON P.Student_tb_Student_id = S.Student_id WHERE Student_tb_Student_id = '$STUDENTID' ORDER BY InvoiceNo DESC LIMIT 1;";
				$result =getData($query);
				if (mysqli_num_rows($result) > 0) {
						// output data of each row
					while ($row = mysqli_fetch_assoc($result)) {
			
							$total +=$row['Price'];
							$data[] =array("year"=>$row['AcadamicYear'],"part"=>$row['Part'],"subject"=>$row['subjectname'],"price"=>$row['Price'],"name"=>$row['Name'],"total"=>$total);
							$i++;
							$Count++;
					}
				}
			}
		}
	echo json_encode($data);
	}
	//echo "</table>"; //Close the table in HTML
	
	connection_close(); //Make sure to close out the database connection
?>