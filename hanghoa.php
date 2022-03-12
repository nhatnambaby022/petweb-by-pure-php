
<?php 
    require("./connect.php");
    if (isset($_GET['acction']) && $_GET['acction']=="add") {
        if(isset($_GET['MSHH'])){
            if(isset($_SESSION['giohang'][$_GET['MSHH']])){
                $sql_t='select * from HANGHOA where MSHH="'.$_GET['MSHH'].'"';
                $kq_t=mysqli_query($con,$sql_t);
                if (mysqli_num_rows($kq_t)!=0){
                    $row_t=mysqli_fetch_array($kq_t);
                    if ($_SESSION['giohang'][$_GET['MSHH']]['soluong'] < $row_t['SOLUONGHANG']){
                        $_SESSION['giohang'][$_GET['MSHH']]['soluong']++;
                    }    
                };
            } else {
                $sql_t='select * from HANGHOA where MSHH="'.$_GET['MSHH'].'"';
                $kq_t=mysqli_query($con,$sql_t);
                if (mysqli_num_rows($kq_t)!=0){
                    $row_t=mysqli_fetch_array($kq_t);
                    $_SESSION['giohang'][$row_t['MSHH']]=array(
                        "gia" => $row_t['GIA'],
                        "soluong" => 1
                    );
                }; 
            };                  
        };
    };
?>

<?php
    $sql='select MALOAIHANG from LOAIHANGHOA order by MALOAIHANG asc';
    $pages=array();
    $kq=mysqli_query($con,$sql);
    if (!$kq){die("Lỗi truy vấn!");}
    while ($row=mysqli_fetch_array($kq)){
        $pages[]=$row['MALOAIHANG'];
    }
    

    if (isset($_GET['page'])){
        if(in_array($_GET['page'],$pages)){
            $page='where MALOAIHANG="'.$_GET['page'].'"';
            $paage='page='.$_GET['page'].'&';
        } else {
            $page="";
            $paage="";
        }
    } else {
        $page="";
        $paage="";
    }
    if (isset($_GET['page'])){
        $sql_s = 'select * from LOAIHANGHOA where MALOAIHANG="'.$_GET['page'].'"';
        $kq_s = $con -> query($sql_s);
        if(mysqli_num_rows($kq_s)!=0){
            $row_s=mysqli_fetch_array($kq_s);
            $tb_title=$row_s['TENLOAIHANG'];
        } else{
            $tb_title="Tất cả các hàng hóa";
        }
    } else {
        $tb_title="Tất cả các hàng hóa";
    }

    echo '<p class="btn btn-success">'.$tb_title.'</p>';
    $sql = "select * from HANGHOA ".$page." order by MSHH asc";
    $kq = $con -> query($sql);
    echo '<tr>
            <th>Mã Hàng</th>
            <th>Tên hàng</th>
            <th>Số lượng có</th>
            <th>Giá tiền</th>
            <th>Đơn vị tiền tệ</th>
            <th>#</th>
        </tr>';
    if ($kq){
        while ($row = $kq -> fetch_array(MYSQLI_ASSOC)){
?>

<tr>
    <td><?php echo $row['MSHH']?></td>
    <td><?php echo $row['TENHH']?></td> 
    <td><?php echo $row['SOLUONGHANG']?></td>
    <td><?php echo $row['GIA']?></td>
    <td>VNĐ</td>
    <td class=""><a href="./<?php echo 'index.php?trang=hanghoa&'.$paage.'acction=add&MSHH='.$row['MSHH']; ?>" class="btn btn-primary">Thêm vào giỏ hàng</a></td>
</tr>

<?php
        };
    } else {
        echo "Có lỗi truy vấn!";
    };
?>

