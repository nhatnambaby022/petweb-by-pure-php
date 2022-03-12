<?php 
    if(isset($_POST['submit']) && (count($_POST['soluong'])>0)){
        foreach ($_POST['soluong'] as $key => $val){
            if ($val==0){
                unset($_SESSION['giohang'][$key]);
                if(count($_SESSION['giohang'])==0){
                    unset($_SESSION['giohang']);
                };
            } else {
                $_SESSION['giohang'][$key]['soluong']=$val;
            }
        }

    }
?>

<form method="POST" action="./index.php?trang=giohang">
    
        <?php 
            if(isset($_SESSION['giohang'])){
                echo   '<label class="text-primary">Cho số lượng về 0 để xóa!</label>
                        <table class="table table-striped table-bordered table-light table-primary">
                            <tr>
                                <th>Mã số hàng hóa</th>
                                <th>Tên hàng hóa</th>
                                <th>Số lượng đặt</th>
                                <th>Giá tiền</th>
                                <th>Tổng tiền</th>
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
                        <td  ><?php echo $row['MSHH']?></td>
                        <td class="text-left"><?php echo $row['TENHH'];?></td>
                        <td class="text-left"><input type="number" min="0" max="<?php echo $row['SOLUONGHANG'];?>"name="soluong[<?php echo  $row['MSHH'].']'?>" value="<?php echo strval($_SESSION['giohang'][$row['MSHH']]['soluong']);?>" /> </td>
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
                </table>
                <button type="submit" class="btn btn-primary" name="submit" >Cập nhật giỏ hàng</button>
                <a class="btn btn-primary" id="dathang" href="./index.php?trang=dathang">Đặt hàng</a>
                <a class="btn btn-primary" id="dathang" href="./index.php?trang=hanghoa">Mua tiếp</a>';
            } else {
                echo '<p class="btn btn-danger" >Giỏ hàng của bạn trống!</p>';
            }
        ?>
</form>
