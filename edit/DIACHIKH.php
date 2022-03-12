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
            if(isset($_GET['MADC'])){
                require("../connect.php");
                $sql='select * from DIACHIKH where MADC="'.$_GET['MADC'].'"';
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
    <form method="POST" action="./DIACHIKH.php" id="form-edit">
        <div class="form-group" id="input">
            
            <label>Mã địa chỉ</label>
            <input type="text" name="MADC" value="<?php if(isset($_GET['MADC'])){echo $row['MADC'];} ?>" class="form-control" maxlength="8" placeholder="Mã địa chỉ">
            
            <label>Mã số khách hàng</label>
            <input type="text" name="MSKH" value="<?php if(isset($_GET['MADC'])){echo $row['MSKH'];} ?>" class="form-control" maxlength="8" placeholder="Mã số khách hàng">
            <?php 
                if(isset($_POST['luu']) && $_POST['MSKH']!=""){
                    require("../connect.php");
                    $sql='select * from KHACHHANG where MSKH="'.$_POST['MSKH'].'"';
                    $kq=mysqli_query($con,$sql);
                    if (mysqli_num_rows($kq)!=0){
                    } else {
                        $_POST['MSKH']='';
                    }
                }
            ?>
                
            <label>Địa chỉ</label>
            <input type="text" name="DIACHI" value="<?php if(isset($_GET['MADC'])){echo $row['DIACHI'];} ?>" class="form-control" maxlength="255" placeholder="Địa chỉ">
            
        </div></br>
        <button type="submit" class="btn btn-primary" name="luu" >Lưu</button>
    </form>
    </div>
    <?php 
        if (isset($_POST['luu']) && $_POST['MADC']!="" && $_POST['MSKH']!="" && $_POST['DIACHI']!=""){           
            require("../connect.php");
            $sql='select * from DIACHIKH where MADC="'.$_POST['MADC'].'"';
            $kq=mysqli_query($con,$sql);
            if (mysqli_num_rows($kq)!=0){
                $sql='update DIACHIKH set MADC="'.$_POST['MADC'].'",MSKH="'.$_POST['MSKH'].'",DIACHI="'.$_POST['DIACHI'].'" where MADC="'.$_POST['MADC'].'"';
                if (mysqli_query($con,$sql)){
                    echo    '<script>
                                    alert("Cập nhật thành công!");
                    </script>';
                }
            } else {
                require("../connect.php");
                $sql='insert into DIACHIKH value ("'.$_POST['MADC'].'","'.$_POST['MSKH'].'","'.$_POST['DIACHI'].'")'; 
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
