

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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO barang VALUES("18","5000024804","Trizact 1 1/4","ROL","DIRECT","1821827","0","8");
INSERT INTO barang VALUES("6","5661482","tim tom","kilo","Indirect","1000000","180","5");
INSERT INTO barang VALUES("8","5661482","ciken","ton","Indirect","8500","16","5");
INSERT INTO barang VALUES("16","5000023265","Nylon Cloth 400cm x 400cm","PC","DIRECT","258600","40","50");
INSERT INTO barang VALUES("17","5000023456","Shin Nhn Wex Glove @10pairs  XT002274550","BAG","Indirect","878000","20","0");
INSERT INTO barang VALUES("19","5000012647","SBP XX  (WASH BENZINE)","L","Direct","7000","320","0");
INSERT INTO barang VALUES("20","5000026331","Sankyo Wool Sponge Pad ( D75 x T5 )","PC","Indirect","7400","10","20");



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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

INSERT INTO order_history VALUES("20","Doorline","5000026331","Sankyo Wool Sponge Pad ( D75 x T5 )","20","PC","INDIRECT","7400","148000","makan","admin","36999","Shift B","2019-11-27","Doorline2019-11-27","ok");
INSERT INTO order_history VALUES("15","Doorline","5000026331","Sankyo Wool Sponge Pad ( D75 x T5 )","5","PC","INDIRECT","0","0","makan siang","arie","25888","Non Shift","2019-11-26","Doorline2019-11-26","");
INSERT INTO order_history VALUES("19","Final","5661482","tim tom","10","kilo","INDIRECT","1000000","10000000","pro","arie","25888","Shift B","2019-11-27","Final2019-11-27","");
INSERT INTO order_history VALUES("17","Final","5661482","ciken","2","ton","INDIRECT","8500","17000","pro","arie","25888","Shift B","2019-11-27","Final2019-11-27","");
INSERT INTO order_history VALUES("18","Final","5000026331","Sankyo Wool Sponge Pad ( D75 x T5 )","25","PC","INDIRECT","7400","185000","makan malam","arie","25888","Shift B","2019-11-27","Final2019-11-27","");
INSERT INTO order_history VALUES("21","Doorline","5661482","tim tom","10","kilo","INDIRECT","1000000","10000000","makan siang","admin","36999","Shift B","2019-11-27","Doorline2019-11-27","");
INSERT INTO order_history VALUES("23","Final","5000026331","Sankyo Wool Sponge Pad ( D75 x T5 )","20","PC","INDIRECT","7400","148000","makan malam","arie","25888","Non Shift","2019-11-28","Final2019-11-28","ok");
INSERT INTO order_history VALUES("24","Final","5661482","tim tom","10","kilo","INDIRECT","1000000","10000000","pro","arie","25888","Non Shift","2019-11-28","Final2019-11-28","ok");
INSERT INTO order_history VALUES("25","Final","5000023456","Shin Nhn Wex Glove @10pairs  XT002274550","20","BAG","INDIRECT","878000","17560000","makan","arie","25888","Non Shift","2019-11-28","Final2019-11-28","ok");
INSERT INTO order_history VALUES("26","Doorline","5000023265","Nylon Cloth 400cm x 400cm","2","PC","DIRECT","258600","2586000","Improvement","arie","25888","Shift B","2019-11-28","Doorline2019-11-28","");
INSERT INTO order_history VALUES("27","SPS","5661482","ciken","2","ton","INDIRECT","8500","17000","2 S","admin","25899","Shift A","2019-11-29","SPS2019-11-29Shift A","ok");
INSERT INTO order_history VALUES("28","SPS","5000026331","Sankyo Wool Sponge Pad ( D75 x T5 )","5","PC","INDIRECT","7400","37000","Produksi","admin","25899","Shift A","2019-11-29","SPS2019-11-29Shift A","ok");
INSERT INTO order_history VALUES("29","SPS","5000023456","Shin Nhn Wex Glove @10pairs  XT002274550","10","BAG","INDIRECT","878000","8780000","TPM","admin","25899","Shift A","2019-11-29","SPS2019-11-29Shift A","");
INSERT INTO order_history VALUES("30","Final","5661482","tim tom","10","kilo","INDIRECT","1000000","10000000","Produksi","arie","25888","Non Shift","2019-12-02","Final2019-12-02Non Shift","");



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

INSERT INTO user VALUES("1","Arie Prasetyo","25999","Shift B","arie","1edf6b45927340a06b736d71d69ae4c9","Administrator","","085777640888","on");
INSERT INTO user VALUES("2","Arie","0000","Shift B","cibinong","67dbd060eaacee3a8b48c6e404c3f728","Administrator","","99999","on");
INSERT INTO user VALUES("18","Admin","25888","Non Shift","admin","67dbd060eaacee3a8b48c6e404c3f728","Admin","PROJECT","0258","on");

