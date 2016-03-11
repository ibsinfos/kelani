<?php
include_once 'dbconfig.php'; //Connect to database
$query = "SELECT u.Username, e.NameInitial, ul.lavel_name, b.City, u.CreateDate
FROM user_tbl u, employee_tb e, userlevel_tbl ul, branch_tbl b
WHERE u.Emp_id = e.Emp_id AND u.UserLevel_tbl_id = ul.id AND e.Branch_tbl_Branch_id = b.Branch_id
";
//Username, NameInitial, lavel_name, City, CreateDate
$result = getData($query);
echo "<table width='100%' class='table table-bordered table-hover'>"; // start a table tag in the HTML
echo "<tr>
                        <th>USERNAME</th>
                        <th>NAME</th>
                        <th>USER LEVEL</th>
                        <th>CITY</th>
						<th>CREATE DATE</th>
						<th>#EDIT</th>
                        </tr>";
while ($row = mysqli_fetch_array($result)) {//Creates a loop to loop through results
    echo "<tr><td>" . $row['Username'] . "</td><td>" . $row['NameInitial'] . "</td><td>" . $row['lavel_name'] . "</td><td>" . $row['City'] . "</td><td>" . $row['CreateDate'] . "</td><td><a href='user.php?edit=" . $row['Username'] . "'>Edit</a></td></tr>";  //$row['index'] the index here is a field name
}
echo "</table>"; //Close the table in HTML
connection_close(); //Make sure to close out the database connection
?>