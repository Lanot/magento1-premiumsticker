<?php
/**
 * Private Entrepreneur Anatolii Lehkyi (aka Lanot)
 *
 * @category    Lanot
 * @package     Lanot_EasySticker
 * @copyright   Copyright (c) 2010 Anatolii Lehkyi
 * @license     http://opensource.org/licenses/osl-3.0.php
 * @link        http://www.lanot.biz/
 */

/* @var $this Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */
$this->startSetup();

/** @var $helper Lanot_EasySticker_Helper_Data */
$helper = Mage::helper('lanot_easysticker');

//tables definition
$stickerTable = $this->getTable('lanot_easysticker/sticker');
$stickerProductTable = $this->getTable('lanot_easysticker/sticker_product');
$productTable = $this->getTable('catalog/product');


//create table for sticker
$this->run("
	DROP TABLE IF EXISTS `{$stickerTable}`;
	CREATE TABLE `{$stickerTable}` (
	    `sticker_id`   int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Sticker ID',
	    `is_active`  tinyint DEFAULT 0,
	    `title`      varchar(255) DEFAULT NULL,
        `image`      varchar(255) DEFAULT NULL,
        `position`   varchar(32),
		`created_at` timestamp NULL DEFAULT NULL COMMENT 'Creation Time',
  		`updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Update Time',
		PRIMARY KEY (`sticker_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stickers Entity Table';
");

//create new columns
foreach($helper->getAttributes() as $attributeCode) {
    $this->run("ALTER TABLE `{$stickerTable}` ADD `scale_{$attributeCode}` SMALLINT DEFAULT NULL AFTER `position`");
}

//create table for sticker
$this->run("
	DROP TABLE IF EXISTS `{$stickerProductTable}`;
	CREATE TABLE `{$stickerProductTable}` (
	    `product_id`   int(10) unsigned NOT NULL COMMENT 'Product ID',
	    `sticker_id`   int(10) unsigned NOT NULL COMMENT 'Sticker ID',
		PRIMARY KEY (`product_id`, `sticker_id`),
  		CONSTRAINT `FK_STICKER_PRODUCT_ID_CATALOG_PRODUCT_ENTITY_ID` FOREIGN KEY (`product_id`) REFERENCES `{$productTable}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  		CONSTRAINT `FK_STICKER_STICKER_ID_STICKER_STICKER_ID` FOREIGN KEY (`sticker_id`) REFERENCES `{$stickerTable}` (`sticker_id`) ON DELETE CASCADE ON UPDATE CASCADE
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stickers To Products Table';
");

$this->endSetup();