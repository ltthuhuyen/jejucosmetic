<?php

    include '../../admin/config/config.php';
    session_start();
    if(isset($_REQUEST['MHH']) and $_REQUEST['MHH']!=""){
        $MHH=$_GET['MHH'];
        unset($_SESSION['cart'][$MHH]);
        header("location: ./danhsach.php");
    }
    // $loai = mysqli_query($connect,"SELECT * FROM LoaiHangHoa ");$action = (isset($_GET['action'])) ? $_GET['action'] : 'add';
    // $SoLuong = (isset($_GET['SoLuong'])) ? $_GET['SoLuong'] : 1;
    // if($SoLuong <= 0){
    //     $SoLuong = 1;
    // }
    
    // $query = mysqli_query($connect, "SELECT * FROM hanghoa WHERE MHH = $MHH" );

    // if($query){
    //     $hanghoa = mysqli_fetch_assoc($query);
    // }
    // $item = [
    //     'MHH' => $hanghoa['MHH'],
    //     'TenHH' => $hanghoa['TenHH'],
    //     'Hinh' => $hanghoa['Hinh'],
    //     'Gia' => ($hanghoa['Gia'] > 0) ? $hanghoa['GiaKM'] : $hanghoa['Gia'],
    //     'SoLuong' => $SoLuong
    // ];

    
    // if($action == 'delete'){
    //    unset($_SESSION['cart'][$MHH]);
    // }


  
?>