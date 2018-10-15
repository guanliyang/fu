-- 地区限制
update local_area set level=-1 where id in
(
(select id from (SELECT id from local_area where level=1) a)
);
update local_area set level=1 where id in (464,579);
update local_area set parentId=-2 where id in (591,621,628,634,640);

-- 产地和装货地址
ALTER TABLE `s_bill` ADD COLUMN `c_province_id` int(11) unsigned DEFAULT '0' COMMENT '产地省份id';
ALTER TABLE `s_bill` ADD COLUMN `c_city_id` int(11) unsigned DEFAULT '0' COMMENT '产地市id';
ALTER TABLE `s_bill` ADD COLUMN `c_area_id` int(11) unsigned DEFAULT '0' COMMENT '产地区id';

ALTER TABLE `s_bill` ADD COLUMN `z_province_id` int(11) unsigned DEFAULT '0' COMMENT '装货省份id';
ALTER TABLE `s_bill` ADD COLUMN `z_city_id` int(11) unsigned DEFAULT '0' COMMENT '装货市id';
ALTER TABLE `s_bill` ADD COLUMN `z_area_id` int(11) unsigned DEFAULT '0' COMMENT '装货区id';

ALTER TABLE `r_offer` ADD COLUMN `c_province_id` int(11) unsigned DEFAULT '0' COMMENT '产地省份id';
ALTER TABLE `r_offer` ADD COLUMN `c_city_id` int(11) unsigned DEFAULT '0' COMMENT '产地市id';
ALTER TABLE `r_offer` ADD COLUMN `c_area_id` int(11) unsigned DEFAULT '0' COMMENT '产地区id';

-- 用户等级
ALTER TABLE `sys_user` ADD COLUMN `ul_id` int(11) DEFAULT '10' COMMENT '用户级别id';

-- 粮食等级
insert into g_level set gl_name='二等',gl_id=2;

-- 地区呕吐
alter table `local_area` add COLUMN `val_ot` int(11) DEFAULT NULL;

-- 自动脚本
alter table `b_order_item` add column   `oi_status` int(11) unsigned DEFAULT '0' COMMENT '对应货组状态，1已卸货 2已收货';

alter table `b_order_item` add column  `oi_artime` int(11) unsigned DEFAULT NULL COMMENT '最晚确认收货时间（物流运营点击确认到货/确认已自提时，更新此数据字段当前时间+全局变量确认收货时间）/客户端 用点击击“确认收货”按钮时，更新此数据字段为点击时时间/系统自动脚本运行，根据此数据荐更新状态为2 已收货';