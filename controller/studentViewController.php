<?php
require_once ("../dbconfig.php");
if (isset($_POST["studentID"])) {

    $con = connection();
	$search = trim($_POST['studentID']);
    $query = "SELECT * FROM student_tb WHERE Student_id LIKE CONCAT('','".$search."','%');";
	$result= $con->query($query);
	if (mysqli_num_rows($result) > 0){
		echo "<table width='100%'>"; // start a table tag in the HTML
		echo "<tr>
				<th>Student ID</th>
                        <th>Old Student ID</th>
                        <th>Name</th>
                        <th>NIC</th>
                        <th>Mobile No</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
				</tr>";			
				while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                            echo "<tr><td>" . $row['Student_id']. "</td><td>" . $row['Old_student_id']. "</td><td>" . $row['Name']. "</td><td>" . $row['NIC'] . "</td><td>" . $row['TP_mob'] . "</td><td>" . $row['Email'] . "</td><td><a href='student_management_Edit.php?Studentid=".$row['Student_id']."'>View</a></td><td> 
									<a href='students_course.php?Studentid=".$row['Student_id']."'>Cource</a></td>
									<td><a href='students_payment_view.php?Studentid=".$row['Student_id']."'>Payment</a></td>
									<td><a href='students_attends_view.php?Studentid=".$row['Student_id']."'>Attendance</a></td></tr>";  //$row['index'] the index here is a field name
                        }
				echo "</table>";
	}
}
if (isset($_POST["OldstudentID"])) {

    $con = connection();
	$search = trim($_POST['OldstudentID']);
    $query = "SELECT * FROM student_tb WHERE Old_student_id LIKE CONCAT('','".$search."','%');";
	$result= $con->query($query);
	if (mysqli_num_rows($result) > 0){
		echo "<table width='100%'>"; // start a table tag in the HTML
		echo "<tr>
				<th>Student ID</th>
                        <th>Old Student ID</th>
                        <th>Name</th>
                        <th>NIC</th>
                        <th>Mobile No</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
				</tr>";			
				while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                            echo "<tr><td>" . $row['Student_id']. "</td><td>" . $row['Old_student_id']. "</td><td>" . $row['Name']. "</td><td>" . $row['NIC'] . "</td><td>" . $row['TP_mob'] . "</td><td>" . $row['Email'] . "</td><td><a href='student_management_Edit.php?Studentid=".$row['Student_id']."'>View</a></td><td> 
									<a href='students_course.php?Studentid=".$row['Student_id']."'>Cource</a></td>
									<td><a href='students_payment_view.php?Studentid=".$row['Student_id']."'>Payment</a></td>
									<td><a href='students_attends_view.php?Studentid=".$row['Student_id']."'>Attendance</a></td></tr>";  //$row['index'] the index here is a field name
                        }
				echo "</table>";
	}
}
if (isset($_POST["NIC"])) {

    $con = connection();
	$search = trim($_POST['NIC']);
    $query = "SELECT * FROM student_tb WHERE NIC LIKE CONCAT('','".$search."','%');";
	$result= $con->query($query);
	if (mysqli_num_rows($result) > 0){
		echo "<table width='100%'>"; // start a table tag in the HTML
		echo "<tr>
				<th>Student ID</th>
                        <th>Old Student ID</th>
                        <th>Name</th>
                        <th>NIC</th>
                        <th>Mobile No</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
				</tr>";			
				while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                            echo "<tr><td>" . $row['Student_id']. "</td><td>" . $row['Old_student_id']. "</td><td>" . $row['Name']. "</td><td>" . $row['NIC'] . "</td><td>" . $row['TP_mob'] . "</td><td>" . $row['Email'] . "</td><td><a href='student_management_Edit.php?Studentid=".$row['Student_id']."'>View</a></td><td> 
									<a href='students_course.php?Studentid=".$row['Student_id']."'>Cource</a></td>
									<td><a href='students_payment_view.php?Studentid=".$row['Student_id']."'>Payment</a></td>
									<td><a href='students_attends_view.php?Studentid=".$row['Student_id']."'>Attendance</a></td></tr>";  //$row['index'] the index here is a field name
                        }
				echo "</table>";
	}
}

?>

