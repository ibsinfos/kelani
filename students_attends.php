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
	<script src="js/jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function(e) {
		$("#txtStudentID").focus();
        $(document.stuatt.txtStudentID).keyup(function(e){
			if(document.stuatt.txtStudentID.value.length == 10 || document.stuatt.txtStudentID.value.length == 6){
			//if(e.which == 13){
				var Studentid  = document.getElementById("txtStudentID").value;
				//var Studentidv  = document.getElementById("txtStudentID").value; 
				$.ajax({
					type:'POST',
					url:"attendsLoadScript.php",
					dataType:"json",
					data:{studentid:Studentid},
					success: function(data){
					var i = 0;
					var text = "<table width='94%'>";
					text = text.concat("<tr><th>SUBJECT</th></tr>");
					while(data.length > 0){
						
						text=text.concat("<tr><td>",data[i]['subject'], "</td></tr>");
						document.getElementById("txtstudentName").value = data[i]['name'];
						i++;
						if(i == data.length){
							break;
						}
					}
					text = text.concat("</table>");
					document.getElementById("SubjectID").innerHTML = text;
					ViewStudentAttendence();
					ViewStudentPay();
					}					
				});
			}
		});
    });
	
	function ViewStudentAttendence(){	
		var Studentid  = document.getElementById("txtStudentID").value;

			$.ajax({
					type:'POST',
					url:"attendsLoadStudent.php",
					dataType:"json",
					data:{studentid:Studentid},
					success: function(data){	
					var i = 0;
					var text = "<table width='94%'>";
					text = text.concat("<tr><th>DATE</th><th>TIME</th></tr>");
					while(data.length > 0){
						
						text=text.concat("<tr><td>",data[i]['date'],"</td><td>",data[i]['time'],"</td></tr>");
						
						i++;
						if(i == data.length){
							break;
						}
						}
						text = text.concat("</table>");
						document.getElementById("Attends").innerHTML = text;
					}					
				});
        }
		
		function ViewStudentPay(){	
		var Studentid  = document.getElementById("txtStudentID").value;

			$.ajax({
					type:'POST',
					url:"attendsLoadStudent.php",
					dataType:"json",
					data:{stid:Studentid},
					success: function(data){	
					var i = 0;
					var text = "<table width='94%'>";
					while(data.length > 0){
						
						text=text.concat("<tr><td>",data[i]['paid'],"</td></tr>");
						
						i++;
						if(i == data.length){
							break;
						}
						}
						text = text.concat("</table>");
						document.getElementById("PayStudent").innerHTML = text;
					}					
				});
        }
	</script>
	</head>
	<body>
<?php
include_once './inc/top.php';
?>
<script type="text/javascript">
		function dateTimeShow() {
		document.getElementById('datetimeshow').value= Date();
		}
	</script>
<div id="wrapper">
      <div id="page-wrapper">
    <div class="container-fluid"> 
          
          <!-- Page Heading -->
          <div class="row">
        <div class="col-lg-12">
              <h1 class="page-header"> Student Attendance </h1>
              <ol class="breadcrumb">
            <li> <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> <i class="fa fa-fw fa-barcode"></i></i> Student Attends </li>
          </ol>
            </div>
      </div>
          <!-- /.row -->
          
          <form method="post" id="stuatt" name="stuatt" action="controller/students_attendsController.php">
        <div class="row">
              <div class="col-lg-4">
            <label>Student ID</label>
            <br/>
            <input type="text" id="txtStudentID" name="txtStudentID" size="50" onClick="dateTimeShow"/>
            <br/>
            <label>Name</label>
            <br/>
            <input type="text" id="txtstudentName" name="txtstudentName" size="50" readonly/>
            <br/>
             <div id="SubjectID" class="col-lg-8"> </div>
            <!--<table width="100%">
                  <tr>
                <th>SUBJECTS</th>
              </tr>
                  <tr>
                <td>&nbsp;</td>
              </tr>
                </table>-->
          </div>
              <div class="col-lg-4" id="Attends">
            <label>Attendance  History</label>
            <br/>
           
          </div>
              <div class="col-lg-4">
            <table>
              <tr>
                <td>DATE&nbsp;</td>
                <td align="right"><?php echo date("Y-m-d"); ?></td>
              </tr>
              <tr>
                <td>TIME&nbsp;</td>
                <td align="right"><?php date_default_timezone_set("Asia/Colombo"); echo $today = date("H:i:s");?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
				<td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
				<td></td>
              </tr>
            </table>
            	<div class="col-lg-4" id="PayStudent">
              	</div> 
            <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="dtpDate">
            <input type="hidden" value="<?php date_default_timezone_set('Asia/Colombo'); echo $today = date('H:i:s');?>" name="dtpTime">
            <input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">
          </div>
            </div>
        <!-- /.row -->
        
        <div class="row" style="padding-left: 15px;">
              <input type="submit" value="Add" name="btnAdd" />
              <input type="reset" value="Clear"  name="btnClear"/>
            </div>
        <!-- /.row -->
      </form>
        </div>
    <!-- /.container-fluid --> 
    
  </div>
      <!-- /#page-wrapper --> 
      
    </div>
<!-- /#wrapper -->
<?php include_once './inc/footer.php'; ?>
</body>
</html>