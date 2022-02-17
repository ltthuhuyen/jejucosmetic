<?php
include ('../config/config.php');
//Xủ lý ràng buộc đăng nhập
session_start();
if(!isset($_SESSION['username'])){
    header("location: ../login.php");
}
//
if(isset($_REQUEST['MHH']) and $_REQUEST['MHH']!=""){
$MHH=$_GET['MHH'];
$sql = "DELETE FROM HangHoa WHERE MHH='$MHH'";
if ($connect->query($sql) === TRUE) {
    header('location: danhsach.php');
} else {
    echo "Error updating record: " . $connect->error;
}

$connect->close();
}
?>