<?php
 
    include '../../admin/config/config.php';
    // Xử lý ràng buộc đăng nhập
    session_start();
    if (!isset($_SESSION['TenDangNhap'])) {
      header("location: ../login.php");
      
    } 
    // session_destroy();
    $loai = mysqli_query($connect,"SELECT * FROM LoaiHangHoa ");

    $cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
      
      if(isset($_GET['MHH'])){
          $MHH = $_GET['MHH'];
          $hanghoa = mysqli_query($connect, "SELECT * FROM hanghoa WHERE MHH = '$MHH'" );
          $data = mysqli_fetch_assoc($hanghoa);
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
                  <a class="nav-link" href="../home.php"><i class="fas fa-home fa-1x"></i>Trang chủ<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown mr-3">
                  <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bars fa-1x"></i>
                  Sản phẩm
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php if (($loai)) {?>
                    <?php foreach ($loai as $key => $row) {?>
                      <a class="dropdown-item" href="../../menu.php?MaLoaiHang=<?php echo $row['MaLoaiHang'] ?>"><?php echo $row['TenLoaiHang'] ?></a>
                    <?php } ?>
                    <?php } ?>
                  </div>
                </li>
                <li class="nav-item active">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><i class="fas fa-phone-square-alt fa-1x"></i> 0939 543 909<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active ml-3">
                <a class="nav-link " href="../giohang/danhsach.php" tabindex="-1" aria-disabled="true"><i class="fas fa-shopping-cart fa-1x"></i>Giỏ hàng</a>
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
                <h4 class=" rounded-pill text-dark font-italic mt-5 p-2"  style="background-color: rgb(253, 215, 226);" >Chi Tiết</h4>
            </div>
        </div>

      
        <div class="row mx-auto mt-5 mt-5 p-0">
          <div class="col-md-2 mt-4">
              
          </div>
          <div class="col-md-3 mt-4">
              <div class="card">
                <div class="product-top img-wrap">                         
                    <img class="card-img-top img-wrap" src="../../image/<?php echo $data['Hinh'] ?>" alt="">   
                </div>
              </div>
          </div>
          <div class="col-md-5 mt-3" style="text-align: left">
            <div class="product-info m-2">
                <h3><?php echo $data['TenHH'] ?></h3>
                    <form action="cart.php" method="GET">
                    <div class="product-price my-3">
                      <!-- Giá sản phẩm: <del><?php echo number_format  ($data['Gia'],0,",",".") ?> </del>VND -->
                      <?php if($data['GiaKM'] > 0) { ?>
                      <p>
                       <del>Giá: <?php echo number_format  ($data['Gia'],0,",",".") ?> VND</del>  
                      </p>
                      <p>
                        <span style="color:#e83e8c">Khuyến mãi: <?php echo number_format  ($data['GiaKM'],0,",",".") ?> VND</span> 
                      </p>
                      <?php }else { ?>
                      <p>
                        Giá:
                        <span><?php echo number_format  ($data['Gia'],0,",",".") ?></span> VND
                        </p>
                        <?php } ?>
                        <div class="mt-3"> <?php echo $data['MoTa'] ?> </div>
                        <input type="hidden" name="MHH" value="<?php echo $data['MHH'] ?>">
                      </div>
                     
                      
                    <button type="submit" class="btn text-white py-3" style="background-color: black;"><i class="fas fa-check"></i> Thêm vào giỏ hàng</button>
                    </form>
                   
            </div>
          </div>
                   
        </div>
        
        <!-- <div class="container mt-2">
            <div class="row mt-3 ">
                <div class="col-8">
                    
                </div>
                <div class="col-4">
                    <div>TỔNG CỘNG</div>
                    <br>
                    <div class="row">
                        <div class="col-6"><h5>Tổng tiền</h5></div>
                        <div class="float-right"><h5><?php echo number_format  ($tong,0,",",".") ?></h5></div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-12">
                        <button type="button" class="btn text-white float-right py-3" style="background-color: black;"><i class="fas fa-check"></i>  
                          <a href ="./them.php?MHH=<?php echo $row['MHH'] ?>"  class="text-white" style="text-decoration: none;"> TIẾN HÀNH THANH TOÁN</a>
                        </button>
                      </div>
                    </div>
                 </div>
            </div>
        </div>
         -->
       
        

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


