<?php
require_once ("..\dbconfig.php");
if (isset($_POST["btnAdd"])) {

    $con = connection();
	
	$query = "SELECT LPAD(RIGHT(IFNULL(MAX(esp),0),6)+1,7,'0') AS esp FROM otherexpenses_tbl";
	$result= $con->query($query);
	//echo $query;
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while ($row = mysqli_fetch_assoc($result)) {
					if($row['esp'] == null || $row['esp'] == ""){
						//$invoiceno = 'INV0000001';
						$invoiceno = 'ESP0000001';
					}
					else{
						$invoiceno = 'ESP'.$row['esp'];
					}
			}
	}
	
    $stmt=$con->prepare('INSERT INTO otherexpenses_tbl VALUES (?,?,?,?,?,?,?,?,?)');
    $stmt->bind_param('ssssssdsi', $ID,$INVOICE,$DATE,$TIME,$SUPLIER,$DES,$AMOUNT,$USER,$STATUS);
    
	//$ID = $_POST['num'];
	$ID = $invoiceno;
    $INVOICE = $_POST['txtInvoiceNumber'];
    $DATE = $_POST['dtpDate'];
    $TIME = $_POST['dtpTime'];
    $SUPLIER =$_POST['txtSupplierName'];
    $DES =$_POST['txaDescription'];
    $AMOUNT =$_POST['txtAmount'];
	$USER = 'Admin';
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

