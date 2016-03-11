<?php
						include_once 'dbconfig.php'; //Connect to database
						$query = "SELECT Emp_id, `name`, TP_mob, Address, Email FROM employee_tb WHERE Status = '1';";
						$result =getData($query);
						echo "<table width='100%' class='table table-bordered table-hover'>"; // start a table tag in the HTML
						echo "<th>Employee ID</th><th>Name</th><th>Mobile</th><th>Address</th><th>Email</th><th>&nbsp;</th></tr>";
						while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
							echo "<tr><td>".$row['Emp_id']."</td><td>".$row['name']."</td><td>".$row['TP_mob']."</td><td>".$row['Address']."</td><td>".$row['Email']."</td><td><a href='employee.php?edit=".$row['Emp_id']."'>View</a></td></tr>";  //$row['index'] the index here is a field name
						}
						echo "</table>"; //Close the table in HTML
						connection_close(); //Make sure to close out the database connection
					?>