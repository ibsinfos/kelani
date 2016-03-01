<?php
require_once ("../dbconfig.php");

if (isset($_POST["btnAdd"])) {

    $con = connection();
    $stmt=$con->prepare('INSERT INTO polling_devition_tbl VALUES (?,?,now(),?,?)');
    $stmt->bind_param('issi', $ID,$NAME,$USER,$STATUS);
	
    $NAME = $_POST['txtPollingDivision'];
    $USER = $_POST['ssUser'];
    $STATUS = '1';
    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../polling_divisions.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../polling_divisions.php');
    }




}

elseif(isset($_POST["btnUpdate"])) {
    echo "<script type='text/javascript'>alert('Update');</script>";
}

elseif(isset($_POST["btnDelete"])) {
    echo "<script type='text/javascript'>alert('Delete');</script>";
}

elseif(isset($_POST["btnClear"])) {
    echo "Yes, Clear";
}

function idgenarate(){

    $query1="SELECT MAX(Course_ID) FROM course_tbl";

}

?>


