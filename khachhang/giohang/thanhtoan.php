<script>
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
    $query_khachhang = mysqli_query($connect,$sql_khachhang);
    $khachhang = mysqli_fetch_assoc($query_khachhang);
    $diachi = mysqli_query($connect, "SELECT * FROM diachi dc join khachhang kh on dc.MSKH = kh.MSKH WHERE TenDangNhap = '".$_SESSION['TenDangNhap']."'");

    
    // Thêm thông tin khách hàng vào đơn đặt hàng
    if(isset($_SESSION['TenDangNhap'])){
      $TenDangNhap = $_SESSION['TenDangNhap'];
    }
 
    if(isset($_POST['btn_payment'])){
        $MSKH = $khachhang['MSKH'];
        $MaDC = $_POST['MaDC'];
        $sql_dathang = "INSERT INTO DatHang ( MSKH, MaDC )
                    VALUES ( '$MSKH', '$MaDC' ) ";
                  
        $dathang = mysqli_query($connect,$sql_dathang);
        if ($dathang) {
          $SoDonDH = mysqli_insert_id($connect);
          if(isset($_SESSION["cart"])){
            foreach($_SESSION["cart"] as $row){
              $thanhtien = $row['Gia']*$row['SoLuong'];
              $sql_chitietdh = "INSERT INTO ChiTietDatHang ( SoDonDH,	MHH,	SoLuong,	GiaDatHang ) 
                              VALUES ( '$SoDonDH',	'$row[MHH]',	'$row[SoLuong]',	'$thanhtien' )";
              mysqli_query($connect,$sql_chitietdh);
            }
          }
          ?>
          alert("<?php echo "Đặt hàng thành công"; ?>");
          <?php
           unset($_SESSION['cart']);  
        }
      }   
    
 ?>
 </script>
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
        .btn-pink{
            background-color: #e83e8c;
            color: white;
        }
        .font {
            font-family: 'Satisfy', cursive;
            font-size: 35px;
        }
    
      </style>

</head>
<body>
    <div class="container-fluid p-0">
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
                <a class="nav-link " href="./danhsach.php" tabindex="-1" aria-disabled="true"><i class="fas fa-shopping-cart fa-1x"></i>Giỏ hàng</a>
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
                <h4 class=" rounded-pill text-dark font-italic mt-5 p-2"  style="background-color: rgb(253, 215, 226);" >Thanh Toán</h4>
            </div>
        </div>

      
        <div class="row mt-5">
          <div class="col-3 text-center">

          </div>
            <div class="col-6 border border-light p-3 m-3 " style="background-color:white">
                <h2 class="text-center font-italic mt-3">Thông tin khách hàng</h2><br/>
                <form class="text-dark mx-5" action="" method="POST">
                    <div class="from-group mb-3 mx-5">
                        <label for="MSKH" class="form-label font-italic">Họ tên</label>
                          <!-- <select class="form-control" id="MSKH" name="MSKH">
                            <?php
                              while($row_khachhang = mysqli_fetch_assoc($khachhang)){?>
                              <option value="<?php echo $row_khachhang['MSKH'] ?>"><?php echo $row_khachhang['HoTenKH'] ?></option>
                            <?php } ?>
                          </select>  -->
                          <input type="text" class="form-control" name="HoTenKH" id="HoTenKH" value="<?=$khachhang['HoTenKH'] ?>">      
                        
                    </div>
                
    
                    <div class="from-group mb-3 mx-5">
                        <label for="DiaChi" class="form-label font-italic">Địa chỉ giao hàng</label>
                          <select class="form-control" id="MaDC" name="MaDC">
                            <?php
                              while($row_diachi = mysqli_fetch_assoc($diachi)){?>
                              <option value="<?php echo $row_diachi['MaDC'] ?>"><?php echo $row_diachi['DiaChi'] ?></option>
                            <?php } ?>
                          </select>
                    </div>
                    <div>
                      <button class="btn btn-pink py-2 m-3 mr-5 mx-5 "style="border: 1px solid pink" type="submit" >
                        <a href="../diachi/them.php" class="text-white" style="text-decoration: none;">Thêm địa chỉ  </a>   
                      </button>
                    </div>

                     
                        <div>
                          <button type="submit" name="btn_payment" class="btn text-white float-right py-3 mx-5" style="background-color: black;"><i class="fas fa-check"></i>  
                            ĐẶT HÀNG
                          </button>
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


