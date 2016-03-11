<?php
						include_once 'dbconfig.php'; //Connect to database
						$query = "SELECT a.`year` AS acadamicyear, c.`Name` AS course, p.`name` AS part, cp.StartDate, cp.EndDate 
									FROM courseprocess cp INNER JOIN acadamicyear a ON cp.AcadamicYear_id=a.id INNER JOIN course_tbl c ON cp.Course_tbl_id=c.id INNER JOIN part_tbl p ON cp.Part_tbl_id=p.id WHERE  cp.Status = '1'";
						$result = getData($query);
						echo "<table width='100%' class='table table-bordered table-hover'>"; // start a table tag in the HTML
						echo "<tr>
								<th>ACADAMIC YEAR</th>
								<th>COURSE</th>
								<th>PART</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>#EDIT</th>
							  </tr>";
						while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
						
							echo "<tr><td>" . $row['acadamicyear']. "</td><td>" . $row['course']. "</td><td>" . $row['part']. "</td><td>" . $row['StartDate']. "</td><td>" . $row['EndDate'] . "</td><td><a href='courseProcess.php?acadamicyear=".$row['acadamicyear']."&course=".$row['course']."&part=".$row['part']."'>Edit</a></td></tr>";  //$row['index'] the index here is a field name
						}
						echo "</table>"; //Close the table in HTML
						connection_close(); //Make sure to close out the database connection
						?>