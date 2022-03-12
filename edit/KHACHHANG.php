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
            if(isset($_GET['MSKH'])){
                require("../connect.php");
                $sql='select * from KHACHHANG where MSKH="'.$_GET['MSKH'].'"';
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
        <h1 class="text text-primary" id="title">Edit khách hàng</h1>
        <a class="text-middle btn btn-primary" href="/webthucung/quanlydulieu.php"id="quanly">Trang quản lý dữ liệu</a>
    </nav>
    <div class="container">
    <form method="POST" action="./KHACHHANG.php" id="form-edit">
        <div class="form-group" id="input">
            
            <label>Mã số khách hàng</label>
            <input type="text" name="MSKH" value="<?php if(isset($_GET['MSKH'])){echo $row['MSKH'];} ?>" class="form-control" maxlength="8" placeholder="Mã số khách hàng">
            
            <label>Họ và tên </label>
            <input type="text" name="HOTENKH" value="<?php if(isset($_GET['MSKH'])){echo $row['HOTENKH'];} ?>" class="form-control" maxlength="60" placeholder="Họ và tên ">
            
                
            <label>Tên công ty</label>
            <input type="text" name="TENCONGTY" value="<?php if(isset($_GET['MSKH'])){echo $row['TENCONGTY'];} ?>" class="form-control" maxlength="60" placeholder="Tên công ty">
            
    
            <label>Số điện thoại</label>
            <input type="text" name="SODIENTHOAI" value="<?php if(isset($_GET['MSKH'])){echo $row['SODIENTHOAI'];} ?>" class="form-control" maxlength="11" placeholder="Số điện thoại">
            

            <label>Email</label>
            <input type="email" name="EMAIL" value="<?php if(isset($_GET['MSKH'])){echo $row['EMAIL'];} ?>" class="form-control" maxlength="255" placeholder="Email">

            
        </div></br>
        <button type="submit" class="btn btn-primary" name="luu" >Lưu</button>
    </form>
    </div>
    <?php 
        if (isset($_POST['luu']) && $_POST['MSKH']!="" && $_POST['HOTENKH']!="" && $_POST['TENCONGTY']!="" && $_POST['SODIENTHOAI']!="" && $_POST['EMAIL']!=""){           
            require("../connect.php");
            $sql='select * from KHACHHANG where MSKH="'.$_POST['MSKH'].'"';
            $kq=mysqli_query($con,$sql);
            if (mysqli_num_rows($kq)!=0){
                $sql='update KHACHHANG set MSKH="'.$_POST['MSKH'].'",HOTENKH="'.$_POST['HOTENKH'].'",TENCONGTY="'.$_POST['TENCONGTY'].'",SODIENTHOAI="'.$_POST['SODIENTHOAI'].'",EMAIL="'.$_POST['EMAIL'].'" where MSKH="'.$_POST['MSKH'].'"';
                if (mysqli_query($con,$sql)){
                    echo    '<script>
                                    alert("Cập nhật thành công!");
                    </script>';
                }
            } else {
                require("../connect.php");
                $sql='insert into KHACHHANG value ("'.$_POST['MSKH'].'","'.$_POST['HOTENKH'].'","'.$_POST['TENCONGTY'].'","'.$_POST['SODIENTHOAI'].'","'.$_POST['EMAIL'].'")'; 
                if (mysqli_query($con,$sql)){
                    echo    '<script>
                                    alert("Thêm thành công!");
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
