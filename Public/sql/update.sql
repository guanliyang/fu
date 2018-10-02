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