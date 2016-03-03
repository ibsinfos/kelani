<?php
require_once ("../dbconfig.php");
if (isset($_POST["btnAdd"])) {
		
    $con = connection();
    $stmt=$con->prepare('INSERT INTO user_tbl VALUES(?,?,?,?,?,?,?)');
    $stmt->bind_param('ssisssi', $USERNAME,$PASSWORDX,$USERLEVEL,$EMPLOYEE,$USER,$DATE,$STATUS);
	
	//var_dump($_POST);
 	//die();
	
	$USERNAME = $_POST['usernamex'];
	$PASSWORDX = md5($_POST['pwd1']);
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

elseif(isset($_POST["btnUpdate"])) {
    $con = connection();
    if(trim(($_POST['usernamey'])) != ''){

        $USERNAMEY = $_POST['usernamey'];
        $PASSWORDX = md5($_POST['pwd1']);
        $USERLEVEL = $_POST['cmbUserLevel'];
        $STATUS = $_POST['cmbStatus'];

        $query = "UPDATE user_tbl SET Password = '".$PASSWORDX."', UserLevel_tbl_id = '".$USERLEVEL."', Status = '".$STATUS."' WHERE Username = '".$USERNAMEY."' ";
        $result= $con->query($query);

    }

    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Update');</script>";
        header('Location:../user.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../user.php');
    }
}

elseif(isset($_POST["btnDelete"])) {
}

elseif(isset($_POST["btnClear"])) {
    echo "Yes, Clear";
}
?>




