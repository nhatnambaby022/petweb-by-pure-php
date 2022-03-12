<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link
          href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
          rel="stylesheet"
        />
        <link rel="stylesheet" href="../css/bootstrap.min.css" />  
        <link rel="stylesheet" href="../css/style.css" />    
        <title>Quản lý bán hàng</title>
        <?php
            if(isset($_GET['MSNV'])){
                require("../connect.php");
                $sql='select * from NHANVIEN where MSNV="'.$_GET['MSNV'].'"';
                $kq=mysqli_query($con,$sql);
                if ($kq){
                    $row=mysqli_fetch_array($kq);
                }
            }
        ?>
    </head>
<body>
    <nav class="nav-bar">
        <a class="shop" href="/webthucung">
            <img class="logo" src="../images/logo.png">
            <label class="shopName">Shop Cún Cưng Quotes</label>
        </a>
        <h1 class="text text-primary" id="title">Edit nhân viên</h1>
        <a class="text-middle btn btn-primary" href="/webthucung/quanlydulieu.php"id="quanly">Trang quản lý dữ liệu</a>
    </nav>
    <div class="container">
    <form method="POST" action="./NHANVIEN.php" id="form-edit">
        <div class="form-group" id="input">
            
            <label>Mã số nhân viên</label>
            <input type="text" name="MSNV" value="<?php if(isset($_GET['MSNV'])){echo $row['MSNV'];} ?>" class="form-control" maxlength="8" placeholder="Mã số nhân viên">
            
            <label>Họ và tên </label>
            <input type="text" name="HOTENNV" value="<?php if(isset($_GET['MSNV'])){echo $row['HOTENNV'];} ?>" class="form-control" maxlength="60" placeholder="Họ và tên ">
            
                
            <label>Chức vụ</label>
            <input type="text" name="CHUCVU" value="<?php if(isset($_GET['MSNV'])){echo $row['CHUCVU'];} ?>" class="form-control" maxlength="60" placeholder="Chức vụ">
            
    
            <label>Địa chỉ</label>
            <input type="text" name="DIACHI" value="<?php if(isset($_GET['MSNV'])){echo $row['DIACHI'];} ?>" class="form-control" maxlength="255" placeholder="Địa chỉ">
            

            <label>Số điện thoại</label>
            <input type="text" name="SODIENTHOAI" value="<?php if(isset($_GET['MSNV'])){echo $row['SODIENTHOAI'];} ?>" class="form-control" maxlength="11" placeholder="Số điện thoại">

            
        </div></br>
        <button type="submit" class="btn btn-primary" name="luu" >Lưu</button>
    </form>
    </div>
    <?php 
        if (isset($_POST['luu']) && $_POST['MSNV']!="" && $_POST['HOTENNV']!="" && $_POST['CHUCVU']!="" && $_POST['DIACHI']!="" && $_POST['SODIENTHOAI']!=""){           
            require("../connect.php");
            $sql='select * from NHANVIEN where MSNV="'.$_POST['MSNV'].'"';
            $kq=mysqli_query($con,$sql);
            if (mysqli_num_rows($kq)!=0){
                $sql='update NHANVIEN set MSNV="'.$_POST['MSNV'].'",HOTENNV="'.$_POST['HOTENNV'].'",CHUCVU="'.$_POST['CHUCVU'].'",DIACHI="'.$_POST['DIACHI'].'",SODIENTHOAI="'.$_POST['SODIENTHOAI'].'" where MSNV="'.$_POST['MSNV'].'"';
                if (mysqli_query($con,$sql)){
                    echo    '<script>
                                    alert("Cập nhật thành công!");
                    </script>';
                }
            } else {
                require("../connect.php");
                $sql='insert into NHANVIEN value ("'.$_POST['MSNV'].'","'.$_POST['HOTENNV'].'","'.$_POST['CHUCVU'].'","'.$_POST['DIACHI'].'","'.$_POST['SODIENTHOAI'].'")'; 
                if (mysqli_query($con,$sql)){
                    echo    '<script>
                                    alert("Thêm nhật thành công!");
                    </script>';
                }                
            }
        }else {
            if (isset($_POST['luu'])){
                echo    '<script>
                                    alert("Dữ liệu không được bỏ trống!");
                        </script>';
            }
        }
    ?>
</body>
