<?php
require_once ("../dbconfig.php");
if (isset($_POST["btnAdd"])) {

    $con = connection();
    $stmt=$con->prepare('INSERT INTO branch_tbl VALUES (?,?,?,?,?,?,now(),?,?)');
    $stmt->bind_param('sssssssi', $ID,$CITY,$ADDRESS,$TP1,$TP2,$EMAIL,$USER,$STATUS);

    $ID = $_POST['txtBranchID'];
    $CITY = $_POST['txtBranchCity'];
    $ADDRESS = $_POST['txtBranchAddress'];
    $TP1 = $_POST['txtBranchTelephone1'];
    $TP2 =$_POST['txtBranchTelephone2'];
    $EMAIL =$_POST['txtBranchEmail'];
    $USER = $_POST['ssUser'];
    $STATUS = '1';
    $stmt->execute();
	
    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../branch.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../branch.php');
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

