USE sondages;

ALTER TABLE `sondages`.`user` CHANGE COLUMN `password` `password` VARCHAR(128) NOT NULL  ;
