<?php
    include ('admin/config/config.php');
   
    $loai = mysqli_query($connect,"SELECT * FROM LoaiHangHoa ");
   
?>   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
      integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
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
        .text-pink{
          background-color: white;
          color: #e83e8c ;
        }
        .btn-pink:hover{
          background-color: #e83e8c ;
          color: white;
        }
        .font {
          font-family: 'Satisfy', cursive;
          font-size: 35px;
        }
      </style>
  </head>

<body >
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="border border-white rounded-pill m-5 text-gray font-italic font">Jeju Cosmetics</h1>
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
                  <a class="nav-link" href="index.php"><i class="fas fa-home fa-1x"></i>Trang ch???<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown mr-3">
                  <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bars fa-1x"></i>
                  S???n ph???m
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php if (($loai)) {?>
                    <?php foreach ($loai as $key => $row) {?>
                      <a class="dropdown-item" href="./menu.php?MaLoaiHang=<?php echo $row['MaLoaiHang'] ?>"><?php echo $row['TenLoaiHang'] ?></a>
                    <?php } ?>
                    <?php } ?>
                    <!-- <a class="dropdown-item" href="./menuFACE.php">Face</a>
                    <a class="dropdown-item" href="./menuLIP.php">Lip</a>
                    <a class="dropdown-item" href="./menuEYE.php">Eye</a>
                    <a class="dropdown-item" href="./menuCHEEK.php">Cheek</a> -->
                  </div>
                </li>
                <li class="nav-item active">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><i class="fas fa-phone-square-alt fa-1x"></i> 0939 543 909<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active ml-3">
                  <a class="nav-link " href="./khachhang/giohang/danhsach.php" tabindex="-1" aria-disabled="true"><i class="fas fa-shopping-cart fa-1x"></i>Gi??? h??ng</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-1" type="search" placeholder="T??m ki???m" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-1" type="submit">T??m ki???m</button>
              </form>
              <!-- <ul class="navbar-nav ">
              <li class="nav-item">
                    <button type="button" class="btn btn-pink text-pink m-3">
                        <a href="./khachhang/login.php" class="text-pink btn-pink" style="text-decoration: none;">????ng nh???p</a>
                  </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-outline btn-lg color-btn btn-light">
                        <a href="#" class="text-dark" style="text-decoration: none;">????ng k??</a>
                  </button>
                </li>
                </ul> -->
              <ul class="navbar-nav ">
                <li class="nav-item ml-5 ">
                  <a class="nav-link" name ='btn-login' href="./khachhang/login.php">
                    <button class="btn btn-pink text-pink  py-2  ml-0 " style="border: 1px solid pink"  >
                    ????ng nh???p</button>

                </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" name ='btn-register' href="./khachhang/register.php">
                    <button class="btn btn-pink text-pink py-2 ml-0" style="border: 1px solid pink"  >
                    ????ng k?? th??nh vi??n</button>
                  </a>
                </li>
              </ul>
            </div>
        </nav>
    
        <div id="carouselExampleControls" class="carousel slide mt-5 mx-auto container" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100 img-wrap" src="image/banner-3ce-15-1-2018-2.jpg" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100 img-wrap" src="image/banner1.jpg" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100 img-wrap" src="image/banner.jpg" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="row">
          <?php
            $sql_loai=  mysqli_query($connect,"SELECT * FROM LoaiHangHoa WHERE MaLoaiHang = " .$_GET['MaLoaiHang']);
            foreach ($sql_loai as $key => $row){
          ?>
          <div class="col-4 text-center mx-auto">
          <h4 class=" rounded-pill text-dark font-italic mt-5 p-2"  style="background-color: rgb(253, 215, 226);" ><?php echo $row['TenLoaiHang'] ?></h4>
          </div>
          <?php } ?>  
        </div>
        <div class="products container">
            <div class="row text-center mt-5">
              <?php 
                $hanghoa = mysqli_query($connect, "SELECT * FROM HangHoa WHERE MaLoaiHang = " .$_GET['MaLoaiHang']);
                if (($hanghoa)) {?>
                  <?php foreach ($hanghoa as $key => $row){?>
                    <div class="col-sm-3">
                      <div class="product-item  ">
                        <div class="product-top img-wrap">
                          <a href="" class="product-1">
                            <td><img src="./image/<?php echo $row['Hinh'] ?>" alt="" ></td>
                          </a>
                        </div>
                        <div class="product-info m-2">
                          <a href="" style="font-size:14px"><?php echo $row['TenHH'] ?></a>
                          <div class="product-price mt-1"><?php echo number_format  ($row['Gia'],0,",",".") ?>
                          <a href="khachhang/giohang/chitiet.php?MHH=<?php echo $row['MHH'] ?>" ><i class="fas fa-shopping-cart fa-1x btn-outline-dark mt-auto"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>  
                  <?php } ?> 
              <?php } ?>  
            </div>
        </div>
       
    

          <div class="mt-5"></div>
            <div class="row order border-white mt-2 text-gray font-italic p-4" style="background-color:rgb(253, 215, 226)">
              <div class="col-12 text-center">
                  <h3>Jeju Cosmetics</h3>
                  ?????a ch???: 189 ???????ng Hai B?? Tr??ng, ph?????ng B???n Ngh??, qu???n 1, Th??nh ph??? H??? Ch?? Minh
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