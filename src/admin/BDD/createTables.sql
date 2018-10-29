-- maj des tables implique suppression des tables

DROP TABLE IF EXISTS `site_tmpValidate`;
DROP TABLE IF EXISTS `site_messages`;
DROP TABLE IF EXISTS `site_users`;

-- DROP TABLE IF EXISTS `ma_table`;
DROP TABLE IF EXISTS `HaAOtherWorlds`;
DROP TABLE IF EXISTS `HaAOtherWorldsColor`;
DROP TABLE IF EXISTS `HaACityLimits`;
DROP TABLE IF EXISTS `HaATerrorScale`;
DROP TABLE IF EXISTS `HaADistrictLink`;
DROP TABLE IF EXISTS `HaADistrictLinkColor`;
DROP TABLE IF EXISTS `HaADistrict`;
DROP TABLE IF EXISTS `HaADistrictColor`;
DROP TABLE IF EXISTS `HaADistrictPlace`;
DROP TABLE IF EXISTS `HaAPlaceLogoEffect`;

DROP VIEW IF EXISTS HaATerrorScale_TS_color_length;

-- tables de gestion utilisateur

create table if not exists `site_users` (
    `us_id` INT UNIQUE NOT NULL AUTO_INCREMENT, 
    `us_pseudo` VARCHAR(30) UNIQUE NOT NULL,  
    `us_mail` VARCHAR(60) UNIQUE NOT NULL,  
    `us_password` VARCHAR(255) NOT NULL, 
    `us_regDate` DATETIME NOT NULL, 
    `us_status` INT NOT NULL,
    `us_picture` VARCHAR(30),
    `us_nb_msg` INT NOT NULL,
    PRIMARY KEY (`us_id`)
    )ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_bin;

create table if not exists `site_tmpValidate` (
    `val_pseudo` VARCHAR(30) UNIQUE NOT NULL,   
    `val_password` VARCHAR(255) NOT NULL, 
    `val_regDate` DATETIME NOT NULL, 
    `val_mail` VARCHAR(60) UNIQUE NOT NULL, 
    `val_validate` VARCHAR(255) NOT NULL, 
    PRIMARY KEY (`val_mail`) 
    )ENGINE=INNODB;

create table if not exists `site_messages` (
    `msg_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
    `msg_user_id` INT NOT NULL, 
    `msg_ValidateDate` DATETIME NOT NULL, 
    `msg_msg` VARCHAR(3000) NOT NULL, 
    PRIMARY KEY (`msg_id`),  
    CONSTRAINT fk_msg_user_id FOREIGN KEY (`msg_user_id`) REFERENCES site_users(`us_id`) 
    ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=INNODB;
    
    
    
-- tables du jeu

-- petits logos monochromes en bas a gauche et à droite de l'image de chaque lieu
create table if not exists `HaAPlaceLogoEffect` (
    `PLE_name`VARCHAR(30) NOT NULL,
    `PLE_file_name`VARCHAR(30) NOT NULL,
    PRIMARY KEY (`PLE_name`)
    )ENGINE=INNODB;

-- lieux dans les quartiers
create table if not exists `HaADistrictPlace` (
    `DP_id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `DP_name` VARCHAR(30) NOT NULL,
    `DP_description_action` VARCHAR(30) NOT NULL,
    `DP_description` VARCHAR(500) NOT NULL,
    `DP_image` VARCHAR(255) NOT NULL,
    `DP_logo_1` VARCHAR(255) NOT NULL,
    `DP_logo_2` VARCHAR(255) NOT NULL,
    `DP_stable` BOOL NOT NULL, -- 0 false, > 0 true
    PRIMARY KEY (`DP_id`),
    CONSTRAINT fk_dp_logo_1 FOREIGN KEY (`DP_logo_1`) REFERENCES HaAPlaceLogoEffect(`PLE_name`),
    CONSTRAINT fk_dp_logo_2 FOREIGN KEY (`DP_logo_2`) REFERENCES HaAPlaceLogoEffect(`PLE_name`)
    ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=INNODB;

-- couleurs de quartiers possibles 
-- pour éviter les enums et ainsi m'assurer l'évolutivité de la map
create table if not exists `HaADistrictColor` (
    `DC_name`VARCHAR(30) NOT NULL,
    PRIMARY KEY (`DC_name`)
    )ENGINE=INNODB;

-- quartiers
create table if not exists `HaADistrict` (
    `D_id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `D_name` VARCHAR(30) NOT NULL,
    `D_color` VARCHAR(30) NOT NULL, 
    `D_place_1` TINYINT UNSIGNED NOT NULL,
    `D_place_2` TINYINT UNSIGNED NOT NULL,
    `D_place_3` TINYINT UNSIGNED, -- null signifie vide
    PRIMARY KEY (`D_id`),
    CONSTRAINT fk_d_color FOREIGN KEY (`D_color`) REFERENCES HaADistrictColor(`DC_name`),
    CONSTRAINT fk_d_place_1 FOREIGN KEY (`D_place_1`) REFERENCES HaADistrictPlace(`DP_id`),
    CONSTRAINT fk_d_place_2 FOREIGN KEY (`D_place_2`) REFERENCES HaADistrictPlace(`DP_id`),
    CONSTRAINT fk_d_place_3 FOREIGN KEY (`D_place_3`) REFERENCES HaADistrictPlace(`DP_id`)
    ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=INNODB;

-- couleur des flèches entre les quartiers
-- pour éviter les enums et ainsi m'assurer l'évolutivité de la map
create table if not exists `HaADistrictLinkColor` (
    `DLC_name` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`DLC_name`)
    )ENGINE=INNODB;

-- liaisons entre les quartiers
create table if not exists `HaADistrictLink` (
    `DL_id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `DL_district_1` TINYINT UNSIGNED NOT NULL,
    `DL_district_2` TINYINT UNSIGNED NOT NULL,
    `DL_color_1_2` VARCHAR(30) NOT NULL,
    `DL_color_2_1` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`DL_id`),
    CONSTRAINT fk_dl_color_1_2 FOREIGN KEY (`DL_color_1_2`) REFERENCES HaADistrictLinkColor(`DLC_name`),
    CONSTRAINT fk_dl_color_2_1 FOREIGN KEY (`DL_color_2_1`) REFERENCES HaADistrictLinkColor(`DLC_name`),
    CONSTRAINT fk_dl_district_1 FOREIGN KEY (`DL_district_1`) REFERENCES HaADistrict(`D_id`),
    CONSTRAINT fk_dl_district_2 FOREIGN KEY (`DL_district_2`) REFERENCES HaADistrict(`D_id`)
    ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=INNODB;

-- échelle de terreur
create table if not exists `HaATerrorScale` (
    `TS_id` TINYINT UNSIGNED NOT NULL,
    `TS_color` VARCHAR(9), -- 3 caractères par couleur en RGB
    `TS_function` VARCHAR(30),
    PRIMARY KEY (`TS_id`)
    )ENGINE=INNODB;

-- limites de la ville
create table if not exists `HaACityLimits` (
    `CL_name` VARCHAR(30) NOT NULL,
    `CL_image` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`CL_name`)
    )ENGINE=INNODB;

-- couleurs valides Autres Mondes
create table if not exists `HaAOtherWorldsColor` (
    `OWC_id` TINYINT UNSIGNED NOT NULL,
    `OWC_name` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`OWC_id`)
    )ENGINE=INNODB;

-- Autres Mondes
create table if not exists `HaAOtherWorlds` (
    `OW_id` TINYINT UNSIGNED NOT NULL,
    `OW_name` VARCHAR(30) NOT NULL,
    `OW_image_1` VARCHAR(30) NOT NULL,
    `OW_image_2` VARCHAR(30) NOT NULL,
    `OW_color_1` TINYINT UNSIGNED NOT NULL,
    `OW_color_2` TINYINT UNSIGNED NOT NULL,
    `OW_color_3` TINYINT UNSIGNED,
    `OW_color_4` TINYINT UNSIGNED,
    PRIMARY KEY (`OW_id`),
    CONSTRAINT fk_ow_color_1 FOREIGN KEY (`OW_color_1`) REFERENCES HaAOtherWorldsColor(`OWC_id`),
    CONSTRAINT fk_ow_color_2 FOREIGN KEY (`OW_color_2`) REFERENCES HaAOtherWorldsColor(`OWC_id`),
    CONSTRAINT fk_ow_color_3 FOREIGN KEY (`OW_color_3`) REFERENCES HaAOtherWorldsColor(`OWC_id`),
    CONSTRAINT fk_ow_color_4 FOREIGN KEY (`OW_color_4`) REFERENCES HaAOtherWorldsColor(`OWC_id`)
    )ENGINE=INNODB;