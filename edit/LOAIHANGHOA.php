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
            if(isset($_GET['MALOAIHANG'])){
                require("../connect.php");
                $sql='select * from LOAIHANGHOA where MALOAIHANG="'.$_GET['MALOAIHANG'].'"';
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
        <h1 class="text text-light" id="title">Edit khách hàng</h1>
        <a class="text-middle btn btn-primary" href="/webthucung/quanlydulieu.php"id="quanly">Trang quản lý dữ liệu</a>
    </nav>
    <div class="container">
    <form method="POST" action="./LOAIHANGHOA.php" id="form-edit">
        <div class="form-group" id="input">
            
            <label>Mã loại hàng</label>
            <input type="text" name="MALOAIHANG" value="<?php if(isset($_GET['MALOAIHANG'])){echo $row['MALOAIHANG'];} ?>" class="form-control" maxlength="8" placeholder="Mã loại hàng">
            
            <label>Tên loại hàng</label>
            <input type="text" name="TENLOAIHANG" value="<?php if(isset($_GET['MALOAIHANG'])){echo $row['TENLOAIHANG'];} ?>" class="form-control" maxlength="60" placeholder="Tên loại hàng">
            
              
        </div></br>
        <button type="submit" class="btn btn-primary" name="luu" >Lưu</button>
    </form>
    </div>
    <?php 
        if (isset($_POST['luu']) && $_POST['MALOAIHANG']!="" && $_POST['TENLOAIHANG']!=""){           
            require("../connect.php");
            $sql='select * from LOAIHANGHOA where MALOAIHANG="'.$_POST['MALOAIHANG'].'"';
            $kq=mysqli_query($con,$sql);
            if (mysqli_num_rows($kq)!=0){
                $sql='update LOAIHANGHOA set MALOAIHANG="'.$_POST['MALOAIHANG'].'",TENLOAIHANG="'.$_POST['TENLOAIHANG'].'" where MALOAIHANG="'.$_POST['MALOAIHANG'].'"';
                if (mysqli_query($con,$sql)){
                    echo    '<script>
                                    alert("Cập nhật thành công!");
                    </script>';
                }
            } else {
                require("../connect.php");
                $sql='insert into LOAIHANGHOA value ("'.$_POST['MALOAIHANG'].'","'.$_POST['TENLOAIHANG'].'")'; 
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
