

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga_barang` int(100) NOT NULL,
  `stock_barang` int(100) NOT NULL,
  `stock_std` int(100) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO barang VALUES("18","5000024804","Trizact 1 1/4","ROL","DIRECT","1821827","0","8");
INSERT INTO barang VALUES("6","5661482","tim tom","kilo","Indirect","1000000","180","5");
INSERT INTO barang VALUES("8","5661482","ciken","ton","Indirect","8500","16","5");
INSERT INTO barang VALUES("16","5000023265","Nylon Cloth 400cm x 400cm","PC","DIRECT","258600","40","50");
INSERT INTO barang VALUES("17","5000023456","Shin Nhn Wex Glove @10pairs  XT002274550","BAG","Indirect","878000","20","0");
INSERT INTO barang VALUES("19","5000012647","SBP XX  (WASH BENZINE)","L","Direct","7000","320","0");
INSERT INTO barang VALUES("20","5000026331","Sankyo Wool Sponge Pad ( D75 x T5 )","PC","Indirect","7400","10","20");
INSERT INTO barang VALUES("22","100","barang cadangan","pc","direct","5000","5","0");



CREATE TABLE `jalur` (
  `id_jalur` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jalur` varchar(100) NOT NULL,
  PRIMARY KEY (`id_jalur`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO jalur VALUES("1","Final");
INSERT INTO jalur VALUES("2","Trimming0");
INSERT INTO jalur VALUES("3","Trimming1-2");
INSERT INTO jalur VALUES("4","Chassis1");
INSERT INTO jalur VALUES("5","Chassis2");
INSERT INTO jalur VALUES("6","Pretrimming");
INSERT INTO jalur VALUES("7","Doorline");
INSERT INTO jalur VALUES("8","SPS");
INSERT INTO jalur VALUES("9","Jundate");
INSERT INTO jalur VALUES("10","RM");
INSERT INTO jalur VALUES("11","Project");



CREATE TABLE `keterangan` (
  `id_ket` int(11) NOT NULL AUTO_INCREMENT,
  `ket` varchar(100) NOT NULL,
  PRIMARY KEY (`id_ket`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO keterangan VALUES("1","Produksi");
INSERT INTO keterangan VALUES("2","2 S");
INSERT INTO keterangan VALUES("3","TPM");
INSERT INTO keterangan VALUES("4","Improvement");



CREATE TABLE `order_history` (
  `id_order_history` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jalur` varchar(100) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah_order` int(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` int(100) NOT NULL,
  `total_harga` int(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `nama_pic` varchar(50) NOT NULL,
  `npk_pic` int(50) NOT NULL,
  `shift` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `konfirmasi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_order_history`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO order_history VALUES("1","Pretrimming","5000012647","SBP XX  (WASH BENZINE)","50","L","DIRECT","7000","350000","TPM","testing order","61555","Shift A","2019-12-27","Pretrimming2019-12-27Shift A","");



CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_history_view` AS select `order_history`.`id_order_history` AS `id_order_history`,`order_history`.`nama_jalur` AS `nama_jalur`,`order_history`.`kode_barang` AS `kode_barang`,`order_history`.`nama_barang` AS `nama_barang`,`order_history`.`jumlah_order` AS `jumlah_order`,`order_history`.`satuan` AS `satuan`,`order_history`.`kategori` AS `kategori`,`order_history`.`harga` AS `harga`,`order_history`.`total_harga` AS `total_harga`,`order_history`.`keterangan` AS `keterangan`,`order_history`.`nama_pic` AS `nama_pic`,`order_history`.`npk_pic` AS `npk_pic`,`order_history`.`shift` AS `shift`,`order_history`.`tanggal` AS `tanggal`,`order_history`.`barcode` AS `barcode`,`order_history`.`konfirmasi` AS `konfirmasi` from `order_history`;

INSERT INTO order_history_view VALUES("1","Pretrimming","5000012647","SBP XX  (WASH BENZINE)","50","L","DIRECT","7000","350000","TPM","testing order","61555","Shift A","2019-12-27","Pretrimming2019-12-27Shift A","");



CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(100) NOT NULL,
  `npk` varchar(10) NOT NULL,
  `shift` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `jalur` varchar(100) NOT NULL,
  `no_telepon` varchar(50) NOT NULL,
  `aktifasi` varchar(5) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO user VALUES("18","farel","61555","Non Shift","farel","b8e3e2106f00a51a6c69419942ef8e46","Admin","PROJECT","089624035192","on");

