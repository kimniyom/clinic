/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50542
 Source Host           : 127.0.0.1
 Source Database       : clinic

 Target Server Type    : MySQL
 Target Server Version : 50542
 File Encoding         : utf-8

 Date: 02/23/2018 18:02:51 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `alert`
-- ----------------------------
DROP TABLE IF EXISTS `alert`;
CREATE TABLE `alert` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `alert_appoint` int(5) DEFAULT NULL COMMENT 'แจ้งเตือนก่อนถึงวันนัด',
  `alert_product` int(5) DEFAULT NULL COMMENT 'เตือนสินค้าใกล้หมด(สาขา)',
  `alert_expire` int(5) DEFAULT NULL COMMENT 'สินค้าใกล้หมดอายุ(สาขา)',
  `alert_repair` int(5) DEFAULT NULL COMMENT 'แจ้งเตือนก่อนถึงวันที่ซ่อมบำรุง',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ampur`
-- ----------------------------
DROP TABLE IF EXISTS `ampur`;
CREATE TABLE `ampur` (
  `ampur_id` int(11) NOT NULL AUTO_INCREMENT,
  `ampur_code` varchar(4) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ampur_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `geo_id` int(11) NOT NULL DEFAULT '0',
  `changwat_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ampur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=999 DEFAULT CHARSET=utf8 COMMENT='ตารางอำเภอ';

-- ----------------------------
--  Table structure for `appoint`
-- ----------------------------
DROP TABLE IF EXISTS `appoint`;
CREATE TABLE `appoint` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `service_id` int(5) DEFAULT NULL COMMENT 'รหัสให้บริการ',
  `appoint` date DEFAULT NULL COMMENT 'วันที่นัด',
  `timeappoint` varchar(10) DEFAULT NULL COMMENT 'เวลา',
  `branch` int(3) DEFAULT NULL COMMENT 'นัดที่สาขา',
  `create_date` timestamp NULL DEFAULT NULL COMMENT 'วันที่บันทึกข้อมูล',
  `status` int(11) DEFAULT '0' COMMENT '0 = ยังไม่มารับบริการ,1 = มารับบริการแล้ว',
  `type` int(3) DEFAULT NULL COMMENT 'ประเภทนัดหมาย',
  `patient_id` int(5) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `etc` varchar(255) DEFAULT NULL,
  `user_id` int(7) DEFAULT NULL COMMENT 'ผู้บันทึกข้อมูล',
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  CONSTRAINT `patients_id` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `banner`
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `banner_id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `banner_images` varchar(100) DEFAULT NULL COMMENT 'รูปภาพ',
  `status` enum('1','0') DEFAULT '1' COMMENT 'สภานะการแสดง 0 = ''ไม่ให้แสดง'', 1 = ''ให้แสดง''',
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บแบนเนอร์';

-- ----------------------------
--  Table structure for `branch`
-- ----------------------------
DROP TABLE IF EXISTS `branch`;
CREATE TABLE `branch` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสาขา',
  `branchname` varchar(255) DEFAULT NULL COMMENT 'ชื่อสาขา',
  `active` int(1) DEFAULT '1' COMMENT 'แสดง',
  `address` text COMMENT 'ที่อยู่',
  `contact` text COMMENT 'ข้อมูลติดต่อ',
  `menagers` varchar(255) DEFAULT NULL COMMENT 'ผู้จัดการ',
  `taxnumber` varchar(50) DEFAULT NULL COMMENT 'รหัสเสียภาษี',
  `telmenager` varchar(10) DEFAULT NULL COMMENT 'เบอร์ติดต่อ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `center_stockcompany`
-- ----------------------------
DROP TABLE IF EXISTS `center_stockcompany`;
CREATE TABLE `center_stockcompany` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(10) DEFAULT NULL COMMENT 'รหัสบริษัท',
  `company_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อบริษัท',
  `address` varchar(255) DEFAULT NULL COMMENT 'ที่อยู่',
  `tel` varchar(20) DEFAULT NULL COMMENT 'ติดต่อ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บบริษัทที่ขายวัตถุดิบ';

-- ----------------------------
--  Table structure for `center_stockitem`
-- ----------------------------
DROP TABLE IF EXISTS `center_stockitem`;
CREATE TABLE `center_stockitem` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `itemid` int(5) DEFAULT NULL COMMENT 'รหัสitem',
  `total` int(5) DEFAULT NULL COMMENT 'คงเหลือ',
  `price` int(7) DEFAULT NULL COMMENT 'ราคา',
  `lotnumber` varchar(10) DEFAULT NULL COMMENT 'ล๊อตเลขที่',
  `number` int(7) DEFAULT NULL COMMENT 'จำนวน',
  `create_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่นำเข้า',
  `numbercut` int(5) DEFAULT NULL COMMENT 'จำนวนที่ตัดได้',
  `totalcut` int(5) DEFAULT NULL COMMENT 'ยอดคงเหลือที่ตัดได้',
  `unitcut` int(3) DEFAULT NULL COMMENT 'หน่วยในการตัด',
  `outstock` enum('T','F') DEFAULT 'F' COMMENT 'T = เอาออกจากstock',
  `expire` varchar(20) DEFAULT NULL COMMENT 'วันที่หมดอายุ',
  `company_id` int(3) DEFAULT NULL COMMENT 'บริษัทที่สั่งซื้อ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `center_stockitem_name`
-- ----------------------------
DROP TABLE IF EXISTS `center_stockitem_name`;
CREATE TABLE `center_stockitem_name` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `itemcode` varchar(10) DEFAULT NULL COMMENT 'รหัสitem',
  `itemname` varchar(255) DEFAULT NULL COMMENT 'ชื่อItem',
  `price` int(7) DEFAULT NULL COMMENT 'ราคา',
  `unit` int(3) DEFAULT NULL COMMENT 'หน่วยนับ',
  `unitcut` int(3) DEFAULT NULL COMMENT 'หน่วยตัดสต๊อก',
  `alert` int(5) DEFAULT NULL COMMENT 'แจ้งเตือนใกล้หมด',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `center_stockmix`
-- ----------------------------
DROP TABLE IF EXISTS `center_stockmix`;
CREATE TABLE `center_stockmix` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(10) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `itemcode` varchar(10) DEFAULT NULL COMMENT 'รหัสItem',
  `number` int(5) DEFAULT NULL COMMENT 'จำนวน',
  `total` int(5) DEFAULT NULL COMMENT 'คงเหลือ',
  `create_date` time DEFAULT NULL COMMENT 'วันที่',
  `itemid` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `center_stockproduct`
-- ----------------------------
DROP TABLE IF EXISTS `center_stockproduct`;
CREATE TABLE `center_stockproduct` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(20) NOT NULL DEFAULT '0' COMMENT 'รหัสสินค้า',
  `clinicname` varchar(255) DEFAULT NULL COMMENT 'ชื่อที่คลินิกเรียก',
  `product_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อสินค้าส่วนกลาง',
  `product_nameclinic` varchar(255) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `costs` float DEFAULT NULL COMMENT 'ต้นทุน',
  `product_price` int(7) DEFAULT '0' COMMENT 'ราคา',
  `product_detail` text COMMENT 'รายละเอียด',
  `type_id` int(3) DEFAULT NULL COMMENT 'หมวดสินค้า',
  `delete_flag` int(1) DEFAULT '0' COMMENT '0 = ยังไม่ถูกลบ,1 = ลบสินค้าแล้ว',
  `status` int(1) DEFAULT '0' COMMENT '0 = ขาย,1 = ไม่ขาย',
  `d_update` datetime DEFAULT NULL COMMENT 'วันที่อัพเดท',
  `branch` int(3) DEFAULT NULL COMMENT 'สาขา',
  `subproducttype` int(3) DEFAULT NULL COMMENT 'ประเภท',
  `unit` int(3) DEFAULT NULL COMMENT 'หน่วยนับ',
  `company` varchar(5) DEFAULT NULL COMMENT 'รหัสบริษัทสั่งซื้อ',
  `size` varchar(255) DEFAULT NULL COMMENT 'ขนาด',
  `private` int(1) DEFAULT '0' COMMENT '0 = คลินิกมองเห็น , 1 = คลินิกมองไม่เห็น',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บสินค้ารายการ ชื่อ ...';

-- ----------------------------
--  Table structure for `center_stockunit`
-- ----------------------------
DROP TABLE IF EXISTS `center_stockunit`;
CREATE TABLE `center_stockunit` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `unit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `center_storeproduct`
-- ----------------------------
DROP TABLE IF EXISTS `center_storeproduct`;
CREATE TABLE `center_storeproduct` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(20) NOT NULL DEFAULT '0' COMMENT 'รหัสสินค้า',
  `lotnumber` varchar(10) DEFAULT NULL COMMENT 'เลขล๊อต',
  `generate` date DEFAULT NULL COMMENT 'วันที่ผลิต',
  `expire` date DEFAULT NULL COMMENT 'วันที่หมดอายุ',
  `d_update` datetime DEFAULT NULL COMMENT 'วันที่อัพเดท',
  `number` int(5) DEFAULT NULL COMMENT 'จำนวน',
  `total` int(5) DEFAULT NULL COMMENT 'คงเหลือ',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='ตารางสต๊อกสินค้ากลาง';

-- ----------------------------
--  Table structure for `changwat`
-- ----------------------------
DROP TABLE IF EXISTS `changwat`;
CREATE TABLE `changwat` (
  `changwat_id` int(11) NOT NULL AUTO_INCREMENT,
  `changwat_code` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `changwat_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `geo_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`changwat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COMMENT='ตารางจังหวัด';

-- ----------------------------
--  Table structure for `checkbody`
-- ----------------------------
DROP TABLE IF EXISTS `checkbody`;
CREATE TABLE `checkbody` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `patient_id` int(5) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `btemp` varchar(10) DEFAULT NULL COMMENT 'อุณหภมูมิร่างกาย',
  `pr` varchar(10) DEFAULT NULL COMMENT 'อัตราการเต้นชองชีพจร',
  `rr` varchar(255) DEFAULT NULL COMMENT 'อัตราการหายใจ',
  `date_serv` date DEFAULT NULL COMMENT 'วันที่รับการตรวจ',
  `branch` int(3) DEFAULT NULL COMMENT 'สาขาที่รับบบริการ',
  `user_id` int(3) DEFAULT NULL COMMENT 'ผู้ให้บริการ(ซักประวัติ)',
  `ht` varchar(10) DEFAULT NULL COMMENT 'ความดันโลหิต',
  `cc` text COMMENT 'อาการสำคัญ',
  `weight` varchar(10) DEFAULT NULL COMMENT 'น้ำหนัก',
  `height` varchar(10) DEFAULT NULL COMMENT 'ส่วนสูง',
  `waistline` varchar(10) DEFAULT NULL COMMENT 'รอบเอว',
  `seq` int(5) DEFAULT NULL COMMENT 'เลขคิว',
  `service_id` int(5) DEFAULT NULL COMMENT 'รหัสบริการ',
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `patient_id` (`patient_id`),
  KEY `patient_id_2` (`patient_id`),
  KEY `patient_id_3` (`patient_id`),
  CONSTRAINT `patient_id_ckb` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='ตารางตรวจร่างการ';

-- ----------------------------
--  Table structure for `clinic_stockproduct`
-- ----------------------------
DROP TABLE IF EXISTS `clinic_stockproduct`;
CREATE TABLE `clinic_stockproduct` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(20) NOT NULL DEFAULT '0' COMMENT 'รหัสสินค้า',
  `clinicname` varchar(255) DEFAULT NULL COMMENT 'ชื่อที่คลินิกเรียก',
  `product_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อสินค้าส่วนกลาง',
  `product_nameclinic` varchar(255) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `costs` float DEFAULT NULL COMMENT 'ต้นทุน',
  `product_price` int(7) DEFAULT '0' COMMENT 'ราคา',
  `price_promotion` decimal(10,2) DEFAULT NULL COMMENT 'ราคาโปรโมชั่น',
  `product_detail` text COMMENT 'รายละเอียด',
  `type_id` int(3) DEFAULT NULL COMMENT 'หมวดสินค้า',
  `delete_flag` int(1) DEFAULT '0' COMMENT '0 = ยังไม่ถูกลบ,1 = ลบสินค้าแล้ว',
  `status` int(1) DEFAULT '0' COMMENT '0 = พร้อมขาย,1 = ไม่พร้อมขาย',
  `d_update` datetime DEFAULT NULL COMMENT 'วันที่อัพเดท',
  `branch` int(3) DEFAULT NULL COMMENT 'สาขา',
  `subproducttype` int(3) DEFAULT NULL COMMENT 'ประเภท',
  `unit` int(3) DEFAULT NULL COMMENT 'หน่วยนับ',
  `company` varchar(5) DEFAULT NULL COMMENT 'รหัสบริษัทสั่งซื้อ',
  `size` varchar(255) DEFAULT NULL COMMENT 'ขนาด',
  `private` int(1) DEFAULT '0' COMMENT '0 = คลินิกมองเห็น , 1 = คลินิกมองไม่เห็น',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `type_id` (`type_id`),
  KEY `branch` (`branch`),
  CONSTRAINT `branch` FOREIGN KEY (`branch`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='ตารางสินค้า';

-- ----------------------------
--  Table structure for `clinic_storeproduct`
-- ----------------------------
DROP TABLE IF EXISTS `clinic_storeproduct`;
CREATE TABLE `clinic_storeproduct` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(20) NOT NULL DEFAULT '0' COMMENT 'รหัสสินค้า',
  `lotnumber` varchar(10) DEFAULT NULL COMMENT 'เลขล๊อต',
  `generate` date DEFAULT NULL COMMENT 'วันที่ผลิต',
  `expire` date DEFAULT NULL COMMENT 'วันที่หมดอายุ',
  `d_update` datetime DEFAULT NULL COMMENT 'วันที่อัพเดท',
  `number` int(5) DEFAULT NULL COMMENT 'จำนวน',
  `total` int(5) DEFAULT NULL COMMENT 'คงเหลือ',
  `branch` int(3) DEFAULT NULL COMMENT 'สาขา',
  `flag` int(1) DEFAULT '0' COMMENT '0 = อยู่ในคลัง,1 = เอาอากจากคลัง',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `branch` (`branch`),
  KEY `branch_2` (`branch`),
  CONSTRAINT `branch1` FOREIGN KEY (`branch`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='ตารางสินค้า';

-- ----------------------------
--  Table structure for `commission`
-- ----------------------------
DROP TABLE IF EXISTS `commission`;
CREATE TABLE `commission` (
  `id` int(7) NOT NULL DEFAULT '0',
  `money_start` int(7) DEFAULT NULL,
  `money_end` int(7) DEFAULT NULL,
  `percent` int(2) DEFAULT NULL,
  `position` int(5) DEFAULT NULL,
  `branch` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `companycenter`
-- ----------------------------
DROP TABLE IF EXISTS `companycenter`;
CREATE TABLE `companycenter` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `companyname` varchar(255) DEFAULT NULL COMMENT 'ชื่อบริษัท',
  `address` longtext COMMENT 'ที่อยู่',
  `tel` varchar(15) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `memager` varchar(255) DEFAULT NULL COMMENT 'ผู้จัดการ',
  `logo` varchar(100) DEFAULT NULL,
  `tax` varchar(20) DEFAULT NULL COMMENT 'เลขประจำตัวผู้เสียภาษี',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บรายละเอียดคลังสินค้ากลาง';

-- ----------------------------
--  Table structure for `contact`
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `tel` varchar(100) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์ร้านใส่ได้มากกว่า 1 ขั้นด้วย ,',
  `email` varchar(100) DEFAULT NULL COMMENT 'อีเมล์',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูลติดต่อ';

-- ----------------------------
--  Table structure for `contact_social`
-- ----------------------------
DROP TABLE IF EXISTS `contact_social`;
CREATE TABLE `contact_social` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `social_id` int(3) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูลติดต่อ SocialApp';

-- ----------------------------
--  Table structure for `diag`
-- ----------------------------
DROP TABLE IF EXISTS `diag`;
CREATE TABLE `diag` (
  `diagcode` int(5) NOT NULL AUTO_INCREMENT,
  `diagname` text COMMENT 'ชื่อหัตถการ',
  `price` double(7,0) DEFAULT NULL COMMENT 'ราคา',
  PRIMARY KEY (`diagcode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='ตารางหัตถการ';

-- ----------------------------
--  Table structure for `employee`
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `pid` char(10) NOT NULL DEFAULT '' COMMENT 'รหัสพนักงาน',
  `user_id` int(3) DEFAULT NULL COMMENT 'รหัสผู้ใช้งาน',
  `oid` char(3) DEFAULT NULL COMMENT 'รหัสคำนำหน้า',
  `name` varchar(100) DEFAULT NULL COMMENT 'ชื่อ',
  `lname` varchar(100) DEFAULT NULL COMMENT 'นามสกุล',
  `alias` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT 'อีเมล์',
  `tel` char(10) DEFAULT NULL COMMENT 'เบอร์โทร',
  `sex` enum('M','F') DEFAULT NULL,
  `birth` date DEFAULT NULL COMMENT 'วันเกิด',
  `d_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่',
  `create_date` timestamp NULL DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL COMMENT 'รูปภาพประจำตัว',
  `walking` date DEFAULT NULL COMMENT 'วันที่เริ่มทำงาน',
  `salary` int(11) DEFAULT NULL COMMENT 'เงินเดือน',
  `branch` int(3) DEFAULT NULL COMMENT 'สาขาที่ทำงาน',
  `position` int(3) DEFAULT NULL COMMENT 'ตำแหน่ง',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  KEY `oid` (`oid`) USING BTREE,
  KEY `pid` (`pid`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='ตารางสมาชิก';

-- ----------------------------
--  Table structure for `employee_point`
-- ----------------------------
DROP TABLE IF EXISTS `employee_point`;
CREATE TABLE `employee_point` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `employee_id` int(7) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `point` decimal(10,2) DEFAULT '0.00',
  `d_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บคะแนนค่าตอบแทน';

-- ----------------------------
--  Table structure for `gradcustomer`
-- ----------------------------
DROP TABLE IF EXISTS `gradcustomer`;
CREATE TABLE `gradcustomer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grad` varchar(255) DEFAULT '' COMMENT 'ประเภท',
  `distcount` int(5) DEFAULT '0' COMMENT 'ส่วนลดค่ารักษา',
  `distcountsell` int(5) DEFAULT '0' COMMENT 'ส่วนลดซื้อสินค้า',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บระดับลูกค้า';

-- ----------------------------
--  Table structure for `images`
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `images` varchar(255) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บข้อมูล';

-- ----------------------------
--  Table structure for `items`
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `itemcode` varchar(50) DEFAULT NULL COMMENT 'รหัสสินค้าชิ้นนั้น',
  `product_id` varchar(20) NOT NULL DEFAULT '0' COMMENT 'รหัสสินค้า',
  `delete_flag` int(1) DEFAULT '0' COMMENT '0 = ยังไม่ถูกลบ,1 = ลบสินค้าแล้ว',
  `status` int(1) DEFAULT '0' COMMENT '1 = ขาย,0 = ยังไม่ขาย',
  `expire` date DEFAULT NULL COMMENT 'วันที่หมดอายุ',
  `date_input` date DEFAULT NULL COMMENT 'วันที่นำเข้า',
  `d_update` datetime DEFAULT NULL COMMENT 'วันที่อัพเดท',
  `flag` char(1) DEFAULT 'E' COMMENT 'E มาจากการขาย,D มาจากห้องตรวจ',
  `number` int(7) DEFAULT '0' COMMENT 'จำนวน',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางสินค้า';

-- ----------------------------
--  Table structure for `listorder`
-- ----------------------------
DROP TABLE IF EXISTS `listorder`;
CREATE TABLE `listorder` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(10) DEFAULT NULL COMMENT 'รหัสรายการ',
  `product_id` varchar(10) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `number` int(5) DEFAULT NULL COMMENT 'จำนวน',
  `pricetotal` float(7,0) DEFAULT NULL COMMENT 'รวมราคา',
  `d_update` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0 = Unactive , 1= Active',
  `distcountpercent` int(3) DEFAULT NULL COMMENT 'ส่วนลด%',
  `distcountprice` decimal(10,2) DEFAULT NULL COMMENT 'ส่วนลดบาท',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บรายการสั่งซื้อสินค้าแต่ละ Orders';

-- ----------------------------
--  Table structure for `loglogin`
-- ----------------------------
DROP TABLE IF EXISTS `loglogin`;
CREATE TABLE `loglogin` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(3) DEFAULT NULL,
  `branch` int(3) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `logo`
-- ----------------------------
DROP TABLE IF EXISTS `logo`;
CREATE TABLE `logo` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `logo` varchar(100) DEFAULT NULL,
  `active` enum('0','1') DEFAULT '0' COMMENT '0 = ไม่เลือก',
  `d_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `branch` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บโลโก้เว็บ';

-- ----------------------------
--  Table structure for `logsell`
-- ----------------------------
DROP TABLE IF EXISTS `logsell`;
CREATE TABLE `logsell` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `sell_id` varchar(20) DEFAULT NULL,
  `income` int(7) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT '0.00',
  `user_id` int(5) DEFAULT NULL,
  `card` varchar(20) DEFAULT NULL,
  `branch` int(3) DEFAULT NULL,
  `date_sell` date DEFAULT NULL,
  `change` int(7) DEFAULT NULL,
  `totalfinal` decimal(10,0) DEFAULT '0',
  `distcount` double(7,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sell_id` (`sell_id`),
  CONSTRAINT `sell_id` FOREIGN KEY (`sell_id`) REFERENCES `sell` (`sell_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บการสั่งซื้อ';

-- ----------------------------
--  Table structure for `logserviceproduct`
-- ----------------------------
DROP TABLE IF EXISTS `logserviceproduct`;
CREATE TABLE `logserviceproduct` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `itemcode` varchar(20) DEFAULT NULL,
  `product_id` varchar(20) DEFAULT NULL,
  `service_id` int(7) DEFAULT NULL,
  `d_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `mapproductcode`
-- ----------------------------
DROP TABLE IF EXISTS `mapproductcode`;
CREATE TABLE `mapproductcode` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `productcodeclient` varchar(10) DEFAULT NULL COMMENT 'รหัสสินค้าลูกข่าย',
  `productcodemain` varchar(10) DEFAULT NULL COMMENT 'รหัสสินค้าสต๊อกกลาง',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `massocial`
-- ----------------------------
DROP TABLE IF EXISTS `massocial`;
CREATE TABLE `massocial` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `social_app` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บประเภทการติดต่อ SocialApp';

-- ----------------------------
--  Table structure for `masuser`
-- ----------------------------
DROP TABLE IF EXISTS `masuser`;
CREATE TABLE `masuser` (
  `id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT 'รหัสผ่าน',
  `status` int(3) DEFAULT NULL COMMENT 'สถานะ',
  `d_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่',
  `create_date` timestamp NULL DEFAULT NULL,
  `flag` int(11) DEFAULT '0' COMMENT '0 = ยังเป็นพนักงาน 1 = ยกเลิกการเป็นพนักงาน',
  `user_id` int(3) DEFAULT NULL COMMENT 'รหัสพนักงาน',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `password` (`password`) USING BTREE,
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id_del` FOREIGN KEY (`user_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='ตารางสมาชิก';

-- ----------------------------
--  Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `menu` varchar(100) DEFAULT NULL COMMENT 'เมนู',
  `link` varchar(255) DEFAULT NULL COMMENT 'ลิงค์',
  `active` int(1) DEFAULT '1',
  `icon` varchar(255) DEFAULT NULL,
  `type` char(1) DEFAULT 'L',
  `order` int(3) DEFAULT NULL COMMENT 'ลำดับ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `menu_report`
-- ----------------------------
DROP TABLE IF EXISTS `menu_report`;
CREATE TABLE `menu_report` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `report_name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `active` int(1) DEFAULT '0' COMMENT '1 = ไม่แสดง',
  `type` int(1) DEFAULT '1' COMMENT '1 = รายงานสาขา,2 = คลังสินค้ากลาง',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `menu_setting`
-- ----------------------------
DROP TABLE IF EXISTS `menu_setting`;
CREATE TABLE `menu_setting` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `setting` varchar(255) DEFAULT NULL,
  `user_id` int(3) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `month`
-- ----------------------------
DROP TABLE IF EXISTS `month`;
CREATE TABLE `month` (
  `id` char(2) NOT NULL,
  `month_th` varchar(100) DEFAULT NULL,
  `mount_en` varchar(100) DEFAULT NULL,
  `month_th_shot` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `occupation`
-- ----------------------------
DROP TABLE IF EXISTS `occupation`;
CREATE TABLE `occupation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `occupa_id` varchar(255) DEFAULT NULL,
  `occupationname` varchar(255) DEFAULT NULL COMMENT 'อาชีพ',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ID` (`id`),
  KEY `occupa_id` (`occupa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=805 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(10) DEFAULT NULL COMMENT 'รหัสรายการ',
  `branch` int(3) DEFAULT NULL COMMENT 'รหัสสาขา',
  `price` decimal(10,2) DEFAULT '0.00' COMMENT 'ราคาขาย',
  `distcount` double DEFAULT NULL COMMENT 'ส่วนลด %',
  `distcountprice` decimal(10,2) DEFAULT '0.00' COMMENT 'ราคาส่วนลด',
  `pricedeldistcount` decimal(10,2) DEFAULT '0.00' COMMENT 'ราคาหักส่วนลด',
  `vat` decimal(10,2) DEFAULT '0.00' COMMENT 'ภาษี',
  `priceresult` decimal(10,2) DEFAULT '0.00' COMMENT 'ราคาสุทธิ',
  `status` int(11) DEFAULT '0' COMMENT 'สถานะสั่งซื่อ 0 = ยังไม่ได้ของ,1 = ปลายทางส่งของ,2 = ต้นทางรับของ',
  `author` int(3) DEFAULT NULL COMMENT 'ผู้สั่งของ',
  `create_date` date DEFAULT NULL COMMENT 'วันที่สั่งของ',
  `d_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `branch` (`branch`),
  CONSTRAINT `branch_order` FOREIGN KEY (`branch`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `patient`
-- ----------------------------
DROP TABLE IF EXISTS `patient`;
CREATE TABLE `patient` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `pid` varchar(10) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `card` varchar(13) DEFAULT NULL COMMENT 'บัตรประชาชน',
  `oid` char(3) DEFAULT NULL COMMENT 'คำนำหน้า',
  `name` varchar(100) DEFAULT NULL COMMENT 'ชื่อ',
  `lname` varchar(100) DEFAULT NULL COMMENT 'นามสกุล',
  `birth` date DEFAULT NULL COMMENT 'วันเกิด',
  `sex` char(1) DEFAULT NULL COMMENT 'เพศ',
  `type` int(3) DEFAULT NULL COMMENT 'ประเภทลูกค้า',
  `branch` int(3) DEFAULT NULL COMMENT 'สาขาที่รับบริการ',
  `emp_id` int(3) DEFAULT NULL COMMENT 'ผู้บันทึกข้อมูล',
  `images` varchar(100) DEFAULT NULL COMMENT 'รูปภาพ',
  `create_date` date DEFAULT NULL COMMENT 'วันที่ลงทะเบียน',
  `d_update` date DEFAULT NULL COMMENT 'วันที่อัพเดทข้อมูล',
  `occupation` int(3) DEFAULT NULL COMMENT 'อาชีพ',
  `tel` varchar(20) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `email` varchar(255) DEFAULT NULL COMMENT 'อีเมล์',
  `contact` varchar(255) DEFAULT NULL COMMENT 'อื่น ๆ',
  PRIMARY KEY (`id`),
  KEY `branch` (`branch`),
  KEY `branch_2` (`branch`),
  CONSTRAINT `branchID` FOREIGN KEY (`branch`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `patient_contact`
-- ----------------------------
DROP TABLE IF EXISTS `patient_contact`;
CREATE TABLE `patient_contact` (
  `patient_id` int(3) NOT NULL DEFAULT '0' COMMENT 'รหัสลูกค้า',
  `tel` varchar(10) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `email` varchar(100) DEFAULT NULL COMMENT 'อีเมล์',
  `number` varchar(100) DEFAULT NULL COMMENT 'บ้านเลขที่',
  `tambon` varchar(10) DEFAULT NULL COMMENT 'ตำบล',
  `amphur` varchar(10) DEFAULT NULL COMMENT 'อำเภอ',
  `changwat` varchar(10) DEFAULT NULL COMMENT 'จังหวัด',
  `zipcode` varchar(10) DEFAULT NULL COMMENT 'รหัสไปรษณีย์',
  PRIMARY KEY (`patient_id`),
  CONSTRAINT `patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `patient_diag`
-- ----------------------------
DROP TABLE IF EXISTS `patient_diag`;
CREATE TABLE `patient_diag` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `patient_id` int(5) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `diag` int(3) DEFAULT NULL COMMENT 'รหัสหัตถการ',
  `create_date` date DEFAULT NULL COMMENT 'วันที่บันทึกข้อมูล',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `patient_disease`
-- ----------------------------
DROP TABLE IF EXISTS `patient_disease`;
CREATE TABLE `patient_disease` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `patient_id` int(5) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `disease` longtext COMMENT 'โรคประจำตัว',
  `d_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  CONSTRAINT `patient_di` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='ตารางโรคประจำตัว';

-- ----------------------------
--  Table structure for `patient_drug`
-- ----------------------------
DROP TABLE IF EXISTS `patient_drug`;
CREATE TABLE `patient_drug` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `patient_id` int(5) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `drug` longtext COMMENT 'อาการแพ้ยา',
  `d_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  CONSTRAINT `patient_drug` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='ตารางแพ้ยา';

-- ----------------------------
--  Table structure for `period`
-- ----------------------------
DROP TABLE IF EXISTS `period`;
CREATE TABLE `period` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `period` int(4) DEFAULT NULL,
  `active` int(1) DEFAULT '0' COMMENT '0 = No,1 = Yes',
  `default` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='ตรางเก็บช่วงระยะเวลาจองสินค้า';

-- ----------------------------
--  Table structure for `pername`
-- ----------------------------
DROP TABLE IF EXISTS `pername`;
CREATE TABLE `pername` (
  `oid` char(3) NOT NULL DEFAULT '' COMMENT 'รหัส',
  `pername` varchar(50) DEFAULT NULL COMMENT 'คำนำหน้า',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางคำนำหน้าชื่อ';

-- ----------------------------
--  Table structure for `position`
-- ----------------------------
DROP TABLE IF EXISTS `position`;
CREATE TABLE `position` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(20) NOT NULL DEFAULT '0' COMMENT 'รหัสสินค้า',
  `product_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `costs` float DEFAULT NULL COMMENT 'ต้นทุน',
  `product_price` int(7) DEFAULT '0' COMMENT 'ราคา',
  `product_detail` text COMMENT 'รายละเอียด',
  `type_id` char(3) DEFAULT NULL COMMENT 'รหัส ประเภท',
  `delete_flag` int(1) DEFAULT '0' COMMENT '0 = ยังไม่ถูกลบ,1 = ลบสินค้าแล้ว',
  `status` int(1) DEFAULT '0' COMMENT '0 = พร้อมขาย,1 = ไม่พร้อมขาย',
  `d_update` datetime DEFAULT NULL COMMENT 'วันที่อัพเดท',
  `branch` int(3) DEFAULT NULL COMMENT 'สาขา',
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='ตารางสินค้า';

-- ----------------------------
--  Table structure for `product_images`
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(20) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `images` varchar(100) DEFAULT NULL COMMENT 'รูปภาพ',
  `active` int(1) DEFAULT '0',
  `img_id` int(7) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `product_id_2` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บรูปภาพสินค้า';

-- ----------------------------
--  Table structure for `product_type`
-- ----------------------------
DROP TABLE IF EXISTS `product_type`;
CREATE TABLE `product_type` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `type_id` char(3) NOT NULL DEFAULT '' COMMENT 'รหัสประเภท',
  `type_name` varchar(255) DEFAULT NULL COMMENT 'ประเภท',
  `active` int(1) DEFAULT '1' COMMENT 'สถนนะ',
  `upper` int(5) DEFAULT NULL COMMENT 'รหัสประเภทหลัก',
  `sublevel` int(1) DEFAULT '0' COMMENT '1 = มีเมนูย่อย',
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='ตารางประเภทสินค้า';

-- ----------------------------
--  Table structure for `repair`
-- ----------------------------
DROP TABLE IF EXISTS `repair`;
CREATE TABLE `repair` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `object` varchar(255) DEFAULT NULL COMMENT 'อุปกรณ์ซ่อม',
  `detail` varchar(255) DEFAULT NULL COMMENT 'อาการ',
  `price` decimal(10,2) DEFAULT NULL COMMENT 'ราคา',
  `user` int(5) DEFAULT NULL COMMENT 'ผู้บันทึก',
  `d_update` date DEFAULT NULL COMMENT 'วันที่บันทึก',
  `date_alert` date DEFAULT NULL COMMENT 'วันที่แจ้งเตือนการซ่อม',
  `status` int(1) DEFAULT '0' COMMENT '0=ยังไม่ซ่อม,1=ซ่อมแล้ว',
  `branch` int(3) DEFAULT NULL COMMENT 'สาขา',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='ตารางซ่อมเครื่องใช้สำนักงาน';

-- ----------------------------
--  Table structure for `role_branch`
-- ----------------------------
DROP TABLE IF EXISTS `role_branch`;
CREATE TABLE `role_branch` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `user_id` int(3) DEFAULT NULL COMMENT 'รหัสผู้ใช้งาน',
  `branch_id` int(3) DEFAULT NULL COMMENT 'สิทธิ์การเข้าถึงสาขา',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `role_menu`
-- ----------------------------
DROP TABLE IF EXISTS `role_menu`;
CREATE TABLE `role_menu` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `user_id` int(3) DEFAULT NULL COMMENT 'รหัสผู้ใช้งาน',
  `menu_id` int(3) DEFAULT NULL COMMENT 'สิทธิ์การใช้งาน',
  PRIMARY KEY (`id`),
  KEY `menu_id` (`menu_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `masuser` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `role_report`
-- ----------------------------
DROP TABLE IF EXISTS `role_report`;
CREATE TABLE `role_report` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `user_id` int(3) DEFAULT NULL,
  `report_id` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `report_id` (`report_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  CONSTRAINT `report_id` FOREIGN KEY (`report_id`) REFERENCES `menu_report` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_id2` FOREIGN KEY (`user_id`) REFERENCES `masuser` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `role_setting`
-- ----------------------------
DROP TABLE IF EXISTS `role_setting`;
CREATE TABLE `role_setting` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `setting_id` int(3) DEFAULT NULL,
  `user_id` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seeting_id` (`setting_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `setting` FOREIGN KEY (`setting_id`) REFERENCES `menu_setting` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_id3` FOREIGN KEY (`user_id`) REFERENCES `masuser` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `salary`
-- ----------------------------
DROP TABLE IF EXISTS `salary`;
CREATE TABLE `salary` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `month` varchar(10) DEFAULT NULL COMMENT 'เดือน',
  `year` varchar(10) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL COMMENT 'จำนวนเงินรวม',
  `branch` int(3) DEFAULT NULL,
  `d_update` date DEFAULT NULL COMMENT 'วันที่บันทึก',
  `user` int(3) DEFAULT NULL COMMENT 'ผู้บันทึก',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='บันทึกรายจ่ายเงินเดือนรวมแต่ละเดือน';

-- ----------------------------
--  Table structure for `salarylist`
-- ----------------------------
DROP TABLE IF EXISTS `salarylist`;
CREATE TABLE `salarylist` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `employee` varchar(20) DEFAULT NULL COMMENT 'พนักงาน',
  `salary` decimal(10,2) DEFAULT NULL COMMENT 'เงินเดือน',
  `month` varchar(10) DEFAULT NULL COMMENT 'เดือน',
  `year` varchar(10) DEFAULT NULL COMMENT 'ปี',
  `branch` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='เก็บรายการจ่ายเงินเดือนแต่ละคน(employee = pid ตาราง employee)';

-- ----------------------------
--  Table structure for `sell`
-- ----------------------------
DROP TABLE IF EXISTS `sell`;
CREATE TABLE `sell` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `sell_id` varchar(20) DEFAULT NULL,
  `itemcode` varchar(20) DEFAULT NULL,
  `card` varchar(20) DEFAULT NULL,
  `product_id` varchar(20) DEFAULT NULL,
  `user_id` int(3) DEFAULT NULL,
  `date_sell` date DEFAULT NULL,
  `branch` int(3) DEFAULT NULL,
  `comfirm` int(1) DEFAULT '0',
  `number` int(10) DEFAULT NULL COMMENT 'จำนวน',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `sell_id` (`sell_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `service`
-- ----------------------------
DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `branch` int(3) DEFAULT NULL COMMENT 'รหัสสาขา',
  `patient_id` int(5) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `diagcode` int(5) DEFAULT NULL COMMENT 'รหัสหัตถการ',
  `price_total` decimal(10,2) DEFAULT '0.00' COMMENT 'ราคาหัตถการ(รวม)',
  `user_id` int(5) DEFAULT NULL COMMENT 'ผู้ให้บริการ(พยาบาลซักประวัติ)',
  `checkbody` date DEFAULT NULL COMMENT 'วันที่ตรวจร่างกาย',
  `service_date` date DEFAULT NULL COMMENT 'วันที่รับบริการ',
  `service_result` longtext COMMENT 'ผลกการรักษา',
  `comment` longtext COMMENT 'Comment โรคที่มารักษา',
  `d_update` timestamp NULL DEFAULT NULL COMMENT 'วันที่แก้ไขข้อมูล',
  `status` int(1) DEFAULT '1' COMMENT '1 = เข้าคิวรอเรียกตัว,2 = เข้ารักษา,3 = ออกจากห้องคิดค่าใช้จ่ายนัดคิว,4 = เสร็จกระบวนการ',
  `doctor` int(3) DEFAULT NULL COMMENT 'แพทย์ผู้ให้บริการ',
  `user_bill` int(3) DEFAULT NULL COMMENT 'พนักงานออกบิล',
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `patient_id_2` (`patient_id`),
  KEY `patient_id_3` (`patient_id`),
  CONSTRAINT `patient_service` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `service_detail`
-- ----------------------------
DROP TABLE IF EXISTS `service_detail`;
CREATE TABLE `service_detail` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `service_id` int(5) DEFAULT NULL COMMENT 'รหัสการให้บริการ',
  `patient_id` int(5) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `detail` longtext COMMENT 'รายละเอียดการรักษา',
  `price` decimal(10,2) DEFAULT NULL COMMENT 'ค่าใช้จ่าย',
  `comment` longtext COMMENT 'comment',
  `doctor` int(5) DEFAULT NULL COMMENT 'แพทย์ผู้รักษา',
  `date_serv` timestamp NULL DEFAULT NULL COMMENT 'วันที่บันทึก',
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `service_id` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บการรักษาค่าใช้จ่าย(1 ครั้ง สามารถมีหลายการรักษา)';

-- ----------------------------
--  Table structure for `service_diag`
-- ----------------------------
DROP TABLE IF EXISTS `service_diag`;
CREATE TABLE `service_diag` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `service_id` int(5) DEFAULT NULL COMMENT 'รหัสการรับบริการ',
  `patient_id` int(5) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `diagcode` int(5) DEFAULT NULL COMMENT 'รหัสหัตถการ',
  `diagprice` decimal(10,2) DEFAULT NULL COMMENT 'ราคาหัตถการ',
  `doctor` int(5) DEFAULT NULL COMMENT 'แพทย์ผู้บันทึก',
  `date_serv` timestamp NULL DEFAULT NULL COMMENT 'วันที่บันทึก',
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `service_id_2` (`service_id`),
  CONSTRAINT `service_id_diag` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='เก็บการให้บริการหัตถการ';

-- ----------------------------
--  Table structure for `service_drug`
-- ----------------------------
DROP TABLE IF EXISTS `service_drug`;
CREATE TABLE `service_drug` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `patient_id` int(5) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `drug` varchar(20) DEFAULT NULL COMMENT 'รหัสยา / รหัสสินค้า',
  `service_id` int(5) DEFAULT NULL COMMENT 'รหัสที่มารับบริการ',
  `doctor` int(3) DEFAULT NULL COMMENT 'แพทย์ผู้ให้บริการ',
  `price` decimal(10,2) DEFAULT NULL COMMENT 'ราคาต่อหน่วย(ถ้าจัดโปรเอาราคาโปรมาแสดง)',
  `date_serv` date DEFAULT NULL COMMENT 'วันที่บันทึก',
  `number` int(5) DEFAULT NULL COMMENT 'จำนวน',
  `total` decimal(10,2) DEFAULT NULL COMMENT 'รวม',
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `service_drug` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `service_etc`
-- ----------------------------
DROP TABLE IF EXISTS `service_etc`;
CREATE TABLE `service_etc` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `service_id` int(5) DEFAULT NULL COMMENT 'รหัสการให้บริการ',
  `patient_id` int(5) DEFAULT NULL COMMENT 'รหัสลูกค้า',
  `detail` longtext COMMENT 'รายละเอียดการรักษา',
  `price` decimal(10,2) DEFAULT NULL COMMENT 'ค่าใช้จ่าย',
  `doctor` int(5) DEFAULT NULL COMMENT 'แพทย์ผู้รักษา',
  `date_serv` timestamp NULL DEFAULT NULL COMMENT 'วันที่บันทึก',
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  CONSTRAINT `service_etc_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บการรักษาค่าใช้จ่ายอื่น ๆ ถ้ามี(1 ครั้ง สามารถมีหลายการรักษา)';

-- ----------------------------
--  Table structure for `service_images`
-- ----------------------------
DROP TABLE IF EXISTS `service_images`;
CREATE TABLE `service_images` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `seq` int(5) DEFAULT NULL COMMENT 'เลขการให้บริการ',
  `images` varchar(255) DEFAULT NULL COMMENT 'images',
  `create_date` timestamp NULL DEFAULT NULL,
  `service_id` int(7) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `service_id_2` (`service_id`),
  CONSTRAINT `service_id_img` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `status_user`
-- ----------------------------
DROP TABLE IF EXISTS `status_user`;
CREATE TABLE `status_user` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tambon`
-- ----------------------------
DROP TABLE IF EXISTS `tambon`;
CREATE TABLE `tambon` (
  `tambon_id` int(11) NOT NULL AUTO_INCREMENT,
  `tambon_code` varchar(6) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tambon_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ampur_id` int(11) NOT NULL DEFAULT '0',
  `changwat_id` int(11) NOT NULL DEFAULT '0',
  `geo_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tambon_id`),
  KEY `ampur_id` (`ampur_id`),
  CONSTRAINT `ampur` FOREIGN KEY (`ampur_id`) REFERENCES `ampur` (`ampur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8861 DEFAULT CHARSET=utf8 COMMENT='ตารางตำบล';

-- ----------------------------
--  Table structure for `temp_item`
-- ----------------------------
DROP TABLE IF EXISTS `temp_item`;
CREATE TABLE `temp_item` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(10) DEFAULT NULL,
  `itemcode` varchar(10) DEFAULT NULL,
  `number` int(10) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `unit` varchar(100) DEFAULT NULL,
  `itemid` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=543 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `unit`
-- ----------------------------
DROP TABLE IF EXISTS `unit`;
CREATE TABLE `unit` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `unit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `webname`
-- ----------------------------
DROP TABLE IF EXISTS `webname`;
CREATE TABLE `webname` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `webname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='ตารางเก็บชื่อระบบงาน';

-- ----------------------------
--  Table structure for `zipcodes`
-- ----------------------------
DROP TABLE IF EXISTS `zipcodes`;
CREATE TABLE `zipcodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tambon_code` varchar(6) COLLATE utf8_bin NOT NULL,
  `zipcode` varchar(5) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7456 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

SET FOREIGN_KEY_CHECKS = 1;
