<?php
require_once ("../dbconfig.php");
if (isset($_POST["btnFinishDD"])) {
	/* Set connection */
    $con = connection();
	
	//O/L Qulification---------------------------------------------------------------------
	if(trim(($_POST['txtOLindexNo'])) != ''){
		$stmt=$con->prepare('INSERT INTO  olqulification_tbl VALUES (?, ?, ?, ?, now(), ?, ?)');
		$stmt->bind_param('siissi',$Indexno, $Year, $Pass, $Englishgrade, $CreateUser, $Status);
	
		$Indexno = $_POST['txtOLindexNo'];
		$Year = $_POST['txtOLyear'];
		$Pass = $_POST['rbOLpass'];
		$Englishgrade= $_POST['cmbEnglishGrade'];
		$CreateUser = $_POST['ssUser'];
		$Status = '1';
		$stmt->execute();
		/* close statement and connection */
		$stmt->close();
	}
	
	//A/L Qulification---------------------------------------------------------------------
	if(trim(($_POST['txtALindexNo'])) != ''){
		$stmt=$con->prepare('INSERT INTO alqulification_tbl VALUES (?,?,?,?,?,?,?,?,?,?,now(),?,?)');
		$stmt->bind_param('sissiiidissi',$Indexno, $Year, $Medium, $Center_no, $DistrictID, $DistrictRank, $IslandRank, $Z_core, $GeneralTestMarks, $ALStream, $CreateUser, $Status);
	
		$Indexno = $_POST['txtALindexNo'];	
		$Year = $_POST['txtALyear'];
		
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
		$CreateUser = $_POST['ssUser'];
		$Status = '1';
		$stmt->execute();
		$stmt->close();
	}
	
	//Personal Details---------------------------------------------------------------------
	if(trim(($_POST['txtStudentId'])) != ''){
		$stmt=$con->prepare('INSERT INTO Student_tb VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
		, ?, ?, ?, ?, ?, now(), ?, ?)');
		$stmt->bind_param('ssssssssssssssssssiississsi', $Branch_id, $Student_id, $Old_student_id, $FullName, $Name, $NIC, $DOB, $Gender, $Address1, $Address2, $Nationality, $TP_Home, $TP_Office, $TP_mob, $Email, $Reg_Date, $Signature, $Picture, $District_tbl_District_ID, $Polling_devition_tbl_Polling_ID
		, $Course_tbl_Course_ID, $Medium, $ExamCenter_tbl_id, $OLQulification_tbl_Index_no, $ALQulification_tbl_Index_no, $CreateUser, $Student_status);
	
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
		if(trim(($_POST['ImageSig'])) != ''){
			$Signature = 'img/Signature/'.$Student_id.'.jpg';
		}
		else if(trim(($_POST['ImageSig'])) == ''){
			$Signature = '1';
		}
		if(trim(($_POST['ImageStu'])) != ''){
			$Picture = 'img/Student/'.$Student_id.'.jpg';
		}
		else if(trim(($_POST['ImageStu'])) == ''){
			$Picture = '1';
		}

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
		$CreateUser = $_POST['ssUser'];
		$Student_status = 1;
		
		$stmt->execute();
		$stmt->close();
		
		$Student_id = $_POST['txtStudentId'];
		$dir_to_search = $_POST['ImageStu'];
		copy('C:/Kelani/images/Student/'.$dir_to_search, '../img/Student/'.$Student_id.'.jpg');
		
		$Student_id = $_POST['txtStudentId'];
		$Signature_to_search = $_POST['ImageSig'];
		copy('C:/Kelani/images/Signature/'.$Signature_to_search, '../img/Signature/'.$Student_id.'.jpg');
	}
		
	//Other Qulification---------------------------------------------------------------------
	if(trim(($_POST['txtDiplomaName_OQ'])) != ''){
				
		$stmt=$con->prepare('INSERT INTO  otherqulification_tbl VALUES (?,?,?,?,?,?,now(),?,?)');
		$stmt->bind_param('sssssiss', $QulificationID, $Name, $Institute, $Subject, $Grade, $Year, $CreateUser, $Student_tb_Student_id);
	
		$QulificationID = $_POST['txtCourseID'];
		$Name = $_POST['txtDiplomaName_OQ'];
		$Institute = $_POST['txtInstitute_OQ'];
		$Subject = $_POST['txtSubject_OQ'];
		$Grade = $_POST['txtGrade_OQ'];
		$Year = $_POST['txtYear_OQ'];
		$CreateUser = $_POST['ssUser'];
		$Student_tb_Student_id = $_POST['txtStudentId'];
		
		$stmt->execute();
		/* close statement and connection */
		$stmt->close();
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
        header('Location:../students_course.php');
		
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../student_management.php');
    }
}

?>
