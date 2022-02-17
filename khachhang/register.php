<?php
    include '../admin/config/config.php';
    // if(isset($_POST['btn-register'])){
    //     $HoTenKH = $_POST['HoTenKH'];
    //     $SĐT = $_POST['SoDienThoai'];
    //     $TenDangNhap = $_POST['TenDangNhap'];
    //     $Password = md5($_POST['Password']);
    //     $khachhang = "INSERT INTO KhachHang (HoTenKH,SoDienThoai,TenDangNhap,Password)
    //                  VALUE ('$HoTenKH','$SĐT','$TenDangNhap',$Password')";
    //     if (mysqli_query($connect,$khachhang) == true) {
    //         header('location: ./login.php');
    //     } 
    //     else {
    //         echo "Error updating record: " . $connect->error;
    //     }
    // }

    if(isset($_POST['btn-register']) && $_POST['HoTenKH'] != '' && $_POST['SoDienThoai'] != '' && $_POST['TenDangNhap'] != '' && $_POST['Password'] != ''){
        $HoTenKH = $_POST['HoTenKH'];
        $SoDienThoai = $_POST['SoDienThoai'];
        $TenDangNhap = $_POST['TenDangNhap'];
        $Password = md5($_POST['Password']);

        $khachhang = "INSERT INTO KhachHang(HoTenKH, SoDienThoai, TenDangNhap, Password)
                     VALUES ('$HoTenKH', '$SoDienThoai', '$TenDangNhap', '$Password')";

        if (mysqli_query($connect,$khachhang) == true) {
            header('location: ./login.php');
        } 
        else {
            echo "Error updating record: " . $connect->error;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký thành viên</title>
    <style>
        .font {
            font-family: 'Dancing Script', cursive;
            font-size: 20px;
        }
        .text-pink{
          
          color:  #e83e8c;
        }
        body{
            background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
          
            /* background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%); */
        }
        .border{
            background-image: linear-gradient(-225deg, #E3FDF5 50%, #FFE6FA 50%);
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Saira+Semi+Condensed:wght@200&family=Satisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
</head>
<body   >
    <div class="container">
        <div class="row mt-5">
            <div class="col-3" >

            </div>
            <div class="col-5 border rounded p-3 ml-5 " style="background-color:white">
                <h1 class="text-center  font" style=" font-size:45px;">Jeju Cosmetics</h1><br/>
                <form class="text-dark px-3" action="" method="POST">
                    <div class="from-group mb-3">
                        <label for="HoTenKH" class="form-label font">Họ tên</label>
                        <input type="text" class="form-control " name="HoTenKH" id="HoTenKH" aria-describedby="HoTenKH" >
                    </div>
                    <div class="from-group mb-3">
                        <label for="SoDienThoai" class="form-label font">Số điện thoại</label>
                        <input type="tel" class="form-control" name="SoDienThoai" id="SoDienThoai" aria-describedby="SoDienThoai" >
                    </div>
                    <div class="from-group mb-3">
                        <label for="TenDangNhap" class="form-label font">Tên đăng nhập</label>
                        <input type="text" class="form-control" name="TenDangNhap" id="TenDangNhap" aria-describedby="TenDangNhap">
                    </div>
                    <div class="from-group mb-3">
                        <label for="Password" class="form-label font">Mật khẩu</label>
                        <input type="Password" class="form-control" name="Password" id="Password" aria-describedby="Password" >
                    </div>
                    <button style="background-color: #e83e8c" type="submit" name="btn-register" class="btn text-white mb-5 mt-3 py-2 float-right">Đăng ký</button>
                   
                    <div class="text-center" style="margin-top: 130px;">
                        <a href="./login.php" class="text-dark font"> Đã là thành viên ? Đăng nhập</a>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</body>
</html>