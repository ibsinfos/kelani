<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Kelani | Course Process</title>
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
<script src="js/jquery.js"></script>
<script type="text/javascript">		
	
</script>

</head>
<body>
<?php
include_once './inc/top.php';
include_once 'dbconfig.php'; //Connect to database

if(isset($_GET['acadamicyear'])){
	 $acadamicyear = trim($_GET['acadamicyear']);
	 $course = trim($_GET['course']);
	 $part = trim($_GET['part']);
	 $query = "SELECT AcadamicYear_id,Course_tbl_id,Part_tbl_id,cp.StartDate,cp.EndDate FROM courseprocess cp INNER JOIN acadamicyear a ON cp.AcadamicYear_id=a.id INNER JOIN course_tbl c ON cp.Course_tbl_id=c.id INNER JOIN part_tbl p ON cp.Part_tbl_id=p.id WHERE a.`year`='".$acadamicyear."' AND c.`Name` = '".$course."' AND p.`name` = '".$part."'";
	 $result = getData($query);
	if (mysqli_num_rows($result) > 0) {
		 while ($row = mysqli_fetch_assoc($result)) {
			 $StartDate = $row['StartDate'];
			 $EndDate = $row['EndDate'];
			 $acadamicyear = $row['AcadamicYear_id'];
			 $course = $row['Course_tbl_id'];
			 $part = $row['Part_tbl_id'];
			 $btnStatus = 'enabled';
			 $btnAddStatus = 'disabled';
		 }
	 }
	else{
		 $acadamicyear = '';
		 $course = '';
		 $part = '';
		 $StartDate = '';
		 $EndDate = '';
		 $btnStatus = 'disabled';
		 $btnAddStatus = 'enabled';
	}
}
else{
	 $acadamicyear = '';
	 $course = '';
	 $part = '';
	 $StartDate = '';
	 $EndDate = '';
	 $btnStatus = 'disabled';
	 $btnAddStatus = 'enabled';
}
?>
<div id="wrapper">
  <div id="page-wrapper">
    <div class="container-fluid"> 
      
      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header"> Course Process </h1>
          <ol class="breadcrumb">
            <li> <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> <i class="fa fa-bar-chart-o"></i> Course Process </li>
          </ol>
        </div>
      </div>
      <!-- /.row --><?php
		require_once("./config.php");
		$stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'coupro'");
		$stmt->execute();
		$permissions = $stmt->fetchAll();
		if ($permissions[0]['R']) {
		?>
      <form method="post" action="controller/courseProcessController.php" data-toggle="validator" id="coupro">
        <div class="row">
          <div class="col-lg-4"> 
            <!--acadamic year-->
			<div class="form-group">
            <label class="control-label col-md-4">Acadamic Year</label>
            <input type="hidden" name="cmbAcadamicYear_"  value="<?php echo $acadamicyear; ?>" size="40"/>
            <select class="form-control col-md-8" id="cmbAcadamicYear" name="cmbAcadamicYear" <?php echo $btnAddStatus; ?>>
              <?php
							include_once 'dbconfig.php';
							$query = 'SELECT * FROM acadamicyear';
							$result = getData($query);
							if (mysqli_num_rows($result) > 0) {
								// output data of each row
								echo "<option value='0'> -- Select Acadamic Year -- </option>";
								while ($row = mysqli_fetch_assoc($result)) {
									$selected = $row['id'] == $acadamicyear ? 'selected' : '';
									echo "<option ". $selected ." value='".$row['id']."'>".$row['year']."</option>";
								}
							}
							?>
            </select>
			</div>
            <!--select course-->
			<div class="form-group">
			<label class="control-label col-md-4">Course</label>
            <br/>
            <input type="hidden" name="cmbCourse_"  value="<?php echo $course; ?>" size="40"/>
            <select class="form-control col-md-8" id="cmbCourse" name="cmbCourse" <?php echo $btnAddStatus; ?>>
              	<?php
							include_once 'dbconfig.php';
							$query = 'SELECT * FROM course_tbl;';
							$result = getData($query);
							if (mysqli_num_rows($result) > 0) {
								// output data of each row
								echo "<option value='0'> -- Select Course -- </option>";
								while ($row = mysqli_fetch_assoc($result)) {
									$selected = $row['id'] == $course ? 'selected' : '';
									echo "<option ". $selected ." value='".$row['id']."'>".$row['Name']."</option>";
								}
							}
				?>
            </select>
			</div>
            <!--load part-->
			<div class="form-group">
			<label class="control-label col-md-4">Part</label>
            <br/>
            <input type="hidden" name="cmbPart_"  value="<?php echo $part; ?>" size="40"/>
            <select class="form-control col-md-8" id="cmbPart" name="cmbPart" <?php echo $btnAddStatus; ?>>
              <?php
							include_once 'dbconfig.php';
							$query = 'SELECT * FROM part_tbl';
							$result = getData($query);
							if (mysqli_num_rows($result) > 0) {
								// output data of each row
								echo "<option value='0'> -- Select Part -- </option>";
								while ($row = mysqli_fetch_assoc($result)) {
									$selected = $row['id'] == $part ? 'selected' : '';
									echo "<option ". $selected ." value='".$row['id']."'>".$row['name']."</option>";
								}
							}
							?>
            </select>
            </div>
			<div class="form-group">
            <label class="control-label col-md-4">Start Date</label>
            <input class="form-control col-md-8" type="date" name="dtpStartDate" size="50" value="<?php echo $StartDate; ?>"/>
			</div>

			<div class="form-group">
            <label class="control-label col-md-4">End Date</label>
            <input class="form-control col-md-8" type="date" name="dtpEndDate" size="50" value="<?php echo $EndDate; ?>"/>
			<input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">
			</div>
			  <div class="row">
				  <div class="col-lg-12">
					  <?php if ($permissions[0]['W']) { ?>
						  <input name="btnAdd" type="submit" value="Add" class="btn btn-primary"<?php echo $btnAddStatus; ?>/>
						  <input name="btnUpdate" onclick="" type="submit" value="Update" <?php echo $btnStatus; ?>
								 class="btn btn-primary"/>
					  <?php } else {
						  ?>
						  <input name="btnAdd" type="submit" value="Add" class="btn btn-primary" <?php echo $btnAddStatus; ?> disabled/>
						  <input name="btnUpdate" onclick="" type="submit" value="Update" class="btn btn-primary" <?php echo $btnStatus; ?>
								 disabled/>
						  <?php
					  }
					  if ($permissions[0]['D']) {
						  ?>
						  <input name="btnDelete" type="submit" value="Delete" class="btn btn-danger" <?php echo $btnStatus; ?>/>
					  <?php } else {
						  ?>
						  <input name="btnDelete" type="submit" value="Delete" class="btn btn-danger" <?php echo $btnStatus; ?>/>
						  <?php
					  } ?>
					  <input name="btnClear" type="reset" value="Clear" class="btn btn-default"/>
				  </div>
				  <div id='msg'></div>
			  </div>
            <!-- /.row --> 
            
          </div>
          <div class="col-lg-8 selecttable" id="loadtbl">
			  <?php include './courseProcess_list.php'; ?>
          </div>
        </div>
        
        <!-- /.row -->
        
      </form>

		<?php } else {
			?>
			<h1>You Do Not Have Permissions To This Page...!</h1>
			<?php
		} ?>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          
        </div>
      </div>
      <!-- /.row --> 
      
    </div>
    <!-- /.container-fluid --> 
    
  </div>
  <!-- /#page-wrapper --> 
  
</div>
<!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>

<script type="text/javascript">
	$('document').ready(function () {
		$("#coupro").validate({
			submitHandler: submitForm
		});
		function submitForm() {
			var data = $("#coupro").serialize();
			$.ajax({
				type: 'POST',
				url: 'controller/courseProcessController.php',
				data: data,
				beforeSend: function () {
					$("#msg").fadeOut();
				},
				success: function (response) {
					console.log(response);
					if (response) {
						$("#msg").fadeIn(function () {
							$("#msg").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Successfully Inserted...!</div>');
						});
						$('#msg').fadeOut(4000);
						$('#loadtbl').load('courseProcess_list.php');
						$("#coupro")[0].reset();


					}
					else {
						$("#msg").fadeIn(1000, function () {
							$("#msg").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
						});
						$('#msg').fadeOut(4000);
					}
				}
			});
			return false;
		}
	});
</script>

</body>
</html>