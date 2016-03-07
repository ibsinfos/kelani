<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kelani | Lecturer Payment</title>
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

	$(document).ready(function(e) {
					
		$('#cmbSubject').change(function(e){
			GetNoofStudent();
		});

		function GetNoofStudent(){
			var SubjectCource  = document.getElementById("cmbSubject").value;
			var DDate = document.getElementById("dtpDate").value;
            //alert(SubjectCource);
				$.ajax({
					type:'POST',
					url:"GetNoofStudents.php",
					dataType:"json",
					data:{subjectID:SubjectCource, dtDate:DDate},
					success: function(data){
					var i = 0;
					var text = "";		
					document.getElementById("txtxPresentStudents").value ="0";
					document.getElementById("txtSubjectAmount").value = "0.00";			
					while(data.length > 0){

						document.getElementById("txtxPresentStudents").value = data[i]['sCount'];
						document.getElementById("txtSubjectAmount").value = data[i]['price'];
						i++;
						$("#txtCommissionPercentage").focus();
						if(i == data.length){
							break;
						}						
					}					
				}
			});
		}		
	});
	
	function comm(){
		
		var studentx = Number(document.getElementById('txtxPresentStudents').value);
		var subjectpricex = Number(document.getElementById('txtSubjectAmount').value);
		var amountx = studentx*subjectpricex;
		
		var commitionx = Number(document.getElementById('txtCommissionPercentage').value);

		var salaryx = (amountx*commitionx)/100;
			document.getElementById('txtSalary').value = salaryx;
	}
	
	function paymentx(){
		var salaryxx = Number(document.getElementById('txtSalary').value);
		var allowancex = Number(document.getElementById('txtAllowance').value);
		var total = salaryxx + allowancex;
			document.getElementById('txtTotal').value = total;
		var tempAmount = Number(document.getElementById('v_txtExistingTempAmount').value);
		var newAmount = tempAmount - allowancex;
			document.getElementById('v_txtTempAmount').value = newAmount;
	}
	
</script>
</head>
<body>
<?php
include_once './inc/top.php';
include_once 'dbconfig.php';

$query = "SELECT amount FROM tempamount_tbl";
$result = getData($query);
$amount = '0';
if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while ($row = mysqli_fetch_assoc($result)) {
		$amount=$row['amount'];
	}
}
else{
	$amount = '0';	
}

?>
    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Lecturer Payment
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Lecturer Payment
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
                
                <form method="post" action="controller/lecture_paymentsController.php" target="_parent" data-toggle="validator" id="lecpay">                
                <div class="frmbase row">
                    <div class="col-lg-4">
                    <label class="">Date</label>&nbsp;<label for="date" id="dtDate"><?php echo date("Y/m/d") ; ?></label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="">Time</label>&nbsp;<label for="time"><?php date_default_timezone_set("Asia/Colombo");
                    echo $today = date("H:i:s");?></label><br/>
                    <input type="hidden" name="dtpdate" value="<?php echo date('Y-m-d'); ?>"/>
                	</div>
                </div>
                
                <div class="row">
                    <div class="col-lg-4">
                        <label>Date</label><br />
                        <input type="date" name="dtpDate" size="50" required id="dtpDate" data-date-format="DD/MM/YYYY"/><br/>
                    </div>
                    <div class="col-lg-4">
                        <label>Subject</label><br/>
                            <select name="cmbSubject" id="cmbSubject">
                                <option value='0'>        --Select Subject--</option>
                                <?php
                                include_once 'dbconfig.php';
                                $query = 'SELECT sc.AcadamicYear_id, ay.`year`, sc.Course_tbl_id, c.`Name` AS cname, sc.Part_table_id, p.`name` AS pname, sc.Subject_tbl_id, s.subjectname
FROM subject_course_tbl sc, acadamicyear ay , course_tbl c, part_tbl p, subject_tbl s
WHERE sc.AcadamicYear_id = ay.id AND sc.Course_tbl_id=c.id AND sc.Part_table_id=p.id AND sc.Subject_tbl_id=s.id';
                                $result = getData($query);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='".$row['Course_tbl_id']."-".$row['Part_table_id']."-".$row['Subject_tbl_id']."-".$row['year']."-".$row['AcadamicYear_id']."'>".$row['year']." ".$row['cname']." ".$row['pname']." ".$row['subjectname']."</option>";
                                    }
                                }
                                ?>
                            </select><br />
                        
                    </div>
                    <div class="col-lg-4">
                        <label>Lecturer</label><br/>
                            <select name="cmbLecturer">
                                <option value='0'>        --Select Lecturer--</option>
                                <?php
                                include_once 'dbconfig.php';
                                $query = "SELECT * FROM employee_tb WHERE Designation_tbl_id = '2'";
                                $result = getData($query);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='".$row['Emp_id']."'>".$row['Name']."</option>";
                                    }
                                }
                                ?>
                            </select><br />
                            <input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        
                        <table width="100%" class="paymenttable">
                            <tr>
                                <td width="75%">Student Count</td>
                                <td  width="25%" align="right"><input type="text" name="txtxPresentStudents" value="0" size="10" readonly id="txtxPresentStudents"/><label>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                            </tr>
                            <tr>
                                <td>Subject Amount</td>
                                <td align="right"><input type="text" name="txtSubjectAmount" size="10" value="0.00" readonly id="txtSubjectAmount"/><label>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                            </tr>
                            <tr>
                                <td>Commission Percentage</td>
                                <td align="right"><input type="text" name="txtCommissionPercentage" size="5" required id="txtCommissionPercentage" onKeyUp="comm()"/><label>&nbsp;%</label></td>
                            </tr>
                            <tr style="font-weight:bold;">
                                <td>SALARY</td>
                                <td align="right"><input type="text"  style="font-weight:bold;" name="txtSalary" id="txtSalary" size="10" value="0.00" readonly/><label>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                            </tr>
                            <tr>
                                <td>Allowance / Deduction</td>
                                <td align="right"><input type="text" name="txtAllowance" id="txtAllowance" size="10" value="0.00" onKeyUp="paymentx()"/><label>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                            </tr>
                            <tr style="font-weight:bold;">
                                <td>TOTAL SALARY</td>
                                <td align="right"><input type="text"  style="font-weight:bold;" name="txtTotal" id="txtTotal" size="10" value="0.00" readonly/><label>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6">
                       <table width="100%" class="paymenttable">
                            <tr id="lecture_amount">
<!--                                <td>Existing Amount</td>-->
<!--                                <td align="right"><input type="text" id="v_txtExistingTempAmount" value="--><?php //echo $amount; ?><!--" name="v_txtExistingTempAmount" size="5" readonly/><label>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>-->
                                <?php include './lecture_exsisting_amount.php'?>
                            </tr>
                            <tr>
                                <td>New Temp Amount</td>
                                <td align="right"><input type="text" id="v_txtTempAmount" value="0.00" name="v_txtTempAmount" size="5" readonly/><label>&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                            </tr>
                        </table>
                        
                    </div>
                </div>
                <!-- /.row -->
                <div class="row" style="padding-left: 15px;">
                    <div class="row">
                        <div class="col-lg-12">
                    <?php if ($permissions[0]['W']) { ?>
                        <input name="btnAdd" type="submit" value="Add" class="btn btn-primary"/>
                    <?php } else {
                        ?>
                        <input name="btnAdd" type="submit" value="Add" class="btn btn-primary" disabled/>
                        <?php
                    }?>
                    <input name="btnClear" type="reset" value="Clear" class="btn-default btn"/>
                    </div>
                    <div id='msg'></div>
                    </div>
                </div>
                <!-- /.row -->
                </form>
                <?php } else {
                    ?>
                    <h1>You Do Not Have Permissions To This Page...!</h1>
                    <?php
                } ?>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>

<script type="text/javascript">
    $('document').ready(function () {
        $("#lecpay").validate({
            submitHandler: submitForm
        });
        function submitForm() {
            var data = $("#lecpay").serialize();
            $.ajax({
                type: 'POST',
                url: 'controller/lecture_paymentsController.php',
                data: data,
                beforeSend: function () {
                    $("#msg").fadeOut();
                },
                success: function (response) {
                    console.log(response);
                    if (response) {
                        $("lecture_amount").load('./lecture_exsisting_amount.php');
                        $("#msg").fadeIn(function () {
                            $("#msg").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Successfully Inserted...!</div>');
                        });
                        $('#msg').fadeOut(4000);
                        $("#lecpay").reset();
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