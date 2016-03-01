<?php
require_once ("../dbconfig.php");
if (isset($_POST["btnAdd"])) {
	
	$PASSWORD = md5($PASSWORDX);
	
    $con = connection();
    $stmt=$con->prepare('INSERT INTO user_tbl VALUES(?,?,?,?,?,?,?)');
    $stmt->bind_param('ssisssi', $USERNAME,$PASSWORD,$USERLEVEL,$EMPLOYEE,$USER,$DATE,$STATUS);
	
	//var_dump($_POST);
 	//die();
	
	$USERNAME = $_POST['usernamex'];
	$PASSWORDX = $_POST['pwd1'];
	$USERLEVEL = $_POST['cmbUserLevel'];
	$EMPLOYEE = $_POST['cmbEmployee'];
	$USER = $_POST['ssUser'];
	$DATE = $_POST['dtpDatex'];
	$STATUS = $_POST['cmbStatus'];
    $stmt->execute();
	
	if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../user.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../user.php');
    }
	
}
?>




