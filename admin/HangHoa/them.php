<?php
include ('../config/config.php');
    // Xủ lý ràng buộc đăng nhập
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: ../login.php");
    }
    // Lấy tất cả các loại hàng hóa
    $sql_loai = "SELECT * FROM LoaiHangHoa";
    $query_loai = mysqli_query($connect, $sql_loai);
    $hanghoa = mysqli_query($connect, "SELECT * FROM HangHoa hh join LoaiHangHoa loai on hh.MaLoaiHang = loai.MaLoaiHang");
    // Thêm hàng hóa
    if(isset($_POST['submit'])){
    $MaLoaiHang = $_POST["MaLoaiHang"];
    $TenHH = $_POST["TenHH"];
    $Hinh = $_FILES["Hinh"];
    $QuyCach = $_POST["QuyCach"];
    $Gia = $_POST['Gia'];
    $GiaKM = $_POST["GiaKM"];
    $SoLuongHang = $_POST['SoLuongHang'];
    $MoTa = $_POST['MoTa'];
    
    // Thêm hình ảnh
    if(isset($_FILES['Hinh'])){
        $file = $_FILES['Hinh'];
        $file_name = $file['name'];
        move_uploaded_file($file['tmp_name'], '../../image/'.$file_name);

    }else{
        echo "Lỗi";
        $file_name = '';
    }

    if(isset($_FILES['Hinhs'])){
        $files = $_FILES['Hinhs'];
        $file_names = $files['name'];
        foreach($file_names as $key => $row){
            move_uploaded_file($files['tmp_name'][$key], '../../image/'.$row);
        }
    }


    $sql = "INSERT INTO HangHoa (MaLoaiHang, TenHH, Hinh, QuyCach, Gia, GiaKM, SoLuongHang, MoTa) 
                VALUES ('$MaLoaiHang' , '$TenHH' , '$file_name', '$QuyCach' , '$Gia', '$GiaKM', '$SoLuongHang', '$MoTa')";

    $query = mysqli_query($connect, $sql);
    $MHH = mysqli_insert_id($connect);
    foreach($file_names as $key => $row){
        mysqli_query($connect, "INSERT INTO HinhHangHoa(MHH, Hinh) VALUES ('$MHH', '$row')");
    }
    if($query){
        header('location: danhsach.php');
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
                <a href ="../ThongTincaNhan/xem.php" class="text-dark" style="text-decoration: none;"> 
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
                        <button type="button" class="btn btn-light text-gray"><a href="them.php"><i class="fas fa-plus-circle "></i> Thêm</a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-auto mt-5">
            <div class="col-3 ">
                <div class="list-group">
                    <h5 class="list-group-item list-group-item-action text-white"  style="background-color: black">
                  Danh Mục
                    </h5>
                    <a href="./danhsach.php" class="list-group-item list-group-item-action"><i class="fas fa-shopping-bag"></i> Hàng hóa</a>
                    <a href="../LoaiHangHoa/danhsach.php" class="list-group-item list-group-item-action"><i class="fab fa-product-hunt"></i> Loại hàng hóa </a>
                    <a href="../DonDatHang/danhsach.php" class="list-group-item list-group-item-action"><i class="far fa-list-alt"></i> Đơn đặt hàng </a>
                    <a href="../logout.php"  name="logout" class="list-group-item list-group-item-action"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                  </div>
            </div>
            <div class="col-9 border">
                <h4 class="text-center font-italic p-3 ">Thông tin hàng hóa</h4>
                <form action="them.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="MaLoaiHang" class="col-sm-2 col-form-label">Loại hàng hóa:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="MaLoaiHang" name="MaLoaiHang">
                            <?php
                                while($row_loai = mysqli_fetch_assoc($query_loai)){?>
                                    <option value="<?php echo $row_loai['MaLoaiHang'] ?>"><?php echo $row_loai['TenLoaiHang'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="TenHH" class="col-sm-2 col-form-label">Tên hàng hóa:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="TenHH" name="TenHH">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="QuyCach" class="col-sm-2 col-form-label">Quy cách:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="QuyCach" name="QuyCach">
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label for="Gia" class="col-sm-2 col-form-label">Giá:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="Gia" name="Gia">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="GiaKM" class="col-sm-2 col-form-label">Giá khuyến mãi:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="GiaKM" name="GiaKM">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="SoLuongHang" class="col-sm-2 col-form-label">Số lượng:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="SoLuongHang" name="SoLuongHang">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">Hình ảnh:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" name="Hinh" id="Hinh">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">Hình ảnh mô tả:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" name="Hinhs[]" id="Hinh" multiple="multiple">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="MoTa" class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                          <textarea rows="10" class="form-control" id="MoTa" name="MoTa"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="submit" name="btn-thoat" class="btn m-5 mx-auto" style="background-color:lightgrey;">
                            <a href ="./danhsach.php" class="text-dark" style="text-decoration:none">
                            Thoát
                            </a>
                        </button>
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