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
        $('#dtpToDate').change(function(e){
			var FromDate  = document.getElementById("dtpFromDate").value;
			var ToDate  = document.getElementById("dtpToDate").value;
			$.ajax({
				type:'POST',
				url:"GetIncomAndExpenses.php",
				dataType:"json",
				data:{dtFromDate:FromDate, dtToDate:ToDate},
				success: function(data){
					var i = 0;
					var text = "<table width='94%'>";
					text = text.concat("<tr><th>Date</th><th>Description</th><th style='text-align:right'>Income</th><th style='text-align:right'>Expense</th></tr>");
					while(data.length > 0){
					
						text=text.concat("<tr><td>",data[i]['dDate'],"</td><td>",data[i]['dDescription'],"</td><td style='text-align:right'>",data[i]['dIncome'], "</td><td style='text-align:right'>",data[i]['dExpense'] ,"</td></tr>");
						
						i++;
						if(i == data.length){
							break;
						}
					}
					text=text.concat("<tr><td>&nbsp;</td><td>&nbsp;</td><td style='text-align:right'>&nbsp;</td><td style='text-align:right'>&nbsp;</td></tr>");
					text=text.concat("<tr><td>&nbsp;</td><td><b>Total</td><td style='text-align:right'><b>",data[data.length - 1]['totalIncome'], "</td><td style='text-align:right'><b>",data[data.length - 1]['totalExpense'] ,"</td></tr>");
					text=text.concat("<tr><td>&nbsp;</td><td><b>Total Profit</td><td style='text-align:right'></td><td style='text-align:right'><b>",data[data.length - 1]['totalProfit'] ,"</td></tr>");
					text = text.concat("</table>");		
					document.getElementById("pnl").innerHTML = text;
				}
			});
		});						
    }); 
	
	$(document).ready(function(e) {
        $('#dtpFromDate').change(function(e){
			var FromDate  = document.getElementById("dtpFromDate").value;
			var ToDate  = document.getElementById("dtpToDate").value;
			$.ajax({
				type:'POST',
				url:"GetIncomAndExpenses.php",
				dataType:"json",
				data:{dtFromDate:FromDate, dtToDate:ToDate},
				success: function(data){
					var i = 0;
					var text = "<table width='94%'>";
					text = text.concat("<tr><th>Date</th><th>Description</th><th style='text-align:right'>Income</th><th style='text-align:right'>Expense</th></tr>");
					while(data.length > 0){
					
						text=text.concat("<tr><td>",data[i]['dDate'],"</td><td>",data[i]['dDescription'],"</td><td style='text-align:right'>",data[i]['dIncome'], "</td><td style='text-align:right'>",data[i]['dExpense'] ,"</td></tr>");
						
						i++;
						if(i == data.length){
							break;
						}
					}
					text=text.concat("<tr><td>&nbsp;</td><td>&nbsp;</td><td style='text-align:right'>&nbsp;</td><td style='text-align:right'>&nbsp;</td></tr>");
					text=text.concat("<tr><td>&nbsp;</td><td><b>Total</td><td style='text-align:right'><b>",data[data.length - 1]['totalIncome'], "</td><td style='text-align:right'><b>",data[data.length - 1]['totalExpense'] ,"</td></tr>");
					text=text.concat("<tr><td>&nbsp;</td><td><b>Total Profit</td><td style='text-align:right'></td><td style='text-align:right'><b>",data[data.length - 1]['totalProfit'] ,"</td></tr>");
					text = text.concat("</table>");		
					document.getElementById("pnl").innerHTML = text;
				}
			});
		});						
    }); 
	</script>
	</head>
	<body>
<?php
include_once './inc/top.php';
include_once 'dbconfig.php'; 
?>
<div id="wrapper">
      <div id="page-wrapper">
    <div class="container-fluid"> 
          
          <!-- Page Heading -->
          <div class="row">
        <div class="col-lg-12">
              <h1 class="page-header"> Profit & Lost </h1>
              <ol class="breadcrumb">
            <li> <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a> </li>
            <li class="active"> <i class="fa fa-bar-chart-o"></i> Profit & Lost </li>
          </ol>
            </div>
      </div>
          <!-- /.row -->
          
          <form method="post" name="spform" id="spform" action="controller/pnlController.php" data-toggle="validator">
        <div class="row">
          <div class="col-lg-4">
            <label>From Date</label>	
            <br/>
            <input type="date" name="dtpFromDate" size="50" required id="dtpFromDate" data-date-format="DD/MM/YYYY"/>
            <br/>
          </div>
              <div class="col-lg-4">
            <label>To Date</label>
            <br/>
            <input type="date" name="dtpToDate" size="50" required id="dtpToDate" data-date-format="DD/MM/YYYY"/>
            <br/>
          </div>
          <div class="col-lg-4">
            <table>
            <tr>
            <td>DATE</td>
            <td><?php echo date("Y/m/d"); ?></td>
            </tr>
            <tr>
            <td>TIME</td>
            <td><?php date_default_timezone_set("Asia/Colombo"); echo $today = date("H:i:s");?></td>
            </tr>
            </table>
            <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="dtpDate">
            <input type="hidden" value="<?php date_default_timezone_set('Asia/Colombo'); echo $today = date('H:i:s');?>" name="dtpTime">
            <br/>
        </div>
        </div>
        
        <div class="row">
              <div id="pnl" class="col-lg-8">
              
              </div>
              
             
              
              <div class="col-lg-4"> &nbsp; </div>
        </div>
        <!-- /.row -->
        
        <div class="row">
              <div class="col-lg-8" align="right">
          </div>
            </div>
        <div class="row">
        <div id="Subject" class="col-lg-8">
            <!--Load Subjects--> 
        
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