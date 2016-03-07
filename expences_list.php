<?php
                        include_once 'dbconfig.php'; //Connect to database
                        $query = "SELECT * FROM kelanidb.otherexpenses_tbl";
                        $result = getData($query);
                        echo "<table width='100%'>"; // start a table tag in the HTML
                        echo "<tr>
                        <th># NO</th>
                        <th>INVOICE NUMBER</th>
                        <th>SUPPLIER</th>
						<th>DATE</th>
                        <th>TIME</th>
                        <th>DESCRIPTION</th>
                        <th align='right'>AMOUNT</th>
                        </tr>";
                        while($row = mysqli_fetch_array($result)){//Creates a loop to loop through results
                            echo "<tr><td>" . $row['esp']. "</td><td>" . $row['InvoiceNumber']. "</td><td>" . $row['SuplierName']. "</td><td>" . $row['Date'] . "</td><td>" . $row['Time'] . "</td><td>" . $row['Des'] . "</td><td align='right'>" . $row['Amount'] . "</td></tr>";  //$row['index'] the index here is a field name
                        }
                        echo "</table>"; //Close the table in HTML
                        connection_close(); //Make sure to close out the database connection
                        ?>