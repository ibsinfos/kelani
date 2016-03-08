<?php
require_once ("../dbconfig.php");
if (isset($_POST["btnAdd"])) {

    $con = connection();
    $stmt=$con->prepare('INSERT INTO privileges_tbl VALUES(?,?,?,?,?)');
    $stmt->bind_param('isiii', $USERLEVEL,$FORM,$R,$W,$D);

    var_dump($_POST); exit();

    $tmp = array();

    for($j=0;$j<sizeof($_POST); $j++){
        $txtid = 'txtid'.(string)$j;
        $tmp[$j]= array($_POST['txtid'.$j]);//.",".$_POST['txtid'.$j].",".$_POST['cbR'.$j].",".$_POST['cbW'.$j].",".$_POST['cbD'.$j];
    }

    var_dump($tmp); exit();

    $USERLEVEL = $_POST['cmbUserLevel'];
    $FORM = $_POST['txtid'];
    $R = $_POST['cbR'];
    $W = $_POST['cbW'];
    $D = $_POST['cbD'];
    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../userPrivileges.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../userPrivileges.php');
    }

}
?>




