                            <?php
                            include_once './dbconfig.php';
                            $query = "SELECT * FROM course_tbl";
                            $result =getData($query);
                            echo "<table width='100%' class='table table-bordered table-hover'>"; // start a table tag in the HTML
                            echo "<tr><th>COURSE NAME</th><th>#EDIT</th></tr>";
                            while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                                echo "<tr><td>" . $row['Name'] . "</td><td><a href='course.php?edit=".$row['id']."'>Edit</a></td></tr>";  //$row['index'] the index here is a field name
                            }
                            echo "</table>"; //Close the table in HTML
                            connection_close(); //Make sure to close out the database connection
                            ?>