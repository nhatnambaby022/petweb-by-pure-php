<?php ob_start(); ?>
<form method="POST" action="./index.php?trang=dathang" id="form-dathang">
    <?php 
        if(isset($_SESSION['giohang'])){
    ?>
    <div class="form-group" id="input">
        <label>Mã số đơn hàng mới</label>
        <input type="text" name="SODONDH" class="form-control" maxlength="8" placeholder="Mã số đơn hàng mới">
        <?php 
            if(isset($_POST['dathang'])){
                $ok=1;
                if ($_POST['SODONDH']==""){
                    $ok=0;
                    echo '<label class="text-danger">Mã số đơn hàng không được bỏ trống!</label></br>';
                } else {
                    require("./connect.php");
                    $sql='select * from DATHANG where SODONDH="'.$_POST['SODONDH'].'"';
                    $kq=mysqli_query($con,$sql);
                    if (mysqli_num_rows($kq)==0){
                    } else {
                        $ok=0;
                        echo '<label class="text-danger">Mã đơn hàng đã tồn tại!</label></br>';
                    }
                }
            }
        ?>
        <label>Mã số khách hàng</label>
        <input type="text" name="MSKH" class="form-control" maxlength="8" placeholder="Mã số khách hàng">
        <?php 
            if(isset($_POST['dathang'])){
                if ($_POST['MSKH']==""){
                    $ok=0;
                    echo '<label class="text-danger">Mã số khách hàng không được bỏ trống!</label></br>';
                } else {
                    require("./connect.php");
                    $sql='select * from KHACHHANG where MSKH="'.$_POST['MSKH'].'"';
                    $kq=mysqli_query($con,$sql);
                    if (mysqli_num_rows($kq)!=0){
                    } else {
                        $ok=0;
                        echo '<label class="text-danger">Mã số khách hàng không tồn tại!</label></br>';
                    }

                }
            }
        ?>
            
        <label>Mã số nhân viên</label>
        <input type="text" name="MSNV"class="form-control" maxlength="8" placeholder="Mã số nhân viên">
        <?php 
            if(isset($_POST['dathang'])){
                if ($_POST['MSNV']==""){
                    $ok=0;
                    echo '<label class="text-danger">Mã số nhân viên không được bỏ trống!</label></br>';
                } else {
                    require("./connect.php");
                    $sql='select * from NHANVIEN where MSNV="'.$_POST['MSNV'].'"';
                    $kq=mysqli_query($con,$sql);
                    if (mysqli_num_rows($kq)!=0){
                    } else {
                        $ok=0;
                        echo '<label class="text-danger">Mã số nhân viên không tồn tại!</label></br>';
                    }

                }
            }
        ?>
 
        <label>Ngày đặt hàng</label>
        <input type="date" name="NGAYDATHANG" value="cerrent"class="form-control" >
        <?php 
            if(isset($_POST['dathang']) && $_POST['NGAYDATHANG']==null){
                $ok=0;  
                echo '<label class="text-danger">Ngày giao hàng không được bỏ trống!</label></br>';
            }
        ?>

        <label>Ngày giao hàng</label>
        <input type="date" name="NGAYGIAOHANG" class="form-control" >
        <?php 
            if(isset($_POST['dathang'])){
                if ($_POST['NGAYGIAOHANG']==null){
                    $ok=0;
                    echo '<label class="text-danger">Ngày giao hàng không được bỏ trống!</label></br>';
                } else {
                    if ($_POST['NGAYDATHANG']!=null && $_POST['NGAYGIAOHANG']<$_POST['NGAYDATHANG']){
                        $ok=0;
                        echo '<label class="text-danger">Ngày giao hàng phải lớn hơn hoặc bằng ngày đặt hàng!</label></br>';
                    }
                }
            }
        ?>

        
    </div>       
    <label class="text-light"><label>
        <table class="table table-striped table-bordered table-light table-primary">
                    <tr>
                        <th>Mã số hàng hóa</th>
                        <th>Tên hàng hóa</th>
                        <th>Số lượng đặt</th>
                        <th>Giá tiền</th>
                        <th>Tổng tiền</th>
                    </tr>
    <?php
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
                    <td  ><?php echo $row['MSHH']?></td>
                    <td class="text-left"><?php echo $row['TENHH'];?></td>
                    <td class="text-left"><?php echo strval($_SESSION['giohang'][$row['MSHH']]['soluong']);?> </td>
                    <td><?php echo $row['GIA']?></td>
                    <td class="text-left"><?php echo $row['GIA']*$_SESSION['giohang'][$row['MSHH']]['soluong']; ?></td>
                </tr>
    <?php            
            }
            echo '
            <tr>
                <td colspan="4" class="text-right">Tổng hóa đơn</td>
                <td>'.$tong.'</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right">Khuyến mãi</td>
                <td><input type="number" name="KHUYENMAI" value="0" class="form-control" max="'.$tong.'"/></td>
            </tr>
            </table>
            <button type="submit" class="btn btn-primary" name="dathang" >Đặt hàng</button>
            <div><a class="btn btn-primary" id="dathang" href="./index.php?trang=hanghoa">Mua tiếp</a></div>
            ';
        } else {
            echo '<p class="btn btn-danger" id="empty">Giỏ hàng của bạn trống!</p>';
        }
    ?>
</form>
<?php 
    if(isset($_POST['dathang']) && $ok==1){
        require("./connect.php");
        $sql_dh='insert into DATHANG values("'.$_POST['SODONDH'].'","'.$_POST['MSNV'].'","'.$_POST['MSKH'].'","'.$_POST['NGAYDATHANG'].'","'.$_POST['NGAYGIAOHANG'].'")';
        if (mysqli_query($con,$sql_dh)){
            foreach ($_SESSION['giohang'] as $key => $value){
                $sql_ct='insert into CHITIETDATHANG values("'.$key.'","'.$_POST['SODONDH'].'",'.$_SESSION['giohang'][$key]['soluong'].','.$_SESSION['giohang'][$key]['gia'].','.$_POST['KHUYENMAI'].')';
                if (mysqli_query($con,$sql_ct)){
                    $sql='select * from HANGHOA where MSHH="'.$key.'"';
                    $kq_t=mysqli_query($con,$sql);
                    $row_t=mysqli_fetch_array($kq_t);
                    $sql_t='update HANGHOA set SOLUONGHANG="'.($row_t['SOLUONGHANG']-$_SESSION['giohang'][$key]['soluong']).'" where MSHH="'.$key.'"';
                    if (mysqli_query($con,$sql_t)){
                        echo    '<script>
                                    alert("Thêm thành công!");
                        </script>';
                    }
                } else {
                    echo "Lỗi khi thêm chi tiết đơn hàng!";
                }
            }
            echo    '<script>
                                    alert("Thêm thành công!");
                    </script>';
            header('location: http://localhost/webthucung/');
            unset($_SESSION['giohang']);
        } else {
            echo "Lỗi khi thêm đơn hàng!";
        }
    }

?>