<?php
require_once ("../dbconfig.php");
if (isset($_POST["btnAdd"])) {

    $con = connection();
    //$stmt=$con->prepare('INSERT INTO privileges_tbl VALUES(?,?,?,?,?)');
    //$stmt->bind_param('isiii', $USERLEVEL,$FORM,$R,$W,$D);


    $USERLEVEL = $_POST['cmbUserLevel'];

    //var_dump($_POST); exit();

    $tmp = array();

    for($j=0;$j<sizeof($_POST['txtid']); $j++){

        $valCbr = 0;
        $valcbW = 0;
        $valcbD = 0;

        if(isset($_POST['txtid'][$j])) {

            $txtID = $_POST['txtid'][$j];
        }
        if(!isset($_POST['txtid'][$j])) {

            $txtID = 'empty';
        }

        if(isset($_POST['cbR'.$j])){$valCbr =1;}
        if(isset($_POST['cbW'.$j])){$valcbW =1;}
        if(isset($_POST['cbD'.$j])){$valcbD =1;}

        $txtid = 'txtid'.(string)$j;
        $tmp[$j]= array($txtID.",".$valCbr.",".$valcbW.",".$valcbD);

        $stmt=$con->prepare('INSERT INTO privileges_tbl VALUES(?,?,?,?,?)');
        $stmt->bind_param('isiii', $USERLEVEL,$txtID,$valCbr,$valcbW,$valcbD);
        $stmt->execute();
        unset($stmt);

    }

    //var_dump($tmp); exit();

//    $USERLEVEL = $_POST['cmbUserLevel'];
//    $FORM = $_POST['txtid'];
//    $R = $_POST['cbR'];
//    $W = $_POST['cbW'];
//    $D = $_POST['cbD'];
    //$stmt->execute();

    if($stmt->affected_rows > 0){
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../userPrivileges.php');
    }else{
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../userPrivileges.php');
    }

}
?>




