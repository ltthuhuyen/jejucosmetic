<?php
    include ('../config/config.php');
    // Xủ lý ràng buộc đăng nhập
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: ../login.php");
    }
    // Danh sách đơn hàng
    $ds_ddh =  mysqli_query($connect,"SELECT * FROM  KhachHang kh join DatHang dh on dh.MSKH = kh.MSKH join DiaChi dc on dc.MaDC = dh.MaDC ");
    // Xử lý trạng thái đơn hàng
    
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
                        <h3>Quản Lý Đơn Đặt Hàng</h3>
                    </div>
                    <div class="col-2">
                        <!-- <button type="button" class="btn btn-light text-gray"><a href="./them.php"> <i class="fas fa-plus-circle "></i> Thêm</a></button> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row ml-2">
            <div class="col-3 mt-5" >
               
            </div>
    
            <div class="col-9">
           
            <?php $count_hanghoa ?> 
            </div>
        </div>
        <div class="row mx-auto mt-5">
            <div class="col-3 ">
                <div class="list-group">
                    <h5 class="list-group-item list-group-item-action text-white" style="background-color:black">
                  Danh Mục
                    </h5>
                    <a href="../HangHoa/danhsach.php" class="list-group-item list-group-item-action"><i class="fas fa-shopping-bag"></i> Hàng hóa</a>
                    <a href="../LoaiHangHoa/danhsach.php" class="list-group-item list-group-item-action"><i class="fab fa-product-hunt"></i> Loại hàng hóa </a>
                    <a href="./danhsach.php" class="list-group-item list-group-item-action"><i class="far fa-list-alt"></i> Đơn đặt hàng </a>
                    <a href="../logout.php"  name="logout" class="list-group-item list-group-item-action"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                
                </div>
            </div>
            <div class="col-9">
               <table class="table table-bordered">
               <thead>
                    <tr class=" text-center text-white font-italic" style="background-color: black">
                        <th>Đơn đặt hàng</th>
                        <th>Tên khách hàng </th>
                        <th>Địa chỉ</th>
                        <th>Điện thoại</th>  
                        <th>Trạng thái</th>  
                        <th>Hành động</th>
                    </tr>
                </thead>     
                <tbody>
                    <?php if(isset($ds_ddh)){
                    foreach ($ds_ddh as $key => $row) {?>
                    <tr class="text-center">
                        <td ><?php echo $row['SoDonDH'] ?></td>
                        <td ><?php echo $row['HoTenKH'] ?></td>
                        <td ><?php echo $row['DiaChi'] ?></td>
                        <td ><?php echo $row['SoDienThoai'] ?></td>
                        <td>
                            <?php if($row['TrangThaiDH'] == 0) { ?>
                                <span class="label bg-warning text-white p-1"> Chưa xác nhận </span>
                            <?php } elseif($row['TrangThaiDH'] == 1) { ?>
                                <span class="label bg-info text-white p-1"> Đã xác nhận </span>
                            <?php } elseif($row['TrangThaiDH'] == 2) { ?>
                                <span class="label bg-success text-white p-1">Đã giao hàng </span>
                            <?php } elseif($row['TrangThaiDH'] == 3) { ?>
                                <span class="label bg-danger text-white p-1"> Hủy đơn </span>
                                <?php } ?>
                            </td>
                        <td >
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <a href = './xem.php?SoDonDH=<?php echo $row['SoDonDH'] ?>' class="btn btn-light" ><i class="far fa-eye"></i></a>
                            </div>
                            
                            
                        </td>
                    </tr>  
                    <?php
                    }}
                    ?>
                </tbody>                      
                </table>
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