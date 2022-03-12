<?php ob_start(); ?>
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
            session_start();
            
            $trang=array("hanghoa","giohang","dathang");
            if (isset($_GET['trang'])) {
                if(in_array($_GET['trang'],$trang)){
                    $_trang=$_GET['trang'];
                } else {
                    $_trang="hanghoa";
                }
            } else {
                $_trang="hanghoa";
            }
        ?>
    </head>
    <body>
        <div id="root">
            <nav class="nav-bar">
                <a class="shop" href="./">
                    <img class="logo" src="./images/logo.png">
                    <label class="shopName">Shop Cún Cưng Quotes</label>
                </a>
                <a class="giohang" href="./index.php?trang=giohang">
                    <img class="icon-gh" src="./images/giohang.png">
                    <label>Giỏ hàng</label>
                    <div class="dropdown-gh"> 
                        <table class="table table-striped table-bordered table-light ">
                            <?php 
                                if(isset($_SESSION['giohang'])){
                                    echo    '<tr>
                                                <th class="text-primary">Tên hàng</th>
                                                <th class="text-primary">Số lượng</th>
                                                <th class="text-primary">Giá</th>
                                            </tr>';
                                    require("./connect.php");
                                    $sql='select * from HANGHOA where MSHH in (';
                                    foreach($_SESSION['giohang'] as $key => $value){
                                        $sql.='"'.$key.'",';
                                    }
                                    $sql=substr($sql,0,-1).') order by MSHH asc';
                                    $kq=mysqli_query($con,$sql);
                                    $tong=0;
                                    while ($row=mysqli_fetch_array($kq)){
                                        $tong+=$row['GIA']*$_SESSION['giohang'][$row['MSHH']]['soluong'];
                            ?>
                                        <tr>
                                            <td class="text-left"><?php echo $row['TENHH'];?></td>
                                            <td class="text-left"><?php echo strval($_SESSION['giohang'][$row['MSHH']]['soluong']);?></td>
                                            <td class="text-left"><?php echo $row['GIA']*$_SESSION['giohang'][$row['MSHH']]['soluong']; ?></td>
                                        </tr>
                            <?php            
                                    }
                                } else {
                                    echo '<p class="btn btn-danger" id="empty">Giỏ hàng của bạn trống!</p>';
                                }
                            ?>
                        </table>
                    </div>
                </a>
                <a class="text-middle btn btn-primary" id="quanly" href="./quanlydulieu.php">Trang quản lý dữ liệu</a>
            </nav>
            <div class="container">
                <div class="Menu">
                    <h4 class="head-MN">Menu</h4>
                    <?php 
                        require("./connect.php");
                        $sql='select * from LOAIHANGHOA order by MALOAIHANG asc';
                        $kq=mysqli_query($con,$sql);
                        if (!$kq){
                            die("Lỗi truy vấn!");
                        } else {
                            while ($row=mysqli_fetch_array($kq)){
                                echo '<p class="item-MN"><a href="./index.php?trang=hanghoa&page='.$row['MALOAIHANG'].'">'.$row['TENLOAIHANG'].'</a></p>';
                            }
                        }
                    ?> 
                </div>
                <div class="Item-Manager">
                    <table class="table table-striped table-dark table-bordered ">
                        
                        <?php 
                            require($_trang.".php");
                        ?>
                    </table>            
                </div>
            </div>
        </div>
    </body>
</html>