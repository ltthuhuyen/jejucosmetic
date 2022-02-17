<?php
 
    include '../../admin/config/config.php';
    // Xử lý ràng buộc đăng nhập
    session_start();
    if (!isset($_SESSION['TenDangNhap'])) {
        header("location: ./login.php");
        
    } 
    // session_destroy();
    // Ds loại hàng hóa trên menu
    $loai = mysqli_query($connect,"SELECT * FROM LoaiHangHoa ");

    // Lấy thông tin khách hàng đang đăng nhập
    $sql_khachhang="SELECT * FROM KhachHang WHERE TenDangNhap = '".$_SESSION['TenDangNhap']."'";
    $khachhang = mysqli_fetch_assoc($connect->query($sql_khachhang));
    $diachi = mysqli_query($connect, "SELECT * FROM diachi dc join khachhang kh on dc.MSKH = kh.MSKH WHERE TenDangNhap = '".$_SESSION['TenDangNhap']."'");

    // Lấy thông tin hàng hóa trong giỏ hàng
    $sql_hanghoa = "SELECT * FROM HangHoa";
    $query = mysqli_query($connect, $sql_hanghoa );
    if($query){
        $hanghoa = mysqli_fetch_assoc($query);
    }
    $item = [
        'MHH' => $hanghoa['MHH'],
        'TenHH' => $hanghoa['TenHH'],
        // 'Hinh' => $hanghoa['Hinh'],
        'Gia' => $hanghoa['Gia'],
        'SoLuong' => 1
    ];
   
    // Thêm thông tin nhân viên
    if(isset($_POST['btn_payment'])){
      $MSKH = $_POST['MSKH'];
      $MSNV = $_POST['MSNV'];
      $MaDC = $_POST['MaDC'];
      $SĐT = $_POST['SoDienThoai'];
      $TenDangNhap = $_POST['TenDangNhap'];
      $khachhang = "INSERT INTO KhachHang (HoTenKH, SoDienThoai, TenDangNhap, Password)
                   VALUE ('$HoTenKH', '$SĐT' , '$TenDangNhap', $Pass' ) ";
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
                      <a class="dropdown-item" href="../../menu.php?MaLoaiHang=<?php echo $row['MaLoaiHang'] ?>"><?php echo $row['TenLoaiHang'] ?></a>
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
                <h4 class=" rounded-pill text-dark font-italic mt-5 p-2"  style="background-color: rgb(253, 215, 226);" >Thanh Toán</h4>
            </div>
        </div>

        <form class="text-dark pl-3" action="" method="POST">
        <div class="row mt-5">
      
             <div class="col-4 border border-light p-3 ml-5 " style="background-color:white">
                <h2 class="text-center font-italic">Thông tin khách hàng</h2><br/>
                    <div class="from-group mb-3 mx-5">
                        <label for="HoTenKH" class="form-label font-italic">Họ tên</label>
                        <input type="text" class="form-control" name="HoTenKH" id="HoTenKH" value="<?php echo $khachhang['HoTenKH'] ?>" >
                         
                    </div>
                    <div class="from-group mb-3 mx-5">
                        <label for="SoDienThoai" class="form-label font-italic">Số điện thoại</label>
                        <input type="tel" class="form-control" name="SoDienThoai" id="SoDienThoai" value="<?php echo $khachhang['SoDienThoai'] ?>" >
                    </div>
                    <div class="from-group mb-3 mx-5">
                        <label for="HoTenKH" class="form-label font-italic">Tên đăng nhập</label>
                        <input type="text" class="form-control" name="TenDangNhap" id="TenDangNhap" value="<?php echo $_SESSION['TenDangNhap'] ?>"  >
                    </div>
                    <div class="from-group mb-3 mx-5">
                        <label for="DiaChi" class="form-label font-italic">Địa chỉ giao hàng</label>
                          <select class="form-control" id="MSKH" name="MSKH">
                            <?php
                              while($row_diachi = mysqli_fetch_assoc($diachi)){?>
                              <option value="<?php echo $row_diachi['MaDC'] ?>"><?php echo $row_diachi['DiaChi'] ?></option>
                            <?php } ?>
                          </select>
                    </div>
                 
                        <button class="btn btn-pink py-2 m-3 mr-5 float-right" name="btn_payment" style="border: 1px solid pink" type="submit" >
                        <a href="../diachi/them.php" class="text-white" style="text-decoration: none;">Thêm địa chỉ  </a>   
                        </button>
                   
            </div>
            <div class="col-7 ml-5" >
            <h2 class="text-center font-italic mt-2">Đơn hàng</h2><br/>
                <div class="container mt-5">
                    <table class="table table-hover text-center">
                        <thead class="">
                            <tr>
                                <th scope="col">Mã</th>
                                <!-- <th scope="col">Hình</th> -->
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Thành tiền</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(isset($_SESSION['cart'])){
                                $tong = 0;
                            foreach($_SESSION['cart'] as $key => $row){
                                $thanhtien=0;
                                $thanhtien= $row['Gia']*$row['SoLuong'];
                                $tong += $thanhtien ;
                            ?>
                            <tr>
                                <td><?php echo $key ++?></td>
                                <!-- <td><img src="../image/<?php echo $row['Hinh'] ?>" alt="" width="70"></td> -->
                                <td><?php echo $row['TenHH'] ?></td>
                                <td ><?php echo number_format ($row['Gia'],0,",",".") ?></td>
                                <td><?php echo $row['SoLuong'] ?></td>
                                <td><?php echo number_format  ($thanhtien,0,",",".") ?></td>
                                <td><i class="fas fa-trash-alt"></i></td>
                            </tr>
                            <?php } }?>
                        </tbody>
                    </table>
                </div>
            </div>
                    
        </div>
        

        <div class="container mt-5">
            <div class="row mt-5 ">
                <div class="col-8">
                <button class="btn btn-light py-3" type="submit" name="update">CẬP NHẬT GIỎ HÀNG</button>
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
                        <button type="button" name="btn-payment" class="btn text-white float-right p-3" style="background-color: black;"><i class="fas fa-check"></i>  
                           ĐẶT HÀNG
                        </button>
                      </div>
                    </div>
                 </div>
            </div>
        </div>
        </form> 
       
        

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


