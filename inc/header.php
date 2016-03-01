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


<script type="text/javascript">
	$(document).ready(function(e) {
		$('#cmbPart').click(function(e){
			Subjectload();
		});
		$('#cmbPart').change(function(e){
			Subjectload();
		});
		function Subjectload(){
			var e = document.getElementById("cmbAcadamicYear");
			var Year = e.options[e.selectedIndex].value;
			e = document.getElementById("cmbCourse");
			var Course = e.options[e.selectedIndex].value;
			e = document.getElementById("cmbPart");
			var Part = e.options[e.selectedIndex].value;
			$.ajax({
				type:'POST',
				url:"subjectLoadScript.php",
				data:{year:Year,course:Course,part:Part},
				success: function(data){
					document.getElementById("Subject").innerHTML = data;
				}
			});
		}
	});
	</script>
</head><body>
