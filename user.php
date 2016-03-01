<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kelani | User</title>
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

        document.addEventListener("DOMContentLoaded", function () {

            // JavaScript form validation

            var checkPassword = function (str) {
                var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
                return re.test(str);
            };

            var checkForm = function (e) {
                if (this.usernamex.value == "") {
                    alert("Error: Username cannot be blank!");
                    this.usernamex.focus();
                    e.preventDefault(); // equivalent to return false
                    return;
                }
                re = /^\w+$/;
                if (!re.test(this.usernamex.value)) {
                    alert("Error: Username must contain only letters, numbers and underscores!");
                    this.usernamex.focus();
                    e.preventDefault();
                    return;
                }
                if (this.pwd1.value != "" && this.pwd1.value == this.pwd2.value) {
                    if (!checkPassword(this.pwd1.value)) {
                        alert("The password you have entered is not valid!");
                        this.pwd1.focus();
                        e.preventDefault();
                        return;
                    }
                } else {
                    alert("Error: Please check that you've entered and confirmed your password!");
                    this.pwd1.focus();
                    e.preventDefault();
                    return;
                }
                alert("Both username and password are VALID!");
            };

            var usrmng = document.getElementById("usrmng");
            usrmng.addEventListener("submit", checkForm, true);

            // HTML5 form validation

            var supports_input_validity = function () {
                var i = document.createElement("input");
                return "setCustomValidity" in i;
            }

            if (supports_input_validity()) {
                var usernameInput = document.getElementById("txtUsername");
                usernameInput.setCustomValidity(usernameInput.title);

                var pwd1Input = document.getElementById("pwd1");
                pwd1Input.setCustomValidity(pwd1Input.title);

                var pwd2Input = document.getElementById("txtRePw");

                // input key handlers

                usernameInput.addEventListener("keyup", function () {
                    usernameInput.setCustomValidity(this.validity.patternMismatch ? usernameInput.title : "");
                }, false);

                pwd1Input.addEventListener("keyup", function () {
                    this.setCustomValidity(this.validity.patternMismatch ? pwd1Input.title : "");
                    if (this.checkValidity()) {
                        pwd2Input.pattern = this.value;
                        pwd2Input.setCustomValidity(pwd2Input.title);
                    } else {
                        pwd2Input.pattern = this.pattern;
                        pwd2Input.setCustomValidity("");
                    }
                }, false);

                pwd2Input.addEventListener("keyup", function () {
                    this.setCustomValidity(this.validity.patternMismatch ? pwd2Input.title : "");
                }, false);

            }

        }, false);

    </script>

</head>
<body>

<?php
include_once './inc/top.php';
include_once 'dbconfig.php'; //Connect to database

if (isset($_GET['edit'])) {
    $id = trim($_GET['edit']);
    $query = "SELECT Username, Password, UserLevel_tbl_id, Emp_id, CreateUser, CreateDate, Status, Username FROM user_tbl WHERE Username='" . $id . "'";
    $result = getData($query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $Username = $row['Username'];
            $Password = $row['Password'];
            $UserLevel_tbl_id = $row['UserLevel_tbl_id'];
            $Emp_id = $row['Emp_id'];
            $CreateUser = $row['CreateUser'];
            $Status = $row['Status'];
        }
    } else {
        $Username = "";
        $Password = "";
        $UserLevel_tbl_id = "";
        $Emp_id = "";
        $CreateUser = "";
        $Status = "";
    }
//	var_dump($_POST);
//	die();

} else {
    $Username = "";
    $Password = "";
    $UserLevel_tbl_id = "";
    $Emp_id = "";
    $CreateUser = "";
    $Status = "";
}

?>

<div id="wrapper">
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        User
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-bar-chart-o"></i> User
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4">
                    <form method="post" action="controller/userController.php" target="_self" data-toggle="validator"
                          id="usrmng">
                        <div class="form-group">
                            <label class="control-label col-md-4">Username</label>
                            <input class="form-control col-md-8" id="txtUsername" value=""
                                   title="Username must not be blank and contain only letters, numbers and underscores."
                                   type="text" required pattern="\w+" name="usernamex">
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Password</label>
                            <input class="form-control col-md-8" id="pwd1"
                                   title="Password must contain at least 6 characters, including UPPER/lowercase and numbers."
                                   type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd1">
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Reenter Password</label>
                            <input class="form-control col-md-8" id="txtRePw" title="Please enter the same Password as above." type="password"
                                   required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd2"></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">User Level</label><br/>
                            <select class="form-control col-md-8" name="cmbUserLevel" id="cmbUserLevel">
                                <option value='0'> --Select UserLevel--</option>
                                <?php
                                include_once 'dbconfig.php';
                                $query = 'SELECT * FROM userlevel_tbl;';
                                $result = getData($query);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected = $row['id'] == $UserLevel_tbl_id ? 'selected' : '';
                                        echo "<option " . $selected . " value='" . $row['id'] . "'>" . $row['lavel_name'] . "</option>";
                                    }
                                }
                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Employee</label><br/>
                            <select class="form-control col-md-8" name="cmbEmployee" id="cmbEmployee">
                                <option value='0'> --Select Employee--</option>
                                <?php
                                include_once 'dbconfig.php';
                                $query = 'SELECT * FROM employee_tb';
                                $result = getData($query);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $selected = $row['Emp_id'] == $Emp_id ? 'selected' : '';
                                        echo "<option " . $selected . " value='" . $row['Emp_id'] . "'>" . $row['Name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Status</label>
                            <select class="form-control col-md-8" name='cmbStatus' id="cmbStatus">
                                <option <?php echo $Status == "1" ? 'selected' : '' ?> value='1'>Active</option>
                                <option <?php echo $Status == "0" ? 'selected' : '' ?> value='0'>Deactive</option>
                            </select>
                        </div>
                        <input type="hidden" value="<?php echo date('Y-m-d'); ?>" name="dtpDatex">
                        <input type="hidden"
                               value="<?php echo ($_SESSION['user_session'] == 'loged') ? $_SESSION['username'] : 'User'; ?>"
                               name="ssUser">

                        <div class="form-group col-md-12">
                                <input name="btnAdd" type="submit" value="Add" class="btn btn-primary"/>
                                <input name="btnUpdate" onclick="" type="submit" value="Update" class="btn btn-primary"/>
                                <input name="btnDelete" type="submit" value="Delete" class="btn btn-danger"/>
                                <input name="btnClear" type="reset" value="Clear" class="btn btn-default"/>
                        </div>
                    </form>
                </div>

                <div class="col-lg-8 selecttable">
                    <?php
                    include_once 'dbconfig.php'; //Connect to database
                    $query = "SELECT u.Username, e.NameInitial, ul.lavel_name, b.City, u.CreateDate
FROM user_tbl u, employee_tb e, userlevel_tbl ul, branch_tbl b
WHERE u.Emp_id = e.Emp_id AND u.UserLevel_tbl_id = ul.id AND e.Branch_tbl_Branch_id = b.Branch_id
";
                    //Username, NameInitial, lavel_name, City, CreateDate
                    $result = getData($query);
                    echo "<table width='100%'>"; // start a table tag in the HTML
                    echo "<tr>
                        <th>USERNAME</th>
                        <th>NAME</th>
                        <th>USER LEVEL</th>
                        <th>CITY</th>
						<th>CREATE DATE</th>
						<th>&nbsp;</th>
                        </tr>";
                    while ($row = mysqli_fetch_array($result)) {//Creates a loop to loop through results
                        echo "<tr><td>" . $row['Username'] . "</td><td>" . $row['NameInitial'] . "</td><td>" . $row['lavel_name'] . "</td><td>" . $row['City'] . "</td><td>" . $row['CreateDate'] . "</td><td><a href='user.php?edit=" . $row['Username'] . "'>Edit</a></td></tr>";  //$row['index'] the index here is a field name
                    }
                    echo "</table>"; //Close the table in HTML
                    connection_close(); //Make sure to close out the database connection
                    ?>
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