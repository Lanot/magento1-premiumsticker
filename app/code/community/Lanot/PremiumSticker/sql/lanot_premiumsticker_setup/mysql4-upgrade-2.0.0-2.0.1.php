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

/** @var $helper Lanot_PremiumSticker_Helper_Data */
$helper = Mage::helper('lanot_premiumsticker');

//prepare standard data for dynamic sticker
$item = array(
    'is_active'          => Lanot_PremiumSticker_Model_Sticker::STATUS_ENABLED,
    'type'               => Lanot_PremiumSticker_Model_Sticker::TYPE_DYNAMIC,
);

//prepare sizes
foreach ($helper->getAttributes() as $attributeCode) {
    $item['scale_' . $attributeCode] = '45';//45%
}

// Set up data rows
$dataRows = array(
    array(
        'title'         => 'Sticker For New Products',
        'image'         => '/d/y/dynamic_label_new.png',
        'position'      => 'top-left',
        'backend_model' => 'lanot_premiumsticker/sticker_backend_new',
    ),
    array(
        'title'         => 'Sticker For Products on Sale (with special price)',
        'image'         => '/d/y/dynamic_label_sale.png',
        'position'      => 'top-right',
        'backend_model' => 'lanot_premiumsticker/sticker_backend_sale',
    ),
    array(
        'title'         => 'Sticker For Sold Products (is not salable)',
        'image'         => '/d/y/dynamic_label_sold.png',
        'position'      => 'bottom-right',
        'backend_model' => 'lanot_premiumsticker/sticker_backend_sold',
    ),
);

/** @var $model Lanot_PremiumSticker_Model_Sticker */
$model = Mage::getModel('lanot_easysticker/sticker');

//save dynamic stickers to a database
foreach ($dataRows as $data) {
    $data = array_merge($data, $item);
    $model->setData($data)->setOrigData()->save();
}
