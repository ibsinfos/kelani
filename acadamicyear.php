<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kelani | Acadamic Year</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="title" content="al_ubject">


    <?php 
	require_once './inc/header.php';
	?>
</head>
<body>

<?php

include_once './inc/top.php';
include_once 'dbconfig.php'; //Comnnect to database
?>

<div id="wrapper">
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-">
					<div id='msg'></div>
                    <h1 class="page-header">
                        Acadamic Year
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-bar-chart-o"></i> Acadamic Year
                        </li>
                    </ol>
                </div>
            </div>
            <?php
            require_once("./config.php");
            $stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'acyear'");
            $stmt->execute();
            $permissions = $stmt->fetchAll();
            ?>
            <?php if($permissions[0]['R']){?>
            <form method="post" action="" data-toggle="validator" id="acyear">
                <div class="row">
                    <div class="col-lg-4">
                        <label>Subject Name</label><br/>
                        <input type="text" name="txtSubjectName"/><br/>
                        <div>
                            <?php if($permissions[0]['W']){?>
                            <input type="submit" value="Add" name="btnAdd" class="btn-primary"/>
                            <input type="submit" value="Update" name="btnUpdate" class="btn-primary"/>
                            <?php } else {
                                ?>
                                <input type="submit" value="Add" name="btnAdd" class="btn-disabled" disabled/>
                                <input type="submit" value="Update" name="btnUpdate" class="btn-disabled" disabled/>
                                <?php
                            }
                            if($permissions[0]['D']){?>
                            <input type="submit" value="Delete" name="btnDelete" class="btn-danger"/>
                            <?php } else {
                                ?>
                                <input type="submit" value="Delete" name="btnDelete" class="btn-disabled" disabled/>
                                <?php
                            } ?>
                            <input type="reset" value="Clear" name="btnClear"  class="btn-default"/>
                        </div>
                    </div>
                    <div class="col-lg-8 selecttable">
                        <?php

                        $query = "SELECT `year` FROM acadamicyear";
                        $result = getData($query);
                        echo "<table width='100%'>"; // start a table tag in the HTML
                        echo "<tr><th>ACADAMIC YEAR</th><th>&nbsp;</th></tr>";
                        while ($row = mysqli_fetch_array($result)) {   //Creates a loop to loop through results
                            echo "<tr><td>" . $row['year'] . "</td><td><input type='button' value='Edit'></td></tr>";  //$row['index'] the index here is a field name
                        }
                        echo "</table>"; //Close the table in HTML
                        connection_close(); //Make sure to close out the database connection
                        ?>
                    </div>
                </div>
            </form>
            <?php } else {
                ?>
                <h1>You Do Not Have Permissions To This Page...!</h1>
                <?php
            } ?>
            <!-- /al subject mng -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php include_once './inc/footer.php'; ?>
<script type="text/javascript">
    $('document').ready(function () {
        $("#alsubj").validate({
            submitHandler: submitForm
        });
        function submitForm() {
            var data = $("#alsubj").serialize();
            $.ajax({
                type: 'POST',
                url: 'controller/al_subjectController.php',
                data: data,
                beforeSend: function () {
                    $("#msg").fadeOut();
                    //$("#btnAdd").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
                },
                success: function (response) {
                    if (response == "ok") {
						$("#msg").fadeIn(function () {
							$("#msg").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Successfully Inserted...!</div>');
						});
						
                    }
                    else {
						window.location.reload();
							$("#msg").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>'); 
                    }
                }
            });
            return false;
        }
    });
</script>
</body>
</html>