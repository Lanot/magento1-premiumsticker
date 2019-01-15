<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Lanot
 * @package     Lanot_PremiumSticker
 * @copyright   Copyright (c) 2012 Lanot
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Lanot_PremiumSticker_Model_Sticker_Backend_Sale
implements Lanot_PremiumSticker_Model_Sticker_Backend_Interface
{
    /**
     * @param Mage_Catalog_Model_Product $product
     * @param Lanot_PremiumSticker_Model_Sticker $sticker
     * @return bool
     */
    public function isMatched($product, $sticker)
    {
        if (!$product->isSalable()) {
            return false;
        }
        return ($product->getPrice() > $product->getFinalPrice());
    }
}