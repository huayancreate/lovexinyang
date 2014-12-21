/*
SQLyog v10.2 
MySQL - 5.5.16 : Database - axy
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`axy` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

USE `axy`;

/*Data for the table `ad_advertisement` */

insert  into `ad_advertisement`(`id`,`createrId`,`createTime`,`mapLink`,`mapOrder`,`mapLocation`,`updateTime`,`adName`,`endDate`,`startDate`,`isValid`,`photoUrl`) values (1,0,'2014-12-15 17:24:16','1',111,NULL,NULL,'1','2014-12-15 00:00:00','2014-12-15 00:00:00','1','1');
insert  into `ad_advertisement`(`id`,`createrId`,`createTime`,`mapLink`,`mapOrder`,`mapLocation`,`updateTime`,`adName`,`endDate`,`startDate`,`isValid`,`photoUrl`) values (2,0,'2014-12-15 17:25:40','2',2,NULL,NULL,'2','2014-12-15 00:00:00','2014-12-15 00:00:00','1','2');
insert  into `ad_advertisement`(`id`,`createrId`,`createTime`,`mapLink`,`mapOrder`,`mapLocation`,`updateTime`,`adName`,`endDate`,`startDate`,`isValid`,`photoUrl`) values (3,0,'2014-12-15 17:33:01','3',3,NULL,NULL,'3','2014-12-15 00:00:00','2014-12-15 00:00:00','1','3');
insert  into `ad_advertisement`(`id`,`createrId`,`createTime`,`mapLink`,`mapOrder`,`mapLocation`,`updateTime`,`adName`,`endDate`,`startDate`,`isValid`,`photoUrl`) values (4,0,'2014-12-15 17:40:27','4',4,NULL,NULL,'4','2014-12-15 00:00:00','2014-12-15 00:00:00','1','4');
insert  into `ad_advertisement`(`id`,`createrId`,`createTime`,`mapLink`,`mapOrder`,`mapLocation`,`updateTime`,`adName`,`endDate`,`startDate`,`isValid`,`photoUrl`) values (5,0,'2014-12-15 17:40:36','5',5,NULL,NULL,'5','2014-12-15 00:00:00','2014-12-15 00:00:00','1','5');
insert  into `ad_advertisement`(`id`,`createrId`,`createTime`,`mapLink`,`mapOrder`,`mapLocation`,`updateTime`,`adName`,`endDate`,`startDate`,`isValid`,`photoUrl`) values (6,0,'2014-12-15 17:40:52','6',6,NULL,'2014-12-15 17:50:53','6','2014-12-15 00:00:00','2014-12-15 00:00:00','0','6');
insert  into `ad_advertisement`(`id`,`createrId`,`createTime`,`mapLink`,`mapOrder`,`mapLocation`,`updateTime`,`adName`,`endDate`,`startDate`,`isValid`,`photoUrl`) values (7,0,'2014-12-16 14:59:43','7',7,NULL,NULL,'7','2014-12-16 00:00:00','2014-12-16 00:00:00','1','7');

/*Data for the table `ad_push_message` */

/*Data for the table `ad_recommend_goods` */

insert  into `ad_recommend_goods`(`id`,`creater`,`createTime`,`adLocation`,`endDate`,`startDate`,`ad_recommend_goods`,`isValid`,`ad_advertisement`,`order`) values (1,0,'2014-12-16 11:37:10',NULL,'2014-12-16 00:00:00','2014-12-16 00:00:00',1,'0','1',1);
insert  into `ad_recommend_goods`(`id`,`creater`,`createTime`,`adLocation`,`endDate`,`startDate`,`ad_recommend_goods`,`isValid`,`ad_advertisement`,`order`) values (2,0,'2014-12-16 11:56:15',NULL,'2014-12-16 00:00:00','2014-12-16 00:00:00',1,'0','2',2);
insert  into `ad_recommend_goods`(`id`,`creater`,`createTime`,`adLocation`,`endDate`,`startDate`,`ad_recommend_goods`,`isValid`,`ad_advertisement`,`order`) values (3,0,'2014-12-16 15:00:33',NULL,'2014-12-16 00:00:00','2014-12-16 00:00:00',2,'1','2',2);
insert  into `ad_recommend_goods`(`id`,`creater`,`createTime`,`adLocation`,`endDate`,`startDate`,`ad_recommend_goods`,`isValid`,`ad_advertisement`,`order`) values (4,0,'2014-12-16 15:14:30',NULL,'2014-12-16 00:00:00','2014-12-16 00:00:00',3,'0','2',3);
insert  into `ad_recommend_goods`(`id`,`creater`,`createTime`,`adLocation`,`endDate`,`startDate`,`ad_recommend_goods`,`isValid`,`ad_advertisement`,`order`) values (5,0,'2014-12-16 15:15:57',NULL,'2014-12-16 00:00:00','2014-12-16 00:00:00',5,'0','2',5);
insert  into `ad_recommend_goods`(`id`,`creater`,`createTime`,`adLocation`,`endDate`,`startDate`,`ad_recommend_goods`,`isValid`,`ad_advertisement`,`order`) values (6,0,'2014-12-17 18:29:59',NULL,'2014-12-17 00:00:00','2014-12-17 00:00:00',1,'1',NULL,8);
insert  into `ad_recommend_goods`(`id`,`creater`,`createTime`,`adLocation`,`endDate`,`startDate`,`ad_recommend_goods`,`isValid`,`ad_advertisement`,`order`) values (7,0,'2014-12-18 09:33:39',NULL,'2014-12-18 00:00:00','2014-12-18 00:00:00',11,'1',NULL,9);

/*Data for the table `com_account` */

insert  into `com_account`(`id`,`email`,`createTime`,`phoneNumber`,`updateTime`,`password`,`sex`,`nickname`,`userName`,`accountStatus`,`address`,`isFirstLogin`) values (1,'wzz_rj0902@163.com','2014-12-07 10:30:30','15055172456','2014-12-07 10:30:30','123456','男','liuwei','wliu',1,'dizhi','1');
insert  into `com_account`(`id`,`email`,`createTime`,`phoneNumber`,`updateTime`,`password`,`sex`,`nickname`,`userName`,`accountStatus`,`address`,`isFirstLogin`) values (2,'wliu@126.com','2014-12-07 10:30:49','15055172456','2014-12-07 10:30:49','123456','男','liuwei','13855117262',1,'dizhi','1');
insert  into `com_account`(`id`,`email`,`createTime`,`phoneNumber`,`updateTime`,`password`,`sex`,`nickname`,`userName`,`accountStatus`,`address`,`isFirstLogin`) values (3,'11@126.com','2014-12-07 10:43:06','123','2014-12-07 10:43:06','123456','男','123','11',1,'123','1');
insert  into `com_account`(`id`,`email`,`createTime`,`phoneNumber`,`updateTime`,`password`,`sex`,`nickname`,`userName`,`accountStatus`,`address`,`isFirstLogin`) values (4,'12123@126.com','2014-12-08 04:11:29','12312','2014-12-08 04:11:29','123456','女','1231','111123',1,'123','1');

/*Data for the table `com_blacklist` */

/*Data for the table `com_business_district` */

insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (1,NULL,'新天地',1,'0');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (2,NULL,'文化宫',1,'0');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (3,NULL,'体彩广场',4,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (4,NULL,'天润广场',2,'0');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (5,NULL,'和美广场',2,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (6,NULL,'信阳师院',5,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (7,NULL,'东方红大道',3,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (8,NULL,'三里庵',6,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (9,NULL,'之心城',6,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (10,NULL,'万达广场',7,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (11,NULL,'宝业东城广场',8,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (12,NULL,'白水坝',9,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (13,NULL,'港澳广场',10,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (14,NULL,'皖西学院',11,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (15,NULL,'寿县',12,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (16,NULL,'集贤南路',13,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (17,NULL,'华润五环城',14,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (18,NULL,'长江批发市场',15,'1');
insert  into `com_business_district`(`businessDistrictId`,`businessDistrictCode`,`businessDistrictName`,`countyId`,`isValid`) values (19,20141202,'浉河区002',1,'0');

/*Data for the table `com_category_maintain` */

insert  into `com_category_maintain`(`id`,`parentCategoryId`,`categoryAttribute`,`categoryFeature`,`categoryCode`,`categoryGrade`,`categoryName`,`categoryType`,`operatorId`,`operatorName`,`updateTime`,`isValid`,`sort`) values (1,NULL,'','',20141200,NULL,'测试数据0',1,NULL,NULL,'2014-12-03 17:54:41','0',0);
insert  into `com_category_maintain`(`id`,`parentCategoryId`,`categoryAttribute`,`categoryFeature`,`categoryCode`,`categoryGrade`,`categoryName`,`categoryType`,`operatorId`,`operatorName`,`updateTime`,`isValid`,`sort`) values (2,1,'','',20141201,NULL,'测试数据1',1,NULL,NULL,'2014-12-03 10:45:22','1',1);
insert  into `com_category_maintain`(`id`,`parentCategoryId`,`categoryAttribute`,`categoryFeature`,`categoryCode`,`categoryGrade`,`categoryName`,`categoryType`,`operatorId`,`operatorName`,`updateTime`,`isValid`,`sort`) values (3,1,'','',20141202,NULL,'测试数据2',1,NULL,NULL,'2014-12-03 10:45:26','1',2);
insert  into `com_category_maintain`(`id`,`parentCategoryId`,`categoryAttribute`,`categoryFeature`,`categoryCode`,`categoryGrade`,`categoryName`,`categoryType`,`operatorId`,`operatorName`,`updateTime`,`isValid`,`sort`) values (4,NULL,'','',20141203,NULL,'测试数据3',1,NULL,NULL,'2014-12-03 10:45:29','1',3);
insert  into `com_category_maintain`(`id`,`parentCategoryId`,`categoryAttribute`,`categoryFeature`,`categoryCode`,`categoryGrade`,`categoryName`,`categoryType`,`operatorId`,`operatorName`,`updateTime`,`isValid`,`sort`) values (5,4,'','',20141214,NULL,'测试数据4',2,NULL,NULL,'2014-12-03 10:45:12','1',4);
insert  into `com_category_maintain`(`id`,`parentCategoryId`,`categoryAttribute`,`categoryFeature`,`categoryCode`,`categoryGrade`,`categoryName`,`categoryType`,`operatorId`,`operatorName`,`updateTime`,`isValid`,`sort`) values (7,5,'','',20141205,NULL,'测试数据5',2,NULL,NULL,NULL,'1',5);
insert  into `com_category_maintain`(`id`,`parentCategoryId`,`categoryAttribute`,`categoryFeature`,`categoryCode`,`categoryGrade`,`categoryName`,`categoryType`,`operatorId`,`operatorName`,`updateTime`,`isValid`,`sort`) values (8,7,NULL,NULL,201411231,NULL,'CAD啊啊啊',2,NULL,NULL,NULL,'1',10);

/*Data for the table `com_checkout_stream` */

insert  into `com_checkout_stream`(`id`,`operatorId`,`operatorAccount`,`operatorTime`,`depositAlipayName`,`depositAlipayAccount`,`interfaceSerialNumber`,`balanceMoney`,`balanceApplyId`,`balanceTime`,`storeId`,`storeName`,`expenditureAlipayName`,`expenditureAlipayAccount`,`alipayTransactionStream`,`payTime`) values (7,111,'张三','2014-12-19 15:24:03','张三','123@qq.com','12345678',0,111,'2014-12-19 15:24:03',111,'111','111','111','111','2014-12-19 15:24:03');

/*Data for the table `com_citycenter` */

insert  into `com_citycenter`(`id`,`cityCenterName`) values (1,'信阳');
insert  into `com_citycenter`(`id`,`cityCenterName`) values (2,'合肥');
insert  into `com_citycenter`(`id`,`cityCenterName`) values (3,'安庆');

/*Data for the table `com_comment` */

/*Data for the table `com_comment_del` */

/*Data for the table `com_county` */

insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (1,'浉河区',1,'0');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (2,'罗山县',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (3,'固始县',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (4,'光山县',2,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (5,'淮滨县',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (6,'蜀山区',2,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (7,'高新区',2,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (8,'庐阳区',2,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (9,'瑶海区',2,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (10,'经开区',2,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (11,'迎江区',3,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (12,'望江县',3,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (13,'潜山县',3,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (14,'怀宁县',3,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (15,'岳西县',3,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (16,'枞阳县',3,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (17,'TEST888888',2,'0');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (18,'罗山县222222',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (19,'S99999999',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (20,'11111',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (21,'Test县',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (22,'Test1县',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (23,'1',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (24,'2',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (25,'3',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (26,'4',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (27,'5',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (28,'6',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (29,'8',1,'1');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (30,'test',1,'0');
insert  into `com_county`(`countyId`,`countyName`,`cityCenterId`,`isValid`) values (31,'测试数据111',1,'1');

/*Data for the table `com_evaluation_category` */

insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (1,NULL,'2014-11-06 15:18:32',NULL,NULL,2014001,NULL,'美食',NULL,'1',5);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (2,NULL,'2014-11-06 15:14:03',NULL,NULL,2014002,NULL,'酒店',NULL,'1',2);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (3,NULL,'2014-11-06 10:45:10',NULL,NULL,2014003,NULL,'电影',NULL,'1',3);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (4,NULL,'2014-11-06 10:45:51',NULL,NULL,2014004,NULL,'休闲娱乐',NULL,'1',4);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (5,NULL,'2014-11-06 15:23:52',NULL,NULL,2014005,NULL,'旅游',NULL,'0',10);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (6,NULL,'2014-11-03 15:22:33',NULL,NULL,2014006,NULL,'丽人',NULL,'1',6);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (7,5,'2014-11-06 15:23:52',NULL,NULL,2014007,NULL,'登山',NULL,'0',1);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (8,1,'2014-11-06 15:18:32',NULL,NULL,2014008,NULL,'火锅',NULL,'1',NULL);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (9,5,'2014-11-06 15:23:52',NULL,NULL,2014009,NULL,'麻辣香锅',NULL,'0',NULL);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (10,2,'2014-11-04 17:35:18',NULL,NULL,20140010,NULL,'快捷酒店',NULL,'1',NULL);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (11,2,'2014-11-13 15:51:14',NULL,NULL,20140011,NULL,'五星级酒店',NULL,'1',NULL);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (12,1,'2014-11-06 15:18:32',NULL,NULL,20140012,NULL,'自助餐',NULL,'1',NULL);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (13,1,'2014-11-06 15:18:32',NULL,NULL,20140013,NULL,'纸上烤肉',NULL,'1',NULL);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (14,4,'2014-11-06 10:45:42',NULL,NULL,20140014,NULL,'KTV',NULL,'1',NULL);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (17,6,'2014-11-05 16:52:50',NULL,NULL,20140015,NULL,'瘦身体育馆',NULL,'1',7);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (18,6,'2014-11-06 10:45:33',NULL,NULL,20140017,NULL,'纤荷瘦身',NULL,'1',NULL);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (19,6,'2014-11-06 14:38:39',NULL,NULL,20140016,NULL,'美发',NULL,'1',NULL);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (20,6,'2014-11-05 16:32:02',NULL,NULL,20140018,NULL,'美甲',NULL,'1',NULL);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (21,3,'2014-11-06 15:24:40',NULL,NULL,20140019,NULL,'露水红颜',NULL,'0',NULL);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (22,NULL,'2014-11-06 17:47:25',NULL,NULL,20140020,NULL,'单身男女2',NULL,'0',9);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (23,22,'2014-11-06 17:47:25',NULL,NULL,20140021,NULL,'单身男女2',NULL,'0',NULL);
insert  into `com_evaluation_category`(`id`,`mapCategoryParenClasstId`,`updateTime`,`categoryAttribute`,`categoryFeature`,`evaluationCategoryCode`,`evaluationCategoryGrade`,`evaluationName`,`evaluationAttribute`,`isValid`,`sort`) values (24,6,'2014-11-17 14:38:08',NULL,NULL,20140017,NULL,'汗蒸',NULL,'1',NULL);

/*Data for the table `com_goods_review` */

insert  into `com_goods_review`(`cgrId`,`goodsId`,`goodsName`,`applyerId`,`applyerAccount`,`applyTime`,`reviewerId`,`reviewerName`,`reviewTaskId`,`reviewTime`,`reviewStatus`,`remark`) values (1,1,'1',1,'1','2014-12-08 17:33:18',1,'1',1,'0000-00-00 00:00:00',0,'1');

/*Data for the table `com_menu` */

insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (1,NULL,'菜单目录','2014-11-05 10:11:53',0,NULL,'1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (2,'','权限管理','2014-10-28 10:59:24',1,'2014-12-07 16:18:59','1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (12,'','广告管理','2014-10-28 09:24:44',1,'2014-10-30 17:20:42','1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (14,'','旅游管理','2014-10-28 16:52:56',1,NULL,'1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (15,'','test','2014-10-29 10:43:51',14,NULL,'0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (16,'','www','2014-10-29 10:45:59',1,NULL,'0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (21,'','eeeeeee','2014-10-29 14:54:26',1,NULL,'0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (22,'','菜单管理','2014-10-29 17:54:35',2,'2014-10-31 12:39:37','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (23,'','系统配置','2014-10-29 18:17:18',1,'2014-11-07 17:18:15','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (24,'','财务管理','2014-10-30 10:02:06',1,NULL,'1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (25,'','数据删除','2014-10-30 11:44:15',1,NULL,'1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (26,'','账号管理','2014-10-30 11:49:23',2,'2014-12-07 13:58:14','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (27,'','客户经理中心','2014-10-30 17:23:18',1,'2014-10-30 17:31:12','1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (28,'','审核管理','2014-10-30 17:31:51',1,NULL,'1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (29,'','留言管理','2014-10-30 17:32:49',1,NULL,'1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (30,'','省市配置','2014-10-31 13:48:55',23,'2014-11-07 17:18:15','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (31,'','商品类别配置','2014-10-31 13:53:32',23,'2014-11-07 17:18:15','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (32,'','客户工单','2014-10-31 17:59:12',1,'2014-10-31 18:05:38','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (33,'www.qq.com','我的店铺','2014-12-03 11:21:38',1,'2014-12-03 11:22:31','1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (34,'www.google.com','店铺信息','2014-12-03 11:23:24',33,'2014-12-03 12:34:25','1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (35,'addgoods','添加商品','2014-12-03 11:23:52',33,'2014-12-03 11:25:53','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (36,'','消费者评价','2014-12-03 11:48:39',33,'2014-12-03 11:53:55','1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (37,'','test22222','2014-12-03 11:51:00',33,'2014-12-03 11:55:19','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (38,'','1111','2014-12-03 11:51:30',33,'2014-12-03 11:52:03','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (39,'www.baidu.com','webtest1','2014-12-05 13:23:20',1,'2014-12-05 13:23:32','1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (40,'www.google.com','test111111','2014-12-05 13:23:46',39,'2014-12-05 13:23:52','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (41,'123123','123123','2014-12-05 08:19:59',1,'2014-12-09 09:24:18','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (42,'235555','1351','2014-12-05 08:20:40',41,'2014-12-09 09:24:18','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (43,'','12315566','2014-12-05 08:22:03',41,'2014-12-09 09:24:18','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (44,'','我的会员','2014-12-07 14:20:04',1,'2014-12-07 14:21:11','1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (45,'http://www.baidu.com','购买券验证','2014-12-07 14:20:45',44,NULL,'1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (46,'www.google.com1','购买券查询11','2014-12-07 16:37:56',44,'2014-12-07 16:39:41','0');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (47,'www.google.com','会员设置','2014-12-07 17:13:43',44,NULL,'1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (48,'','会员消费登记','2014-12-07 17:16:53',44,NULL,'1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (49,'http://localhost/ixinyang-web/ixinyang/backend/web/index.php?r=com-menu%2Findex','财务合同管理','2014-12-07 17:39:54',1,'2014-12-07 17:42:07','1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (50,'test121','test121','2014-12-12 08:18:38',1,'2014-12-12 08:20:52','1');
insert  into `com_menu`(`id`,`menuUrl`,`menuName`,`createTime`,`parentMenuId`,`updateTime`,`isValid`) values (51,'22','23','2014-12-12 08:19:15',50,'2014-12-12 08:19:48','1');

/*Data for the table `com_menu_rolerelation` */

insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (627,1,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (628,2,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (629,22,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (630,26,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (631,12,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (632,14,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (633,15,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (634,16,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (635,21,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (636,23,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (637,30,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (638,31,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (639,24,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (640,25,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (641,27,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (642,28,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (643,29,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (644,32,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (645,33,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (646,34,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (647,35,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (648,36,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (649,37,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (650,38,NULL,NULL,63,NULL);
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (651,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (652,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (653,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (654,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (655,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (656,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (657,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (658,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (659,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (660,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (661,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (662,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (663,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (664,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (665,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (666,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (667,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (668,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (669,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (670,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (671,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (672,NULL,'administrator','2014-12-04 02:40:50',63,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (770,1,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (771,2,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (772,22,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (773,26,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (774,12,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (775,14,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (776,15,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (777,21,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (778,23,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (779,30,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (780,31,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (781,24,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (782,25,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (783,27,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (784,28,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (785,29,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (786,32,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (787,33,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (788,34,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (789,35,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (790,36,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (791,37,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (792,38,'administrator','2014-12-04 03:34:19',64,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (1016,NULL,'administrator','2014-12-08 16:29:38',70,'1');
insert  into `com_menu_rolerelation`(`id`,`menuId`,`creater`,`updateTime`,`roleId`,`isValid`) values (1052,NULL,'administrator','2014-12-12 08:15:17',1,'1');

/*Data for the table `com_message_box` */

/*Data for the table `com_person_rolerelation` */

insert  into `com_person_rolerelation`(`id`,`updateTime`,`roleId`,`personId`,`isValid`,`accountType`) values (5,'2014-12-07 10:30:49',2,2,'1',1);
insert  into `com_person_rolerelation`(`id`,`updateTime`,`roleId`,`personId`,`isValid`,`accountType`) values (7,'2014-12-07 10:43:29',2,3,'1',1);
insert  into `com_person_rolerelation`(`id`,`updateTime`,`roleId`,`personId`,`isValid`,`accountType`) values (8,'2014-12-07 10:43:29',3,3,'1',1);
insert  into `com_person_rolerelation`(`id`,`updateTime`,`roleId`,`personId`,`isValid`,`accountType`) values (15,'2014-12-08 04:13:04',2,4,'1',1);
insert  into `com_person_rolerelation`(`id`,`updateTime`,`roleId`,`personId`,`isValid`,`accountType`) values (16,'2014-12-08 04:13:04',3,4,'1',1);
insert  into `com_person_rolerelation`(`id`,`updateTime`,`roleId`,`personId`,`isValid`,`accountType`) values (17,'2014-12-08 04:13:04',NULL,4,'1',1);
insert  into `com_person_rolerelation`(`id`,`updateTime`,`roleId`,`personId`,`isValid`,`accountType`) values (18,'2014-12-12 09:16:00',2,1,'1',1);
insert  into `com_person_rolerelation`(`id`,`updateTime`,`roleId`,`personId`,`isValid`,`accountType`) values (19,'2014-12-12 09:16:00',3,1,'1',1);
insert  into `com_person_rolerelation`(`id`,`updateTime`,`roleId`,`personId`,`isValid`,`accountType`) values (20,'2014-12-12 09:16:00',63,1,'1',1);
insert  into `com_person_rolerelation`(`id`,`updateTime`,`roleId`,`personId`,`isValid`,`accountType`) values (21,'2014-12-12 09:16:00',6,1,'1',1);

/*Data for the table `com_refund_review` */

/*Data for the table `com_refund_stream` */

/*Data for the table `com_role` */

insert  into `com_role`(`id`,`creater`,`updateTime`,`roleCode`,`roleName`,`isValid`,`updatePerson`) values (1,'adminstror','2014-12-12 08:15:17',1,'超级管理员','0','adminstror');
insert  into `com_role`(`id`,`creater`,`updateTime`,`roleCode`,`roleName`,`isValid`,`updatePerson`) values (2,'wy','2014-10-28 10:14:41',2,'客户经理','1','wy');
insert  into `com_role`(`id`,`creater`,`updateTime`,`roleCode`,`roleName`,`isValid`,`updatePerson`) values (3,'wzz','2014-10-28 10:16:39',3,'财务','1','wzz');
insert  into `com_role`(`id`,`creater`,`updateTime`,`roleCode`,`roleName`,`isValid`,`updatePerson`) values (63,'adminstror','2014-12-04 03:27:28',10004,'客服','1','adminstror');
insert  into `com_role`(`id`,`creater`,`updateTime`,`roleCode`,`roleName`,`isValid`,`updatePerson`) values (64,'adminstror','2014-12-04 03:34:18',10005,'营业员','1','adminstror');
insert  into `com_role`(`id`,`creater`,`updateTime`,`roleCode`,`roleName`,`isValid`,`updatePerson`) values (70,'adminstror','2014-12-08 16:29:37',1111,'店家','1','adminstror');

/*Data for the table `com_route_mapsceneryspot` */

/*Data for the table `com_scenery_spot` */

/*Data for the table `com_scenery_spotmapgoods` */

/*Data for the table `com_tour_route` */

/*Data for the table `com_work_order` */

/*Data for the table `cus_consumption_records` */

insert  into `cus_consumption_records`(`id`,`orderNo`,`orderId`,`goodsId`,`verfificationCode`,`goodsNumber`,`costPrice`,`payablePrice`,`rebate`,`userAccount`,`memberCardNo`,`memberName`,`sellerId`,`sellerName`,`sellerAccount`,`verifierAccount`,`verifierTime`,`shopId`,`shopName`,`flag`) values (36,NULL,NULL,NULL,NULL,NULL,3,2.940000057220459,9.8,NULL,'7550000159',NULL,NULL,NULL,NULL,NULL,'2014-12-18 09:38:58',1,NULL,'0');
insert  into `cus_consumption_records`(`id`,`orderNo`,`orderId`,`goodsId`,`verfificationCode`,`goodsNumber`,`costPrice`,`payablePrice`,`rebate`,`userAccount`,`memberCardNo`,`memberName`,`sellerId`,`sellerName`,`sellerAccount`,`verifierAccount`,`verifierTime`,`shopId`,`shopName`,`flag`) values (39,NULL,NULL,NULL,NULL,NULL,10,8,8,NULL,'75500005D8',NULL,NULL,NULL,NULL,NULL,'2014-12-18 10:54:35',1,NULL,'0');
insert  into `cus_consumption_records`(`id`,`orderNo`,`orderId`,`goodsId`,`verfificationCode`,`goodsNumber`,`costPrice`,`payablePrice`,`rebate`,`userAccount`,`memberCardNo`,`memberName`,`sellerId`,`sellerName`,`sellerAccount`,`verifierAccount`,`verifierTime`,`shopId`,`shopName`,`flag`) values (40,NULL,NULL,NULL,NULL,NULL,20,16,8,NULL,'75500005D8',NULL,NULL,NULL,NULL,NULL,'2014-12-18 10:56:15',NULL,NULL,NULL);
insert  into `cus_consumption_records`(`id`,`orderNo`,`orderId`,`goodsId`,`verfificationCode`,`goodsNumber`,`costPrice`,`payablePrice`,`rebate`,`userAccount`,`memberCardNo`,`memberName`,`sellerId`,`sellerName`,`sellerAccount`,`verifierAccount`,`verifierTime`,`shopId`,`shopName`,`flag`) values (41,NULL,NULL,NULL,NULL,NULL,170,166.60000610351562,9.8,NULL,'7550000159',NULL,NULL,NULL,NULL,NULL,'2014-12-18 10:59:19',NULL,NULL,NULL);
insert  into `cus_consumption_records`(`id`,`orderNo`,`orderId`,`goodsId`,`verfificationCode`,`goodsNumber`,`costPrice`,`payablePrice`,`rebate`,`userAccount`,`memberCardNo`,`memberName`,`sellerId`,`sellerName`,`sellerAccount`,`verifierAccount`,`verifierTime`,`shopId`,`shopName`,`flag`) values (42,NULL,NULL,NULL,NULL,NULL,190,186.1999969482422,9.8,NULL,'7550000159',NULL,NULL,NULL,NULL,NULL,'2014-12-18 11:00:59',NULL,NULL,NULL);
insert  into `cus_consumption_records`(`id`,`orderNo`,`orderId`,`goodsId`,`verfificationCode`,`goodsNumber`,`costPrice`,`payablePrice`,`rebate`,`userAccount`,`memberCardNo`,`memberName`,`sellerId`,`sellerName`,`sellerAccount`,`verifierAccount`,`verifierTime`,`shopId`,`shopName`,`flag`) values (43,NULL,NULL,NULL,NULL,NULL,200,196,9.8,NULL,'7550000159',NULL,NULL,NULL,NULL,NULL,'2014-12-18 11:01:28',NULL,NULL,NULL);
insert  into `cus_consumption_records`(`id`,`orderNo`,`orderId`,`goodsId`,`verfificationCode`,`goodsNumber`,`costPrice`,`payablePrice`,`rebate`,`userAccount`,`memberCardNo`,`memberName`,`sellerId`,`sellerName`,`sellerAccount`,`verifierAccount`,`verifierTime`,`shopId`,`shopName`,`flag`) values (44,NULL,NULL,NULL,NULL,NULL,35,28,8,NULL,'75500005D8',NULL,NULL,NULL,NULL,NULL,'2014-12-18 11:05:45',NULL,NULL,NULL);
insert  into `cus_consumption_records`(`id`,`orderNo`,`orderId`,`goodsId`,`verfificationCode`,`goodsNumber`,`costPrice`,`payablePrice`,`rebate`,`userAccount`,`memberCardNo`,`memberName`,`sellerId`,`sellerName`,`sellerAccount`,`verifierAccount`,`verifierTime`,`shopId`,`shopName`,`flag`) values (45,NULL,NULL,NULL,NULL,NULL,30,24,8,NULL,'75500005D8',NULL,NULL,NULL,NULL,NULL,'2014-12-18 11:06:34',NULL,NULL,NULL);
insert  into `cus_consumption_records`(`id`,`orderNo`,`orderId`,`goodsId`,`verfificationCode`,`goodsNumber`,`costPrice`,`payablePrice`,`rebate`,`userAccount`,`memberCardNo`,`memberName`,`sellerId`,`sellerName`,`sellerAccount`,`verifierAccount`,`verifierTime`,`shopId`,`shopName`,`flag`) values (46,NULL,NULL,NULL,NULL,NULL,60,48,8,NULL,'75500005D8',NULL,NULL,NULL,NULL,NULL,'2014-12-18 11:07:17',NULL,NULL,NULL);
insert  into `cus_consumption_records`(`id`,`orderNo`,`orderId`,`goodsId`,`verfificationCode`,`goodsNumber`,`costPrice`,`payablePrice`,`rebate`,`userAccount`,`memberCardNo`,`memberName`,`sellerId`,`sellerName`,`sellerAccount`,`verifierAccount`,`verifierTime`,`shopId`,`shopName`,`flag`) values (47,NULL,NULL,NULL,NULL,NULL,70,56,8,NULL,'75500005D8',NULL,NULL,NULL,NULL,NULL,'2014-12-18 11:10:33',NULL,NULL,NULL);
insert  into `cus_consumption_records`(`id`,`orderNo`,`orderId`,`goodsId`,`verfificationCode`,`goodsNumber`,`costPrice`,`payablePrice`,`rebate`,`userAccount`,`memberCardNo`,`memberName`,`sellerId`,`sellerName`,`sellerAccount`,`verifierAccount`,`verifierTime`,`shopId`,`shopName`,`flag`) values (48,NULL,NULL,NULL,NULL,NULL,1325,1258.75,9.5,NULL,'7550000265',NULL,NULL,NULL,NULL,NULL,'2014-12-18 11:11:59',NULL,NULL,NULL);
insert  into `cus_consumption_records`(`id`,`orderNo`,`orderId`,`goodsId`,`verfificationCode`,`goodsNumber`,`costPrice`,`payablePrice`,`rebate`,`userAccount`,`memberCardNo`,`memberName`,`sellerId`,`sellerName`,`sellerAccount`,`verifierAccount`,`verifierTime`,`shopId`,`shopName`,`flag`) values (49,NULL,NULL,NULL,NULL,NULL,1325,1258.75,9.5,NULL,'7550000265',NULL,NULL,NULL,NULL,NULL,'2014-12-18 11:12:06',NULL,NULL,NULL);
insert  into `cus_consumption_records`(`id`,`orderNo`,`orderId`,`goodsId`,`verfificationCode`,`goodsNumber`,`costPrice`,`payablePrice`,`rebate`,`userAccount`,`memberCardNo`,`memberName`,`sellerId`,`sellerName`,`sellerAccount`,`verifierAccount`,`verifierTime`,`shopId`,`shopName`,`flag`) values (50,NULL,NULL,NULL,NULL,NULL,2000,1900,9.5,NULL,'7550000265',NULL,NULL,NULL,NULL,NULL,'2014-12-18 11:13:08',NULL,NULL,NULL);

/*Data for the table `cus_electronic_card` */

insert  into `cus_electronic_card`(`id`,`memberId`,`memberCardNumber`,`sellerName`,`userIndividualCenterId`,`userId`) values (1,1,'7550000159','泡泡鱼',1,1);
insert  into `cus_electronic_card`(`id`,`memberId`,`memberCardNumber`,`sellerName`,`userIndividualCenterId`,`userId`) values (2,2,'7550000265','泡泡鱼',1,2);
insert  into `cus_electronic_card`(`id`,`memberId`,`memberCardNumber`,`sellerName`,`userIndividualCenterId`,`userId`) values (3,3,'755000038D','泡泡鱼',1,3);
insert  into `cus_electronic_card`(`id`,`memberId`,`memberCardNumber`,`sellerName`,`userIndividualCenterId`,`userId`) values (4,4,'75500004D7','泡泡鱼',1,4);
insert  into `cus_electronic_card`(`id`,`memberId`,`memberCardNumber`,`sellerName`,`userIndividualCenterId`,`userId`) values (5,5,'75500005D8','泡泡鱼',1,5);

/*Data for the table `cus_member_up_log` */

/*Data for the table `cus_order` */

/*Data for the table `cus_order_details` */

insert  into `cus_order_details`(`id`,`orderId`,`goodsName`,`goodsId`,`price`,`totalPrice`,`rebate`,`rebatePrice`,`totalNum`,`sellerId`,`memberCardNo`) values (1,1,'1',1,1,1,'1',1,1,1,'1');

/*Data for the table `cus_payment_records` */

/*Data for the table `cus_prepaid_mention_now` */

/*Data for the table `cus_shopping_trolley` */

/*Data for the table `cus_user_account` */

/*Data for the table `cus_user_individual_center` */

/*Data for the table `cus_verification_code` */

insert  into `cus_verification_code`(`id`,`orderDetailsId`,`verificationCode`,`goodsId`,`orderNo`,`number`,`costPrice`,`payablePrice`,`state`) values (1,1,'1',1,'1',1,1,1,'1');

/*Data for the table `goods_apply_info` */

/*Data for the table `goodspicture` */

insert  into `goodspicture`(`id`,`goodsId`,`path`,`attribute`,`renewTime`,`classification`,`uploadPersonnel`) values (1,8,'uploads/goodsPic/14186937376240.jpg',NULL,'2014-12-16 02:35:37',NULL,'admin');
insert  into `goodspicture`(`id`,`goodsId`,`path`,`attribute`,`renewTime`,`classification`,`uploadPersonnel`) values (2,8,'uploads/goodsPic/14186937371963.jpg',NULL,'2014-12-16 02:35:37',NULL,'admin');
insert  into `goodspicture`(`id`,`goodsId`,`path`,`attribute`,`renewTime`,`classification`,`uploadPersonnel`) values (3,8,'uploads/goodsPic/14186937377599.jpg',NULL,'2014-12-16 02:35:37',NULL,'admin');
insert  into `goodspicture`(`id`,`goodsId`,`path`,`attribute`,`renewTime`,`classification`,`uploadPersonnel`) values (4,10,'uploads/goodsPic/14186942063308.jpg',NULL,'2014-12-16 02:43:26',NULL,'admin');
insert  into `goodspicture`(`id`,`goodsId`,`path`,`attribute`,`renewTime`,`classification`,`uploadPersonnel`) values (5,11,'uploads/goodsPic/14186988499468.jpg',NULL,'2014-12-16 04:00:49',NULL,'admin');
insert  into `goodspicture`(`id`,`goodsId`,`path`,`attribute`,`renewTime`,`classification`,`uploadPersonnel`) values (6,11,'uploads/goodsPic/14186988494709.jpg',NULL,'2014-12-16 04:00:49',NULL,'admin');
insert  into `goodspicture`(`id`,`goodsId`,`path`,`attribute`,`renewTime`,`classification`,`uploadPersonnel`) values (7,12,'uploads/goodsPic/14188857807752.jpg',NULL,'2014-12-18 07:56:20',NULL,'admin');
insert  into `goodspicture`(`id`,`goodsId`,`path`,`attribute`,`renewTime`,`classification`,`uploadPersonnel`) values (8,12,'uploads/goodsPic/14188857806769.jpg',NULL,'2014-12-18 07:56:20',NULL,'admin');
insert  into `goodspicture`(`id`,`goodsId`,`path`,`attribute`,`renewTime`,`classification`,`uploadPersonnel`) values (9,12,'uploads/goodsPic/14188857808044.jpg',NULL,'2014-12-18 07:56:20',NULL,'admin');

/*Data for the table `shop_info_review` */

insert  into `shop_info_review`(`id`,`city`,`longitude`,`latitude`,`shopName`,`contact`,`regional`,`storeId`,`storeAccount`,`businessDistrictId`,`address`,`businessHours`,`storeOutline`,`cityId`,`countyId`,`applyTime`,`applyUserId`,`applyUserName`,`auditUserId`,`auditUserName`,`auditTime`,`managerId`,`managerName`,`managerTime`,`auditState`,`Rejection`,`shopBalance`,`shopId`,`storeType`) values (19,NULL,1,2,'测试店铺22','0551-1234567',NULL,1,'storeAdmin',7,'合肥蜀山区','9:00-23:00','ZDfsd fasf sad fsda fasd fasd fasdf sd asd fasd fas fsd ',1,3,'2014-12-09 07:55:43',1,'张三',NULL,NULL,NULL,111111,'张三','2014-12-17 03:30:31',4,NULL,NULL,NULL,NULL);
insert  into `shop_info_review`(`id`,`city`,`longitude`,`latitude`,`shopName`,`contact`,`regional`,`storeId`,`storeAccount`,`businessDistrictId`,`address`,`businessHours`,`storeOutline`,`cityId`,`countyId`,`applyTime`,`applyUserId`,`applyUserName`,`auditUserId`,`auditUserName`,`auditTime`,`managerId`,`managerName`,`managerTime`,`auditState`,`Rejection`,`shopBalance`,`shopId`,`storeType`) values (20,NULL,1,2,'测试店铺3','0551-1234567',NULL,6,'storeAdmin',7,'合肥蜀山区','9:00-23:00','范德萨发撒旦富士达发的是富士达阿萨德发生的阿萨德法撒旦',1,3,'2014-12-09 07:56:43',1,'张三',NULL,NULL,NULL,111111,'张三','2014-12-17 03:44:30',5,'test 111111111',NULL,NULL,NULL);
insert  into `shop_info_review`(`id`,`city`,`longitude`,`latitude`,`shopName`,`contact`,`regional`,`storeId`,`storeAccount`,`businessDistrictId`,`address`,`businessHours`,`storeOutline`,`cityId`,`countyId`,`applyTime`,`applyUserId`,`applyUserName`,`auditUserId`,`auditUserName`,`auditTime`,`managerId`,`managerName`,`managerTime`,`auditState`,`Rejection`,`shopBalance`,`shopId`,`storeType`) values (22,NULL,1,2,'测试店铺1','0551-1234567',NULL,NULL,'storeAdmin',8,'合肥蜀山区','9:00-23:00',' 范德萨发生的富士达富士达阿萨德阿萨德',2,6,'2014-12-09 08:15:23',1,'张三',NULL,NULL,NULL,111111,'张三','2014-12-17 03:45:13',4,NULL,NULL,NULL,NULL);

/*Data for the table `sto_apply_info` */

insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (1,2,NULL,NULL,'餐饮',1111,'aaaa','2014-12-05 10:48:08',111111,'张三','2014-12-12 11:14:05','0551-1234569','肯德基','0551-1234567',2,123456,NULL,3,'2014-11-07 15:14:13','13855117363','合肥高新区国购','王贞贞','wzz_rj0902@163.com',3,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (5,2,NULL,NULL,'餐饮',NULL,'','2014-12-05 10:56:26',111111,'张三','2014-12-12 11:21:00','055-1236598','麦当劳','0551-1234567',2,654123,NULL,3,'2014-11-07 15:12:39','15055172478','合肥市蜀山区之心城','乐乐','wzz_rj0902@163.com',3,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (7,2,NULL,NULL,'商家介绍:例如营业面积、本店特色等\r\n\r\n合作店数:\r\n\r\n套餐/产品:\r\n\r\n是否有营业执照/其它证书:\r\n\r\n人均消费:\r\n\r\n日均可接待量:\r\n\r\n其他介绍:',NULL,'','2014-12-05 10:59:42',111111,'张三','2014-12-12 11:30:25','055-1236598','必胜客','0551-1234567',2,654123,NULL,3,'2014-11-07 15:25:20','13855117363','合肥市蜀山区之心城','锅锅','wzz_rj0902@163.com',3,1,'test11111');
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (8,1,NULL,NULL,'',NULL,'','2014-12-09 02:53:57',111111,'张三','2014-12-12 11:36:09','055-1236598','肯德基12','0551-1234567',1,123456,NULL,1,'2014-11-10 17:57:40','13855117363','信阳浉河区新天地','王贞贞','',3,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (9,1,NULL,NULL,'<p style=\"font-size:14px;text-indent:2em;color:#252525;font-family:宋体, sans-serif;text-align:justify;background-color:#FFFFFF;\">\r\n	<strong>秦海璐节目谈王新军必称：“我老公”</strong>\r\n</p>\r\n<p style=\"font-size:14px;text-indent:2em;color:#252525;font-family:宋体, sans-serif;text-align:justify;background-color:#FFFFFF;\">\r\n	刚宣布完婚讯的秦海璐也首度回归《超级先生》节目录制，对于当天媒体的婚事和孕事等问题，秦海璐则不愿多回应，不过秦海璐心情看上去十分愉悦，身穿一身蓝色连衣裙的秦海璐笑容甜蜜、气色极佳，还频频挥手与现场观众打招呼，不时和谢娜、李小冉等互动，而在节目录制现场，秦海璐也不时与嘉宾互动谈及王新军，而值得一提的是，秦海璐一提王新军已经十分熟路的改口：“我老公”，一脸幸福，一改之前男朋友的称呼。\r\n</p>\r\n<img src=\"http://img2.cache.netease.com/ent/2014/7/14/20140714035228aa541.jpg\" alt=\"李小冉\" />',NULL,'','2014-12-05 11:50:38',111111,'张三','2014-12-12 02:05:07','055-1236598','肯德基13','0551-1234567',2,123456,NULL,5,'2014-11-12 14:52:19','15055172478','信阳罗山','乐乐13','wzz_rj0902@163.com',3,1,'3333');
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (10,1,NULL,NULL,'<iframe src=\"http://localhost/yii2/apps/yii2test/backend/web/assets/5f61567f/plugins/baidumap/index.html?center=117.203073%2C31.846456&zoom=19&width=558&height=360&markers=117.203073%2C31.846456&markerStyles=l%2CA\" frameborder=\"0\" style=\"width:560px;height:362px;\">\r\n</iframe>\r\n<table style=\"width:100%;\" cellpadding=\"2\" cellspacing=\"0\" border=\"1\" bordercolor=\"#000000\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<br />',NULL,'','2014-12-05 11:51:39',111111,'张三','2014-12-12 02:35:04','055-1236598','肯德基14','',1,NULL,NULL,2,'2014-11-12 16:23:26','15055172478','信阳','乐乐14','',3,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (11,1,3,40.055878,'<h2>\r\n	订单\r\n</h2>',NULL,'','2014-12-05 01:20:30',111111,'张三','2014-12-12 09:25:18','055-1236598','必胜客144','0551-1234567',1,123456,NULL,1,'2014-11-14 09:21:21','15055172478','信阳石狮','王贞贞14','wzz_rj0902@163.com',4,1,'ces ');
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (12,3,116.307854,40.055878,'<br />\r\n&nbsp;&nbsp;<span style=\"font-family:Simsun;font-size:14px;line-height:26px;\">海地前总统突发心脏病63岁逝世19岁时成为“终生总统\"</span><br />\r\n<span id=\"__kindeditor_bookmark_start_0__\"></span>',NULL,'','2014-12-05 01:20:44',111111,'张三','2014-12-12 09:28:21','055-1236598','必胜客17','0551-1234567',6,NULL,NULL,8,'2014-11-17 15:54:06','13855117363','合肥蜀山区','王贞贞17','wzz_rj0902@163.com',3,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (13,3,116.307854,40.055878,'<h2>\r\n	<span><i><u>地对地导弹地对地导弹</u></i></span>\r\n</h2>',NULL,'','2014-12-05 06:12:19',111111,'张三','2014-12-14 03:43:58','055-1236598','必胜客12-01','0551-1234567',7,123456,NULL,10,'2014-12-01 16:13:55','13855117363','合肥高新区万达','王贞贞12-01','wzz_rj0902@163.com',3,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (14,3,NULL,NULL,'<h2>\r\n	<span style=\"color:#E53333;\">的顶顶顶顶顶</span><span style=\"color:#E53333;\"></span>\r\n</h2>',NULL,NULL,NULL,111111,'张三','2014-12-21 11:48:12','055-1236598','必胜客12-12','0551-1234567',2,123456,NULL,4,'2014-12-01 16:21:22','13855117363','信阳','乐乐12-12','wzz_rj0902@163.com',3,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (15,3,116.307854,40.055878,'凤飞飞',NULL,NULL,NULL,111111,'张三','2014-12-21 11:55:14','055-1236598','必胜客','0551-1234567',1,123456,NULL,1,'2014-12-01 16:22:41','13855117363','信阳s','王贞贞','wzz_rj0902@163.com',3,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (16,3,116.307854,40.055878,'测试',NULL,NULL,NULL,111111,'张三','2014-12-14 03:55:05','0551-62799998','测试数据','liuweiisme@126.com',1,100,NULL,1,'2014-12-01 16:28:16','15056056649','测试','我在测试','wliu@126.com',4,1,'测试数据 备注');
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (17,3,116.307854,40.055878,'测试',NULL,'','2014-12-12 08:39:26',NULL,NULL,NULL,'0551-62799998','测试数据','liuweiisme@126.com',6,100,NULL,8,'2014-12-01 16:37:42','15056056649','测试','我在测试','wliu@126.com',1,2,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (18,NULL,NULL,NULL,'',NULL,'','2014-12-12 08:36:54',NULL,NULL,NULL,'','','',NULL,NULL,NULL,NULL,'2014-12-04 14:39:20','','','','',2,NULL,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (19,2,NULL,NULL,'餐饮',NULL,'','2014-12-14 03:28:42',NULL,NULL,NULL,'0551-1234569','肯德基','0551-1234567',2,123456,NULL,3,'2014-11-07 15:14:13','13855117363','合肥高新区国购','王贞贞','wzz_rj0902@163.com',2,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (20,2,NULL,NULL,'餐饮',NULL,'','2014-12-14 03:26:25',111111,'张三','2014-12-21 12:10:49','055-1236598','麦当劳','0551-1234567',2,654123,NULL,3,'2014-11-07 15:12:39','15055172478','合肥市蜀山区之心城','乐乐','wzz_rj0902@163.com',3,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (21,2,NULL,NULL,'商家介绍:例如营业面积、本店特色等\r\n\r\n合作店数:\r\n\r\n套餐/产品:\r\n\r\n是否有营业执照/其它证书:\r\n\r\n人均消费:\r\n\r\n日均可接待量:\r\n\r\n其他介绍:',NULL,NULL,NULL,NULL,NULL,NULL,'055-1236598','必胜客','0551-1234567',2,654123,NULL,3,'2014-11-07 15:25:20','13855117363','合肥市蜀山区之心城','锅锅','wzz_rj0902@163.com',0,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (22,1,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'055-1236598','肯德基12','0551-1234567',1,123456,NULL,1,'2014-11-10 17:57:40','13855117363','信阳浉河区新天地','王贞贞','',0,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (23,1,NULL,NULL,'<p style=\"font-size:14px;text-indent:2em;color:#252525;font-family:宋体, sans-serif;text-align:justify;background-color:#FFFFFF;\">\r\n	<strong>秦海璐节目谈王新军必称：“我老公”</strong>\r\n</p>\r\n<p style=\"font-size:14px;text-indent:2em;color:#252525;font-family:宋体, sans-serif;text-align:justify;background-color:#FFFFFF;\">\r\n	刚宣布完婚讯的秦海璐也首度回归《超级先生》节目录制，对于当天媒体的婚事和孕事等问题，秦海璐则不愿多回应，不过秦海璐心情看上去十分愉悦，身穿一身蓝色连衣裙的秦海璐笑容甜蜜、气色极佳，还频频挥手与现场观众打招呼，不时和谢娜、李小冉等互动，而在节目录制现场，秦海璐也不时与嘉宾互动谈及王新军，而值得一提的是，秦海璐一提王新军已经十分熟路的改口：“我老公”，一脸幸福，一改之前男朋友的称呼。\r\n</p>\r\n<img src=\"http://img2.cache.netease.com/ent/2014/7/14/20140714035228aa541.jpg\" alt=\"李小冉\" />',NULL,NULL,NULL,NULL,NULL,NULL,'055-1236598','肯德基13','0551-1234567',2,123456,NULL,5,'2014-11-12 14:52:19','15055172478','信阳罗山','乐乐13','wzz_rj0902@163.com',0,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (24,1,NULL,NULL,'<iframe src=\"http://localhost/yii2/apps/yii2test/backend/web/assets/5f61567f/plugins/baidumap/index.html?center=117.203073%2C31.846456&zoom=19&width=558&height=360&markers=117.203073%2C31.846456&markerStyles=l%2CA\" frameborder=\"0\" style=\"width:560px;height:362px;\">\r\n</iframe>\r\n<table style=\"width:100%;\" cellpadding=\"2\" cellspacing=\"0\" border=\"1\" bordercolor=\"#000000\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<br />',NULL,NULL,NULL,NULL,NULL,NULL,'055-1236598','肯德基14','',1,NULL,NULL,2,'2014-11-12 16:23:26','15055172478','信阳','乐乐14','',0,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (25,1,3,40.055878,'<h2>\r\n	订单\r\n</h2>',NULL,NULL,NULL,NULL,NULL,NULL,'055-1236598','必胜客144','0551-1234567',1,123456,NULL,1,'2014-11-14 09:21:21','15055172478','信阳石狮','王贞贞14','wzz_rj0902@163.com',0,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (26,3,116.307854,40.055878,'<br />\r\n&nbsp;&nbsp;<span style=\"font-family:Simsun;font-size:14px;line-height:26px;\">海地前总统突发心脏病63岁逝世19岁时成为“终生总统\"</span><br />\r\n<span id=\"__kindeditor_bookmark_start_0__\"></span>',NULL,NULL,NULL,NULL,NULL,NULL,'055-1236598','必胜客17','0551-1234567',6,NULL,NULL,8,'2014-11-17 15:54:06','13855117363','合肥蜀山区','王贞贞17','wzz_rj0902@163.com',0,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (27,3,116.307854,40.055878,'<h2>\r\n	<span><i><u>地对地导弹地对地导弹</u></i></span>\r\n</h2>',NULL,NULL,NULL,NULL,NULL,NULL,'055-1236598','必胜客12-01','0551-1234567',7,123456,NULL,10,'2014-12-01 16:13:55','13855117363','合肥高新区万达','王贞贞12-01','wzz_rj0902@163.com',0,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (28,3,NULL,NULL,'<h2>\r\n	<span style=\"color:#E53333;\">的顶顶顶顶顶</span><span style=\"color:#E53333;\"></span>\r\n</h2>',NULL,NULL,NULL,NULL,NULL,NULL,'055-1236598','必胜客12-12','0551-1234567',2,123456,NULL,4,'2014-12-01 16:21:22','13855117363','信阳','乐乐12-12','wzz_rj0902@163.com',0,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (29,3,116.307854,40.055878,'凤飞飞',NULL,NULL,NULL,NULL,NULL,NULL,'055-1236598','必胜客','0551-1234567',1,123456,NULL,1,'2014-12-01 16:22:41','13855117363','信阳s','王贞贞','wzz_rj0902@163.com',0,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (30,3,116.307854,40.055878,'测试',NULL,NULL,NULL,NULL,NULL,NULL,'0551-62799998','测试数据','liuweiisme@126.com',1,100,NULL,1,'2014-12-01 16:28:16','15056056649','测试','我在测试','wliu@126.com',0,1,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (31,3,116.307854,40.055878,'测试',NULL,NULL,NULL,NULL,NULL,NULL,'0551-62799998','测试数据','liuweiisme@126.com',6,100,NULL,8,'2014-12-01 16:37:42','15056056649','测试','我在测试','wliu@126.com',0,2,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (32,NULL,NULL,NULL,'',NULL,'','2014-12-12 08:37:51',NULL,NULL,NULL,'','','',NULL,NULL,NULL,NULL,'2014-12-04 14:39:20','','','','',2,NULL,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (33,2,NULL,NULL,'',NULL,NULL,NULL,111111,'张三','2014-12-12 11:08:46','','','',0,NULL,NULL,7,'2014-12-05 16:54:16','150000000','','测试','test@126.com',3,NULL,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (34,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'','','',NULL,NULL,NULL,NULL,'2014-12-05 16:54:55','150000000','','测试','test@126.com',1,NULL,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (35,NULL,NULL,NULL,'',NULL,'','2014-12-12 08:37:25',NULL,NULL,NULL,'','','',NULL,NULL,NULL,NULL,'2014-12-05 16:55:48','','','','',2,NULL,NULL);
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (36,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'','','',NULL,NULL,NULL,NULL,'2014-12-12 16:03:30','','','','',0,NULL,'');
insert  into `sto_apply_info`(`applyId`,`city`,`longitude`,`latitude`,`scopeBusiness`,`customerServiceId`,`customerServiceName`,`cusServiceReviewTime`,`customerManagerId`,`customerManagerName`,`cusManagerReviewTime`,`storePhone`,`storeName`,`otherContact`,`regional`,`daySales`,`storeApplyNumber`,`businessZone`,`applyTime`,`phone`,`address`,`name`,`email`,`applyStatus`,`storeCategoryId`,`remark`) values (37,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,'','','',NULL,NULL,NULL,NULL,'2014-12-12 16:03:33','','','','',0,NULL,'');

/*Data for the table `sto_balance_bill_detailed` */

insert  into `sto_balance_bill_detailed`(`id`,`balanceApplyId`,`goodsId`,`goodsNumber`,`consumeSaleStream`,`payablePrice`,`costPrice`,`verificationCode`,`verificaterAccount`,`verificateTime`,`membershipCardNumber`,`userAccount`,`userDiscount`,`orderId`,`shopId`,`shopName`,`sellerId`,`sellerName`) values (7,1,NULL,NULL,39,8,10,NULL,NULL,'2014-12-18 10:54:35','75500005D8',NULL,8,NULL,1,NULL,NULL,NULL);

/*Data for the table `sto_balance_review` */

insert  into `sto_balance_review`(`id`,`financeId`,`financeAccount`,`financeReviewStatus`,`reviewId`,`reviewAccount`,`reviewTime`,`reviewStatus`,`serviceFee`,`serviceAgreement`,`balanceEndTime`,`balanceStartTime`,`storeId`,`storeName`,`shopId`,`shopName`,`applyerId`,`applyerAccount`,`applyMoney`,`applyTime`,`actualBalanceMoney`,`financeReviewTime`,`remark`) values (1,111111,'张三',0,0,'0','0000-00-00 00:00:00',0,0,'0','2014-12-18 23:59:59','2014-12-18 00:00:00',0,'测试数据',1,NULL,0,'201412141153',NULL,'2014-12-18 13:57:08',0,'2014-12-19 05:32:24','test ');

/*Data for the table `sto_collection` */

/*Data for the table `sto_goods` */

insert  into `sto_goods`(`id`,`goodsName`,`summary`,`describes`,`price`,`subClass`,`validity`,`supplyDateTime`,`enjoyRebate`,`goodsGrade`,`goodsWeight`,`goodsState`,`createDate`,`createID`,`createName`) values (1,'十全大补丸11111','概述一下','',998,'','0',NULL,'',NULL,NULL,0,NULL,NULL,NULL);
insert  into `sto_goods`(`id`,`goodsName`,`summary`,`describes`,`price`,`subClass`,`validity`,`supplyDateTime`,`enjoyRebate`,`goodsGrade`,`goodsWeight`,`goodsState`,`createDate`,`createID`,`createName`) values (2,'含笑半步癫','概述一下','',998,'','0',NULL,'',NULL,NULL,0,NULL,NULL,NULL);
insert  into `sto_goods`(`id`,`goodsName`,`summary`,`describes`,`price`,`subClass`,`validity`,`supplyDateTime`,`enjoyRebate`,`goodsGrade`,`goodsWeight`,`goodsState`,`createDate`,`createID`,`createName`) values (8,'222222','','',NULL,'1','0',NULL,'',NULL,NULL,0,NULL,NULL,NULL);
insert  into `sto_goods`(`id`,`goodsName`,`summary`,`describes`,`price`,`subClass`,`validity`,`supplyDateTime`,`enjoyRebate`,`goodsGrade`,`goodsWeight`,`goodsState`,`createDate`,`createID`,`createName`) values (9,'444','','',NULL,'1','0',NULL,'',NULL,NULL,0,NULL,NULL,NULL);
insert  into `sto_goods`(`id`,`goodsName`,`summary`,`describes`,`price`,`subClass`,`validity`,`supplyDateTime`,`enjoyRebate`,`goodsGrade`,`goodsWeight`,`goodsState`,`createDate`,`createID`,`createName`) values (10,'555','','',NULL,'1','0',NULL,'',NULL,NULL,0,NULL,NULL,NULL);
insert  into `sto_goods`(`id`,`goodsName`,`summary`,`describes`,`price`,`subClass`,`validity`,`supplyDateTime`,`enjoyRebate`,`goodsGrade`,`goodsWeight`,`goodsState`,`createDate`,`createID`,`createName`) values (11,'测试商品','','',9.8,'1','0',NULL,'',NULL,NULL,1,NULL,NULL,NULL);
insert  into `sto_goods`(`id`,`goodsName`,`summary`,`describes`,`price`,`subClass`,`validity`,`supplyDateTime`,`enjoyRebate`,`goodsGrade`,`goodsWeight`,`goodsState`,`createDate`,`createID`,`createName`) values (12,'包子','','',NULL,'1','1',NULL,'',NULL,NULL,1,NULL,NULL,NULL);

/*Data for the table `sto_goods_change` */

/*Data for the table `sto_goods_store` */

/*Data for the table `sto_info_review` */

/*Data for the table `sto_logon_account` */

insert  into `sto_logon_account`(`id`,`storeId`,`roleId`,`sellerId`,`password`,`loginName`,`nickName`,`validity`,`flag`) values (1,17,70,35,'123456','test111店家',NULL,'1',0);
insert  into `sto_logon_account`(`id`,`storeId`,`roleId`,`sellerId`,`password`,`loginName`,`nickName`,`validity`,`flag`) values (2,17,3,35,'123456','test111财务',NULL,'1',0);
insert  into `sto_logon_account`(`id`,`storeId`,`roleId`,`sellerId`,`password`,`loginName`,`nickName`,`validity`,`flag`) values (3,17,64,35,'123456','test111营业员',NULL,'1',0);
insert  into `sto_logon_account`(`id`,`storeId`,`roleId`,`sellerId`,`password`,`loginName`,`nickName`,`validity`,`flag`) values (4,19,70,37,'123456','test8888店家',NULL,'1',0);
insert  into `sto_logon_account`(`id`,`storeId`,`roleId`,`sellerId`,`password`,`loginName`,`nickName`,`validity`,`flag`) values (5,19,3,37,'123456','test8888财务',NULL,'1',0);
insert  into `sto_logon_account`(`id`,`storeId`,`roleId`,`sellerId`,`password`,`loginName`,`nickName`,`validity`,`flag`) values (6,19,64,37,'123456','test8888营业员',NULL,'1',0);
insert  into `sto_logon_account`(`id`,`storeId`,`roleId`,`sellerId`,`password`,`loginName`,`nickName`,`validity`,`flag`) values (7,20,70,38,'123456','test888店家',NULL,'1',0);
insert  into `sto_logon_account`(`id`,`storeId`,`roleId`,`sellerId`,`password`,`loginName`,`nickName`,`validity`,`flag`) values (8,20,3,38,'123456','test888财务',NULL,'1',0);
insert  into `sto_logon_account`(`id`,`storeId`,`roleId`,`sellerId`,`password`,`loginName`,`nickName`,`validity`,`flag`) values (9,20,64,38,'123456','test888营业员',NULL,'1',0);

/*Data for the table `sto_member_rule` */

insert  into `sto_member_rule`(`id`,`operatorId`,`operatorName`,`createTime`,`memberRating`,`upperLimit`,`lowerLimit`,`ico`,`memberName`,`rebate`,`sellerId`,`sellerName`,`validity`,`modifyTime`) values (1,1,'操作人','2014-12-17 14:17:57',1,100,0,'uploads/vipPicture/hybg.png','青铜','9.8',1,'泡泡鱼','1','2014-12-17 14:20:15');
insert  into `sto_member_rule`(`id`,`operatorId`,`operatorName`,`createTime`,`memberRating`,`upperLimit`,`lowerLimit`,`ico`,`memberName`,`rebate`,`sellerId`,`sellerName`,`validity`,`modifyTime`) values (2,1,'操作人','2014-12-17 14:20:36',2,200,100,'uploads/vipPicture/hybg-1.png','白银','9.5',1,'泡泡鱼','1','2014-12-17 14:21:33');
insert  into `sto_member_rule`(`id`,`operatorId`,`operatorName`,`createTime`,`memberRating`,`upperLimit`,`lowerLimit`,`ico`,`memberName`,`rebate`,`sellerId`,`sellerName`,`validity`,`modifyTime`) values (3,1,'操作人','2014-12-17 14:21:47',3,300,200,'uploads/vipPicture/hybg-2.png','黄金','9.0',1,'泡泡鱼','1','2014-12-17 14:22:35');
insert  into `sto_member_rule`(`id`,`operatorId`,`operatorName`,`createTime`,`memberRating`,`upperLimit`,`lowerLimit`,`ico`,`memberName`,`rebate`,`sellerId`,`sellerName`,`validity`,`modifyTime`) values (4,1,'操作人','2014-12-17 14:22:44',4,400,300,'uploads/vipPicture/hybg-2.png','钻石','8.5',1,'泡泡鱼','1','2014-12-17 14:23:26');
insert  into `sto_member_rule`(`id`,`operatorId`,`operatorName`,`createTime`,`memberRating`,`upperLimit`,`lowerLimit`,`ico`,`memberName`,`rebate`,`sellerId`,`sellerName`,`validity`,`modifyTime`) values (5,1,'操作人','2014-12-17 14:23:37',5,500,400,'uploads/vipPicture/hybg-2.png','超级VIP','8.0',1,'泡泡鱼','1','2014-12-17 14:24:23');

/*Data for the table `sto_seller_info` */

insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (1,111111,NULL,'0551-1234567','<h2>\r\n	订单\r\n</h2>',NULL,'1','王贞贞14','15055172478','wzz_rj0902@163.com',NULL,'张三');
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (6,111111,NULL,'0551-1234567','餐饮',NULL,'1','王贞贞','13855117363','wzz_rj0902@163.com',NULL,'张三');
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (12,111111,NULL,'0551-1234567','餐饮',NULL,'1','乐乐','15055172478','wzz_rj0902@163.com',NULL,'张三');
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (13,111111,NULL,'0551-1234567','',NULL,'1','王贞贞','13855117363','',NULL,NULL);
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (14,111111,NULL,'0551-1234567','',NULL,'1','王贞贞','13855117363','',NULL,NULL);
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (15,111111,NULL,'0551-1234567','<h2>\r\n	订单\r\n</h2>',NULL,'1','王贞贞14','15055172478','wzz_rj0902@163.com',NULL,NULL);
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (17,111111,NULL,'0551-1234567','商家介绍:例如营业面积、本店特色等\r\n\r\n合作店数:\r\n\r\n套餐/产品:\r\n\r\n是否有营业执照/其它证书:\r\n\r\n人均消费:\r\n\r\n日均可接待量:\r\n\r\n其他介绍:',NULL,'1','锅锅','13855117363','wzz_rj0902@163.com',NULL,NULL);
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (18,111111,NULL,'','',NULL,'1','测试','150000000','test@126.com',NULL,NULL);
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (20,111111,NULL,'0551-1234567','餐饮',NULL,'1','王贞贞','13855117363','wzz_rj0902@163.com',NULL,NULL);
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (22,111111,NULL,'0551-1234567','餐饮',NULL,'1','乐乐','15055172478','wzz_rj0902@163.com',NULL,NULL);
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (23,111111,NULL,'0551-1234567','商家介绍:例如营业面积、本店特色等\r\n\r\n合作店数:\r\n\r\n套餐/产品:\r\n\r\n是否有营业执照/其它证书:\r\n\r\n人均消费:\r\n\r\n日均可接待量:\r\n\r\n其他介绍:',NULL,'1','锅锅','13855117363','wzz_rj0902@163.com',NULL,NULL);
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (24,111111,NULL,'0551-1234567','',NULL,'1','王贞贞','13855117363','',NULL,NULL);
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (25,NULL,NULL,'','<iframe src=\"http://localhost/yii2/apps/yii2test/backend/web/assets/5f61567f/plugins/baidumap/index.html?center=117.203073%2C31.846456&zoom=19&width=558&height=360&markers=117.203073%2C31.846456&markerStyles=l%2CA\" frameborder=\"0\" style=\"width:560px;height:362px;\">\r\n</iframe>\r\n<table style=\"width:100%;\" cellpadding=\"2\" cellspacing=\"0\" border=\"1\" bordercolor=\"#000000\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<br />',NULL,'1','乐乐14','15055172478','',NULL,NULL);
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (26,NULL,NULL,'','<iframe src=\"http://localhost/yii2/apps/yii2test/backend/web/assets/5f61567f/plugins/baidumap/index.html?center=117.203073%2C31.846456&zoom=19&width=558&height=360&markers=117.203073%2C31.846456&markerStyles=l%2CA\" frameborder=\"0\" style=\"width:560px;height:362px;\">\r\n</iframe>\r\n<table style=\"width:100%;\" cellpadding=\"2\" cellspacing=\"0\" border=\"1\" bordercolor=\"#000000\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<br />',NULL,'1','乐乐14','15055172478','',NULL,NULL);
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (27,NULL,NULL,'0551-1234567','<br />\r\n&nbsp;&nbsp;<span style=\"font-family:Simsun;font-size:14px;line-height:26px;\">海地前总统突发心脏病63岁逝世19岁时成为“终生总统\"</span><br />\r\n<span id=\"__kindeditor_bookmark_start_0__\"></span>',NULL,'1','王贞贞17','13855117363','wzz_rj0902@163.com',NULL,NULL);
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (28,111111,NULL,'0551-1234567','<h2>\r\n	<span><i><u>地对地导弹地对地导弹</u></i></span>\r\n</h2>',NULL,'1','王贞贞12-01','13855117363','wzz_rj0902@163.com',NULL,NULL);
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (35,111111,NULL,'0551-1234567','<h2>\r\n	<span style=\"color:#E53333;\">的顶顶顶顶顶</span><span style=\"color:#E53333;\"></span>\r\n</h2>','test111','1','乐乐12-12','13855117363','wzz_rj0902@163.com',NULL,'test2222');
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (37,111111,NULL,'0551-1234567','凤飞飞','test8888','1','王贞贞','13855117363','wzz_rj0902@163.com',NULL,'test9999');
insert  into `sto_seller_info`(`id`,`customerManager`,`contractId`,`otherContactWay`,`summary`,`sellerName`,`validity`,`contacts`,`phone`,`email`,`accountBalance`,`owner`) values (38,NULL,NULL,'0551-1234567','餐饮','test888','1','乐乐','15055172478','wzz_rj0902@163.com',NULL,'test9999');

/*Data for the table `sto_store_info` */

insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (1,'2014-12-05 13:23:56','合肥蜀山区',1,'测试店铺22','0551-1234567',1,'1','早上10：00到晚上22：00',1,2,'ZDfsd fasf sad fsda fasd fasd fasdf sd asd fasd fas fsd ',7,1,3,'4');
insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (2,'2014-12-12 11:10:28','安徽',1,'傣妹','0551-6677887',1,'1','早上10：00到晚上22：00',1.111,2.111,'法第三方士大夫删的份都是法撒旦是是打发是打发是打发是打发是是的',1,1,1,'1');
insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (3,'2014-12-12 11:30:25','合肥蜀山区',1,'测试店铺3','0551-1234567',1,'1',NULL,1,2,'范德萨发撒旦富士达发的是富士达阿萨德发生的阿萨德法撒旦',7,1,3,'4');
insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (4,'2014-12-12 11:36:09','信阳浉河区新天地',1,'肯德基12','0551-1234567',1,'1',NULL,1,2,'',1,1,1,NULL);
insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (5,'2014-12-12 02:05:07','信阳罗山',1,'肯德基13','0551-1234567',NULL,'1',NULL,NULL,NULL,'<p style=\"font-size:14px;text-indent:2em;color:#252525;font-family:宋体, sans-serif;text-align:justify;background-color:#FFFFFF;\">\r\n	<strong>秦海璐节目谈王新军必称：“我老公”</strong>\r\n</p>\r\n<p style=\"font-size:14px;text-indent:2em;color:#252525;font-family:宋体, sans-serif;text-align:justify;background-color:#FFFFFF;\">\r\n	刚宣布完婚讯的秦海璐也首度回归《超级先生》节目录制，对于当天媒体的婚事和孕事等问题，秦海璐则不愿多回应，不过秦海璐心情看上去十分愉悦，身穿一身蓝色连衣裙的秦海璐笑容甜蜜、气色极佳，还频频挥手与现场观众打招呼，不时和谢娜、李小冉等互动，而在节目录制现场，秦海璐也不时与嘉宾互动谈及王新军，而值得一提的是，秦海璐一提王新军已经十分熟路的改口：“我老公”，一脸幸福，一改之前男朋友的称呼。\r\n</p>\r\n<img src=\"http://img2.cache.netease.com/ent/2014/7/14/20140714035228aa541.jpg\" alt=\"李小冉\" />',5,1,2,NULL);
insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (6,'2014-12-12 02:35:04','信阳',1,'肯德基14','',26,'1',NULL,NULL,NULL,'<iframe src=\"http://localhost/yii2/apps/yii2test/backend/web/assets/5f61567f/plugins/baidumap/index.html?center=117.203073%2C31.846456&zoom=19&width=558&height=360&markers=117.203073%2C31.846456&markerStyles=l%2CA\" frameborder=\"0\" style=\"width:560px;height:362px;\">\r\n</iframe>\r\n<table style=\"width:100%;\" cellpadding=\"2\" cellspacing=\"0\" border=\"1\" bordercolor=\"#000000\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<br />',2,1,1,NULL);
insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (7,'2014-12-12 09:28:21','合肥蜀山区',1,'必胜客17','0551-1234567',27,'1',NULL,116.307854,40.055878,'<br />\r\n&nbsp;&nbsp;<span style=\"font-family:Simsun;font-size:14px;line-height:26px;\">海地前总统突发心脏病63岁逝世19岁时成为“终生总统\"</span><br />\r\n<span id=\"__kindeditor_bookmark_start_0__\"></span>',8,3,6,NULL);
insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (8,'2014-12-14 03:43:58','合肥高新区万达',1,'必胜客12-01','0551-1234567',28,'1',NULL,116.307854,40.055878,'<h2>\r\n	<span><i><u>地对地导弹地对地导弹</u></i></span>\r\n</h2>',10,3,7,NULL);
insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (9,NULL,'合肥蜀山区',NULL,'测试店铺1','0551-1234567',NULL,NULL,NULL,1,2,' 范德萨发生的富士达富士达阿萨德阿萨德',8,2,6,'4');
insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (10,'2014-12-17 15:30:31','合肥蜀山区',NULL,'测试店铺10','0551-1234567',1,'1','9:00-23:00',1,2,'ZDfsd fasf sad fsda fasd fasd fasdf sd asd fasd fas fsd ',7,1,3,'4');
insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (11,'2014-12-17 15:45:13','合肥蜀山区',NULL,'测试店铺1','0551-1234567',NULL,'1','9:00-23:00',1,2,' 范德萨发生的富士达富士达阿萨德阿萨德',8,2,6,'4');
insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (17,'2014-12-21 11:48:11','信阳',1,'必胜客12-12','0551-1234567',35,'1',NULL,NULL,NULL,'<h2>\r\n	<span style=\"color:#E53333;\">的顶顶顶顶顶</span><span style=\"color:#E53333;\"></span>\r\n</h2>',4,3,2,NULL);
insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (19,'2014-12-21 11:55:14','信阳s',1,'必胜客','0551-1234567',37,'1',NULL,116.307854,40.055878,'凤飞飞',1,3,1,NULL);
insert  into `sto_store_info`(`id`,`createTime`,`storeAddress`,`storeType`,`storeName`,`contactWay`,`sellerId`,`validity`,`businessHours`,`longitude`,`latitude`,`storeOutline`,`businessDistrictId`,`cityId`,`countryID`,`auditState`) values (20,'2014-12-21 12:10:49','合肥市蜀山区之心城',1,'麦当劳','0551-1234567',38,'1',NULL,NULL,NULL,'餐饮',3,2,2,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
