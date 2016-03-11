
<?php
include_once 'dbconfig.php'; //Connect to database
include ('./paginate.php');

$query = "SELECT Name FROM polling_devition_tbl";
$result = getData($query);
$per_page = 10;
$total_results = mysqli_num_rows($result);
$total_pages = ceil($total_results/$per_page);

if (isset($_GET['page'])) {
    $show_page = $_GET['page']; //current page
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else {
        // error - show first set of results
        $start = 0;
        $end = $per_page;
    }
} else {
    // if page isn't set, show first set of results
    $show_page = 0;
    $start = 0;
    $end = $per_page;
}
// display pagination
if(isset($_GET['page'])) {
    $page = intval($_GET['page']);
} else {
    $page = 0;
}
$tpages=$total_pages;
if ($page <= 0){
    $page = 1;
}

$reload = $_SERVER['PHP_SELF'] . "?tpages=" . $tpages;


echo "<table class='table table-bordered table-hover'>"; // start a table tag in the HTML
echo "<tr>
         <th>POLLING DIVITIONS</th>
</tr>";
$res = mysqli_fetch_all($result);
for ($i = $start; $i < $end; $i++) {
    if ($i == $total_results) {
        break;
    }

    echo "<tr>";
    echo '<td>' . $res[$i][0].'</td>';
    echo "</tr>";
}

echo "</table>"; //Close the table in HTML
echo '<nav><ul class="pagination">';
if ($total_pages > 1) {
    echo paginate($reload, $show_page, $total_pages);
}
echo "</ul></nav>";
connection_close(); //Make sure to close out the database connection
?>
