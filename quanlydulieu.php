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
        <link rel="stylesheet" href="./css/bootstrap.min.css" />  
        <link rel="stylesheet" href="./css/style.css" />    
        <title>Quản lý bán hàng</title>
        <?php 
            $trang=array("HANGHOA","LOAIHANGHOA","DATHANG","CHITIETDATHANG","DIACHIKH","NHANVIEN","KHACHHANG");
            if (isset($_GET['trang'])) {
                if(in_array($_GET['trang'],$trang)){
                    $_trang=$_GET['trang'];
                } else {
                    $_trang="HANGHOA";
                }
            } else {
                $_trang="HANGHOA";
            }
        ?>
    </head>

    

    <body>
    <?php 
        if(isset($_GET['delete']) && $_GET['delete']="yes"){
            if ($_trang=="CHITIETDATHANG"){
                if (isset($_GET['MSHH']) && isset($_GET['SODONDH'])){
                    require("./connect.php");
                    $sql='delete from '.$_trang.' where MSHH="'.$_GET['MSHH'].'" and SODONDH="'.$_GET['SODONDH'].'"';
                    if (mysqli_query($con,$sql)){
                        echo    '<script>
                                    alert("Xóa thành công!");
                                </script>';
                    } else {
                        echo    '<script>
                                    alert("Xóa thất bại!'.mysqli_connect_error().'");
                                </script>';
                    }
                }
            } else {
                if (isset($_GET['col']) && isset($_GET['val'])){
                    require("./connect.php");
                    $sql='delete from '.$_trang.' where '.$_GET['col'].'="'.$_GET['val'].'"';
                    if (mysqli_query($con,$sql)){
                        echo    '<script>
                                    alert("Xóa thành công!");
                                </script>';
                    } else {
                        echo    '<script>
                                    alert("Xóa thất bại!'.mysqli_connect_error().'");
                                </script>';
                    }
                }
            }
        }
    
    ?>
        <div id="root">
            <nav class="nav-bar">
                <a class="shop" href="./">
                    <img class="logo" src="./images/logo.png">
                    <label class="shopName">Shop Cún Cưng Quotes</label>
                </a>
                
                <a class="text-middle btn btn-primary" id="quanly">Trang quản lý dữ liệu</a>
            </nav>
            <div class="container">
                <div class="Menu">
                    <h4 class="head-MN">Menu</h4> 
                    <p class="item-MN"><a href="./quanlydulieu.php?trang=LOAIHANGHOA">Loại hàng hóa</a></p>
                    <p class="item-MN"><a href="./quanlydulieu.php?trang=HANGHOA">Hàng hóa</a></p>
                    <p class="item-MN"><a href="./quanlydulieu.php?trang=NHANVIEN">Nhân viên</a></p>
                    <p class="item-MN"><a href="./quanlydulieu.php?trang=KHACHHANG">Khách hàng</a></p>
                    <p class="item-MN"><a href="./quanlydulieu.php?trang=DATHANG">Đơn đặt hàng</a></p>
                    <p class="item-MN"><a href="./quanlydulieu.php?trang=CHITIETDATHANG">Chi tiết đặt hàng</a></p>
                    <p class="item-MN"><a href="./quanlydulieu.php?trang=DIACHIKH">Địa chỉ</a></p>
                </div>
                <div class="Item-Manager">
                    <table class="table table-striped table-dark table-bordered ">
                        <?php 
                            require("./connect.php");
                            $sql='DESCRIBE '.$_trang;
                            $kq=mysqli_query($con,$sql);
                        ?>
                        <tr>
                            <?php
                                $i=0; 
                                while ($row_t=mysqli_fetch_array($kq)) {
                                    echo '<th>'.$row_t['Field'].'</th>';
                                    if ($i==0){
                                        $firtcol=$row_t['Field'];
                                    }
                                    $i=1;
                                }
                                echo '<th><a href="./edit/'.$_trang.'.php" class="btn btn-primary">+Insert</a></th>'
                            ?>
                            
                        </tr>
                        <?php
                            $sql='DESCRIBE '.$_trang;
                            $kq=mysqli_query($con,$sql);
                            $n=mysqli_num_rows($kq);
                            $sql='select * from '.$_trang;
                            $kq=mysqli_query($con,$sql);
                            if ($_trang!="CHITIETDATHANG"){
                                while ($row=mysqli_fetch_array($kq)){
                                    echo '<tr>';
                                    for($i=0;$i<$n;$i++){
                                        echo '<td>'.$row[$i].'</td>';
                                    }
                        ?>
                                <td>
                                    <a class="text-primary" href="./edit/<?php echo $_trang.'.php?'.$firtcol.'='.$row[0]; ?>">EDIT</a> </br>
                                    <a class="text-danger"href="./quanlydulieu.php?trang=<?php echo $_trang.'&delete=yes'.'&col='.$firtcol.'&val='.$row[0];?>" onclick="return confirm('Bạn có muốn xóa không?')">DELETE</a>
                                </td>
                        <?php
                                    echo '</tr>';
                                }
                            } else {
                                while ($row=mysqli_fetch_array($kq)){
                                    echo '<tr>';
                                    for($i=0;$i<$n;$i++){
                                        echo '<td>'.$row[$i].'</td>';
                                    }
                        ?>
                                <td>
                                    <a class="text-primary" href="./edit/CHITIETDATHANG.php?MSHH=<?php echo $row['MSHH'].'&SODONDH='.$row['SODONDH']; ?>">EDIT</a> </br>
                                    <a class="text-danger"href="./quanlydulieu.php?trang=<?php echo $_trang.'&delete=yes&MSHH='.$row['MSHH'].'&SODONDH='.$row['SODONDH'];?>" onclick="return confirm('Bạn có muốn xóa không?')">DELETE</a>
                                </td>
                        <?php
                                    echo '</tr>';
                                }

                            }
                        
                        ?>
                    </table>            
                </div>
            </div>
        </div>
    </body>
</html>