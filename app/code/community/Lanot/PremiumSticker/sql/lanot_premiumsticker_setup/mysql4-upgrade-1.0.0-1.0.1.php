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
/** @var $helper Lanot_PremiumSticker_Helper_Data */
$helper = Mage::helper('lanot_premiumsticker');

//tables definition
$premiumStickerTable = $this->getTable('lanot_premiumsticker/sticker');
$easyStickerTable = $this->getTable('lanot_easysticker/sticker');

$premiumStickerProductTable = $this->getTable('lanot_premiumsticker/sticker_product');
$easyStickerProductTable = $this->getTable('lanot_easysticker/sticker_product');

$productTable = $this->getTable('catalog/product');
$websiteTable = $this->getTable('core/website');
$customerGroupTable = $this->getTable('customer/customer_group');

$websiteIds = Mage::getModel('core/website')->getCollection()
    ->addFieldToFilter('website_id', array('gt' => 0))
    ->getAllIds();

$customerGroupIds = Mage::getModel('customer/group')->getCollection()
    ->getAllIds();

$websiteIds = implode(',', $websiteIds);
$customerGroupIds = implode(',', $customerGroupIds);

$this->startSetup();

//create new columns
$cols = array();
foreach ($helper->getAttributes() as $attributeCode) {
    $cols[] = 'scale_' . $attributeCode;
}
//populate tables by old data
$sizes = implode('`,`', $cols);

//populate stickers table
$this->run("
INSERT INTO `{$premiumStickerTable}`
    (`sticker_id`, `is_active`, `title`, `image`, `position`, `{$sizes}`, `created_at`, `updated_at`, `website_ids`, `customer_group_ids`)
SELECT `sticker_id`, `is_active`, `title`, `image`, `position`, `{$sizes}`,  `created_at`, `updated_at`,
    '{$websiteIds}' as website_ids, '{$customerGroupIds}' as customer_group_ids
FROM `{$easyStickerTable}`
");

//populate sticker products table
$this->run("
INSERT INTO `{$premiumStickerProductTable}` (`product_id`, `sticker_id`, `website_id`, `customer_group_id`)
SELECT
    `sp`.`product_id`,
    `sp`.`sticker_id`,
    `cw`.`website_id`,
    `cg`.`customer_group_id`
FROM
    `{$easyStickerProductTable}` as `sp`
    INNER JOIN `{$websiteTable}` as `cw`
    INNER JOIN `{$customerGroupTable}` as `cg`
");

$this->endSetup();
