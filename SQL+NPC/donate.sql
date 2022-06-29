CREATE TABLE `donate` (
`id` INT( 6 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
`userid` VARCHAR( 23 ) NOT NULL ,
`account_id` INT( 11 ) NOT NULL ,
`amount` INT( 4 ) UNSIGNED NOT NULL ,
`status` TINYINT( 1 ) UNSIGNED NOT NULL ,
`added_time` DATETIME NOT NULL ,
`claim_time` DATETIME NOT NULL ,
`referenceNo` VARCHAR( 15 ) NOT NULL ,
`gbpReferenceNo` VARCHAR( 250 ) NOT NULL ,
PRIMARY KEY ( `id` ) 
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `donate` ADD INDEX ( `account_id` );