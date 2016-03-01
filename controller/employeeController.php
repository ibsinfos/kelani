<?php
require_once ("../dbconfig.php");

if (isset($_POST["btnSubmit"])) {

    $con = connection();
    $stmt=$con->prepare('INSERT INTO employee_tb VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,now(),?,?)');
    $stmt->bind_param('ssisssssssssssi', $EMPID,$BRANCH,$DESINGATION,$NAME,$NAMEINITIAL,$GENDER,$NIC,$DOB,$HOMEADDRESS,$TPHOME,$TPMOBILE,$EMAIL,$PHOTO,$USER,$STATUS);
		
	$EMPID  = $_POST['txtEmployeeId'];
	$BRANCH = $_POST['cmbBranch'];
	$DESINGATION  = $_POST['cmbDesignation'];
	$NAME  = $_POST['txaName'];
	$NAMEINITIAL  = $_POST['txtNameWithInitians'];
	$GENDER  = $_POST['rbGender'];
	$NIC  = $_POST['txtNic'];
	$DOB  = $_POST['dtpBirthday'];
	$HOMEADDRESS  = $_POST['txaHomeAddress'];
	$TPHOME  = $_POST['txtTelephoneHome'];
	$TPMOBILE  = $_POST['txtTelephoneMobile'];
	$EMAIL  = $_POST['txtEmail'];

	if(trim(($_POST['imgImage'])) != ''){
		$PHOTO = 'img/Employee/'.$EMPID.'.jpg';
	}
	else if(trim(($_POST['imgImage'])) == ''){
		$PHOTO = '1';
	}
	$USER = $_POST['ssUser'];
    $STATUS = '1';
	
	$EMPID = $_POST['txtEmployeeId'];
	$dir_to_search = $_POST['imgImage'];
	copy('C:/Kelani/images/Employee/'.$dir_to_search, '../img/Employee/'.$EMPID.'.jpg');
		
    $stmt->execute();
	
	//var_dump($_POST);
	//die();
	
    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../employee.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../employee.php');
    }
}

elseif(isset($_POST["btnUpdate"])) {
 	$con = connection();
	if(trim(($_POST['txtEmployeeId'])) != ''){
		$EMPID  = $_POST['txtEmployeeId'];
		$BRANCH = $_POST['cmbBranch'];
		$DESINGATION  = $_POST['cmbDesignation'];
		$NAME  = $_POST['txaName'];
		$NAMEINITIAL  = $_POST['txtNameWithInitians'];
		$GENDER  = $_POST['rbGender'];
		$NIC  = $_POST['txtNic'];
		$DOB  = $_POST['dtpBirthday'];
		$HOMEADDRESS  = $_POST['txaHomeAddress'];
		$TPHOME  = $_POST['txtTelephoneHome'];
		$TPMOBILE  = $_POST['txtTelephoneMobile'];
		$EMAIL  = $_POST['txtEmail'];
	
		//if(trim(($_POST['imgImage'])) != ''){
			$PHOTO = 'img/Employee/'.$EMPID.'.jpg';
		//}
		//else if(trim(($_POST['imgImage'])) == ''){
		//	$PHOTO = '1';
		//}

		$query = "UPDATE employee_tb SET Branch_tbl_Branch_id = '".$BRANCH."', Designation_tbl_id = '".$DESINGATION."', Name = '".$NAME."', NameInitial = '".$NAMEINITIAL."', Gender = '".$GENDER."', NIC = '".$NIC."', DOB = '".$DOB."', Address = '".$HOMEADDRESS."', TP_home = '".$TPHOME."', TP_mob = '".$TPMOBILE."', Email = '".$EMAIL."', Picture = '".$PHOTO."'  WHERE Emp_id = '".$EMPID."'"; 				
		$result= $con->query($query);
			
		$EMPID = $_POST['txtEmployeeId'];
		$dir_to_search = $_POST['imgImage'];
		copy('C:/Kelani/images/Employee/'.$dir_to_search, '../img/Employee/'.$EMPID.'.jpg');
	}	
    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Update');</script>";
        header('Location:../employee.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../employee.php');
    }
}

elseif(isset($_POST["btnDelete"])) {
	$con = connection();
    	if(trim(($_POST['txtEmployeeId'])) != ''){
		$EMPID  = $_POST['txtEmployeeId'];
		$query = "UPDATE employee_tb SET Status = '0'  WHERE Emp_id = '".$EMPID."'"; 				
		$result= $con->query($query);	
	}	
    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Delete');</script>";
        header('Location:../employee.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../employee.php');
    }
}

elseif(isset($_POST["btnClear"])) {
    echo "Yes, Clear";
}

function idgenarate(){

    $query1="SELECT MAX(Course_ID) FROM course_tbl";

}

?>


