USE sondages;

ALTER TABLE `sondages`.`user` CHANGE COLUMN `password` `password` VARCHAR(128) NOT NULL  ;

ALTER TABLE `sondages`.`reponse` CHANGE COLUMN `uid_repondant` `uid_repondant` VARCHAR(255) NOT NULL  ;
