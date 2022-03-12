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
            if(isset($_GET['MSHH']) && isset($_GET['SODONDH'])){
                require("../connect.php");
                $sql='select * from HANGHOA where MSHH="'.$_GET['MSHH'].'"';
                    $kq=mysqli_query($con,$sql);
                    if (mysqli_num_rows($kq)!=0){
                        $row_t=mysqli_fetch_array($kq);
                        $soluonghang=$row_t['SOLUONGHANG'];
                        $gia=$row_t['GIA'];
                    } 
                $sql='select * from CHITIETDATHANG where SODONDH="'.$_GET['SODONDH'].'" and MSHH="'.$_GET['MSHH'].'"';
                $kq=mysqli_query($con,$sql);
                if ($kq){
                    $row=mysqli_fetch_array($kq);
                    $soluong=$row['SOLUONG'];
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
    <form method="POST" action="./CHITIETDATHANG.php" id="form-edit">
        <div class="form-group" id="input">
            
            <label>Mã số hàng hóa</label>
            <input type="text" name="MSHH" value="<?php if(isset($_GET['MSHH']) && isset($_GET['SODONDH'])){echo $row['MSHH'];} ?>" class="form-control" maxlength="8" placeholder="Mã hàng hóa">
            <?php 
                if(isset($_POST['luu']) && $_POST['MSHH']!=""){
                    require("../connect.php");
                    $sql='select * from HANGHOA where MSHH="'.$_POST['MSHH'].'"';
                    $kq=mysqli_query($con,$sql);
                    if (mysqli_num_rows($kq)!=0){
                        $row_s=mysqli_fetch_array($kq);
                        $soluonghang=$row_s['SOLUONGHANG'];
                        $gia=$row_s['GIA'];
                    } else {
                        $_POST['MSHH']='';
                    }
                }
            ?>

            <label>Số đơn đặt hàng</label>
            <input type="text" name="SODONDH" value="<?php if(isset($_GET['MSHH']) && isset($_GET['SODONDH'])){echo $row['SODONDH'];} ?>" class="form-control" maxlength="8" placeholder="Số đơn đặt hàng ">
            <?php 
                if(isset($_POST['luu']) && $_POST['SODONDH']!=""){
                    require("../connect.php");
                    $sql='select * from CHITIETDATHANG where SODONDH="'.$_POST['SODONDH'].'" and MSHH="'.$_POST['MSHH'].'"';
                    $kq=mysqli_query($con,$sql);
                    if (mysqli_num_rows($kq)!=0){
                        $row=mysqli_fetch_array($kq);
                        $soluong=$row['SOLUONG'];
                    } else {
                        $_POST['SODONDH']='';
                    }
                }
            ?>
            

            <label>Số lượng</label>
            <input type="number" name="SOLUONG" min="0" max="<?php if ($soluonghang){ echo $soluonghang;}?>" value="<?php if(isset($_GET['MSHH']) && isset($_GET['SODONDH'])){echo $row['SOLUONG'];} ?>" class="form-control">
            

            <label>Giảm giá (Nếu có)</label>
            <input type="number" name="GIAMGIA" min="0" max="<?php echo $soluong*$gia;?>" value="<?php if(isset($_GET['MSHH']) && isset($_GET['SODONDH'])){echo $row['GIAMGIA'];} ?>" class="form-control" >

            
        </div></br>
        <button type="submit" class="btn btn-primary" name="luu" >Lưu</button>
    </form>
    </div>
    <?php 
        if (isset($_POST['luu']) && $_POST['MSHH']!="" && $_POST['SODONDH']!="" && $_POST['SOLUONG']!="" && $_POST['SOLUONG']<=$soluonghang){           
            require("../connect.php");
            $sql='select * from CHITIETDATHANG where SODONDH="'.$_POST['SODONDH'].'" and MSHH="'.$_POST['MSHH'].'"';
            $kq=mysqli_query($con,$sql);
            if (mysqli_num_rows($kq)!=0){
                $sql='update CHITIETDATHANG set MSHH="'.$_POST['MSHH'].'",SODONDH="'.$_POST['SODONDH'].'",SOLUONG="'.$_POST['SOLUONG'].'",GIADATHANG="'.$_POST['SOLUONG']*$gia.'",GIAMGIA="'.$_POST['GIAMGIA'].'" where MSHH="'.$_POST['MSHH'].'" and SODONDH="'.$_POST['SODONDH'].'"';
                if (mysqli_query($con,$sql)){
                    
                    $sql_t='update HANGHOA set SOLUONGHANG="'.($soluonghang-$_POST['SOLUONG']+$soluong).'" where MSHH="'.$_POST['MSHH'].'"';
                    if (mysqli_query($con,$sql_t)){
                        echo    '<script>
                                    alert("Cập nhật thành công!");
                        </script>';
                    }   
                }
            } else {
                require("../connect.php");
                $sql='insert into CHITIETDATHANG value ("'.$_POST['MSHH'].'","'.$_POST['SODONDH'].'","'.$_POST['SOLUONG'].'","'.$_POST['SOLUONG']*$gia.'","'.$_POST['GIAMGIA'].'")'; 
                if (mysqli_query($con,$sql)){
                    $sql_t='update HANGHOA set SOLUONGHANG="'.($soluonghang-$_POST['SOLUONG']).'" where MSHH="'.$_POST['MSHH'].'"';
                    if (mysqli_query($con,$sql_t)){
                        echo    '<script>
                                    alert("Thêm thành công!");
                        </script>';
                    }
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
