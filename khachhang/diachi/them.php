<?php

    include '../../admin/config/config.php';
    // Xử lý ràng buộc đăng nhập
    session_start();
    if (!isset($_SESSION['TenDangNhap'])) {
        header("location: ../login.php");
        
    } 
    // session_destroy();
    // Ds loại hàng hóa trên menu
    $loai = mysqli_query($connect,"SELECT * FROM LoaiHangHoa ");

    // Lấy thông tin khách hàng đang đăng nhập
    $sql_khachhang="SELECT * FROM KhachHang  WHERE TenDangNhap = '".$_SESSION['TenDangNhap']."'";
    $khachhang = mysqli_query($connect,$sql_khachhang);
   
    // Thêm địa chỉ cho khách hàng đang đăng nhập
    if(isset($_POST['btn-submit'])){
        $MSKH = $_POST["MSKH"];  
        $DiaChi = $_POST["DiaChi"];  
        $sql_diachi = "INSERT INTO DiaChi (MSKH, DiaChi) VALUES ('$MSKH', '$DiaChi')";
        $query = mysqli_query($connect, $sql_diachi);
        if($query){
            header('location: ../giohang/thanhtoan.php');
        }
        else{
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
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Saira+Semi+Condensed:wght@200&family=Satisfy&display=swap" rel="stylesheet">
   <style>
        .img-wrap {
          height: 300px;
          overflow: hidden;
        }
        .img-wrap img {
          height: 300px; 
          width: 100%;
        }
        .btn-light:hover{
            background-color: black;
            color: white;
        }
        .btn-pink:hover{
            background-color: rgb(253, 215, 226);
           
        }
        .text-pink{
          background-color: white;
          color: #e83e8c ;
        }
        .font {
            font-family: 'Satisfy', cursive;
            font-size: 35px;
        }
      </style>

</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="border border-white rounded-pill m-5 text-gray font font-italic">Jeju Cosmetics</h1>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(253, 215, 226);">
            <a class="navbar-brand font" style="font-size:25px" href="#">Jeju Cosmetics</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto ">
                <li class="nav-item active mr-3">
                  <a class="nav-link" href="../../index.php"><i class="fas fa-home fa-1x"></i>Trang chủ<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown mr-3">
                  <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bars fa-1x"></i>
                  Sản phẩm
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php if (($loai)) {?>
                    <?php foreach ($loai as $key => $row) {?>
                      <a class="dropdown-item" href="../../menu.php?MSKH=<?php echo $row['MSKH'] ?>"><?php echo $row['TenLoaiHang'] ?></a>
                    <?php } ?>
                    <?php } ?>
                  </div>
                </li>
                <li class="nav-item active">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><i class="fas fa-phone-square-alt fa-1x"></i> 0939 543 909<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active ml-3">
                  <a class="nav-link " ><i class="fas fa-shopping-cart fa-1x btn-outline-dark mt-auto"></i>Giỏ hàng</a>
                </li>    
              </div>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 " type="submit">Tìm kiếm</button>
              </form>
              <ul class="navbar-nav mt-2 ">
                <li class="nav-item ml-5 mt-2 active"><i class="fas fa-user"></i>
                      <?php  
                      if (!isset($_SESSION['TenDangNhap'])) {
                            header("location: ../login.php");
                        }else{
                            echo $_SESSION['TenDangNhap'];
                      }
                      ?>
                  </li>
                <li class="nav-item ml-5 active">
                  <a class="nav-link" name ='logout' href="../logout.php"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a>
                </li>
              </ul>
            </div>
        </nav>

        <div class="row">
            <div class="col-4 text-center">

            </div>
            <div class="col-4 text-center">
                <h4 class=" rounded-pill text-dark font-italic mt-5 p-2"  style="background-color: rgb(253, 215, 226);" >Địa Chỉ</h4>
            </div>
        </div>
        <div class="row p-5">
            <div class="col-3 text-center">

            </div>
            <div class="col-6 ">
            <form class="form-group" method="POST">
                <div class="border border-light p-3" style="background-color:white">
                  <h2 class="text-center font-italic">Thông tin địa chỉ</h2><br/>
                    <div class="from-group m-3 mx-5">
                      <label for="MSKH" class="form-label font-italic">Họ tên khách hàng</label>
                      <select class="form-control" id="MSKH" name="MSKH">
                        <?php
                          while($row_khachhang = mysqli_fetch_assoc($khachhang)){?>
                          <option value="<?php echo $row_khachhang['MSKH'] ?>"><?php echo $row_khachhang['HoTenKH'] ?></option>
                        <?php } ?>
                      </select> 
                    
                    </div>   
                    <div class="from-group m-3 mx-5">
                        <label for="DiaChi" class="form-label font-italic">Địa chỉ</label>
                        <input type="text" class="form-control" name="DiaChi" id="DiaChi">
                    </div> 
                    <button style="background-color: #e83e8c" style="color:pink"  type="submit" name="btn-submit" class="btn text-white m-5 mt-3 py-2 float-right">Lưu</button>
                  
                </div>                 
            </form> 
            </div>
        </div>


       
       
        

        <div class="container-fluid mt-5">
            <div class="row order border-white mt-2 text-gray font-italic p-4" style="background-color:rgb(253, 215, 226)">
                <div class="col-12 text-center">
                    <h3>Jeju Cosmetics</h3>
                    Địa chỉ: 189 đường Hai Bà Trưng, phường Bến Nghé, quận 1, Thành phố Hồ Chí Minh
                </div>
            </div>
        </div>   
    </div>
       
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
</body>
</html>


