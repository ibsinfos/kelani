<!DOCTYPE html>
<html style="margin-top: 0px !important;" lang="fr-FR" prefix="og: http://ogp.me/ns#" class=" js csstransforms3d no-touch" ng-app="validation">

<head>
    <title>Kelani</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">







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
    
<!-- Constant links START -->
<!--<script src="configuration/constant_links.js"></script>-->
<!-- Constant links END -->    
    <!-- Sign in start -->
    <script src="js/jquery.js"></script>
<script type="text/javascript">


 	function signinuser(){
		
 	var uname=document.getElementById("username").value;
 	var pword=document.getElementById("password").value;
	
 	$.ajax({
      type: "POST",
      url: "controller/home_signin.php" ,
      dataType: "json",
      data: {user: uname,upassword: pword},
      success:function(res) {
		  
          var cou=res.count;
			if(cou==1){
				//alert (cou);
				window.location ="index.php";
			}else{	
				//alert (cou);
				//document.getElementById("errortext").innerHTML="Please enter correct username and password";
				
			}	
     }
       /*error: function(res){
     alert('Error Message: '+res);
}*/
    });
 							 }
	</script>   
</head>

<body>

    <div id="">
        <div id="">

            <div class="">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    	
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-6">
                        &nbsp;
                    </div>
                    <div class="col-lg-3" style="background-color:#FFF;	">
                        <h2 class="page-header">
                           Kelani Institute Management System
                        </h2>
                        <h3 class="page-header">
                           LOGIN
                        </h3>
                        <form name="frmregister" action="<?php /*?><?= $_SERVER['PHP_SELF'] ?><?php */?>" method="post" >
                        
                        </label>USERNAME</label><br>
                        <input type="text" name="username" id="username"><br>
                        
                        <label>PASSWORD</label><br>
                        <input type="password" name="password" id="password"><br>
                        <div id="errortext" class="signin_validation">www</div>
                        <input type="submit" value="LOGIN" onclick="signinuser()" >
                        <input type="reset" value="RESET">
                        
                        
                        </form>
                    </div>
                    <div class="col-lg-3">
	                   
                       
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

</body>
</html>