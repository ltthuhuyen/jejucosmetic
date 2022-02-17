<?php
    include ('../config/config.php');       
    //Xủ lý ràng buộc đăng nhập
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: ../login.php");
    }        
    if(isset($_GET['MaLoaiHang'])){
        $MaLoaiHang = $_GET['MaLoaiHang'];
        $sql = "SELECT * FROM loaihanghoa WHERE MaLoaiHang = $MaLoaiHang ";
        $data = mysqli_query($connect,$sql);
        $lhh = mysqli_fetch_assoc($data);
    }
                                    
    if(isset($_POST['submit'])){
        $TenLoaiHang = $_POST["TenLoaiHang"];
        $sql = "UPDATE loaihanghoa SET TenLoaiHang = '$TenLoaiHang' WHERE MaLoaiHang = $MaLoaiHang";
        $query = mysqli_query($connect, $sql);
        if($query){
            header('location: danhsach.php');
        }
        else{
            echo "Error";
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
                <a href ="../ThongTinCaNhan/xem.php" class="text-dark" style="text-decoration: none;"> 
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
                        <h3>Quản Lý Loại Hàng Hóa</h3>
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
                    <a href="../HangHoa/danhsach.php" class="list-group-item list-group-item-action"><i class="fas fa-shopping-bag"></i> Hàng hóa</a>
                    <a href="./danhsach.php" class="list-group-item list-group-item-action"><i class="fab fa-product-hunt"></i> Loại hàng hóa </a>
                    <a href="../DonDatHang/danhsach.php" class="list-group-item list-group-item-action"><i class="far fa-list-alt"></i> Đơn đặt hàng </a>
                    <a href="../logout.php"  name="logout" class="list-group-item list-group-item-action"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                  </div>
            </div>
            <div class="col-9 border">
                <form action="" method="POST">
                    <div class="form-group row mt-5">
                        <label for="TenLoaiHang" class="col-sm-2 col-form-label">Tên loại hàng hóa:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="TenLoaiHang" id="TenLoaiHang" value="<?php echo $lhh['TenLoaiHang'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="submit" name="btn-thoat" class="btn m-5 mx-auto" style="background-color:lightgrey;">
                            <a href ="./danhsach.php" class="text-dark" style="text-decoration:none">
                            Thoát
                            </a>
                        </button>
                        <button type="submit" name="submit" id="submit" class="btn btn-primary m-5 mx-auto">Lưu</button>
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
