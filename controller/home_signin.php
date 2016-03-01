<?php
session_start();
require_once '../config.php';

if(isset($_POST['btn-login']))
{
	$username = trim($_POST['username']);
	$password = md5(trim($_POST['password']));

	try
	{
		$stmt = $db_con->prepare("SELECT * FROM user_tbl WHERE Username='".$username."'");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$count = $stmt->rowCount();
		if($row['Password']==$password){
			echo "ok"; // log in
			$_SESSION['user_session'] = "loged";
			$_SESSION['username'] = $username;
			$_SESSION['userLvl'] = $row['UserLevel_tbl_id'];
			$_SESSION['status'] = $row['Status'];
		}
		else{
			echo "Username or password does not exist.";
		}
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}
?>