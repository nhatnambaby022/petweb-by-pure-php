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
            if(isset($_GET['SODONDH'])){
                require("../connect.php");
                $sql='select * from DATHANG where SODONDH="'.$_GET['SODONDH'].'"';
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
    <form method="POST" action="./DATHANG.php" id="form-edit">
        <div class="form-group" id="input">
            
            <label>Số đơn đặt hàng</label>
            <input type="text" name="SODONDH" value="<?php if(isset($_GET['SODONDH'])){echo $row['SODONDH'];} ?>" class="form-control" maxlength="8" placeholder="Số đơn đặt hàng">
            
            <label>Mã số nhân viên</label>
            <input type="text" name="MSNV" value="<?php if(isset($_GET['SODONDH'])){echo $row['MSNV'];} ?>" class="form-control" maxlength="8" placeholder="Mã số nhân viên">
            <?php 
                if(isset($_POST['luu']) && $_POST['MSNV']!=""){
                    require("../connect.php");
                    $sql='select * from NHANVIEN where MSNV="'.$_POST['MSNV'].'"';
                    $kq=mysqli_query($con,$sql);
                    if (mysqli_num_rows($kq)!=0){
                    } else {
                        $_POST['MSNV']='';
                    }
                }
            ?>
                
            <label>Mã số khách hàng</label>
            <input type="text" name="MSKH" value="<?php if(isset($_GET['SODONDH'])){echo $row['MSKH'];} ?>" class="form-control" maxlength="60" placeholder="Mã số khách hàng">
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
    
            <label>Ngày đặt hàng</label>
            <input type="date" name="NGAYDH" value="<?php if(isset($_GET['SODONDH'])){echo substr($row['NGAYDH'],0,-9);} ?>" class="form-control" >
            

            <label>Ngày giao hàng</label>
            <input type="date" name="NGAYGH" value="<?php if(isset($_GET['SODONDH'])){echo substr($row['NGAYGH'],0,-9);} ?>" class="form-control" >

            
        </div></br>
        <button type="submit" class="btn btn-primary" name="luu" >Lưu</button>
    </form>
    </div>
    <?php 
        if (isset($_POST['luu']) && $_POST['SODONDH']!="" && $_POST['MSNV']!="" && $_POST['MSKH']!="" && $_POST['NGAYDH']!="" && $_POST['NGAYGH']!="" && $_POST['NGAYGH']>$_POST['NGAYDH']){           
            require("../connect.php");
            $sql='select * from DATHANG where SODONDH="'.$_POST['SODONDH'].'"';
            $kq=mysqli_query($con,$sql);
            if (mysqli_num_rows($kq)!=0){
                $sql='update DATHANG set SODONDH="'.$_POST['SODONDH'].'",MSNV="'.$_POST['MSNV'].'",MSKH="'.$_POST['MSKH'].'",NGAYDH="'.$_POST['NGAYDH'].'",NGAYGH="'.$_POST['NGAYGH'].'" where SODONDH="'.$_POST['SODONDH'].'"';
                if (mysqli_query($con,$sql)){
                    echo    '<script>
                                    alert("Cập nhật thành công!");
                    </script>';
                }
            } else {
                require("../connect.php");
                $sql='insert into DATHANG value ("'.$_POST['SODONDH'].'","'.$_POST['MSNV'].'","'.$_POST['MSKH'].'","'.$_POST['NGAYDH'].'","'.$_POST['NGAYGH'].'")'; 
                if (mysqli_query($con,$sql)){
                    echo    '<script>
                                    alert("Thêm thành công!");
                    </script>';
                }                
            }
        }else {
            if (isset($_POST['luu'])){
                echo    '<script>
                                    alert("Dữ liệu không hợp lệ!");
                        </script>';
            }
        }
    ?>
</body>
