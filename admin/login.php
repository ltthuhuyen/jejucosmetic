<?php
   
    session_start();
    include('./config/config.php');
    if(isset($_POST['btn-login']) && $_POST['username'] != '' && $_POST['password'] != ''){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM TaiKhoan WHERE username='$username' AND password = '$password' ";
        $row = mysqli_query($connect, $sql);
        $count = mysqli_num_rows($row);
        if($count>0)
        {          
            $_SESSION['username'] = $username;
            header("location: ./HangHoa/danhsach.php");
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
          
            
        }
       
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Saira+Semi+Condensed:wght@200&family=Satisfy&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body >
    <div class="container">
        <div class="row mt-5">
            <div class="col-4">

            </div>
            <div class="col-4 border rounded p-3 ">
            <h1 class="text-center font mt-2" style=" font-size:45px;">Jeju Cosmetics</h1><br/>
                <form class="text-dark px-3" action="" method="POST">
                    <div class="from-group mb-3">
                        <label for="username" class="form-label font ">Tên đăng nhập</label>
                        <input type="tel" class="form-control" name="username" id="username" aria-describedby="username" >
                    </div>
                    <div class="from-group mb-3">
                        <label for="password" class="form-label font">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" id="password" >
                    </div>
                    <div class="from-group form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label font" for="exampleCheck1">Ghi nhớ tôi</label>
                    </div>
                    <button type="submit" name="btn-login" class="btn btn-outline-dark mb-5 mt-3 float-right">Login</button>
                </form>
            </div>
           
        </div>
    </div>
</body>
</html>