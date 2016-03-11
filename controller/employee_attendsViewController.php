<?php
require_once ("../dbconfig.php");
	
	$Employee = $_POST['empID'];
	$ToDate = $_POST['dtToDate'];
	$FromDate = $_POST['dtFromDate'];

	$con = connection();

$query = "SELECT e.NameInitial, a.Employee_tb_Emp_id, a.`Date`, a.`Time`
FROM attendanceemployee_tbl a
INNER JOIN employee_tb e ON e.Emp_id = a.Employee_tb_Emp_id
WHERE `Date` BETWEEN '$FromDate' AND '$ToDate'
					  AND Employee_tb_Emp_id = '$Employee'";

	$result= $con->query($query);

if (mysqli_num_rows($result) > 0){
	echo "<table width='100%' class='table table-bordered table-hover'>"; // start a table tag in the HTML
	echo "<tr>
                        <th>EMPLOYEE ID</th>
                        <th>NAME</th>
                        <th>DATE</th>
                        <th>TIME</th>
                        </tr>";
	while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
		echo "<tr><td>" . $row['Employee_tb_Emp_id']. "</td><td>" . $row['NameInitial']. "</td><td>" . $row['Date']. "</td><td>" . $row['Time'] . "</td></tr>";  //$row['index'] the index here is a field name
	}
	echo "</table>"; //Close the table in HTML
	connection_close(); //Make sure to close out the database connection

}

?>

