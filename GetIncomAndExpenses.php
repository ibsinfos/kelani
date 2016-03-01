<?php
	include 'dbconfig.php';

	$ToDate = $_POST['dtToDate'];
	$FromDate = $_POST['dtFromDate'];
	$query = "	(SELECT P.`Date` AS Date, 'Card Payments' AS Description,SUM(P.SubTotal) - SUM(P.DueAmount) AS Income, '0.00' AS Expense
				FROM payment_tbl AS P 
				WHERE P.`Date` BETWEEN '$FromDate' AND '$ToDate'
				GROUP BY P.`Date`)
				UNION
				(SELECT L.`date` AS Date, 'Lecture Payments' AS Description, '0.00' AS Income, L.total AS Expense
				FROM lecturerpayment_tbl AS L
				WHERE L.`date` BETWEEN '$FromDate' AND '$ToDate'
				GROUP BY L.`date`)
				UNION
				(SELECT O.`Date` AS Date, 'Other Eexpenses' AS Description, '0.00' AS Income, O.Amount AS Expense
				FROM otherexpenses_tbl AS O
				WHERE O.`Date` BETWEEN '$FromDate' AND '$ToDate'
				GROUP BY O.`Date`) ORDER BY Date;";
	$result = getData($query);
	$data= array();
	$i = 0;
	$totalIncome = 0.00;
	$totalExpense = 0.00;
	$totalProfit = 0.00;
	//echo $query;
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			$totalIncome +=$row['Income'];
			$totalExpense +=$row['Expense'];
			$totalProfit = $totalIncome - $totalExpense;
			
			$data[] =array("dDate"=>$row['Date'],"dDescription"=>$row['Description'],"dIncome"=>$row['Income'],"dExpense"=>$row['Expense'], "totalIncome"=>$totalIncome, 
			"totalExpense"=>$totalExpense, "totalProfit" => $totalProfit);
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