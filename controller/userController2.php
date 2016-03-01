<?php
require_once ("../dbconfig.php");
if (isset($_POST["btnAdd"])) {

    $con = connection();
    $stmt=$con->prepare('INSERT INTO user_tbl VALUES(?,?,?,?,?,?,?)');
    $stmt->bind_param('ssisssi', $USERNAME,$PASSWORD,$USERLEVEL,$EMPLOYEE,$USER,$DATE,$STATUS);
	
	var_dump($_POST);
 	die();
	
	$USERNAME = $_POST['username'];
	$PASSWORD = $_POST['pwd1'];
	$USERLEVEL = $_POST['cmbUserLevel'];
	$EMPLOYEE = $_POST['cmbEmployee'];
	$USER = 'Admin';
	$DATE = '2016-01-04';
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
elseif(isset($_POST["btnUpdate"])) {
    $con = connection();
	if (isset($_POST['cmbUser'])) {
	$ID = $_POST['cmbUser'];
	}
    $PASSWORD = $_POST['password'];
	if (isset($_POST['cmbUserLevel'])) {
	$LEVEL = $_POST['cmbUserLevel'];
	}
    $EMAIL = $_POST['email'];
    $CREATEUSER = 'Admin';
	$DATE = '1/2/2016';
    if (isset($_POST['cmbBranch'])) {
	$BRANCH = $_POST['cmbBranch'];
	}
    //$stmt2=$con->prepare("UPDATE user_tbl SET Password='$PASSWORD',User_lavel='$LEVEL',Email='$EMAIL',CreateDate='now()',CreateUser='$CREATEUSER',Employee_tb_Emp_id='$ID',Branch_tbl_Branch_id='$BRANCH' WHERE User_id='$ID';");
	
	$stmt2=$con->prepare("UPDATE user_tbl SET Password=?,UserLevel_tbl_id=?,Email=?,CreateDate=now(),CreateUser=?,Branch_tbl_Branch_id=? WHERE User_id=?;");
	$stmt2->bind_param('ssssss',$PASSWORD,$LEVEL,$EMAIL,$CREATEUSER,$BRANCH,$ID );
	
	$stmt2->execute();
	
	if($stmt2->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../user.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../user.php');
    }
}

elseif(isset($_POST["btnDelete"])) {
    $con = connection();
    $stmt=$con->prepare('DELETE FROM user_tbl WHERE User_id=?;');
    $stmt->bind_param('s',$ID);
	$stmt->execute();
	if($stmt2->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../user.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../user.php');
    }
}

elseif(isset($_POST["btnClear"])) {
    echo "Yes, Clear";
}





?>


