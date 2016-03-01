<!DOCTYPE html>
<html style="margin-top: 0px !important;" lang="fr-FR" prefix="og: http://ogp.me/ns#"
      class=" js csstransforms3d no-touch" ng-app="validation">

<head>
    <?php include_once './inc/header.php'; ?>


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

                    <div id="error"></div>

                    <form id="login-form" name="login-form" method="post">

                        </label>USERNAME</label><br>
                        <input type="text" name="username" id="username"><br>

                        <label>PASSWORD</label><br>
                        <input type="password" name="password" id="password"><br>

                        <div class="form-group">
                            <input type="submit" name="btn-login" id="btn-login" value="LOGIN" class="btn btn-primary">
                            <input type="reset" value="RESET" class="btn btn-default">
                        </div>

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
<script type="text/javascript">
    $('document').ready(function () {
        $("#login-form").validate({
            submitHandler: submitForm
        });
        function submitForm() {
            var data = $("#login-form").serialize();
            $.ajax({
                type: 'POST',
                url: 'controller/home_signin.php',
                data: data,
                beforeSend: function () {
                    $("#error").fadeOut();
                    $("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                },
                success: function (response) {
                    console.log('success');
                    if (response == "ok") {
                        $("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                        setTimeout(' window.location.href = "index.php"; ', 2000);
                    }
                    else {

                        $("#error").fadeIn(1000, function () {
                            $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                            $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                        });
                    }
                }
            });
            return false;
        }
    });
</script>
</body>
</html>