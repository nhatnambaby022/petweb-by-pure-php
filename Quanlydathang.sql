
create database B1809263_Quanlydathang;
use B1809263_Quanlydathang;
create or replace table LOAIHANGHOA (
   MALOAIHANG           varchar(8)              not null,
   TENLOAIHANG          varchar(60)             not null,
   constraint PK_LOAIHANGHOA primary key nonclustered (MALOAIHANG)
);


create or replace table HANGHOA (
   MSHH                 varchar(8)              not null,
   MALOAIHANG           varchar(8)              not null,
   TENHH                varchar(60)             not null,
   QUYCACH              varchar(60)             not null,
   GIA                  int                  not null,
   SOLUONGHANG          int                  not null,
   GHICHU               varchar(255)            null,
   constraint PK_HANGHOA primary key nonclustered (MSHH),
   constraint FK_HANGHOA_THUOC_LOAIHANG foreign key (MALOAIHANG)
      references LOAIHANGHOA (MALOAIHANG)
);


create or replace table NHANVIEN (
   MSNV                 varchar(8)              not null,
   HOTENNV              varchar(60)             not null,
   CHUCVU               varchar(60)             not null,
   DIACHI               varchar(255)            not null,
   SODIENTHOAI          varchar(11)             not null,
   constraint PK_NHANVIEN primary key nonclustered (MSNV)
);



create or replace table KHACHHANG (
   MSKH                 varchar(8)              not null,
   HOTENKH              varchar(60)             not null,
   TENCONGTY            varchar(60)             not null,
   SODIENTHOAI          varchar(11)             not null,
   EMAIL                varchar(255)            not null,
   constraint PK_KHACHHANG primary key nonclustered (MSKH)
);



create or replace table DATHANG (
   SODONDH              varchar(8)              not null,
   MSNV                 varchar(8)              not null,
   MSKH                 varchar(8)              not null,
   NGAYDH               datetime             not null,
   NGAYGH               datetime             not null,
   constraint PK_DATHANG primary key nonclustered (SODONDH),
   constraint FK_DATHANG_HOANTHANH_NHANVIEN foreign key (MSNV)
      references NHANVIEN (MSNV),
   constraint FK_DATHANG_DAT_KHACHHAN foreign key (MSKH)
      references KHACHHANG (MSKH)
);



create or replace table CHITIETDATHANG (
   MSHH varchar(8)              not null,
   SODONDH              varchar(8)              not null,
   SOLUONG              int                  not null ,
   GIADATHANG           int                  not null,
   GIAMGIA              int                  not null,
   constraint PK_CHITIETDATHANG primary key (MSHH, SODONDH),
   constraint FK_CHITIETD_CHITIETDA_HANGHOA foreign key (MSHH)
      references HANGHOA (MSHH),
   constraint FK_CHITIETD_CHITIETDA_DATHANG foreign key (SODONDH)
      references DATHANG (SODONDH)
);

create or replace table DIACHIKH (
   MADC                 varchar(8)              not null,
   MSKH                 varchar(8)              not null,
   DIACHI               varchar(255)            not null,
   constraint PK_DIACHIKH primary key nonclustered (MADC),
   constraint FK_DIACHIKH_CO_KHACHHAN foreign key (MSKH)
      references KHACHHANG (MSKH)
);

/* Dữ liệu LOAIHANGHOA*/

insert into LOAIHANGHOA values ('TAC','Thức ăn cho chó');
insert into LOAIHANGHOA values ('PAC','Pate Cho Chó');
insert into LOAIHANGHOA values ('TAK','Thức ăn khô');
insert into LOAIHANGHOA values ('QAC','Quần áo cho chó');
insert into LOAIHANGHOA values ('PKC','Phụ kiện');
insert into LOAIHANGHOA values ('BCC','Bát, chén ăn');
insert into LOAIHANGHOA values ('BNC','Bình nước');
insert into LOAIHANGHOA values ('YTE','Y tế cún cưng');


/* Dữ liệu KHACHHANG */
insert into KHACHHANG values ('KH1','Lê Văn A','Công ty SAMPLE','0963005441','lva@email.com');
insert into KHACHHANG values ('KH2','Lê Văn C','Công ty SAMPLE','0963005442','lvc@email.com');
insert into KHACHHANG values ('KH3','Lê Văn D','Công ty SAMPLE','0963005443','lvd@email.com');
insert into KHACHHANG values ('KH4','Lê Văn E','Công ty SAMPLE','0963005444','lve@email.com');
insert into KHACHHANG values ('KH5','Lê Văn F','Công ty SAMPLE','0963005445','lvf@email.com');
insert into KHACHHANG values ('KH6','Lê Văn G','Công ty SAMPLE','0963005446','lvg@email.com');


/* Dữ liệu NHANVIEN */
insert into NHANVIEN values ('NV1','Lê Dăn J','Nhân viên Bán hàng','Lấp Vò, Đồng Tháp','0963000000');
insert into NHANVIEN values ('NV2','Lê Dăn K','Nhân viên Bán hàng','Lấp Vò, Đồng Tháp','0963000000');
insert into NHANVIEN values ('NV3','Lê Dăn A','Nhân viên Bán hàng','Lấp Vò, Đồng Tháp','0963000000');
insert into NHANVIEN values ('NV4','Lê Dăn C','Nhân viên Bán hàng','Lấp Vò, Đồng Tháp','0963000000');
insert into NHANVIEN values ('NV5','Lê Dăn Z','Nhân viên Bán hàng','Lấp Vò, Đồng Tháp','0963000000');
insert into NHANVIEN values ('NV6','Lê Dăn G','Nhân viên Bán hàng','Lấp Vò, Đồng Tháp','0963000000');
insert into NHANVIEN values ('NV7','Lê Dăn P','Nhân viên Bán hàng','Lấp Vò, Đồng Tháp','0963000000');


/* Dữ liệu DIACHI */
insert into DIACHIKH values ('DC1','KH1','336 ấp Hưng Thành Đông, Long Hưng B, Lấp Vò, Đồng Tháp');
insert into DIACHIKH values ('DC2','KH2','02 ấp Hưng Thành Tây, Long Hưng B, Lấp Vò, Đồng Tháp');
insert into DIACHIKH values ('DC3','KH3','34/1 3 Tháng 2, Xuân Khánh, Ninh Kiều, TP.Cần Thơ');
insert into DIACHIKH values ('DC4','KH4','68 ấp Hưng Thành Nhơn, Long Hưng B, Lấp Vò, Đồng Tháp');
insert into DIACHIKH values ('DC5','KH5','3/14 Trần Văn Hoài, Xuân Khánh, Ninh Kiều, TP.Cần Thơ');
insert into DIACHIKH values ('DC6','KH6','63 ấp Hưng Thạnh, Mỹ An Hưng B, Lấp Vò, Đồng Tháp');


/*Dữ liệu hàng hóa*/
insert into HANGHOA values ('HH1','TAC','SmartHeart Adult Power Pack (3kg)','Dùng trực tiếp',215000,10,'');
insert into HANGHOA values ('HH2','TAC','Dr.Kyan Predogen - Sữa bột cho chó','Dùng trực tiếp',189000,10,'');
insert into HANGHOA values ('HH3','TAC','Thức ăn cho chó Poodle - Royal','Dùng trực tiếp',328000,10,'');
insert into HANGHOA values ('HH4','TAC','Sữa Bio Milk cho chó mèo con','Dùng trực tiếp',42000,10,'');
insert into HANGHOA values ('HH5','TAC','Thức ăn dành cho chó trưởng thành','Dùng trực tiếp',280000,10,'');
insert into HANGHOA values ('HH6','TAC','Royal Canin Maxi Adult (1kg)','Dùng trực tiếp',145000,10,'');


insert into HANGHOA values ('HH7','PAC','Pate Royal Canin - Recovery 195g','Dùng trực tiếp',58000,10,'');
insert into HANGHOA values ('HH8','PAC','Tellme - Pate gan thịt heo cho chó','Dùng trực tiếp',17000,10,'');
insert into HANGHOA values ('HH9','PAC','Smartheart - Pate vị bò cho chó lớn','Dùng trực tiếp',19000,10,'');
insert into HANGHOA values ('HH10','PAC','Pate Monge cá hồi và lê 100g','Dùng trực tiếp',29000,10,'');
insert into HANGHOA values ('HH11','PAC','Pate Monge vịt và cam 100g','Dùng trực tiếp',29000,10,'');
insert into HANGHOA values ('HH12','PAC','Pate Monge gà và quả mâm xôi','Dùng trực tiếp',29000,10,'');


insert into HANGHOA values ('HH13','TAk','Thức ăn cho chó con Dog Mania','Dùng trực tiếp',258000,10,'');
insert into HANGHOA values ('HH14','TAk','Thức ăn cho chó Earthborn Holistic','Dùng trực tiếp',207000,10,'');
insert into HANGHOA values ('HH15','TAk','Thức ăn cho chó sơ sinh Farmina','Dùng trực tiếp',459000,10,'');
insert into HANGHOA values ('HH16','TAk','Royal Canin Urinary Canine Dog 2kg','Dùng trực tiếp',289000,10,'');
insert into HANGHOA values ('HH17','TAk','Golden Pet Cún con vị thịt gà 450gr','Dùng trực tiếp',460000,10,'');
insert into HANGHOA values ('HH18','TAk','Thức ăn khô Iskhan Sensitive vị cá','Dùng trực tiếp',429000,10,'');


insert into HANGHOA values ('HH19','QAC','Áo thun hạc chanel sọc xanh size 4','Mặc sau khi giặt',40000,10,'');
insert into HANGHOA values ('HH20','QAC','Áo thun cổ lọ cam tim size 6','Mặc sau khi giặt',60000,10,'');
insert into HANGHOA values ('HH21','QAC','Áo thun cổ cao LV đỏ size 5','Mặc sau khi giặt',70000,10,'');
insert into HANGHOA values ('HH22','QAC','Áo thun cổ cao LV nâu size 4','Mặc sau khi giặt',460000,10,'');
insert into HANGHOA values ('HH23','QAC','Áo trụ thêu chanel xanh size 7','Mặc sau khi giặt',40000,10,'');
insert into HANGHOA values ('HH24','QAC','Áo T thần tài liền quần size S','Mặc sau khi giặt',46000,10,'');


insert into HANGHOA values ('HH25','PKC','Vòng cổ Thời thượng 12cm','Phụ kiện đi kèm',26000,10,'');
insert into HANGHOA values ('HH26','PKC','Dây dắt cho chó 1m2','Phụ kiện đi kèm',99000,10,'');
insert into HANGHOA values ('HH27','PKC','Mon Ami Jewelry - Nữ trang hình','Phụ kiện đi kèm',86000,10,'');
insert into HANGHOA values ('HH28','PKC','Yếm cho chó lớn CTCBio','Phụ kiện đi kèm',190000,10,'');
insert into HANGHOA values ('HH29','PKC','Yếm đính hoa PetStar 34*40cm','Phụ kiện đi kèm',229000,10,'');
insert into HANGHOA values ('HH30','PKC','Dây dắt đính hoa Petstar 2*120cm','Phụ kiện đi kèm',160000,10,'');


insert into HANGHOA values ('HH31','BCC','Bát bobo 3031-Z to','Đựng thức ăn cho chó',96000,10,'');
insert into HANGHOA values ('HH32','BCC','Bát ăn đôi lớn','Đựng thức ăn cho chó',196000,10,'');
insert into HANGHOA values ('HH33','BCC','Bát ăn đôi nhỏ','Đựng thức ăn cho chó',120000,10,'');
insert into HANGHOA values ('HH34','BCC','Bát đôi hình xương M','Đựng thức ăn cho chó',150000,10,'');
insert into HANGHOA values ('HH35','BCC','AFP Chill Out - Chén lạnh size M','Đựng thức ăn cho chó',260000,10,'');
insert into HANGHOA values ('HH36','BCC','Bát sứ Pawise Gold Feeding','Đựng thức ăn cho chó',56000,10,'');


insert into HANGHOA values ('HH37','BNC','Bình uống nước tự động (400ml)','Chứa nước uống cho chó',456000,10,'');
insert into HANGHOA values ('HH38','BNC','Mon Ami Bowl - Bình nước Du Lịch','Chứa nước uống cho chó',45000,10,'');
insert into HANGHOA values ('HH39','BNC','Bát uống nước tự động nhỏ cho chó','Chứa nước uống cho chó',350000,10,'');
insert into HANGHOA values ('HH40','BNC','Vòi nước gắn chuồng cho chó mèo','Chứa nước uống cho chó',60000,10,'');
insert into HANGHOA values ('HH41','BNC','Bình bi nhỏ cho chó mèo','Chứa nước uống cho chó',45000,10,'');
insert into HANGHOA values ('HH42','BNC','Bình treo chuồng cao cấp Mypet','Chứa nước uống cho chó',266000,10,'');


insert into HANGHOA values ('HH48','YTE','Bayer - Thuốc tẩy giun sán','Dùng cho chó',56000,10,'');
insert into HANGHOA values ('HH43','YTE','Dung dịch Tropiclean chăm sóc','Dùng cho chó',156000,10,'');
insert into HANGHOA values ('HH44','YTE','Davis - Phấn Nhổ Lông Tai EarMed','Dùng cho chó',456000,10,'');
insert into HANGHOA values ('HH45','YTE','Bio - Thuốc nhỏ trị viêm tai ngoài','Dùng cho chó',36000,10,'');
insert into HANGHOA values ('HH46','YTE','Xịt trị nấm, vảy gàu','Dùng cho chó',156000,10,'');
insert into HANGHOA values ('HH47','YTE','Frontline Plus- Thuốc trị ve rận','Dùng cho chó',256000,10,'');
