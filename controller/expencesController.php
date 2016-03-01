<?php
require_once ("../dbconfig.php");
if (isset($_POST["btnAdd"])) {

    $con = connection();
    $stmt=$con->prepare('INSERT INTO otherexpenses_tbl VALUES (?,?,?,?,?,?,?,?,?)');
    $stmt->bind_param('ssssssdsi', $ID,$INVOICE,$DATE,$TIME,$SUPLIER,$DES,$AMOUNT,$USER,$STATUS);
    
	$ID = $_POST['num'];
    $INVOICE = $_POST['txtInvoiceNumber'];
    $DATE = $_POST['dtpDate'];
    $TIME = $_POST['dtpTime'];
    $SUPLIER =$_POST['txtSupplierName'];
    $DES =$_POST['txaDescription'];
    $AMOUNT =$_POST['txtAmount'];
	$USER = $_POST['ssUser'];
    $STATUS = '1';
    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../expences.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../expences.php');
    }
}
?>

