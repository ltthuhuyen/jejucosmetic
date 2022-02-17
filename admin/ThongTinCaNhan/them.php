<?php
    include ('../config/config.php');
    //Xủ lý ràng buộc đăng nhập
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: ../login.php");
    }
    // Lấy thông tin tài khoản nhân viên đang đăng nhập
    $sql_taikhoan="SELECT * FROM TaiKhoan WHERE username = '".$_SESSION['username']."'";
    $taikhoan = mysqli_query($connect,$sql_taikhoan);
    
    // Thêm thông tin nhân viên
    if(isset($_POST['submit'])){
        $id_taikhoan = $_POST["id_taikhoan"];
        $HoTenNV = $_POST["HoTenNV"];
        $ChucVu = $_POST["ChucVu"];
        $DiaChi = $_POST['DiaChi'];
        $SoDienThoai = $_POST['SoDienThoai'];
        $sql_nhanvien = "INSERT INTO NhanVien (id_taikhoan, HoTenNV , ChucVu, DiaChi, SoDienThoai) 
                    VALUES ('$id_taikhoan' , '$HoTenNV ' , '$ChucVu' , '$DiaChi' , '$SoDienThoai')";
        if (mysqli_query($connect,$sql_nhanvien)) 
        {
            header('location: danhsach.php');
        } else {
        echo "Error updating record: " . $connect->error;
        }
        
        $connect->close();
        }
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Saira+Semi+Condensed:wght@200&family=Satisfy&display=swap" rel="stylesheet">
    <style>
         .font {
        font-family: 'Satisfy', cursive;
        font-size: 35px;
    }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row ml-2">
            <div class="col-2 mt-5" >
                <div class="mt-3 font">Jeju Cosmetics</div>
                <i class="fas fa-user"></i>
                <a href ="../thongtin.php" class="text-dark" style="text-decoration: none;"> 
                    <?php  
                        if (!isset($_SESSION['username'])) {
                            header("location: ../login.php");
                        }else{
                            echo $_SESSION['username'];
                        }
                    ?>
                </a>
            </div>
    
            <div class="col-10">
                <div class="row border border-dark rounded-pill font-italic mt-5 p-4">
                    <div class="col-4 mx-auto">
                        <h3>Quản Lý Hàng Hóa</h3>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-light text-gray"><a href="./them.php"> <i class="fas fa-plus-circle "></i> Thêm</a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-auto mt-5">
            <div class="col-3 ">
                <div class="list-group">
                    <h5 class="list-group-item list-group-item-action text-white" style="background-color:black">
                  Danh Mục
                    </h5>
                    <a href="./HangHoa/danhsach.php" class="list-group-item list-group-item-action"><i class="fas fa-shopping-bag"></i> Hàng hóa</a>
                    <a href="./LoaiHangHoa/danhsach.php" class="list-group-item list-group-item-action"><i class="fab fa-product-hunt"></i> Loại hàng hóa </a>
                    <a href="../DonDatHang/danhsach.php" class="list-group-item list-group-item-action"><i class="far fa-list-alt"></i> Đơn đặt hàng </a>
                    <a href="../logout.php"  name="logout" class="list-group-item list-group-item-action"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                
                </div>
            </div>
            <div class="col-9">
            <h4 class="text-center font-italic p-3 ">Thông tin cá nhân</h4>
                <form action="" method="POST" >
                   
                    <div class="form-group row">
                        <label for="HoTenNV" class="col-sm-2 col-form-label">Họ tên nhân viên:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="HoTenNV" name="HoTenNV" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="QuyCach" class="col-sm-2 col-form-label">Tên đăng nhập:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_taikhoan" name="id_taikhoan">
                                <?php
                                while($row_taikhoan = mysqli_fetch_assoc($taikhoan)){?>
                                <option value="<?php echo $row_taikhoan['id_taikhoan'] ?>"><?php echo $row_taikhoan['username'] ?></option>
                                <?php } ?>  
                            </select>
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <label for="ChucVu" class="col-sm-2 col-form-label">Chức vụ</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="ChucVu" name="ChucVu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="DiaChi" class="col-sm-2 col-form-label">Địa chỉ</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="DiaChi" name="DiaChi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="SoDienThoai" class="col-sm-2 col-form-label">Số điện thoại</label>
                        <div class="col-sm-10">
                          <input type="tel" class="form-control" id="SoDienThoai" name="SoDienThoai">
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="submit" name="btn-thoat" class="btn m-5 mx-auto" style="background-color:lightgrey;">Thoát</button>
                        <button type="submit" name="submit" class="btn btn-primary m-5 mx-auto">Lưu</button>
                    </div>
                </form>
               
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