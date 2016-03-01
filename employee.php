<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kelani</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">



<!-- Bootstrap Core CSS -->

<link href="./css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="./css/sb-admin.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="./css/plugins/morris.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="./font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- Custom Css -->
<link href="./css/formcss.css" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head><body>


<?php
include_once './inc/top.php';
include_once 'dbconfig.php'; //Connect to database

if(isset($_GET['edit'])){
	 $id = trim($_GET['edit']);
	 $query = "SELECT Emp_id, `name` AS Name, TP_mob, Address, Email, Picture, Branch_tbl_Branch_id,Designation_tbl_id,NameInitial,Gender,NIC,DOB,TP_home FROM employee_tb WHERE Emp_id='".$id."'";
	 $result = getData($query);
	 if (mysqli_num_rows($result) > 0) {
		 while ($row = mysqli_fetch_assoc($result)) {
			 $name = $row['Name'];   
			 $TP_mob = $row['TP_mob'];   
			 $Address = $row['Address'];
			 $Email = $row['Email'];
			 $Picture_ = $row['Picture'];
			 $Branch_tbl_Branch_id = $row['Branch_tbl_Branch_id'];
			 $Designation_tbl_id = $row['Designation_tbl_id'];	 
			 $NameInitial = $row['NameInitial'];
			 $Gender_ = $row['Gender'];
			 $NIC = $row['NIC'];	 
			 $DOB = $row['DOB'];	 
			 $TP_home = $row['TP_home'];	 
		 }
	 }
	 else{
	 $name = "";   
	 $TP_mob = "";   
	 $Address = "";
	 $Email = "";
	 $Picture_ = "img/photo.png";
	 $Branch_tbl_Branch_id = "";
	 $Designation_tbl_id = "";	 
	 $NameInitial = "";
	 $Gender_ = "M";
	 $NIC = "";	 
	 $DOB = "";	 
	 $TP_home = "";
	 }
//	var_dump($_POST);
//	die();
	
}
else{
	 $name = "";   
	 $TP_mob = "";   
	 $Address = "";
	 $Email = "";
	 $Picture_ = "img/photo.png";
	 $Branch_tbl_Branch_id = "";
	 $Designation_tbl_id = "";	 
	 $NameInitial = "";
	 $Gender_ = "";
	 $NIC = "";	 
	 $DOB = "";	 
	 $TP_home = "";
}
?>

<script src="js/jquery.js"></script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
	
	
	$(document).ready(function(e) {
					
		$('#cmbBranch').change(function(e){
			GenerateEmpID();
		});

		function GenerateEmpID(){
			
			e = document.getElementById("cmbBranch");
			var Branch = e.options[e.selectedIndex].value;

			$.ajax({
				type:'POST',
				url:"controller/EmpIDGenerate.php",
				data:{branch:Branch},
				success: function(data){
					document.getElementById("EmployeeId").value = data;
				}
			});
		}
		
	});
</script>

    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Employee Management
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Employee Management
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <?php
                require_once("./config.php");
                $stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'alsubj'");
                $stmt->execute();
                $permissions = $stmt->fetchAll();
                if ($permissions[0]['R']) {
                ?>
                <form method="post" action="controller/employeeController.php" data-toggle="validator">
                <div class="row">
                    <div class="col-lg-4">
                    	<label>Branch</label><br/>
                        <select  id="cmbBranch" name="cmbBranch" required>
                        <option value='0'>        --Select Branch--</option>
                        		<?php
                                include_once 'dbconfig.php';
                                $query = 'SELECT * FROM branch_tbl';
                                $result = getData($query);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
										$selected = $row['Branch_id'] == $Branch_tbl_Branch_id ? 'selected' : '';
										echo "<option ". $selected ." value='".$row['Branch_id']."'>".$row['City']."</option>";
                                    }
                                }
                                ?>
                        </select><br />
                        <label>Employee ID</label><br/>
                        <input type="text" name="txtEmployeeId" size="50" id="EmployeeId"  value="<?php if(isset($_GET['edit'])){ echo $id;} ?>" readonly/><br/>
                        <label>Designation</label><br/>
                        <select name="cmbDesignation" required>
                        <option value='0'>        --Select Designation--</option>
                        		<?php
                                include_once 'dbconfig.php';
                                $query = 'SELECT id,`Name` FROM designation_tbl';
                                $result = getData($query);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
									$selected = $row['id'] == $Designation_tbl_id ? 'selected' : '';
										echo "<option ". $selected ." value='".$row['id']."'>".$row['Name']."</option>";
                                    }
                                }
                                ?>
                        </select><br />
                        <label>Name</label><br/>
                        <input type="text" name="txaName" size="50" value="<?php if(isset($_GET['edit'])){ echo $name;} ?>" required/><br/>
                        <label>Name with Initials</label><br/>
                        <input type="text" name="txtNameWithInitians" size="50" value="<?php if(isset($_GET['edit'])){ echo $NameInitial;} ?>"/><br/>
                        <label>Gender</label><br/>
                        <label>
                            <input type="radio" name="rbGender" value="M" id="gender_0"  <?php echo ($Gender_=='M')?'checked':'' ?>/>Male
                        </label>
                        <label>
                            <input type="radio" name="rbGender" value="F" id="gender_1"  <?php echo ($Gender_=='F')?'checked':'' ?>/>Female
                        </label>
                        <br />
                    </div>

                    <div class="col-lg-4">
                    	<label>NIC No</label><br/>
                        <input type="text" name="txtNic" size="12" maxlength="12" value="<?php if(isset($_GET['edit'])){ echo $NIC;} ?>" required/><br/>
                        <label>Birthday</label><br/>
                        <input type="date" name="dtpBirthday" value="<?php if(isset($_GET['edit'])){ echo $DOB;} ?>" required/><br/>
                        <label>Home Address</label><br/>
                        <textarea rows="3" cols="51" name="txaHomeAddress"><?php if(isset($_GET['edit'])){ echo $Address;} ?></textarea><br/>
                        <label>Telephone Home</label><br/>
                        <input type="text" name="txtTelephoneHome" maxlength="10" size="10" value="<?php if(isset($_GET['edit'])){ echo $TP_home;} ?>" required/><br/>
                        <label>Telephone Mobile</label><br/>
                        <input type="text" name="txtTelephoneMobile" maxlength="10" size="10" value="<?php if(isset($_GET['edit'])){ echo $TP_mob;} ?>"/><br/>
                        <label>Email</label><br/>
                        <input type="email" name="txtEmail" size="50" value="<?php if(isset($_GET['edit'])){ echo $Email;} ?>"/><br/>
						<input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">
                    </div>

                    <div class="col-lg-4">
                        <label>Photo</label><br/>
                        <img id="blah" src="<?php echo $Picture_== '1' ? 'img/photo.png': $Picture_ ?>" name="photo" alt="your image"/>
                        <br>
                        <input type='file' name="imgImage" style="border:none !important;" onChange="readURL(this);" /><br />
                    </div>
                </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <?php if ($permissions[0]['W']) { ?>
                                <input name="btnAdd" type="submit" value="Add" class="btn btn-primary"/>
                                <input name="btnUpdate" onclick="" type="submit" value="Update"
                                       class="btn btn-primary"/>
                            <?php } else {
                                ?>
                                <input name="btnAdd" type="submit" value="Add" class="btn btn-primary" disabled/>
                                <input name="btnUpdate" onclick="" type="submit" value="Update" class="btn btn-primary"
                                       disabled/>
                                <?php
                            }
                            if ($permissions[0]['D']) {
                                ?>
                                <input name="btnDelete" type="submit" value="Delete" class="btn btn-danger"/>
                            <?php } else {
                                ?>
                                <input name="btnDelete" type="submit" value="Delete" class="btn btn-danger"/>
                                <?php
                            } ?>
                            <input name="btnClear" type="reset" value="Clear" class="btn btn-default"/>
                        </div>
                    </div>
                <!-- /.row -->
                </form>

                <div class="row">
                    <div class="col-lg-12">                    
                                      
                    <?php
						include_once 'dbconfig.php'; //Connect to database
						$query = "SELECT Emp_id, `name`, TP_mob, Address, Email FROM employee_tb WHERE Status = '1';";
						$result =getData($query);
						echo "<table width='100%'>"; // start a table tag in the HTML
						echo "<th>Employee ID</th><th>Name</th><th>Mobile</th><th>Address</th><th>Email</th><th>&nbsp;</th></tr>";
						while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
							echo "<tr><td>".$row['Emp_id']."</td><td>".$row['name']."</td><td>".$row['TP_mob']."</td><td>".$row['Address']."</td><td>".$row['Email']."</td><td><a href='employee.php?edit=".$row['Emp_id']."'>View</a></td></tr>";  //$row['index'] the index here is a field name
						}
						echo "</table>"; //Close the table in HTML
						connection_close(); //Make sure to close out the database connection
					?>
                    </div>
                </div>
                <?php } else {
                    ?>
                    <h1>You Do Not Have Permissions To This Page...!</h1>
                    <?php
                } ?>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>
</body></html>