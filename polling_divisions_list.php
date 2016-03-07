<?php
include_once 'dbconfig.php'; //Comnnect to database
$query = "SELECT Name FROM polling_devition_tbl;";
$result =getData($query);
echo "<table width='100%'>"; // start a table tag in the HTML
echo "<tr><th>POLLING DIVISIONS</th><th>&nbsp;</th></tr>";
while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
    echo "<tr><td>" . $row['Name'] . "</td><td><input type='button' value='Edit'></td></tr>";  //$row['index'] the index here is a field name
}
echo "</table>"; //Close the table in HTML
connection_close(); //Make sure to close out the database connection
?>