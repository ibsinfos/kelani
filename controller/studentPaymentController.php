<?php
require_once ("..\dbconfig.php");
if (isset($_POST["btnAdd"])) {

    $con = connection();
	
	$query = "SELECT LPAD(RIGHT(IFNULL(MAX(InvoiceNo),0),6)+1,7,'0') AS InvoiceNo FROM payment_tbl;";
	$result= $con->query($query);
	//echo $query;
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while ($row = mysqli_fetch_assoc($result)) {
					if($row['InvoiceNo'] == null || $row['InvoiceNo'] == ""){
						$invoiceno = 'INV0000001';
					}
					else{
						$invoiceno = 'INV'.$row['InvoiceNo'];
					}
			}
	}
	
    $stmt=$con->prepare('INSERT INTO payment_tbl(InvoiceNo, Date, Time, Total, Discount, SubTotal, Settle, Balance, DueAmount, Student_tb_Student_id, CreateUser, Status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
    $stmt->bind_param('sssddddddssi', $INVOICENO,$DATE,$TIME,$TOTAL,$DISCOUNT,$SUBTOTAL,$SETTLE,$BALANCE,$DUEAMOUNT,$STUDENT,$USER,$STATUS);
	
	
	$STUDENT = $_POST['txtStudentID'];
	//$INVOICENO = $_POST['invoiceno'];
	$INVOICENO = $invoiceno;
	$DATE = $_POST['dtpDate'];
	$TIME = $_POST['dtpTime'];
	$TOTAL = $_POST['txtTotal'];
	$DISCOUNT = $_POST['txtDiscount'];
	$SUBTOTAL= $_POST['txtSubTotal'];
	$SETTLE = $_POST['txtSettel'];
	$BALANCE = $_POST['txtBalance'];
	$DUEAMOUNT = $_POST['txtDue'];
	$cbSubject = $_POST['cbSubject'];

	$USER = 'Admin';
    $STATUS = '1';
    $stmt->execute();
	$stmt->close();
	
	foreach ($cbSubject as $cbSubjectEach){
		
		$subjectSplit = explode("-",$cbSubjectEach);
		$subjectCode = $subjectSplit[0];
		$stmt=$con->prepare('INSERT INTO payment_detail_tbl VALUES(?,?,?,?,?)');
		$stmt->bind_param('sisdd', $INVOICENO,$subjectCode,$DATE,$subjectSplit[1],$subjectSplit[1]);
		
		$stmt->execute();
	}	
	//mysqli_query("query here") or die(mysqli_error($con));
	//echo $con->error;
	//var_dump($_POST);
	//die();
    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../student_payments.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../student_payments.php');
    }
}

elseif(isset($_POST["btnUpdate"])) {
    echo "<script type='text/javascript'>alert('Update');</script>";
}

elseif(isset($_POST["btnDelete"])) {
    echo "<script type='text/javascript'>alert('Delete');</script>";
}

elseif(isset($_POST["btnClear"])) {
    echo "Yes, Clear";
}
?>

