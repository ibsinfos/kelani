<?php
require_once ("../dbconfig.php");
if (isset($_POST["btnFinishDD"])) {
	/* Set connection */
    $con = connection();
	
	//O/L Qulification---------------------------------------------------------------------
	if(trim(($_POST['txtOLindexNo'])) != ''){
		$OLIndexno = $_POST['txtOLindexNo'];
		$YearOL = $_POST['txtOLyear'];
		$PassOL = $_POST['rbOLpass'];
		$EnglishgradeOL= $_POST['cmbEnglishGrade'];
		$CreateUser = 'Admin';
		$Status = '1';
			
		$query = "UPDATE olqulification_tbl SET Year = '".$YearOL."', Pass = '".$PassOL."', English_grade = '".$EnglishgradeOL."' WHERE Index_no = '".$OLIndexno."'"; 				
		$result= $con->query($query);	
	}
	
	//A/L Qulification---------------------------------------------------------------------
	if(trim(($_POST['txtALindexNo'])) != ''){
		$ALIndexno = $_POST['txtALindexNo'];	
		$YearAL = $_POST['txtALyear'];
		
		if (isset($_POST['cmbALmedium'])) {
			$Medium = $_POST['cmbALmedium'];
		}		
		$Center_no = $_POST['txtALCenterNo'];
			
		if (isset($_POST['cmbALdistrict'])) {
			$DistrictID = $_POST['cmbALdistrict'];
		}
		$DistrictRank = $_POST['txtALdistrictRank'];
		$IslandRank = $_POST['txtALislandRank'];
		$Z_core = $_POST['txtALzscore'];
		$GeneralTestMarks = $_POST['txtALgeneralTest'];
		
		if (isset($_POST['cmbALStream'])) {
			$ALStream = $_POST['cmbALStream'];
		}	
						
		$query = "UPDATE alqulification_tbl SET Year = '".$YearAL."', Medium = '".$Medium."', Center_no = '".$Center_no."', District_tbl_District_ID = '".$DistrictID."', District_rank = '".$DistrictRank."', Island_rank = '".$IslandRank."', Z_core = '".$Z_core."', GeneralTestMarks = '".$GeneralTestMarks."', ALStream = '".$ALStream."'  WHERE Index_no = '".$ALIndexno."'";
		$result= $con->query($query);
	}
	
	//Personal Details---------------------------------------------------------------------
	if(trim(($_POST['txtStudentId'])) != ''){
		if (isset($_POST['cmbBranch'])) {
			$Branch_id = $_POST['cmbBranch'];
		}
		$Student_id = $_POST['txtStudentId'];
		$Old_student_id = $_POST['txtOldStudentId'];
		$FullName = $_POST['txaFullname'];
		$Name =$_POST['txtNamewithInitians'];
		$NIC =$_POST['txtNic'];
		$DOB = $_POST['dtpBirthday'];
		$Gender = $_POST['rbGender'];
		$Address1 = $_POST['txaHomeAddress'];
		$Address2 = $_POST['txaOfficeAddress'];
		$Nationality = $_POST['cmbNationality'];
		$TP_Home = $_POST['txtTelephoneHome'];
		$TP_Office = $_POST['txtTelephoneOffice'];
		$TP_mob = $_POST['txtTelephoneMobile'];
		$Email = $_POST['txtEmail'];
		$Reg_Date = $_POST['dtpRegDate'];
		//if(trim(($_POST['ImageSig'])) != ''){
			$Signature = 'img/Signature/'.$Student_id.'.jpg';
		//}
		//else{
		//	$Signature = '1';
		//}
		//if(trim(($_POST['ImageStu'])) != ''){
			$Picture = 'img/Student/'.$Student_id.'.jpg';
		//}
		//else{
		//	$Picture = '1';
		//}

		if (isset($_POST['cmbDistrict'])) {
			$District_tbl_District_ID = $_POST['cmbDistrict'];
		}
		if (isset($_POST['cmbPollingDivision'])) {
			$Polling_devition_tbl_Polling_ID = $_POST['cmbPollingDivision'];
		}	
		$Course_tbl_Course_ID = '0';
		
		if (isset($_POST['cmbDegreeMedium'])) {
			$Medium = $_POST['cmbDegreeMedium'];
		}	
		if (isset($_POST['cmbCenters'])) {
			$ExamCenter_tbl_id = $_POST['cmbCenters'];
		}
		$OLQulification_tbl_Index_no = $_POST['txtOLindexNo'];
		$ALQulification_tbl_Index_no = $_POST['txtALindexNo'];
		
		$query = "UPDATE Student_tb SET Branch_tbl_Branch_id = '".$Branch_id."', Old_student_id = '".$Old_student_id."', FullName = '".$FullName."', Name = '".$Name."', NIC = '".$NIC."', DOB = '".$DOB."', Gender = '".$Gender."', Address1 = '".$Address1."', Address2 = '".$Address2."', Nationality = '".$Nationality."', TP_Home = '".$TP_Home."', TP_Office = '".$TP_Office."', TP_mob = '".$TP_mob."', Email = '".$Email."', Reg_Date = '".$Reg_Date."', Signature = '".$Signature."', Picture = '".$Picture."', District_tbl_District_ID = '".$District_tbl_District_ID."', Polling_devition_tbl_Polling_ID = '".$Polling_devition_tbl_Polling_ID."', Course_tbl_Course_ID = '".$Course_tbl_Course_ID."', Medium = '".$Medium."', ExamCenter_tbl_id = '".$ExamCenter_tbl_id."', OLQulification_tbl_Index_no = '".$OLQulification_tbl_Index_no."', ALQulification_tbl_Index_no = '".$ALQulification_tbl_Index_no."'  WHERE Student_id = '".$Student_id."'";		
		$result= $con->query($query);	
		
		$Student_id = $_POST['txtStudentId'];
		$dir_to_search = $_POST['ImageStu'];
		if(trim(($_POST['ImageStu'])) != ''){
		copy('C:/Kelani/images/Student/'.$dir_to_search, '../img/Student/'.$Student_id.'.jpg');
		}
		$Student_id = $_POST['txtStudentId'];
		$Signature_to_search = $_POST['ImageSig'];
		if(trim(($_POST['ImageSig'])) != ''){
		copy('C:/Kelani/images/Signature/'.$Signature_to_search, '../img/Signature/'.$Student_id.'.jpg');
		}
	}
		
	//Other Qulification---------------------------------------------------------------------
	if(trim(($_POST['txtDiplomaName_OQ'])) != ''){
		if(trim(($_POST['txtCourseID'])) != ''){
			$Student_tb_Student_id = $_POST['txtStudentId'];
			$QulificationID = $_POST['txtCourseID'];
			$NameOQ = $_POST['txtDiplomaName_OQ'];
			$Institute = $_POST['txtInstitute_OQ'];
			$SubjectOQ = $_POST['txtSubject_OQ'];
			$GradeOQ = $_POST['txtGrade_OQ'];
			$YearOQ = $_POST['txtYear_OQ'];
			
			$query = "UPDATE otherqulification_tbl SET Name = '".$NameOQ."', Institute = '".$Institute."', Subject = '".$SubjectOQ."', Grade = '".$GradeOQ."', Year = '".$YearOQ."' WHERE QulificationID = '".$QulificationID."'";
			$result= $con->query($query);
		}
		else{
			$query = "SELECT (IFNULL(MAX(CAST(QulificationID AS UNSIGNED INT)),0) + 1) AS MAXNO FROM otherqulification_tbl;";
			$result = getData($query);
			$row = mysqli_fetch_array($result);
			$QulificationID_ = $row['MAXNO'];

			$stmt=$con->prepare('INSERT INTO  otherqulification_tbl VALUES (?,?,?,?,?,?,now(),?,?)');
			$stmt->bind_param('sssssiss', $QulificationID, $Name, $Institute, $Subject, $Grade, $Year, $CreateUser, $Student_tb_Student_id);
		
			$QulificationID = $QulificationID_;
			$Name = $_POST['txtDiplomaName_OQ'];
			$Institute = $_POST['txtInstitute_OQ'];
			$Subject = $_POST['txtSubject_OQ'];
			$Grade = $_POST['txtGrade_OQ'];
			$Year = $_POST['txtYear_OQ'];
			$CreateUser = 'Admin';
			$Student_tb_Student_id = $_POST['txtStudentId'];
			
			$stmt->execute();
			/* close statement and connection */
			$stmt->close();
		}
	}
	
	//Subjects Results---------------------------------------------------------------------
	if (isset($_POST['btnFinishDD'])) {	

		$query = "SELECT SubjectID, Grade FROM TempALSubject_tbl";
		$result= $con->query($query);
		$count = $result->num_rows; 

		if ($count > 0) {
			// output data of each row
			while ($row = $result->fetch_assoc())  {
				$stmt=$con->prepare('INSERT INTO ALQulification_tbl_has_ALSubject_tbl VALUES (?,?,?) ');
				$stmt->bind_param('iis',$Index_no, $SubjectID, $Grade);
				$Index_no = $_POST['txtALindexNo'];
				$SubjectID = $row["SubjectID"];
				$Grade = $row["Grade"];
		
				$stmt->execute();	
			}
			$stmt->close();	
			
			$query = "DELETE FROM TempALSubject_tbl";
			$result= $con->query($query);
		}				
	}
//			var_dump($_POST);
//			die();
    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../student_management.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../student_management.php');
    }
}
if (isset($_POST["btnDelete"])) {
 $con = connection();
	//O/L Qulification---
	if(trim(($_POST['txtOLindexNo'])) != ''){
		$OLIndexno = $_POST['txtOLindexNo'];

		$query = "UPDATE olqulification_tbl SET OLQulification__status = '0' WHERE Index_no = '".$OLIndexno."'"; 				
		$result= $con->query($query);	
	}
	//A/L Qulification-----
	if(trim(($_POST['txtALindexNo'])) != ''){
		$ALIndexno = $_POST['txtALindexNo'];	
		
		$query = "UPDATE alqulification_tbl SET ALQulification_status = '0'  WHERE Index_no = '".$ALIndexno."'";
		$result= $con->query($query);
	}	
	//Personal Details---------------------------------------------------------------------
	if(trim(($_POST['txtStudentId'])) != ''){
		$Student_id = $_POST['txtStudentId'];
		
		$query = "UPDATE Student_tb SET Student_status = '0' WHERE Student_id = '".$Student_id."'";		
		$result= $con->query($query);	
	}
	if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../student_management.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../student_management.php');
    }
}
?>


