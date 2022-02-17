<?php
    include ('../config/config.php');
    // Xủ lý ràng buộc đăng nhập
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: ../login.php");
    }
    // Xem chi tiết từng đơn đặt hàng
    if(isset($_GET['SoDonDH'])){
        $SoDonDH = $_GET['SoDonDH'];
        $chitiet_dh=  mysqli_query($connect,"SELECT * FROM DatHang dh join  ChiTietDatHang ctdh on dh.SoDonDH = ctdh.SoDonDH join HangHoa hh on ctdh.MHH = hh.MHH WHERE ctdh.SoDonDH ='".$SoDonDH."' ");
    }
    // Xử lý trạng thái đơn hàng
    if(isset($_POST['TrangThaiDH'])){        
        $TrangThaiDH = $_POST['TrangThaiDH'];               
        mysqli_query($connect, "UPDATE DatHang SET TrangThaiDH = '$TrangThaiDH' WHERE SoDonDH = '".$SoDonDH."'");
        header('location: danhsach.php');
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
                        <th>STT</th>
                        <th>Đơn đặt hàng</th>
                        <th>Tên hàng hóa</th>
                        <th>Số lượng </th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>     
                <tbody>
                    <?php
                    if(isset($chitiet_dh)){
                        $tong = 0;
                        $key = 1;
                    foreach ($chitiet_dh as $key => $row) {
                        $key +=1;
                        $tong += $row['SoLuong'] * $row['Gia'] ?>
                    <tr class="text-center">
                        <td ><?php echo $key ?></td>
                        <td ><?php echo $row['SoDonDH'] ?></td>
                        <td ><?php echo $row['TenHH'] ?></td>
                        <td ><?php echo $row['SoLuong'] ?></td>
                        <td ><?php echo number_format  ($row['Gia'],0,",",".") ?></td>
                        <td ><?php echo number_format  ($row['SoLuong'] * $row['Gia'],0,",",".") ?></td>
                    </tr>  
                    <?php
                    }}
                    ?>
                     <tr class="text-center">
                        <td colspan="6" class="bg-light">  
                            <div class="col-12"><h5>Tổng tiền: <?php echo number_format  ($tong,0,",",".") ?></h5></div>
                            <div class="btn-group m-3" role="group" aria-label="Basic mixed styles example">
                               
                               <form action="" method="POST" required = "requỉed">
                                   <select class="form-control" name="TrangThaiDH">
                                       <option value="0"> Chưa xác nhận</option>
                                       <option value="1"> Đã xác nhận</option>
                                       <option value="2"> Đã giao hàng</option>
                                       <option value="3"> Hủy đơn </option>
                                   </select>    
                                       
                           </div>
                                   <button type="submit" name='btn-luu' class="btn btn-outline  navbar-bg btn-light ">Cập nhật</button>                          
                               </form>
                        </td>
                
                    </tr>  
                
                   
                            
                   
                      
                   
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
