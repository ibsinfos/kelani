<?php
include_once 'dbconfig.php';
$query = "SELECT amount FROM tempamount_tbl";
$result = getData($query);
$amount = '0';
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $amount=$row['amount'];
    }
}
else{
    $amount = '0';
}
?>
<td>Existing Amount</td>
<td align="right">
    <input type="text" id="v_txtExistingTempAmount" value="<?php echo $amount; ?>" name="v_txtExistingTempAmount" size="5" readonly/><label></label></td>
