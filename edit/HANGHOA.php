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
            if(isset($_GET['MSHH'])){
                require("../connect.php");
                $sql='select * from HANGHOA where MSHH="'.$_GET['MSHH'].'"';
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
    <form method="POST" action="./HANGHOA.php" id="form-edit">
        <div class="form-group" id="input">
            
            <label>Mã số hàng hóa</label>
            <input type="text" name="MSHH" value="<?php if(isset($_GET['MSHH'])){echo $row['MSHH'];} ?>" class="form-control" maxlength="8" placeholder="Mã số hàng hóa">
            
            <label>Mã loại hàng</label>
            <input type="text" name="MALOAIHANG" value="<?php if(isset($_GET['MSHH'])){echo $row['MALOAIHANG'];} ?>" class="form-control" maxlength="60" placeholder="Mã loại hàng">
            <?php 
                if(isset($_POST['luu']) && $_POST['MALOAIHANG']!=""){
                    require("../connect.php");
                    $sql='select * from LOAIHANGHOA where MALOAIHANG="'.$_POST['MALOAIHANG'].'"';
                    $kq=mysqli_query($con,$sql);
                    if (mysqli_num_rows($kq)!=0){
                    } else {
                        $_POST['MALOAIHANG']='';
                    }
                }
            ?>
                
            <label>Tên hàng hóa</label>
            <input type="text" name="TENHH" value="<?php if(isset($_GET['MSHH'])){echo $row['TENHH'];} ?>" class="form-control" maxlength="60" placeholder="Tên hàng hóa">
            
    
            <label>Quy cách</label>
            <input type="text" name="QUYCACH" value="<?php if(isset($_GET['MSHH'])){echo $row['QUYCACH'];} ?>" class="form-control" maxlength="60" placeholder="Quy cách">
            

            <label>Giá</label>
            <input type="number" name="GIA" value="<?php if(isset($_GET['MSHH'])){echo $row['GIA'];} ?>" class="form-control">

            <label>Số lượng</label>
            <input type="number" name="SOLUONGHANG" value="<?php if(isset($_GET['MSHH'])){echo $row['SOLUONGHANG'];} ?>" class="form-control" >

            <label>Ghi chú (Nếu có)</label>
            <input type="text" name="GHICHU" value="<?php if(isset($_GET['MSHH'])){echo $row['GHICHU'];} ?>" class="form-control" maxlength="255" placeholder="Ghi chú">

        </div></br>
        <button type="submit" class="btn btn-primary" name="luu" >Lưu</button>
    </form>
    </div>
    <?php 
        if (isset($_POST['luu']) && $_POST['MSHH']!="" && $_POST['MALOAIHANG']!="" && $_POST['TENHH']!="" && $_POST['QUYCACH']!="" && $_POST['SOLUONGHANG']!="" && $_POST['GIA']!=""){           
            require("../connect.php");
            $sql='select * from HANGHOA where MSHH="'.$_POST['MSHH'].'"';
            $kq=mysqli_query($con,$sql);
            if (mysqli_num_rows($kq)!=0){
                $sql='update HANGHOA set MSHH="'.$_POST['MSHH'].'",MALOAIHANG="'.$_POST['MALOAIHANG'].'",TENHH="'.$_POST['TENHH'].'",QUYCACH="'.$_POST['QUYCACH'].'",GIA="'.$_POST['GIA'].'",SOLUONGHANG="'.$_POST['SOLUONGHANG'].'",GHICHU="'.$_POST['GHICHU'].'" where MSHH="'.$_POST['MSHH'].'"';
                if (mysqli_query($con,$sql)){
                    echo    '<script>
                                    alert("Cập nhật thành công!");
                    </script>';
                }
            } else {
                require("../connect.php");
                $sql='insert into HANGHOA value ("'.$_POST['MSHH'].'","'.$_POST['MALOAIHANG'].'","'.$_POST['TENHH'].'","'.$_POST['QUYCACH'].'","'.$_POST['GIA'].'","'.$_POST['SOLUONGHANG'].'","'.$_POST['GHICHU'].'")'; 
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
