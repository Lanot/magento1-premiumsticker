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

interface Lanot_PremiumSticker_Model_Sticker_Backend_Interface
{
    /**
     * @param Mage_Catalog_Model_Product $product
     * @param Lanot_PremiumSticker_Model_Sticker $sticker
     * @return bool
     */
    public function isMatched($product, $sticker);
}
