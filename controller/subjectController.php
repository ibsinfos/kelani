<?php
require_once ("../dbconfig.php");

if (isset($_POST["btnAdd"])) {

    $con = connection();
    $stmt=$con->prepare('INSERT INTO subject_tbl VALUES (?,?,?,now(),?,?)');
    $stmt->bind_param('isssi', $ID,$NAME,$CODE,$USER,$STATUS);

    $NAME = $_POST['txtSubjectName'];
    $CODE = $_POST['txtSubjectCode'];
    $USER = $_POST['ssUser'];
    $STATUS = '1';
    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../subject.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../subject.php');
    }
}

elseif(isset($_POST["btnUpdate"])) {
    $con = connection();
    if(trim(($_POST['idx'])) != ''){

        $IDX = $_POST['idx'];
        $NAME = $_POST['txtSubjectName'];
        $CODE = $_POST['txtSubjectCode'];
        $USER = $_POST['ssUser'];

        $query = "UPDATE subject_tbl SET subjectname = '".$NAME."', Subjectcode = '".$CODE."', CreateUser = '".$USER."' WHERE id ='".$IDX."' ";
        $result= $con->query($query);
//        var_dump($_POST);
//        die();
//	mysqli_query("query here") or die(mysqli_error($con));
//	echo $con->error;
    }

    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Update');</script>";
        header('Location:../subject.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../subject.php');
    }
}

elseif(isset($_POST["btnDelete"])) {
    echo "<script type='text/javascript'>alert('Delete');</script>";
}

elseif(isset($_POST["btnClear"])) {
    header('Location:../subject.php');
}

function idgenarate(){

    $query1="SELECT MAX(Course_ID) FROM course_tbl";

}

?>


