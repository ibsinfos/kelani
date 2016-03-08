<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kelani | User Privileges</title>
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
</script>  
    
</head>
<body>

<?php
include_once './inc/top.php';
?>

    <div id="wrapper">
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            User Privileges
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> User Privileges
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <?php
                    require_once("./config.php");
                    $stmt = $db_con->prepare("SELECT * FROM privileges_tbl WHERE UserLevel_tbl_id = '" . $_SESSION['userLvl'] . "' AND Form_tbl_FormID = 'alsubj'");
                    $stmt->execute();
                    $permissions = $stmt->fetchAll();
                    if($permissions[0]['R']){?>
                    <form method="post" action="controller/userPrivilegesController.php" target="_self" data-toggle="validator" id="usrpri">
                        <div class="col-lg-6">

                        <label>User Level</label><br/>
                        <select name="cmbUserLevel" id="cmbUserLevel">
                        <option value='0'>        --Select UserLevel--</option>
                        		<?php
                                include_once 'dbconfig.php';
                                $query = 'SELECT * FROM userlevel_tbl;';
                                $result = getData($query);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
										echo "<option value='".$row['id']."'>".$row['lavel_name']."</option>";
                                    }
                                }
                                ?>
                        </select>
                        

                    <div><?php if($permissions[0]['W']){?>
                        <input name="btnAdd" type="submit" value="Add" class="btn btn-primary"/>
                        <input name="btnUpdate" onclick="" type="submit" value="Update" class="btn btn-primary"/>
                        <?php } else {
                        ?>
                        <input name="btnAdd" type="submit" value="Add" class="btn btn-primary" disabled/>
                        <input name="btnUpdate" onclick="" type="submit" value="Update" class="btn btn-primary"disabled/>
                            <?php
                        }
                        if($permissions[0]['D']){?>
                        <input name="btnDelete" type="submit" value="Delete" class="btn btn-danger"/>
                        <?php } else {
                            ?>
                            <input name="btnDelete" type="submit" value="Delete" class="btn btn-danger"/>
                            <?php
                        } ?>
                        <input name="btnClear" type="reset" value="Clear" class="btn btn-default"/>
                    </div>

                    </div>
					
                    <div class="col-lg-6 selecttable">
                        <table name="tbl_previ">
                            <tr><th>Form Name</th><th>R</th><th>W</th><th>D</th></tr>
                        <?php
                        include_once 'dbconfig.php';
                        $result = getData("SELECT FormID, `Name` FROM form_tbl");
                        $rows = mysqli_fetch_all($result);
                        $i = 0;
                        foreach($rows as $row){
                            ?>
                            <tr>
                                <td>
                                    <input type='text' readonly name='txtname<?php echo $i?>' value='<?php echo $row[1];?>'>
                                    <input type='hidden' readonly name='txtid<?php echo $i?>' value='<?php echo $row[0];?>'>
                                </td>
                                <td><input type='checkbox' name='cbR<?php echo $i?>' value='1'></td>
                                <td><input type='checkbox' name='cbW<?php echo $i?>' value='1'></td>
                                <td><input type='checkbox' name='cbD<?php echo $i?>' value='1'></td>
                            </tr>
                            <?php
                            $i++;
                        }
                        connection_close(); //Make sure to close out the database connection
                        ?>
                    </div>


                    <?php } else {
                        ?>
                        <h1>You Do Not Have Permissions To This Page...!</h1>
                        <?php
                    } ?>
                </form>
                </div>
                <!-- /.row -->



				
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include_once './inc/footer.php'; ?>
</body></html>