<?php
include_once 'dbconfig.php'; //Comnnect to database
$query = "SELECT id, subjectname, Subjectcode FROM subject_tbl;";
$result = getData($query);
echo "<table width='100%'>"; // start a table tag in the HTML
echo "<tr><th>CODE</th><th>SUBJECT NAME</th><th>&nbsp;</th></tr>";
while ($row = mysqli_fetch_array($result)) {   //Creates a loop to loop through results
    echo "<tr><td>" . $row['Subjectcode'] . "</td><td>" . $row['subjectname'] . "</td><td><a href='subject.php?edit=" . $row['id'] . "'>Edit</a></td></tr>";  //$row['index'] the index here is a field name
}
echo "</table>"; //Close the table in HTML
connection_close(); //Make sure to close out the database connection
?>