/*
SQLyog Job Agent v11.24 (32 bit) Copyright(c) Webyog Inc. All Rights Reserved.


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

/*Table structure for table `ad_advertisement` */

DROP TABLE IF EXISTS `ad_advertisement`;

CREATE TABLE `ad_advertisement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createrId` int(11) DEFAULT NULL COMMENT '创建人员ID',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `mapLink` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '对应链接',
  `mapOrder` int(11) DEFAULT NULL COMMENT '对应顺序',
  `mapLocation` int(11) DEFAULT NULL COMMENT '对应位置',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  `adName` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '广告名称',
  `endDate` datetime DEFAULT NULL COMMENT '结束日期（有效期）',
  `startDate` datetime DEFAULT NULL COMMENT '开始日期（有效期）',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  `photoUrl` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '图片路径',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='广告';

/*Table structure for table `ad_push_message` */

DROP TABLE IF EXISTS `ad_push_message`;

CREATE TABLE `ad_push_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '地区',
  `toAge` int(11) DEFAULT NULL COMMENT '截至年龄',
  `fromAge` int(11) DEFAULT NULL COMMENT '起始年龄',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  `pushIntroduction` blob COMMENT '推送概述',
  `pushTime` datetime DEFAULT NULL COMMENT '推送时间',
  `pushDetails` blob COMMENT '推送详情',
  `pushSex` varchar(4) COLLATE utf8_bin DEFAULT NULL COMMENT '推送性别',
  `messageTopic` blob COMMENT '消息主题',
  `membershipGrade` int(11) DEFAULT NULL COMMENT '会员等级',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='推送消息';

/*Table structure for table `ad_recommend_goods` */

DROP TABLE IF EXISTS `ad_recommend_goods`;

CREATE TABLE `ad_recommend_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creater` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '创建人',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `adLocation` int(11) DEFAULT NULL COMMENT '广告位置',
  `endDate` datetime DEFAULT NULL COMMENT '结束时间（有效期）',
  `startDate` datetime DEFAULT NULL COMMENT '开始日期（有效期）',
  `goodsId` int(11) DEFAULT NULL COMMENT '商品ID',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='推荐商品';

/*Table structure for table `com_account` */

DROP TABLE IF EXISTS `com_account`;

CREATE TABLE `com_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '邮箱',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `phoneNumber` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '电话号码',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  `password` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '密码',
  `sex` varchar(4) COLLATE utf8_bin DEFAULT NULL COMMENT '性别',
  `nickname` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户名称',
  `userName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户姓名',
  `accountStatus` int(11) DEFAULT NULL COMMENT '帐号状态',
  `address` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '住址',
  `isFirstLogin` char(4) COLLATE utf8_bin DEFAULT NULL COMMENT '是否是首次登录 1 是 0 否',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='账号';

/*Table structure for table `com_blacklist` */

DROP TABLE IF EXISTS `com_blacklist`;

CREATE TABLE `com_blacklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createrId` int(11) DEFAULT NULL COMMENT '创建人员ID',
  `createrName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '创建人员名称',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `pullInBlacklistReason` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '拉入黑名单原因',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  `userAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户账号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='黑名单';

/*Table structure for table `com_business_district` */

DROP TABLE IF EXISTS `com_business_district`;

CREATE TABLE `com_business_district` (
  `businessDistrictId` int(11) NOT NULL AUTO_INCREMENT COMMENT '商圈ID',
  `businessDistrictCode` int(11) DEFAULT NULL COMMENT '商圈编码',
  `businessDistrictName` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '商圈名称',
  `countyId` int(11) DEFAULT NULL COMMENT '区县id',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  PRIMARY KEY (`businessDistrictId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商圈';

/*Table structure for table `com_category_maintain` */

DROP TABLE IF EXISTS `com_category_maintain`;

CREATE TABLE `com_category_maintain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentCategoryId` int(11) DEFAULT NULL COMMENT '父类类别id',
  `categoryAttribute` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '类别属性',
  `categoryFeature` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '类别特性',
  `categoryCode` int(11) DEFAULT NULL COMMENT '类别编码',
  `categoryGrade` int(11) DEFAULT NULL COMMENT '类别等级',
  `categoryName` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '类别名称',
  `categoryType` int(255) DEFAULT NULL COMMENT '类别类型 [1.商品类别 2.评价类别]',
  `operatorId` int(11) DEFAULT NULL COMMENT '操作人ID',
  `operatorName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '操作人名称',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='类别维护';

/*Table structure for table `com_checkout_stream` */

DROP TABLE IF EXISTS `com_checkout_stream`;

CREATE TABLE `com_checkout_stream` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `operatorId` int(11) DEFAULT NULL COMMENT '操作人Id',
  `operatorAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '操作人账号',
  `operatorTime` datetime DEFAULT NULL COMMENT '操作时间',
  `depositAlipayName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '存入支付宝名称',
  `depositAlipayAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '存入支付宝账号',
  `interfaceSerialNumber` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '接口流水编号',
  `balanceMoney` double DEFAULT NULL COMMENT '结款金额',
  `balanceApplyId` int(11) DEFAULT NULL COMMENT '结款申请Id',
  `balanceTime` datetime DEFAULT NULL COMMENT '结款时间',
  `storeId` int(11) DEFAULT NULL COMMENT '商家Id',
  `storeName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家名称',
  `expenditureAlipayName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '支出支付宝名称',
  `expenditureAlipayAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '支出支付宝账号',
  `alipayTransactionStream` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '支付宝交易流水',
  `payTime` datetime DEFAULT NULL COMMENT '支付时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='结款流水';

/*Table structure for table `com_citycenter` */

DROP TABLE IF EXISTS `com_citycenter`;

CREATE TABLE `com_citycenter` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `cityCenterName` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '市区名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='市区表';

/*Table structure for table `com_comment` */

DROP TABLE IF EXISTS `com_comment`;

CREATE TABLE `com_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键 自增列',
  `storeId` int(11) DEFAULT NULL COMMENT '门店ID',
  `storeName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '门店名称',
  `content` blob COMMENT '评价内容',
  `commentPersonID` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '评论人',
  `commentPersonName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '评论人名称',
  `discussantAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '评论人账号',
  `commentDate` datetime DEFAULT NULL COMMENT '评论时间',
  `sellerId` int(11) DEFAULT NULL COMMENT '商家ID',
  `sellerName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家名称',
  `goodsId` int(11) DEFAULT NULL COMMENT '商品ID',
  `goodsName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商品名称',
  `cryptonym` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '是否匿名：0不匿名，1匿名',
  `validity` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '是否有效：0无效，1有效',
  `detailsComment` blob COMMENT '详细评价',
  `overallScore` int(11) DEFAULT NULL COMMENT '总体评分',
  `pid` int(11) DEFAULT NULL COMMENT '用于商家回复使用 存储为回复当前评论ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='评价';

/*Table structure for table `com_comment_del` */

DROP TABLE IF EXISTS `com_comment_del`;

CREATE TABLE `com_comment_del` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增列',
  `commentId` bigint(20) DEFAULT NULL COMMENT '评价ID',
  `operationPersonNo` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '操作人工号',
  `operationPersonnel` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '操作人',
  `operationDate` datetime DEFAULT NULL COMMENT '操作时间',
  `reason` blob COMMENT '原因',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='品论删除日志';

/*Table structure for table `com_county` */

DROP TABLE IF EXISTS `com_county`;

CREATE TABLE `com_county` (
  `countyId` int(11) NOT NULL AUTO_INCREMENT COMMENT '区县ID',
  `countyName` varchar(600) COLLATE utf8_bin DEFAULT NULL COMMENT '区县名称',
  `cityCenterId` int(11) DEFAULT NULL COMMENT '市区id（扩展备用）',
  `isValid` char(3) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  PRIMARY KEY (`countyId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `com_evaluation_category` */

DROP TABLE IF EXISTS `com_evaluation_category`;

CREATE TABLE `com_evaluation_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapCategoryParenClasstId` int(11) DEFAULT NULL COMMENT '对应类别父类id',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  `categoryAttribute` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '类别属性',
  `categoryFeature` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '类别特性',
  `evaluationCategoryCode` int(11) DEFAULT NULL COMMENT '评价类别编码',
  `evaluationCategoryGrade` int(11) DEFAULT NULL COMMENT '评价类别等级',
  `evaluationName` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '评价名称',
  `evaluationAttribute` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '评价属性',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='评价类别';

/*Table structure for table `com_goods_review` */

DROP TABLE IF EXISTS `com_goods_review`;

CREATE TABLE `com_goods_review` (
  `storeId` int(11) DEFAULT NULL COMMENT '商家Id',
  `storeName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家名称',
  `storeApplyId` int(11) DEFAULT NULL COMMENT '商家申请Id',
  `applyerId` int(11) DEFAULT NULL COMMENT '申请人Id',
  `applyerAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '申请人账号',
  `applyTime` datetime DEFAULT NULL COMMENT '申请时间',
  `reviewerId` int(11) DEFAULT NULL COMMENT '审核人员Id',
  `reviewerName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '审核人员名称',
  `reviewTaskId` int(11) DEFAULT NULL COMMENT '审核任务Id',
  `reviewTime` datetime DEFAULT NULL COMMENT '审核时间',
  `reviewStatus` int(11) DEFAULT NULL COMMENT '审核状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商品信息审核';

/*Table structure for table `com_menu` */

DROP TABLE IF EXISTS `com_menu`;

CREATE TABLE `com_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menuUrl` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '菜单URL',
  `menuName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '菜单名称',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `parentMenuId` int(11) DEFAULT NULL COMMENT '父菜单ID',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='菜单';

/*Table structure for table `com_menu_rolerelation` */

DROP TABLE IF EXISTS `com_menu_rolerelation`;

CREATE TABLE `com_menu_rolerelation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menuId` int(11) DEFAULT NULL COMMENT '菜单id',
  `creater` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '创建者',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  `roleId` int(11) DEFAULT NULL COMMENT '角色id',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=860 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='菜单角色关系表';

/*Table structure for table `com_message_box` */

DROP TABLE IF EXISTS `com_message_box`;

CREATE TABLE `com_message_box` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键 自增列',
  `seeDate` datetime DEFAULT NULL COMMENT '查看时间',
  `sendOutDate` datetime DEFAULT NULL COMMENT '发出时间',
  `recipientsId` int(11) DEFAULT NULL COMMENT '收件人ID',
  `recipientsName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '收件人姓名',
  `readState` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '是否读取：0未读取，1：已读取',
  `summary` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '消息概述',
  `content` blob COMMENT '消息内容',
  `title` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '消息主题，标题',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='消息盒子';

/*Table structure for table `com_person_rolerelation` */

DROP TABLE IF EXISTS `com_person_rolerelation`;

CREATE TABLE `com_person_rolerelation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  `roleId` int(11) DEFAULT NULL COMMENT '角色id',
  `personId` int(11) DEFAULT NULL COMMENT '人员id',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  `accountType` int(11) DEFAULT NULL COMMENT '帐号类型  1、系统帐号；2、商家',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='人员角色关系表';

/*Table structure for table `com_refund_review` */

DROP TABLE IF EXISTS `com_refund_review`;

CREATE TABLE `com_refund_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `financeId` int(11) DEFAULT NULL COMMENT '财务人员Id',
  `financeAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '财务人员账号',
  `financeReviewTime` datetime DEFAULT NULL COMMENT '财务审核时间',
  `financeReviewStatus` int(11) DEFAULT NULL COMMENT '财务审核状态',
  `reviewId` int(11) DEFAULT NULL COMMENT '初审人员Id',
  `reviewAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '初审人员账号',
  `reviewTime` datetime DEFAULT NULL COMMENT '初审时间',
  `reviewStatus` int(11) DEFAULT NULL COMMENT '初审状态',
  `orderId` int(11) DEFAULT NULL COMMENT '订单Id',
  `orderName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '订单名称',
  `storeName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家名称',
  `storeAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家账号',
  `applyTime` datetime DEFAULT NULL COMMENT '申请时间',
  `refundMoney` double DEFAULT NULL COMMENT '退款金额',
  `refundReason` varchar(250) COLLATE utf8_bin DEFAULT NULL COMMENT '退款原因',
  `verificationCode` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '验证码',
  `userName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户名称',
  `userAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户账号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='退款审核';

/*Table structure for table `com_refund_stream` */

DROP TABLE IF EXISTS `com_refund_stream`;

CREATE TABLE `com_refund_stream` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `operatorId` int(11) DEFAULT NULL COMMENT '操作人Id',
  `operatorAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '操作人账号',
  `operateTime` datetime DEFAULT NULL COMMENT '操作时间',
  `loadTime` datetime DEFAULT NULL COMMENT '存入时间',
  `loadAlipayName` varchar(250) COLLATE utf8_bin DEFAULT NULL COMMENT '存入支付宝名称',
  `loadAlipayAccount` varchar(250) COLLATE utf8_bin DEFAULT NULL COMMENT '存入支付宝账号',
  `refundMoney` double DEFAULT NULL COMMENT '退款金额',
  `refundStreamId` int(11) DEFAULT NULL COMMENT '退款流水Id',
  `refundTime` datetime DEFAULT NULL COMMENT '退款入账时间',
  `refundApplyId` int(11) DEFAULT NULL COMMENT '退款申请Id',
  `refundApplyTime` datetime DEFAULT NULL COMMENT '退款申请时间',
  `verificationCode` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '验证码',
  `userId` int(11) DEFAULT NULL COMMENT '用户Id',
  `userAccount` varchar(250) COLLATE utf8_bin DEFAULT NULL COMMENT '用户账号',
  `payAlipayName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '支出支付宝名称',
  `payAlipayAccount` varchar(250) COLLATE utf8_bin DEFAULT NULL COMMENT '支出支付宝账号',
  `alipayStreamNumber` int(11) DEFAULT NULL COMMENT '支付宝交易流水号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='退款流水';

/*Table structure for table `com_role` */

DROP TABLE IF EXISTS `com_role`;

CREATE TABLE `com_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creater` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '创建人',
  `updateTime` datetime DEFAULT NULL COMMENT '更新时间',
  `roleCode` int(11) DEFAULT NULL COMMENT '角色编码',
  `roleName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '角色名称',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  `updatePerson` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '修改人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色表';

/*Table structure for table `com_route_mapsceneryspot` */

DROP TABLE IF EXISTS `com_route_mapsceneryspot`;

CREATE TABLE `com_route_mapsceneryspot` (
  `relationId` int(11) DEFAULT NULL COMMENT '关系ID',
  `scenerySpotId` int(11) DEFAULT NULL COMMENT '景点ID',
  `routeId` int(11) DEFAULT NULL COMMENT '路线ID',
  `routeTravelIntroduction` blob COMMENT '路线行程说明',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='路线对应景点';

/*Table structure for table `com_scenery_spot` */

DROP TABLE IF EXISTS `com_scenery_spot`;

CREATE TABLE `com_scenery_spot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '地址',
  `phoneNumber` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '电话',
  `recommendedPlayTime` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '建议游玩时间',
  `scenerySpotIntroduction` blob COMMENT '景点简介',
  `scenerySpotName` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '景点名称',
  `scenerySpotDetails` blob COMMENT '景点详情',
  `isFree` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '是否免费  0 否 、  1 是',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  `locationLongitude` double DEFAULT NULL COMMENT '位置-经度',
  `locationLatitude` double DEFAULT NULL COMMENT '位置-纬度',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='景点';

/*Table structure for table `com_scenery_spotmapgoods` */

DROP TABLE IF EXISTS `com_scenery_spotmapgoods`;

CREATE TABLE `com_scenery_spotmapgoods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scenerySpotId` int(11) DEFAULT NULL COMMENT '景点ID',
  `goodsId` int(11) DEFAULT NULL COMMENT '商品ID',
  `goodsType` int(11) DEFAULT NULL COMMENT '商品类型  1、门票；2、宾馆；3、没事；4、其他',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='景点对应商品';

/*Table structure for table `com_tour_route` */

DROP TABLE IF EXISTS `com_tour_route`;

CREATE TABLE `com_tour_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `routeIntroduction` blob COMMENT '路线简介',
  `routeName` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '路线名称',
  `routeEffectMap` blob COMMENT '路线效果图',
  `isValid` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '0 无效、1 有效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='旅游路线';

/*Table structure for table `com_work_order` */

DROP TABLE IF EXISTS `com_work_order`;

CREATE TABLE `com_work_order` (
  `workOrderId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `processMethod` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '处理方式',
  `processContent` blob COMMENT '处理内容',
  `processerNumber` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '处理人工号',
  `processerName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '处理人名称',
  `processerTime` datetime DEFAULT NULL COMMENT '处理时间',
  `workOrderType` int(11) DEFAULT NULL COMMENT '工单类型',
  `workOrderContent` blob COMMENT '工单内容',
  `workOrderStatus` int(11) DEFAULT NULL COMMENT '工单状态',
  `recordNumber` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '记录人员工号',
  `recordName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '记录人员名称',
  `recordTime` datetime DEFAULT NULL COMMENT '记录时间',
  `nickName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户名称',
  `userName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户账号',
  PRIMARY KEY (`workOrderId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='工单';

/*Table structure for table `cus_consumption_records` */

DROP TABLE IF EXISTS `cus_consumption_records`;

CREATE TABLE `cus_consumption_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增列',
  `orderNo` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '订单编号',
  `orderId` int(11) DEFAULT NULL COMMENT '订单ID',
  `goodsId` int(11) DEFAULT NULL COMMENT '商品ID',
  `verfificationCode` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '验证码',
  `goodsNumber` int(11) DEFAULT NULL COMMENT '商品数量',
  `costPrice` float DEFAULT NULL COMMENT '原价',
  `payablePrice` float DEFAULT NULL COMMENT '应付价格，实付价格',
  `rebate` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '折扣',
  `userAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户账户',
  `memberCardNo` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '会员卡卡号',
  `sellerId` int(11) DEFAULT NULL COMMENT '商家ID',
  `sellerAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家账号',
  `verifierAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '验证人账号',
  `verifierTime` datetime DEFAULT NULL COMMENT '验证时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='消费记录、流水';

/*Table structure for table `cus_electronic_card` */

DROP TABLE IF EXISTS `cus_electronic_card`;

CREATE TABLE `cus_electronic_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键 自助增长',
  `memberId` int(11) DEFAULT NULL COMMENT '会员等级ID',
  `memberCardNumber` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '会员卡卡号',
  `sellerName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家名称',
  `userIndividualCenterId` int(11) DEFAULT NULL COMMENT '用户个人中心ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户对应会员电子卡';

/*Table structure for table `cus_member_up_log` */

DROP TABLE IF EXISTS `cus_member_up_log`;

CREATE TABLE `cus_member_up_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键 自增列',
  `userIndividualCenterId` int(11) DEFAULT NULL COMMENT '用户个人中心ID',
  `oldMemberId` int(11) DEFAULT NULL COMMENT '原始会员卡规则ID',
  `oldMemberName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '原始会员卡等级名称',
  `newMemberId` int(11) DEFAULT NULL COMMENT '新会员卡规则ID',
  `newMemberName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '新会员卡等级名称',
  `upgradeDate` datetime DEFAULT NULL COMMENT '升级日期',
  `consumptionAmount` float DEFAULT NULL COMMENT '消费金额',
  `memberCardNo` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '会员卡号',
  `oldRebate` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '原始会员折扣',
  `newRebate` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '新会员折扣',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='会员卡升级日志';

/*Table structure for table `cus_order` */

DROP TABLE IF EXISTS `cus_order`;

CREATE TABLE `cus_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增列',
  `orderNo` int(11) DEFAULT NULL COMMENT '订单编号',
  `totalPrice` float DEFAULT NULL COMMENT '订单总价',
  `userAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户账户',
  `userName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户姓名',
  `payTotalPrice` float DEFAULT NULL COMMENT '支付总价',
  `buyTime` datetime DEFAULT NULL COMMENT '购买时间',
  `methodsPayment` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '支付方式',
  `paymentAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '支付账户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='订单信息';

/*Table structure for table `cus_order_details` */

DROP TABLE IF EXISTS `cus_order_details`;

CREATE TABLE `cus_order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增列',
  `orderId` int(11) DEFAULT NULL COMMENT '订单ID',
  `goodsName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商品名称',
  `goodsId` int(11) DEFAULT NULL COMMENT '商品ID',
  `price` float DEFAULT NULL COMMENT '商品价格',
  `totalPrice` float DEFAULT NULL COMMENT '商品总价',
  `rebate` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '折扣',
  `rebatePrice` float DEFAULT NULL COMMENT '折扣价格',
  `totalNum` int(11) DEFAULT NULL COMMENT '商品数量',
  `sellerId` int(11) DEFAULT NULL COMMENT '商家ID',
  `memberCardNo` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '会员卡卡号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='订单详情';

/*Table structure for table `cus_payment_records` */

DROP TABLE IF EXISTS `cus_payment_records`;

CREATE TABLE `cus_payment_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增列',
  `recordsNo` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '流水、记录编号',
  `orderId` int(11) DEFAULT NULL COMMENT '订单ID',
  `orderNo` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '订单编号',
  `orderTotalPrice` float DEFAULT NULL COMMENT '订单总金额',
  `remainingSum` float DEFAULT NULL COMMENT '余额付款金额',
  `otherPaymentAmount` float DEFAULT NULL COMMENT '其他付款金额',
  `paymentTime` datetime DEFAULT NULL COMMENT '支付时间',
  `userIndividualCenterId` int(11) DEFAULT NULL COMMENT '用户Id',
  `userAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户账户',
  `sellerId` int(11) DEFAULT NULL COMMENT '商家ID',
  `sellerName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='支付流水、记录';

/*Table structure for table `cus_prepaid_mention_now` */

DROP TABLE IF EXISTS `cus_prepaid_mention_now`;

CREATE TABLE `cus_prepaid_mention_now` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增列',
  `transactionType` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '交易类型',
  `serialNumber` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '充值提现序号，流水号',
  `orderNo` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '订单编号',
  `amount` float DEFAULT NULL COMMENT '金额',
  `operationTime` datetime DEFAULT NULL COMMENT '操作时间',
  `depositAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '存入账号',
  `depositAccountName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '支付宝名称',
  `payAccountName` varchar(0) COLLATE utf8_bin DEFAULT NULL COMMENT '支付账号名称',
  `payAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '支付账号',
  `userIdAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户账号',
  `transactionNo` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '交易流水号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='充值提现信息';

/*Table structure for table `cus_shopping_trolley` */

DROP TABLE IF EXISTS `cus_shopping_trolley`;

CREATE TABLE `cus_shopping_trolley` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增列',
  `goodsId` int(11) DEFAULT NULL COMMENT '商品ID',
  `goodsName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商品名称',
  `price` float DEFAULT NULL COMMENT '单价',
  `number` int(11) DEFAULT NULL COMMENT '数量',
  `userIndividualCenterId` int(11) DEFAULT NULL COMMENT '用户ID-用户?鋈酥行腎D',
  `DATETIME` datetime DEFAULT NULL COMMENT '时间',
  `memberCardNo` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '会员卡卡号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='购物车';

/*Table structure for table `cus_user_account` */

DROP TABLE IF EXISTS `cus_user_account`;

CREATE TABLE `cus_user_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增列',
  `validity` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '是否有效  0 无效  1  有效',
  `userPassWord` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户登录密码',
  `userAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户登录名',
  `registrationDate` datetime DEFAULT NULL COMMENT '注册日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户账户';

/*Table structure for table `cus_user_individual_center` */

DROP TABLE IF EXISTS `cus_user_individual_center`;

CREATE TABLE `cus_user_individual_center` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键 自增列',
  `userAccountId` int(11) DEFAULT NULL COMMENT '用户账号ID',
  `birthday` datetime DEFAULT NULL COMMENT '生日',
  `validity` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '是否有效 0 无效、1 有效',
  `phone` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '手机号',
  `memberGrade` int(11) DEFAULT NULL COMMENT '系统会员等级',
  `consumptionAmount` float DEFAULT NULL COMMENT '消费金额',
  `interest` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '兴趣',
  `sex` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '性别  0：女  1：男',
  `userName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户姓名',
  `userAccount` float DEFAULT NULL COMMENT '用户账号、账户',
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '电子邮箱',
  `spareAmount` float DEFAULT NULL COMMENT '余款',
  `profession` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '职业',
  `registrationDate` datetime DEFAULT NULL COMMENT '注册日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户个人中心';

/*Table structure for table `cus_verification_code` */

DROP TABLE IF EXISTS `cus_verification_code`;

CREATE TABLE `cus_verification_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增列',
  `orderDetailsId` int(11) DEFAULT NULL COMMENT '订单详情ID',
  `verificationCode` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '验证码',
  `goodsId` int(11) DEFAULT NULL COMMENT '商品ID',
  `orderNo` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '订单编号',
  `number` int(11) DEFAULT NULL COMMENT '数量',
  `costPrice` float DEFAULT NULL COMMENT '原价',
  `payablePrice` float DEFAULT NULL COMMENT '应付价格',
  `state` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='验证码明细表';

/*Table structure for table `goods_apply_info` */

DROP TABLE IF EXISTS `goods_apply_info`;

CREATE TABLE `goods_apply_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `shopId` int(11) DEFAULT NULL COMMENT '店铺Id',
  `shopName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '店铺名称',
  `stock` int(11) DEFAULT NULL COMMENT '库存',
  `enterId` int(11) DEFAULT NULL COMMENT '录入Id',
  `enterAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '录入账号',
  `storeId` int(11) DEFAULT NULL COMMENT '商家Id',
  `storeName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家名称',
  `supplyTime` datetime DEFAULT NULL COMMENT '商品供应时间',
  `goodsPrice` double DEFAULT NULL COMMENT '商品价格',
  `goodsIntroduction` blob COMMENT '商品简介',
  `goodsType` int(11) DEFAULT NULL COMMENT '商品类别',
  `goodsDescription` blob COMMENT '商品描述',
  `goodsName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商品名称',
  `goodsValidityDate` datetime DEFAULT NULL COMMENT '商品有效期',
  `goodsId` int(11) DEFAULT NULL COMMENT '商品正式Id',
  `goodsStatus` int(11) DEFAULT NULL COMMENT '商品状态',
  `memberDiscount` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '是否享受会员折扣',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商品申请信息';

/*Table structure for table `goodspicture` */

DROP TABLE IF EXISTS `goodspicture`;

CREATE TABLE `goodspicture` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增列',
  `goodsId` int(11) DEFAULT NULL COMMENT '商品ID',
  `path` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '图片路径',
  `attribute` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '属性',
  `renewTime` datetime DEFAULT NULL COMMENT '更新时间',
  `classification` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '类别',
  `uploadPersonnel` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '上传人员',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商品图片信息';

/*Table structure for table `shop_info_review` */

DROP TABLE IF EXISTS `shop_info_review`;

CREATE TABLE `shop_info_review` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', 
  `longitude` DOUBLE DEFAULT NULL COMMENT '地图经度',
  `latitude` DOUBLE DEFAULT NULL COMMENT '地图纬度',
  `shopName` VARCHAR(50) COLLATE utf8_bin DEFAULT NULL COMMENT '店铺名称',
  `contact` VARCHAR(50) COLLATE utf8_bin DEFAULT NULL COMMENT '联系方式', 
  `storeId` INT(11) DEFAULT NULL COMMENT '商家ID',
  `storeAccount` VARCHAR(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家账号',
  `businessDistrictId` INT(11) DEFAULT NULL COMMENT '商圈id',
  `address` VARCHAR(250) COLLATE utf8_bin DEFAULT NULL COMMENT '详细地址',
  `businessHours` VARCHAR(100) COLLATE utf8_bin DEFAULT NULL COMMENT '营业时间',
  `storeOutline` TEXT COLLATE utf8_bin DEFAULT NULL COMMENT '门店概述', 
  `cityId` INT(11)   DEFAULT NULL COMMENT '地市ID',
  `countyId` INT(11)   DEFAULT NULL COMMENT '区县ID',
  `applyTime` DATETIME DEFAULT NULL COMMENT '申请时间',
  `applyUserId` INT(11) DEFAULT NULL COMMENT '申请人ID',
  `applyUserName` VARCHAR(100) COLLATE utf8_bin DEFAULT NULL COMMENT '申请人姓名',
  `auditUserId` INT(11) DEFAULT NULL COMMENT '初审人ID',
  `auditUserName` VARCHAR(100) COLLATE utf8_bin DEFAULT NULL COMMENT '初审人姓名',
  `auditTime` INT(11) DEFAULT NULL COMMENT '初审时间',
  `managerId` INT(11) DEFAULT NULL COMMENT '客户经理ID',
  `managerName` VARCHAR(100) COLLATE utf8_bin DEFAULT NULL COMMENT '客户经理姓名',
  `managerTime` INT(11) DEFAULT NULL COMMENT '客户经理审核时间',
  `auditState` INT(11) DEFAULT NULL COMMENT '审核状态 1、申请中 2、初审通过 3、初审驳回 4、经理审核通过  5、经理审核驳回',
  `Rejection` VARCHAR(100) COLLATE utf8_bin DEFAULT NULL COMMENT '驳回原因',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商家信息（门店信息审核）';

/*Table structure for table `sto_apply_info` */

DROP TABLE IF EXISTS `sto_apply_info`;

CREATE TABLE `sto_apply_info` (
  `applyId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `city` int(11) DEFAULT NULL COMMENT '城市',
  `longitude` double DEFAULT NULL COMMENT '经度',
  `latitude` double DEFAULT NULL COMMENT '纬度',
  `scopeBusiness` mediumtext COLLATE utf8_bin COMMENT '经营内容',
  `customerServiceId` int(11) DEFAULT NULL COMMENT '客服人员Id',
  `customerServiceName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '客服人员名称',
  `cusServiceReviewTime` datetime DEFAULT NULL COMMENT '客服人员审核时间',
  `customerManagerId` int(11) DEFAULT NULL COMMENT '客户经理Id',
  `customerManagerName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '客户经理名称',
  `cusManagerReviewTime` datetime DEFAULT NULL COMMENT '客户经理审核时间',
  `storePhone` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '门店电话',
  `storeName` varchar(250) COLLATE utf8_bin DEFAULT NULL COMMENT '门店名称',
  `otherContact` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '其他联系方式',
  `regional` int(11) DEFAULT NULL COMMENT '区域',
  `daySales` double DEFAULT NULL COMMENT '日销售额',
  `storeApplyNumber` int(11) DEFAULT NULL COMMENT '商家申请任务编号',
  `businessZone` int(11) DEFAULT NULL COMMENT '商圈',
  `applyTime` datetime DEFAULT NULL COMMENT '申请时间',
  `phone` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '手机',
  `address` varchar(250) COLLATE utf8_bin DEFAULT NULL COMMENT '详细地址',
  `name` varchar(250) COLLATE utf8_bin DEFAULT NULL COMMENT '姓名',
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '邮箱',
  `applyStatus` int(11) DEFAULT NULL COMMENT '最终审核状态',
  `storeCategoryId` int(11) DEFAULT NULL COMMENT '商家类型[类型维护表外键]',
  PRIMARY KEY (`applyId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商家信息';

/*Table structure for table `sto_balance_bill_detailed` */

DROP TABLE IF EXISTS `sto_balance_bill_detailed`;

CREATE TABLE `sto_balance_bill_detailed` (
  `balanceApplyId` int(11) DEFAULT NULL COMMENT '结算申请Id',
  `storeId` int(11) DEFAULT NULL COMMENT '商品Id',
  `goodsNumber` int(11) DEFAULT NULL COMMENT '商品数量',
  `consumeSaleStream` int(11) DEFAULT NULL COMMENT '消费交易流水',
  `actualConsumptionMoney` double DEFAULT NULL COMMENT '消费实付金额',
  `cunsumeOriginalMoney` double DEFAULT NULL COMMENT '消费原金额',
  `verificationCode` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '验证码',
  `verificaterAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '验证人账号',
  `verificateTime` datetime DEFAULT NULL COMMENT '验证时间',
  `membershipCardNumber` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户会员卡卡号',
  `userAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用户账号',
  `userDiscount` double DEFAULT NULL COMMENT '用户折扣'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商家结算账单明细';

/*Table structure for table `sto_balance_review` */

DROP TABLE IF EXISTS `sto_balance_review`;

CREATE TABLE `sto_balance_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `financeId` int(11) DEFAULT NULL COMMENT '财务人员Id',
  `financeAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '财务人员账号',
  `financeReviewStatus` int(11) DEFAULT NULL COMMENT '财务审核状态',
  `reviewId` int(11) DEFAULT NULL COMMENT '初审人员Id',
  `reviewAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '初审人员账号',
  `reviewTime` datetime DEFAULT NULL COMMENT '初审时间',
  `reviewStatus` int(11) DEFAULT NULL COMMENT '初审状态',
  `serviceFee` double DEFAULT NULL COMMENT '服务费抽取金额',
  `serviceAgreement` blob COMMENT '服务费协议',
  `balanceEndTime` datetime DEFAULT NULL COMMENT '结算截止时间',
  `balanceStartTime` datetime DEFAULT NULL COMMENT '结算起始时间',
  `storeId` int(11) DEFAULT NULL COMMENT '商家Id',
  `storeName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家名称',
  `applyerId` int(11) DEFAULT NULL COMMENT '申请人Id',
  `applyerAccount` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '申请人账号',
  `applyMoney` double DEFAULT NULL COMMENT '申请总金额',
  `actualBalanceMoney` double DEFAULT NULL COMMENT '实际结算金额',
  `financeReviewTime` datetime DEFAULT NULL COMMENT '财务审核时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商家结算审核';

/*Table structure for table `sto_goods` */

DROP TABLE IF EXISTS `sto_goods`;

CREATE TABLE `sto_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增列',
  `goodsName` varchar(150) COLLATE utf8_bin DEFAULT NULL COMMENT '商品名称',
  `summary` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '商品概述，简介',
  `describes` blob COMMENT '商品描述',
  `price` float DEFAULT NULL COMMENT '商品价格',
  `parentClass` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商品大类',
  `subClass` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商品子类',
  `sellerId` int(11) DEFAULT NULL COMMENT '对应商家ID',
  `storeId` int(11) DEFAULT NULL COMMENT '对应店铺门店ID',
  `validity` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '是否有效 0 无效  1 有效',
  `supplyDateTime` datetime DEFAULT NULL COMMENT '供应时间',
  `inventory` int(11) DEFAULT NULL COMMENT '库存',
  `enjoyRebate` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '是否享受会员折扣',
  `goodsGrade` int(11) DEFAULT NULL COMMENT '商品等级',
  `goodsWeight` int(11) DEFAULT NULL COMMENT '商品权重',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商品信息';

/*Table structure for table `sto_goods_change` */

DROP TABLE IF EXISTS `sto_goods_change`;

CREATE TABLE `sto_goods_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增列',
  `goodsName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商品名称',
  `oldGoodsPrice` float DEFAULT NULL COMMENT '变动前商品价格',
  `newGoodsPrice` float DEFAULT NULL COMMENT '变动后商品价格',
  `oldEnable` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '变动前是否享受会员折扣',
  `newEnable` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '变动后是否享受会员折扣',
  `changeDate` datetime DEFAULT NULL COMMENT '变动时间',
  `operationPersonID` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '操作人ID',
  `operationPersonName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '操作人名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商品变动日志';

/*Table structure for table `sto_info_review` */

DROP TABLE IF EXISTS `sto_info_review`;

CREATE TABLE `sto_info_review` (
  `infoReviewId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `customerManagerId` int(11) DEFAULT NULL COMMENT '客户经理Id',
  `customerManagerName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '客户经理名称',
  `customerManagerConfirmTime` datetime DEFAULT NULL COMMENT '客户经理确认时间',
  `otherContact` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '其他类型方式',
  `taskType` int(11) DEFAULT NULL COMMENT '任务类型',
  `storeIntroduction` blob COMMENT '商家介绍',
  `storeName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家名称',
  `storeInfoId` int(11) DEFAULT NULL COMMENT '商家信息Id',
  `shopOwnerName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '店主姓名',
  `applyTime` datetime DEFAULT NULL COMMENT '申请时间',
  `reviewResult` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '审核结果',
  `reviewerId` int(11) DEFAULT NULL COMMENT '审核人员Id',
  `reviewerName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '审核人员名称',
  `reviewTime` datetime DEFAULT NULL COMMENT '审核时间',
  `phone` int(11) DEFAULT NULL COMMENT '手机',
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '邮箱',
  `lastResult` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '最终结果',
  PRIMARY KEY (`infoReviewId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商家信息审核';

/*Table structure for table `sto_logon_account` */

DROP TABLE IF EXISTS `sto_logon_account`;

CREATE TABLE `sto_logon_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商家账号ID 自增列',
  `storeId` int(11) DEFAULT NULL COMMENT '店铺ID  ',
  `storeName` varchar(150) COLLATE utf8_bin DEFAULT NULL COMMENT '店铺名称',
  `roleId` int(11) DEFAULT NULL COMMENT '角色ID',
  `roleName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '角色名称',
  `sellerId` int(11) DEFAULT NULL COMMENT '商家ID',
  `PASSWORD` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家密码',
  `logonName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家登录账号',
  `nickName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '账号名称、昵称',
  `validity` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '是否有效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商家账号信息';

/*Table structure for table `sto_member_rule` */

DROP TABLE IF EXISTS `sto_member_rule`;

CREATE TABLE `sto_member_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID 自增列',
  `operatorId` int(11) DEFAULT NULL COMMENT '操作人ID',
  `operatorName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '操作人名称',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `memberRating` int(11) DEFAULT NULL COMMENT '会员等级',
  `upperLimit` int(11) DEFAULT NULL COMMENT '会员积分上限',
  `lowerLimit` bigint(20) DEFAULT NULL COMMENT '会员积分下限',
  `ico` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '会员等级图标',
  `memberName` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '会员名称',
  `rebate` varchar(5) COLLATE utf8_bin DEFAULT NULL COMMENT '折扣',
  `sellerId` int(11) DEFAULT NULL COMMENT '商家ID',
  `sellerName` varchar(150) COLLATE utf8_bin DEFAULT NULL COMMENT '商家名称',
  `validity` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '是否有效',
  `modifyTime` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='商家会员规则设置';

/*Table structure for table `sto_seller_info` */

DROP TABLE IF EXISTS `sto_seller_info`;

CREATE TABLE `sto_seller_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商家ID',
  `customerManager` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '对应客户经理',
  `contractId` tinyint(4) DEFAULT NULL COMMENT '合同Id',
  `otherContactWay` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '其他联系方式',
  `summary` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '商家概述',
  `sellerName` varchar(150) COLLATE utf8_bin DEFAULT NULL COMMENT '商家名称',
  `sellerdetails` blob COMMENT '商家详情描述',
  `validity` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '是否有效',
  `contacts` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '联系人',
  `phone` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '手机',
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '商家Email、邮箱',
  `accountBalance` float DEFAULT NULL COMMENT '账户余额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Table structure for table `sto_store_info` */

DROP TABLE IF EXISTS `sto_store_info`;

CREATE TABLE `sto_store_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '门店ID',
  `createTime` datetime DEFAULT NULL COMMENT '创建时间',
  `storeAddress` varchar(150) COLLATE utf8_bin DEFAULT NULL COMMENT '店铺地址',
  `storeType` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '店铺类别',
  `storeName` varchar(150) COLLATE utf8_bin DEFAULT NULL COMMENT '门店名称',
  `contactWay` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '联系方式',
  `sellerId` int(11) DEFAULT NULL COMMENT '商家ID',
  `validity` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '是否有效',
  `businessHours` varchar(150) COLLATE utf8_bin DEFAULT NULL COMMENT '营业时间  如：早上10：00到晚上22：00',
  `longitude` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '坐标：经度',
  `latitude` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '坐标：纬度',
  `storeOutline` text COLLATE utf8_bin DEFAULT NULL COMMENT '门店概述',  
  `businessDistrictId` int(11) DEFAULT NULL COMMENT '商圈id',  
  `cityId` int(11) DEFAULT NULL COMMENT '城市id',  
  `countryID` int(11) DEFAULT NULL COMMENT '区县id',  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='门店';

CREATE TABLE `sto_collection` (
  `ID` int(12) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `userId` int(12) NOT NULL COMMENT '用户id',
  `goodsId` int(12) NOT NULL COMMENT '商品ID',
  `insertTime` datetime DEFAULT NULL COMMENT '收藏时间',
  `sign` int(2) NOT NULL DEFAULT '0' COMMENT '收藏类型(默认0 - 商品收藏  扩展：1--商家收藏)',
  `goodsName` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '商品名称',
  `price` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '金额',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户商品收藏表'


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
