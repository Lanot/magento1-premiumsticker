<?php
/**
 * Private Entrepreneur Anatolii Lehkyi (aka Lanot)
 *
 * @category    Lanot
 * @package     Lanot_PremiumSticker
 * @copyright   Copyright (c) 2010 Anatolii Lehkyi
 * @license     http://opensource.org/licenses/osl-3.0.php
 * @link        http://www.lanot.biz/
 */

/** @var $this Mage_Core_Model_Resource_Setup */

//tables definition
$premiumStickerTable = $this->getTable('lanot_premiumsticker/sticker');

$this->startSetup();

$this->run("ALTER TABLE `{$premiumStickerTable}` ADD `type` SMALLINT DEFAULT 0 AFTER `is_active`");
$this->run("ALTER TABLE `{$premiumStickerTable}` ADD `backend_model` VARCHAR(64) DEFAULT NULL");

$this->endSetup();
