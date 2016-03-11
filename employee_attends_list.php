<?php
                        include_once 'dbconfig.php'; //Connect to database
						$datenow = date("Y-m-d");
                        $query = "SELECT * FROM attendanceemployee_tbl WHERE `Date`='$datenow' ";
                        $result = getData($query);
                        echo "<table width='100%' class='table table-bordered table-hover'>"; // start a table tag in the HTML
                        echo "<tr>
                        <th>ATTENDANCE</th>
						<th>DATE</th>
						<th>TIME</th>
                        </tr>";
                        while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                           echo "<tr><td>" . $row['Employee_tb_Emp_id']. "</td><td>" . $row['Date'] ."</td><td>" . $row['Time'] . "</td></tr>";  //$row['index'] the index here is a field name
                        }
                        echo "</table>"; //Close the table in HTML
                        connection_close(); //Make sure to close out the database connection
                        ?>