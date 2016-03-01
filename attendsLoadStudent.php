<?php
	include_once 'dbconfig.php'; //Connect to database
	if (isset($_POST["studentid"])) {
		$STUDENTID = $_POST['studentid'];
		$query = "SELECT A.StudentId, A.`Date`, A.`Time`, CASE IFNULL(P.InvoiceNo,'N') WHEN 'N' THEN '' ELSE 'Paid' END AS Paid
				  FROM attendance_tbl A LEFT OUTER JOIN payment_tbl P ON MONTH(A.`Date`) = MONTH(P.`Date`) AND A.StudentId = P.Student_tb_Student_id 
				  WHERE StudentId = '$STUDENTID' AND A.`Date` BETWEEN DATE_ADD(NOW(),INTERVAL -60 DAY) AND NOW() ORDER BY CONCAT(A.`Date`,A.`Time`) DESC ";
		$result =getData($query);
		$data= array();
		$i = 0;
		
		if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
	
			$data[] =array("name"=>$row['StudentId'],"date"=>$row['Date'],"time"=>$row['Time'], "paid"=>$row['Paid']);
			$i++;
		}
		echo json_encode($data);
		}
	
		connection_close(); //Make sure to close out the database connection
	}
	if (isset($_POST["stid"])) {
		$STUDENTID = $_POST['stid'];
		$query = "SELECT `Date`, 'Paid' AS Paid
                  FROM payment_tbl P                
                  WHERE Student_tb_Student_id = '$STUDENTID' AND MONTH(NOW()) = MONTH(`Date`) ORDER BY InvoiceNo DESC LIMIT 1; ";
		$result =getData($query);
		$data= array();
		$i = 0;
		
		if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
	
			$data[] =array("paid"=>$row['Paid'],"date"=>$row['Date']);
			$i++;
		}
		echo json_encode($data);
		}
	
		connection_close(); //Make sure to close out the database connection
	}
?>