<?php 
    session_start();
    include('../admin/config/config.php');
    if(isset($_POST['btn-login']) && $_POST['TenDangNhap'] != '' && $_POST['Password'] != ''){
        $TenDangNhap = $_POST['TenDangNhap'];
        $Password = md5($_POST['Password']);
        $sql = "SELECT * FROM KhachHang WHERE TenDangNhap='$TenDangNhap' AND Password = '$Password' ";
        $row = mysqli_query($connect, $sql);
        $count = mysqli_num_rows($row);
        if($count>0)
        {          
            $_SESSION['TenDangNhap'] = $TenDangNhap;
            header("location: ./home.php");
        }
        else{
            header("location: ./login.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
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
<body  >
    <div class="container">
        <div class="row mt-5">
            <div class="col-4">

            </div>
            <div class="col-sm-4 border rounded p-3 mt-3"  style="background-color: pink " >
            <h1 class="text-center font mt-2" style=" font-size:45px;">Jeju Cosmetics</h1><br/>
                <form class="text-dark px-3 " action="" method="POST" >
                    <div class="from-group mb-3">
                        <label for="TenDangNhap" class="form-label font">Tên đăng nhập</label>
                        <input type="text" class="form-control" name="TenDangNhap" id="TenDangNhap" aria-describedby="TenDangNhap" unique >
                    </div>
                    <div class="from-group mb-3">
                        <label for="Password" class="form-label font">Mật khẩu</label>
                        <input type="Password" class="form-control" name="Password" id="Password" >
                    </div>
                    <!-- <div class="from-group form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label font-italic" for="exampleCheck1">Ghi nhớ tôi</label>
                    </div> -->
                    <button style="background-color: #e83e8c" style="color:pink"  type="submit" name="btn-login" class="btn text-white mb-5 mt-3 p-2 float-right">Đăng nhập</button>
                    <div class="text-center font" style="margin-top: 130px;">
                        <a href="./register.php" class="text-dark"> Bạn chưa đăng ký thành viên? </a>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</body>
</html>