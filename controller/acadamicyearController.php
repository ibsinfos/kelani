<?php
include ("../dbconfig.php");

if (isset($_POST["btnAdd"])) {

    $con = connection();
    $stmt=$con->prepare('INSERT INTO acadamicyear VALUES (?,?)');
    $stmt->bind_param('is', $ID,$YEAR);
	
    $YEAR = $_POST['txtyear'];

    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../acadamicyear.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../acadamicyear.php');
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


