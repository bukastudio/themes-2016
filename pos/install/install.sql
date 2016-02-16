CREATE TABLE IF NOT EXISTS `oc_cart_holder` (
  `cart_holder_id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cart` text NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`cart_holder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;\n


CREATE TABLE IF NOT EXISTS `oc_pos_withdraw` (
  `pos_withdraw_id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`pos_withdraw_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;\n


INSERT INTO `oc_setting` (
`setting_id` ,
`store_id` ,
`group` ,
`key` ,
`value` ,
`serialized`
)
VALUES (
NULL , '0', 'pos', 'pos_user_group_id', '1', '0'
);\n


INSERT INTO `oc_setting` (
`setting_id` ,
`store_id` ,
`group` ,
`key` ,
`value` ,
`serialized`
)
VALUES (
NULL , '0', 'config', 'pos_status', '1', '0'
);\n

ALTER TABLE `oc_user` ADD `cash` decimal(10,2) NOT NULL DEFAULT '0.000' AFTER `ip` ;\n

ALTER TABLE `oc_user` ADD `card` decimal(10,2) NOT NULL DEFAULT '0.000' AFTER `ip` ;\n
