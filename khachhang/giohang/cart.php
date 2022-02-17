<?php
 
    include '../../admin/config/config.php';
    // Xử lý ràng buộc đăng nhập
    session_start();
    if (!isset($_SESSION['TenDangNhap'])) {
        header("location: ../login.php");
        
    } 
    if(isset($_GET['MHH'])){
        $MHH = $_GET['MHH'];
    }

    $action = (isset($_GET['action'])) ? $_GET['action'] : 'add';
    $SoLuong = (isset($_GET['SoLuong'])) ? $_GET['SoLuong'] : 1;
    // var_dump($_GET);
    // die();
    $query = mysqli_query($connect, "SELECT * FROM hanghoa WHERE MHH = $MHH" );

    if($query){
        $hanghoa = mysqli_fetch_assoc($query);
    }
    $item = [
        'MHH' => $hanghoa['MHH'],
        'TenHH' => $hanghoa['TenHH'],
        'Hinh' => $hanghoa['Hinh'],
        'Gia' => ($hanghoa['Gia'] > 0) ? $hanghoa['Gia'] : $hanghoa['GiaKM'],
        'SoLuong' => $SoLuong,
        'MoTa' => $hanghoa['MoTa']
    ];

    if($action == 'add'){
        if(isset($_SESSION['cart'][$MHH])){
            $_SESSION['cart'][$MHH]['SoLuong'] += $SoLuong;
        }
        else{
            $_SESSION['cart'][$MHH] = $item;
        }
    }
    if($action == 'update'){
        $_SESSION['cart'][$MHH]['SoLuong'] = $SoLuong;
    }
    if($action == 'delete'){
       unset($_SESSION['cart'][$MHH]);
    }


    header('location: ./danhsach.php');
    // echo"<pre>";
    // print_r($_SESSION['cart']);
    
?>