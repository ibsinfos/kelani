<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Kelani | Student Payment</title>
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
	
	function printpanel(){
		var pnl = document.getElementById("invoice");
		var pntwindow = window.open('','','Height=\"auto\",width=\"300px\"');
		pntwindow.document.write("<html><head>");
		pntwindow.document.write("<title>INVOICE</title><head>");
		pntwindow.document.write("<body>");
		pntwindow.document.write(pnl.innerHTML);
		pntwindow.document.write("</body>");
		pntwindow.document.write("</html>");
		pntwindow.document.close();
		setTimeout(function(){
			pntwindow.print();
		},200);
			
		return true;
	}
	$(document).ready(function(e) {
		$("#txtStudentID").focus();
        $(document.stupay.txtStudentID).keyup(function(e){
			if(document.stupay.txtStudentID.value.length == 10 || document.stupay.txtStudentID.value.length == 6){
			//if(e.which == 13){
				var Studentid  = document.getElementById("txtStudentID").value;
				$.ajax({
					type:'POST',
					url:"paymentLoadScript.php",
					dataType:"json",
					data:{studentid:Studentid},
					success: function(data){
					var i = 0;
					var text = "<table width='94%'>";
					text = text.concat("<tr><th>YEAR</th><th>PART</th><th>SUBJECT</th><th>PRICE</th></tr>");
					while(data.length > 0){
						
						text=text.concat("<tr><td>",data[i]['year'],"</td><td>",data[i]['part'],"</td><td>",data[i]['subject'], "</td><td style='text-align:right'>",data[i]['price'] ,"</td></tr>");
						document.getElementById("txtTotal").value = data[i]['total'];
							document.getElementById("txtTotal_p").innerHTML = data[i]['total'];
						document.getElementById("txtName").value = data[i]['name'];
							document.getElementById("txtName_p").innerHTML = data[i]['name'];
						i++;
						if(i == data.length){
							break;
						}
					}
					text = text.concat("</table>");		
					document.getElementById("SubjectPrice").innerHTML = text;
					document.getElementById("Subjectpnt").innerHTML = text;
											
					$("#txtSettel").focus();
					discount();	
					Subjectload();
					}
				});
			}
			});						
    }); 
        function Subjectload(){

			var Studentid  = document.getElementById("txtStudentID").value;
				$.ajax({
					type:'POST',
					url:"paymentLoadScript.php",
					dataType:"json",
					data:{studentid:Studentid},
					success: function(data){
					var i = 0;
					var text = "";					
					while(data.length > 0){
						
						text=text.concat("<input type='hidden' value='",data[i]['id'],"-",data[i]['price'], "' name='cbSubject[]'>");
						i++;
						if(i == data.length){
							break;
						}
					}
					document.getElementById("Subject").innerHTML = text;
					}
				});
		}		
		function discount(){	
			var total = Number(document.getElementById('txtTotal').value);
			var discount = Number(document.getElementById('txtDiscount').value);
			var subTotal = total-discount;
			document.getElementById('txtSubTotal').value = subTotal;
				document.getElementById('txtSubTotal_p').innerHTML = subTotal;
				var discountp = document.getElementById('txtDiscount_p').innerHTML = discount;
        }
		
		function settle(){
        	var settleval = Number(document.getElementById('txtSettel').value);
			var subTotal = Number(document.getElementById('txtSubTotal').value);
			var balance = settleval - subTotal;
			document.getElementById('txtBalance').value = balance;
				document.getElementById('txtBalance_p').innerHTML= balance;
				
			var studentid = document.getElementById('txtStudentID').value;
			document.getElementById('txtStudentID_p').innerHTML= studentid;
			
			var due = document.getElementById('txtBalance').value;
				var due = document.getElementById('txtBalance_p').innerHTML;
				var settlep = document.getElementById('txtSettel_p').innerHTML = settleval;
			
			if(subTotal>settleval){
			var dueamount = due * (-1);
			var dueamounttotal = dueamount;
			document.getElementById('txtDue').value = dueamounttotal;
				document.getElementById('txtDue_p').innerHTML= dueamounttotal;			
			}
			else{
			var dueamount = due * (0);
			var dueamounttotal = dueamount;
			document.getElementById('txtDue').value = dueamounttotal;
				document.getElementById('txtDue_p').innerHTML= dueamounttotal;
				}		
        }	
		
	</script>
	</head>
	<body>
<?php
include_once './inc/top.php';
include_once 'dbconfig.php'; 
	$con = connection();

	$query = "SELECT LPAD(RIGHT(IFNULL(MAX(InvoiceNo),0),6)+1,7,'0') AS InvoiceNo FROM payment_tbl;";
	$result= $con->query($query);
	//echo $query;
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while ($row = mysqli_fetch_assoc($result)) {
					if($row['InvoiceNo'] == null || $row['InvoiceNo'] == ""){
						$invoiceno = 'INV0000001';
					}
					else{
						$invoiceno = 'INV'.$row['InvoiceNo'];
					}
			}
	}
	
?>
<div id="wrapper">
      <div id="page-wrapper">
    <div class="container-fluid"> 
          
          <!-- Page Heading -->
          <div class="row">
        <div class="col-lg-12">
              <h1 class="page-header"> Student Payment </h1>
              <ol class="breadcrumb">
            <li> <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> <i class="fa fa-bar-chart-o"></i> Student Payment </li>
          </ol>
            </div>
      </div>
          <!-- /.row -->

		<?php
		require_once("./config.php");
		$stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'alsubj'");
		$stmt->execute();
		$permissions = $stmt->fetchAll();
		?>
		<?php if($permissions[0]['R']){?>
          <form method="post" name="stupay" id="stupay" action="controller/studentPaymentController.php" data-toggle="validator">
        <div class="row">
              <div class="col-lg-4">
            <label>Student ID</label>
            <br />
            <input type="text" name="txtStudentID" id="txtStudentID" size="50"/>
            <br/>
          </div>
              <div class="col-lg-4">
            <label>Name</label>
            <br/>
            <input type="text" name="txtName" id="txtName" disabled="disabled"/>
            <br/>
          </div>
              <div class="col-lg-4">
            <table>
                  <tr>
                <td>INVOICE NO&nbsp;&nbsp;</td>
                <td><?php echo $invoiceno; ?></td>
              </tr>
                  <tr>
                <td>DATE</td>
                <td><?php echo date("Y/m/d"); ?></td>
              </tr>
                  <tr>
                <td>TIME</td>
                <td><?php date_default_timezone_set("Asia/Colombo"); echo $today = date("H:i:s");?></td>
              </tr>
            </table>
            <input type="hidden" id="invoiceno" class="invoiceno" name="invoiceno" value="<?php echo $invoiceno; ?>"/>
            <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="dtpDate">
            <input type="hidden" value="<?php date_default_timezone_set('Asia/Colombo'); echo $today = date('H:i:s');?>" name="dtpTime">
            <input type="hidden" value="<?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?>" name="ssUser">
            <br/>
          </div>
            </div>
        <div class="row">
              <div id="SubjectPrice" class="col-lg-8"> </div>
              <div class="col-lg-4"> &nbsp; </div>
            </div>
        <!-- /.row -->
        
        <div class="row">
              <div class="col-lg-8" align="right">
            <table class="blanktable" style="margin-right: 50px;">
                  <tr>
                <td><label>TOTAL</label></td>
                <td align="right"><input id="txtTotal" type="text" name="txtTotal" placeholder="0.00" readonly/></td>
              </tr>
                  <tr>
                <td><label>Discount&nbsp;</label></td>
                <td align="right"><input id="txtDiscount" type="text" name="txtDiscount" placeholder="0.00" onKeyUp="discount()" value="0.00"/></td>
              </tr>
                  <tr>
                <td><label>Sub Total&nbsp;</label></td>
                <td align="right"><input id="txtSubTotal" type="text" name="txtSubTotal" placeholder="0.00" readonly/></td>
              </tr>
                  <tr>
                <td><label>Settel</label></td>
                <td align="right"><input id="txtSettel" type="text" name="txtSettel" placeholder="0.00" onKeyUp="settle()"/></td>
              </tr>
                  <tr>
                <td><label>Balance</label></td>
                <td align="right"><input id="txtBalance" type="text" name="txtBalance" placeholder="0.00" readonly/></td>
              </tr>
                </table>
            <input type="hidden" id="txtDue" name="txtDue" placeholder="0.00"/>
				  <?php if($permissions[0]['W']){?>
					  <input type="submit" name="btnAdd" onClick="return printpanel()" class="btn btn-primary">
				  <?php } else {
					  ?>
					  <input type="submit" name="btnAdd" onClick="return printpanel()" class="btn btn-primary" disabled>
					  <?php
				  } ?>
            <input type="reset" class="btn btn-default">
          </div>
            </div>
			
    <div class="row">
            <div id="Subject" class="col-lg-8">
                    <input type="hidden" name="cbSubjectPrice" value=""/>
                    <!--Load Subjects-->
                    </div>                   
		<div id="invoice" class="col-lg-4" style="display:none;">
            <table style="font-family:calibri">
                <tr>
					<td align="center" colspan="2"><b>Kelani Institute of Higher Education</b><br>
						  No 216/3, Kandy Road,<br>
						  Dhalugama,<br>
						  Kelaniya.<br>
						  0112987743<br>
						  0112987745<br>
						  info@kelani.lk<br>
						  <hr>
					</td>
				</tr>
                  
                  <!--***************************-->
                <tr>
					<td>INVOICE NO&nbsp;</td>
					<td align="right"><?php echo $invoiceno; ?></td>
				</tr>
                <tr>
					<td>DATE&nbsp;</td>
					<td align="right"><?php echo date("Y/m/d"); ?></td>
				</tr>
				<tr>
					<td>TIME&nbsp;</td>
					<td align="right"><?php date_default_timezone_set("Asia/Colombo"); echo $today = date("H:i:s");?></td>
				</tr>
                <tr>
					<td>STUDENT NAME</td>
					<td align="right"><label id="txtName_p"></label></td>
				</tr>
                <tr>
					<td>STUDENT ID</td>
					<td align="right"><label id="txtStudentID_p"></label></td>
				</tr>
                  <!--***************************-->
				<tr>
					<td colspan="2">
                    <hr>
                    </td>
                </tr>
                
				<tr>
					<td colspan="2"><div id="Subjectpnt"> </div></td>
				</tr>
                  
                  <!--************************-->
				<tr>
					<td colspan="2">
                    <hr>
                    </td>
                </tr>    
                <tr>
					<td><label><b>TOTAL</b></label></td>
                    <td align="right"><label id="txtTotal_p" name="txtTotal" style="font-weight:bold">0000.00</label></td>
				</tr>
                <tr>
					<td><label>Discount</label></td>
                    <td align="right"><label id="txtDiscount_p" name="txtDiscount">0000.00</label></td>
				</tr>
				<tr>
					<td><label>Sub Total</label></td>
                    <td align="right"><label id="txtSubTotal_p" name="txtSubTotal">0000.00</label></td>
				</tr>
                <tr>
					<td><label>Settel</label></td>
                    <td align="right"><label id="txtSettel_p" name="txtSettel">0000.00</label></td>
				</tr>
                <tr>
					<td><label>Balance</label></td>
                    <td align="right"><label id="txtBalance_p" name="txtBalance">0000.00</label></td>
				</tr>
                <tr>
					<td><label>Due Amount</label></td>
                    <td align="right"><label id="txtDue_p" name="txtDue">0000.00</label></td>
				</tr>  
                <!--************************-->
                  
                <tr>
					<td align="center" colspan="2">
					 <hr>
                    THANK YOU<br>
					Powered by PRO IT SOLUTIONS<br>
					0114387900<br>

					</td>
				</tr>
            </table>
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
</body>
</html>