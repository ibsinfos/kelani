<?php
require_once("../dbconfig.php");
if (isset($_POST["btnAdd"])) {

    $con = connection();
    //var_dump($_POST); exit();
    $USERLEVEL = $_POST['cmbUserLevel'];
    $tmp = array();

    for ($j = 0; $j < sizeof($_POST['txtid']); $j++) {
        $valCbr = 0;
        $valcbW = 0;
        $valcbD = 0;
        if (isset($_POST['txtid'][$j])) {
            $txtID = $_POST['txtid'][$j];
        }
        if (!isset($_POST['txtid'][$j])) {
            $txtID = 'empty';
        }
        if (isset($_POST['cbR' . $j])) {
            $valCbr = 1;
        }
        if (isset($_POST['cbW' . $j])) {
            $valcbW = 1;
        }
        if (isset($_POST['cbD' . $j])) {
            $valcbD = 1;
        }

        $txtid = 'txtid' . (string)$j;
        $tmp[$j] = array($txtID . "," . $valCbr . "," . $valcbW . "," . $valcbD);

        $stmt = $con->prepare('INSERT INTO privileges_tbl VALUES(?,?,?,?,?)');
        $stmt->bind_param('isiii', $USERLEVEL, $txtID, $valCbr, $valcbW, $valcbD);
        $stmt->execute();
        unset($stmt);

    }

    if ($stmt->affected_rows > 0) {
        echo "<script type='text/javascript'>alert('Successfully Inserted');</script>";
        header('Location:../userPrivileges.php');
    } else {
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../userPrivileges.php');
    }

} elseif (isset($_POST["btnUpdate"])) {
    $con = connection();

    if (trim(($_POST['cmbUserLevel'])) != '') {
    //var_dump($_POST); exit();
        $USERLEVEL = $_POST['cmbUserLevel'];
        $tmp = array();

        for ($j = 0; $j < sizeof($_POST['txtid']); $j++) {
            $valCbr = 0;
            $valcbW = 0;
            $valcbD = 0;
            if (isset($_POST['txtid'][$j])) {
                $txtID = $_POST['txtid'][$j];
            }
            if (!isset($_POST['txtid'][$j])) {
                $txtID = 'empty';
            }
            if (isset($_POST['cbR' . $j])) {
                $valCbr = 1;
            }
            if (isset($_POST['cbW' . $j])) {
                $valcbW = 1;
            }
            if (isset($_POST['cbD' . $j])) {
                $valcbD = 1;
            }

            $txtid = 'txtid' . (string)$j;
            $tmp[$j] = array($txtID . "," . $valCbr . "," . $valcbW . "," . $valcbD);

//            $stmt = $con->prepare('INSERT INTO privileges_tbl VALUES(?,?,?,?,?)');
//            $stmt->bind_param('isiii', $USERLEVEL, $txtID, $valCbr, $valcbW, $valcbD);
//            $stmt->execute();
//            unset($stmt);
            $query = "UPDATE privileges_tbl SET R = '" . $valCbr . "' , W = '" . $valcbW . "' , D = '" . $valcbD . "' WHERE UserLevel_tbl_id = '" . $USERLEVEL . "' AND Form_tbl_FormID = '" . $txtID ."'";

            $result = $con->query($query);
        }

    }

    if ($stmt->affected_rows > 0) {
        echo "<script type='text/javascript'>alert('Successfully Update');</script>";
        header('Location:../userPrivileges.php');
    } else {
        echo "<script type='text/javascript'>alert('Error');</script>";
        header('Location:../userPrivileges.php');
    }
}

?>




