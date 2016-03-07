<?php
                        include_once 'dbconfig.php'; //Connect to database
                        $query = "SELECT * FROM branch_tbl;";
                        $result = getData($query);
                        echo "<table width='100%'>"; // start a table tag in the HTML
                        echo "<tr>
                        <th>Branch ID</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Telephone 1</th>
                        <th>Telephone 2</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
                        </tr>";
                        while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                            echo "<tr><td>" . $row['Branch_id']. "</td><td>" . $row['City']. "</td><td>" . $row['Address']. "</td><td>" . $row['TP1'] . "</td><td>" . $row['TP2'] . "</td><td>" . $row['Email'] . "</td><td><input type='button' value='Edit'></td></tr>";  //$row['index'] the index here is a field name
                        }
                        echo "</table>"; //Close the table in HTML
                        connection_close(); //Make sure to close out the database connection
                        ?>