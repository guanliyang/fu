/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Version : 50717
 Source Host           : 127.0.0.1
 Source Database       : fu

 Target Server Version : 50717
 File Encoding         : utf-8

 Date: 09/09/2018 14:09:24 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;
-- ----------------------------
--  Table structure for `b_cart`
-- ----------------------------
DROP TABLE IF EXISTS `b_cart`;
CREATE TABLE `b_cart` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '购物车商品ID',
  `u_id` int(11) DEFAULT NULL COMMENT '对应用户ID',
  `bi_id` int(11) DEFAULT NULL COMMENT '加入购物车货组ID',
  `c_ctime` int(11) DEFAULT NULL COMMENT '加入购物车时间',
  `c_otime` int(11) DEFAULT NULL COMMENT '转成订单时间',
  `c_dtime` int(11) DEFAULT NULL COMMENT '删除时间',
  `c_status` int(1) DEFAULT NULL COMMENT '购物车商品状态：-9已删除/1正常/9转成正式订单',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `b_order`
-- ----------------------------
DROP TABLE IF EXISTS `b_order`;
CREATE TABLE `b_order` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '买粮订单ID',
  `o_code` varchar(15) DEFAULT NULL COMMENT '订单编码，格式:B[4位年份][2位周数][8位随机数]',
  `o_contcode` varchar(16) DEFAULT NULL COMMENT '买粮合同编码。主合同格式BC[四位年份][2位周数][8位随机数]，附加合同在后面加[_1]，[_2]...',
  `u_id` int(11) unsigned DEFAULT NULL COMMENT '对应用户ID',
  `o_pay` decimal(11,2) unsigned DEFAULT NULL COMMENT '订单货款金额',
  `o_pay_type` int(11) DEFAULT NULL COMMENT '付款方式.1 20%首付 /2 全款',
  `o_pay_f` decimal(11,2) unsigned DEFAULT NULL COMMENT '首付款金额。全款时，与货款相同。',
  `o_pay_t` decimal(11,2) unsigned DEFAULT NULL COMMENT '尾款金额。全款时，此项为0',
  `o_bsum` int(11) DEFAULT NULL COMMENT '订单包含货箱数',
  `o_nwei` int(11) DEFAULT NULL COMMENT '订单合计净重',
  `o_frei` decimal(11,2) unsigned DEFAULT NULL COMMENT '应付运费(陆运)',
  `o_frei_m` decimal(11,2) DEFAULT NULL COMMENT '应付运费(海运)',
  `o_marnum` varchar(45) DEFAULT NULL COMMENT '海运单号',
  `o_deli_type` int(11) DEFAULT NULL COMMENT '收货方式：1 平台物流到门/2 自提',
  `o_deli_add` varchar(100) DEFAULT NULL COMMENT '收货地址',
  `o_deli_cont` varchar(45) DEFAULT NULL COMMENT '收货联系人',
  `o_deli_mobi` varchar(45) DEFAULT NULL COMMENT '收货手机号',
  `o_ctime` int(11) unsigned DEFAULT NULL COMMENT '订单提交时间',
  `o_dtime` int(11) unsigned DEFAULT NULL COMMENT '审核生效时间/首付款收款确认时间',
  `o_atime` int(11) DEFAULT NULL COMMENT '到港时间',
  `o_detime` int(11) unsigned DEFAULT NULL COMMENT '滞箱期结止日期',
  `o_depay` decimal(11,2) DEFAULT NULL COMMENT '滞箱费',
  `o_rate` decimal(11,10) unsigned DEFAULT '0.0000000000' COMMENT '尾款利率',
  `o_inpay` decimal(11,2) DEFAULT NULL COMMENT '结息(已收计息)',
  `o_ttime` int(11) DEFAULT NULL COMMENT '尾款收款确认时间',
  `o_port` int(11) DEFAULT NULL COMMENT '收货港口ID',
  `o_pri1` decimal(11,2) unsigned DEFAULT '0.00' COMMENT '生成订单时单价*元/吨',
  `o_etime` int(11) unsigned DEFAULT NULL COMMENT '订单结单时间',
  `o_status` int(11) DEFAULT NULL COMMENT '订单状态: -9已删除/0待核费(陆运)/1待核费(海运)/2待付款/3待离岸/4海运中/5已到岸/6待发货7待收货/8待提货/9已收货/ 10已结单',
  `o_acid` int(11) DEFAULT '0',
  PRIMARY KEY (`o_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `b_order_item`
-- ----------------------------
DROP TABLE IF EXISTS `b_order_item`;
CREATE TABLE `b_order_item` (
  `oi_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单货组ID',
  `o_id` int(11) unsigned DEFAULT NULL COMMENT '对应订单ID，与b_order表匹配',
  `bi_id` int(11) unsigned DEFAULT NULL COMMENT '对应货组ID，与s_bill_item对应',
  `oi_dtime` varchar(45) DEFAULT NULL COMMENT '成单时间',
  `oi_dpri` decimal(11,2) DEFAULT NULL COMMENT '成交单价，取自s_bill表b_pri1数据 ',
  `oi_dpay` decimal(11,2) unsigned DEFAULT '0.00' COMMENT '成交货款金额，取自s_bill表b_pri1*[s_bill_item]bi_nwei数据 ',
  `oi_otime` int(11) unsigned DEFAULT NULL COMMENT '离岸时间',
  `oi_atime` int(11) unsigned DEFAULT NULL COMMENT '到岸时间',
  `oi_knot` decimal(11,2) unsigned DEFAULT NULL COMMENT '结息',
  `oi_status` int(1) DEFAULT NULL COMMENT '订单货品成交状态：0待出货/1海运在途/2待付尾款/3待付其他费用/4物流待发货/5待到港提货/6物流配送中/7待确认收货/8已确认收货',
  `oi_pay_t` decimal(11,2) unsigned DEFAULT NULL COMMENT '货组尾款',
  `oi_pay_t_status` tinyint(2) unsigned NOT NULL COMMENT '尾款状态0应付/1已付',
  PRIMARY KEY (`oi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='订单每车信息';

-- ----------------------------
--  Table structure for `b_order_photo`
-- ----------------------------
DROP TABLE IF EXISTS `b_order_photo`;
CREATE TABLE `b_order_photo` (
  `op_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '买粮货品其他图片',
  `o_id` int(11) DEFAULT NULL COMMENT '对应订单ID',
  `op_phopath` varchar(100) DEFAULT NULL COMMENT '图片路径',
  `op_ctime` int(11) DEFAULT NULL COMMENT '上传时间',
  `op_dtime` int(11) DEFAULT NULL COMMENT '删除时间',
  `op_status` int(1) DEFAULT NULL COMMENT '图片状态：-9删除/0屏蔽/1正常',
  PRIMARY KEY (`op_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `g_class`
-- ----------------------------
DROP TABLE IF EXISTS `g_class`;
CREATE TABLE `g_class` (
  `gc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '品类ID',
  `gc_name` varchar(45) DEFAULT NULL COMMENT '品类名称',
  PRIMARY KEY (`gc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `g_level`
-- ----------------------------
DROP TABLE IF EXISTS `g_level`;
CREATE TABLE `g_level` (
  `gl_id` int(11) NOT NULL COMMENT '等级ID',
  `gl_name` varchar(45) DEFAULT NULL COMMENT '等级名称',
  PRIMARY KEY (`gl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `g_place`
-- ----------------------------
DROP TABLE IF EXISTS `g_place`;
CREATE TABLE `g_place` (
  `gp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '产地ID',
  `gp_name` varchar(45) DEFAULT NULL COMMENT '产地名称',
  PRIMARY KEY (`gp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `g_rz`
-- ----------------------------
DROP TABLE IF EXISTS `g_rz`;
CREATE TABLE `g_rz` (
  `gr_id` int(11) NOT NULL COMMENT '容重ID',
  `gr_name` varchar(45) DEFAULT NULL COMMENT '容重名称',
  PRIMARY KEY (`gr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `g_year`
-- ----------------------------
DROP TABLE IF EXISTS `g_year`;
CREATE TABLE `g_year` (
  `gy_id` int(11) NOT NULL COMMENT '出产年份',
  PRIMARY KEY (`gy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `oms_account`
-- ----------------------------
DROP TABLE IF EXISTS `oms_account`;
CREATE TABLE `oms_account` (
  `ac_id` int(11) NOT NULL AUTO_INCREMENT,
  `ac_ln` varchar(30) DEFAULT NULL,
  `ac_ps` varchar(32) DEFAULT NULL,
  `ac_name` varchar(30) DEFAULT NULL,
  `ac_email` varchar(50) DEFAULT NULL,
  `ac_mobile` varchar(20) DEFAULT NULL,
  `ac_vcode` varchar(6) DEFAULT NULL,
  `ac_acode` varchar(32) DEFAULT NULL,
  `ac_verr` int(1) DEFAULT '0',
  `ac_op` int(1) DEFAULT '0' COMMENT '1货品专员 2交易专员 3物流专员 4海运专员 5财务专员 6客服专员 7高级客服专员 8网站专员',
  `ac_status` int(1) DEFAULT '0' COMMENT '帐号状态：-1 失效 0 正常(未登录) 1 正常(已登录)',
  `ac_log` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ac_id`),
  UNIQUE KEY `ac_ln_UNIQUE` (`ac_ln`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `oms_bill_log`
-- ----------------------------
DROP TABLE IF EXISTS `oms_bill_log`;
CREATE TABLE `oms_bill_log` (
  `bl_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '货单操作日志ID',
  `b_id` int(11) DEFAULT NULL COMMENT '货单ID',
  `bl_type` int(11) DEFAULT NULL COMMENT '日志类型：-1审核不通过 0审核通过 4运费已核 1收款确认 2装货已派单 3货组填单完成 31货组信息更新 6回款完成 7上架完成',
  `bl_time` int(11) unsigned NOT NULL COMMENT '操作时间',
  `bl_aid` int(11) DEFAULT NULL COMMENT '运营帐号ID',
  PRIMARY KEY (`bl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `oms_logi_bill`
-- ----------------------------
DROP TABLE IF EXISTS `oms_logi_bill`;
CREATE TABLE `oms_logi_bill` (
  `lb_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '卖方物流派单ID',
  `b_id` int(11) DEFAULT NULL COMMENT '卖粮货单ID',
  `lc_id` int(11) DEFAULT NULL COMMENT '物流公司ID',
  `lb_frei` decimal(11,2) DEFAULT NULL COMMENT '派单运费',
  `lb_time` int(11) DEFAULT NULL COMMENT '物流派单时间',
  `lb_status` tinyint(4) DEFAULT NULL COMMENT '派单状态：0待派单 1已派单',
  PRIMARY KEY (`lb_id`),
  UNIQUE KEY `b_id_UNIQUE` (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `oms_logi_order`
-- ----------------------------
DROP TABLE IF EXISTS `oms_logi_order`;
CREATE TABLE `oms_logi_order` (
  `lo_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '买方物流派单ID',
  `o_id` int(11) DEFAULT NULL COMMENT '买粮货单ID',
  `lc_id` int(11) DEFAULT NULL COMMENT '物流公司ID',
  `lo_frei` decimal(11,2) DEFAULT NULL COMMENT '派单运费',
  `lo_time` int(11) DEFAULT NULL COMMENT '物流派单时间',
  `lo_status` tinyint(4) DEFAULT NULL COMMENT '派单状态：0待派单 1已派单',
  PRIMARY KEY (`lo_id`),
  UNIQUE KEY `o_id_UNIQUE` (`o_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `oms_mari_order`
-- ----------------------------
DROP TABLE IF EXISTS `oms_mari_order`;
CREATE TABLE `oms_mari_order` (
  `mo_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '买方海运派单ID',
  `o_id` int(11) DEFAULT NULL COMMENT '买粮货单ID',
  `mc_id` int(11) DEFAULT NULL COMMENT '海运公司ID',
  `mo_num` varchar(45) DEFAULT NULL COMMENT '运单号',
  `mo_frei` decimal(11,2) DEFAULT NULL COMMENT '派单运费',
  `mo_time` int(11) DEFAULT NULL COMMENT '海运派单时间',
  `mo_status` tinyint(4) DEFAULT NULL COMMENT '派单状态：0待派单 1已派单',
  PRIMARY KEY (`mo_id`),
  UNIQUE KEY `o_id_UNIQUE` (`o_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `oms_order_log`
-- ----------------------------
DROP TABLE IF EXISTS `oms_order_log`;
CREATE TABLE `oms_order_log` (
  `ol_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单操作日志ID',
  `o_id` int(11) DEFAULT NULL COMMENT '订单ID',
  `ol_type` int(11) DEFAULT NULL COMMENT '日志类型：0核费完成/1确认首付款+运费',
  `ol_time` int(11) DEFAULT NULL COMMENT '操作时间',
  `ol_aid` int(11) DEFAULT NULL COMMENT '运营帐号ID',
  PRIMARY KEY (`ol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `r_offer`
-- ----------------------------
DROP TABLE IF EXISTS `r_offer`;
CREATE TABLE `r_offer` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_code` varchar(15) DEFAULT NULL COMMENT '预约编码，格式:R[4位年份][2位周数][8位随机数]',
  `f_contcode` varchar(16) DEFAULT NULL COMMENT '预约要约编码。RC[四位年份][2位周数][8位随机数]',
  `u_id` int(11) DEFAULT NULL COMMENT '对应用户ID',
  `gc_id` int(11) DEFAULT NULL COMMENT '对应货品名称ID,与b_name相关',
  `f_name` varchar(45) DEFAULT NULL COMMENT '货品名称',
  `gy_id` int(11) DEFAULT NULL COMMENT '对应年份ID,与b_year相关',
  `f_year` varchar(4) DEFAULT NULL COMMENT '出产年份',
  `gp_id` int(11) DEFAULT NULL COMMENT '对应产地ID,与b_place相关',
  `f_place` varchar(45) DEFAULT NULL COMMENT '产地',
  `gl_id` int(11) DEFAULT NULL COMMENT '对应货品等级ID,与b_level相关',
  `f_level` varchar(45) DEFAULT NULL COMMENT '等级',
  `gr_id` int(11) DEFAULT NULL COMMENT '对应容重ID,与b_rz相关',
  `f_rz` int(11) DEFAULT NULL COMMENT '容重',
  `f_pric` decimal(11,2) DEFAULT NULL COMMENT '预约单价',
  `f_weig` int(11) DEFAULT NULL COMMENT '预约重量',
  `f_pay` decimal(11,2) DEFAULT NULL COMMENT '预约金',
  `f_ctime` int(11) unsigned DEFAULT NULL COMMENT '预约提交时间',
  `f_dtime` int(11) unsigned DEFAULT NULL COMMENT '成交时间',
  `f_status` int(1) DEFAULT NULL COMMENT '预约单状态, -9删除/0待审核/1预约确认/10已转正式订单',
  `f_service_price` decimal(11,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '服务费',
  `o_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '订单id',
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `s_bill`
-- ----------------------------
DROP TABLE IF EXISTS `s_bill`;
CREATE TABLE `s_bill` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '卖粮货单ID',
  `b_code` varchar(15) CHARACTER SET utf8 DEFAULT NULL COMMENT '卖粮货单编码，格式：S[4位年份][2位周数][8位随机数]',
  `b_concode` varchar(16) CHARACTER SET utf8 DEFAULT NULL COMMENT '卖粮合同编码。主合同格式SC[四位年份][2位周数][8位随机数]，附加合同在后面加[_1]，[_2]...',
  `u_id` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `b_photo` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '货品近照图片地址',
  `gc_id` int(11) DEFAULT NULL COMMENT '对应货品名称ID,与b_name相关',
  `b_name` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT '货品名称',
  `gy_id` int(11) DEFAULT NULL COMMENT '对应年份ID,与b_year相关',
  `b_year` varchar(4) CHARACTER SET utf8 DEFAULT NULL COMMENT '出产年份',
  `gp_id` int(11) DEFAULT NULL COMMENT '对应产地ID,与b_place相关',
  `b_place` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT '产地',
  `gl_id` int(11) DEFAULT NULL COMMENT '对应货品等级ID,与b_level相关',
  `b_level` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT '等级',
  `gr_id` int(11) DEFAULT NULL COMMENT '对应容重ID,与b_rz相关',
  `b_rz` int(11) DEFAULT NULL COMMENT '容重',
  `b_mb` decimal(10,1) DEFAULT NULL COMMENT '霉变',
  `b_sf` decimal(10,1) DEFAULT NULL COMMENT '水份',
  `b_zz` decimal(10,1) DEFAULT NULL COMMENT '杂质',
  `b_ot` int(11) DEFAULT NULL COMMENT '呕吐毒素',
  `b_pri0` decimal(10,2) DEFAULT NULL COMMENT '提交订单时出售单价',
  `b_pri1` decimal(10,2) DEFAULT NULL COMMENT '当前出售单价',
  `b_weig` int(11) DEFAULT NULL COMMENT '出售重量',
  `b_nwei` varchar(45) COLLATE utf8_danish_ci DEFAULT NULL COMMENT '过磅净重合计（实际出售重量）',
  `b_frei` decimal(11,2) DEFAULT NULL COMMENT '应付运费',
  `b_depo` decimal(10,2) DEFAULT NULL COMMENT '应缴保证金',
  `b_rpay` decimal(10,2) DEFAULT NULL COMMENT '回款金额',
  `b_rtime` int(11) DEFAULT NULL COMMENT '回款时间',
  `b_add` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT '装货地址',
  `b_cont` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT '联系人',
  `b_mobi` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT '手机',
  `b_ctime` int(11) unsigned DEFAULT NULL COMMENT '提交时间',
  `b_stime` int(11) unsigned DEFAULT NULL COMMENT '上架时间',
  `b_etime` int(11) unsigned DEFAULT NULL COMMENT '结单时间',
  `b_status` int(2) DEFAULT NULL COMMENT '货单状态: -9删除/-1被退回/0待审核/4待核费/1待付款/2待装货/3待填单/6待回款/7待上架/5在售/9已成交/10已结单',
  `b_rrate` decimal(10,10) unsigned DEFAULT NULL COMMENT '货单回款利率',
  `b_port` int(1) DEFAULT NULL COMMENT '货物待进入港口ID，匹配bas_port表',
  `b_acid` int(11) DEFAULT NULL COMMENT '运营操作ID，此字段只对运营后台生效。大于0时，说明该数据被所对应ID运营人员管理操作，其他人员无法操作。为0时，操作已释放，可操作；',
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- ----------------------------
--  Table structure for `s_bill_item`
-- ----------------------------
DROP TABLE IF EXISTS `s_bill_item`;
CREATE TABLE `s_bill_item` (
  `bi_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '卖粮货组ID',
  `b_id` int(11) DEFAULT NULL COMMENT '卖粮货单ID 按此ID匹配货单',
  `bi_cnum1` varchar(45) DEFAULT NULL COMMENT '箱号1',
  `bi_cnum1_pho` varchar(45) DEFAULT NULL COMMENT '箱号1照片地址',
  `bi_snum1` varchar(45) DEFAULT NULL COMMENT '封号1',
  `bi_snum1_pho` varchar(45) DEFAULT NULL COMMENT '封号1照片',
  `bi_video1` varchar(45) DEFAULT NULL,
  `bi_cnum2` varchar(45) DEFAULT NULL COMMENT '箱号2',
  `bi_cnum2_pho` varchar(45) DEFAULT NULL COMMENT '箱号2照片',
  `bi_snum2` varchar(45) DEFAULT NULL COMMENT '封号2',
  `bi_snum2_pho` varchar(45) DEFAULT NULL COMMENT '封号2照片',
  `bi_video2` varchar(45) DEFAULT NULL,
  `bi_plist_num` varchar(45) DEFAULT NULL COMMENT '磅单号',
  `bi_plist_pho` varchar(45) DEFAULT NULL COMMENT '磅单照片',
  `bi_num` varchar(45) DEFAULT NULL COMMENT '装货车号，非必填，可能为车牌号，可能为自行编码号。',
  `bi_sum` int(1) DEFAULT NULL COMMENT '封箱数量',
  `bi_gwei` decimal(11,2) DEFAULT NULL COMMENT '毛重',
  `bi_tare` decimal(11,2) DEFAULT NULL COMMENT '皮重',
  `bi_nwei` decimal(11,2) DEFAULT NULL COMMENT '净重',
  `bi_itime` int(11) DEFAULT NULL COMMENT '入港时间',
  `bi_port` int(11) DEFAULT NULL COMMENT '港口名称',
  `bi_stime` int(11) DEFAULT NULL COMMENT '上架销售时间',
  `bi_dtime` int(11) DEFAULT NULL COMMENT '成交时间',
  `bi_dpri` decimal(11,2) DEFAULT NULL COMMENT '成交单价，取自s_bill表b_pri1数据',
  `bi_dpay` decimal(11,2) unsigned DEFAULT NULL COMMENT '成交货款金额，取自s_bill表b_pri1*bi_nwei数据',
  `bi_diff` decimal(11,2) DEFAULT NULL COMMENT '价格变动货款差额.负数为补跌价，正数为退溢价。调整 价格时，重新计算此项并更新。',
  `bi_inte` decimal(11,2) DEFAULT NULL COMMENT '在售状态时，为计息，用户每次打开页面，则重新计算利息(bi_rpay*日利率*(天数))，并更新此项数据。成交时(管理后台审核时处理)最后更新此数据。成交状态，为结息，用户打开页面，数据项不发生变化。',
  `bi_status` int(1) DEFAULT NULL COMMENT '货组状态: -9删除/0待审核/1已封箱/2物流运送中/3货物已入港/5在售/6买家已下单/7已成交/8待付利息及其他/9已结算/  注：实际操作中，0/1不具实际意义(添加数据时，即已封箱，并且开始运输)；',
  `bi_depo_status` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '保证金状态0未付/1已付/2已退',
  `bi_acid` int(11) DEFAULT NULL COMMENT '操作数据 运营人员ID',
  PRIMARY KEY (`bi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `s_bill_photo`
-- ----------------------------
DROP TABLE IF EXISTS `s_bill_photo`;
CREATE TABLE `s_bill_photo` (
  `bp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '货品其他图片ID',
  `b_id` int(11) DEFAULT NULL COMMENT '货单ID，与s_bill表匹配',
  `bp_phopath` varchar(100) DEFAULT NULL COMMENT '货品其他图片ID',
  `bp_ctime` int(11) DEFAULT NULL COMMENT '图片上传时间',
  `bp_dtime` int(11) DEFAULT NULL COMMENT '删除时间',
  `bp_status` int(1) DEFAULT NULL COMMENT '图片状态：-9删除/0屏蔽/1正常',
  PRIMARY KEY (`bp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `s_bill_pric`
-- ----------------------------
DROP TABLE IF EXISTS `s_bill_pric`;
CREATE TABLE `s_bill_pric` (
  `bp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '价格变动ID',
  `b_id` int(11) DEFAULT NULL COMMENT '货单ID，凭此与表c_s_bill匹配',
  `bp_price` decimal(11,2) DEFAULT NULL COMMENT '最新变动价格',
  `bp_ctime` int(11) DEFAULT NULL COMMENT '价格变动提交时间',
  PRIMARY KEY (`bp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `s_bill_video`
-- ----------------------------
DROP TABLE IF EXISTS `s_bill_video`;
CREATE TABLE `s_bill_video` (
  `bv_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '货品视频 ID',
  `b_id` int(11) DEFAULT NULL COMMENT '货单ID，与s_bill表匹配',
  `bv_vidpath` varchar(100) DEFAULT NULL COMMENT '视频路径',
  `bv_ctime` int(11) DEFAULT NULL COMMENT '视频上传时间',
  `bv_dtime` int(11) DEFAULT NULL COMMENT '删除时间',
  `bv_status` int(1) DEFAULT NULL COMMENT '视频状态：-9删除/0屏蔽/1正常',
  PRIMARY KEY (`bv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `sms_log`
-- ----------------------------
DROP TABLE IF EXISTS `sms_log`;
CREATE TABLE `sms_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `message` varchar(125) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '发送信息',
  `mobile` varchar(50) DEFAULT NULL COMMENT '用户电话',
  `code` int(11) DEFAULT '0' COMMENT '验证码',
  `ctime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='短信日志';

-- ----------------------------
--  Table structure for `sys_logi_co`
-- ----------------------------
DROP TABLE IF EXISTS `sys_logi_co`;
CREATE TABLE `sys_logi_co` (
  `lc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '物流公司ID',
  `lc_name` varchar(45) DEFAULT NULL COMMENT '公司名称',
  `lc_cont` varchar(45) DEFAULT NULL COMMENT '联系人',
  `lc_mobi` varchar(45) DEFAULT NULL COMMENT '联系手机',
  `lc_status` tinyint(1) DEFAULT NULL COMMENT '公司状态：0停用 1正常',
  `lc_desc` varchar(45) DEFAULT NULL COMMENT '公司描述',
  PRIMARY KEY (`lc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `sys_mari_co`
-- ----------------------------
DROP TABLE IF EXISTS `sys_mari_co`;
CREATE TABLE `sys_mari_co` (
  `mc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '海运公司ID',
  `mc_name` varchar(45) DEFAULT NULL COMMENT '公司名称',
  `mc_cont` varchar(45) DEFAULT NULL COMMENT '联系人',
  `mc_mobi` varchar(45) DEFAULT NULL COMMENT '联系手机',
  `mc_status` tinyint(1) DEFAULT NULL COMMENT '公司状态：0停用 1正常',
  `mc_desc` varchar(45) DEFAULT NULL COMMENT '公司描述',
  PRIMARY KEY (`mc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `sys_mari_frei`
-- ----------------------------
DROP TABLE IF EXISTS `sys_mari_frei`;
CREATE TABLE `sys_mari_frei` (
  `port0` int(11) NOT NULL COMMENT '出发港ID',
  `port1` int(11) DEFAULT NULL COMMENT '到达港ID',
  `frei` decimal(11,2) DEFAULT NULL COMMENT '运费',
  `utime` int(11) DEFAULT NULL COMMENT '更新时间',
  `acid` varchar(45) DEFAULT NULL COMMENT '更新运营人员ID',
  PRIMARY KEY (`port0`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `sys_msg`
-- ----------------------------
DROP TABLE IF EXISTS `sys_msg`;
CREATE TABLE `sys_msg` (
  `sm_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '系统通知ID',
  `sm_content` varchar(500) DEFAULT NULL COMMENT '系统通知内容',
  `sm_status` int(1) DEFAULT '0' COMMENT '系统通知状态：-9删除/0未读/1已读',
  `u_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `sm_type` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '系统通知类型：0买粮订单 1预购约单 2卖粮货单',
  `sm_rid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '资源id',
  `sm_ctime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`sm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `sys_port`
-- ----------------------------
DROP TABLE IF EXISTS `sys_port`;
CREATE TABLE `sys_port` (
  `bp_id` int(11) NOT NULL AUTO_INCREMENT,
  `bp_name` varchar(45) DEFAULT NULL,
  `bp_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`bp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `sys_user`
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `real_name` varchar(125) DEFAULT '' COMMENT '用户名字',
  `mobile` varchar(50) DEFAULT '' COMMENT '用户电话',
  `password` varchar(50) DEFAULT '' COMMENT '用户密码',
  `img` text COMMENT '营业执照',
  `company_name` varchar(225) DEFAULT '' COMMENT '公司名称',
  `province` varchar(225) DEFAULT NULL COMMENT '省',
  `city` varchar(225) DEFAULT NULL COMMENT '市',
  `area` varchar(225) DEFAULT NULL COMMENT '区',
  `address` varchar(225) DEFAULT NULL COMMENT '详细地址',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '用户状态 0待审核,1审核通过 ',
  `bank_name` varchar(45) DEFAULT NULL,
  `bank_account` varchar(45) DEFAULT NULL,
  `bank_payee` varchar(45) DEFAULT NULL,
  `port_id` int(1) DEFAULT NULL COMMENT '对应港口ID号',
  `frei_bs` decimal(11,2) DEFAULT NULL COMMENT '基准运费',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='用户表';

SET FOREIGN_KEY_CHECKS = 1;
