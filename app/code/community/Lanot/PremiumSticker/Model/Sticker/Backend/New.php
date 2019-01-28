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

class Lanot_PremiumSticker_Model_Sticker_Backend_New
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

        if(!$product->getData('news_from_date') && !$product->getData('news_to_date')) {
            return false;
        }

        $currentDate = new DateTime($product->getResource()->formatDate(date('Y-m-d')));
        $fromDate = new DateTime($product->getData('news_from_date'));
        $toDate = new DateTime($product->getData('news_to_date'));

        return (
            (!$product->getData('news_from_date') || ($currentDate >= $fromDate)) &&
            (!$product->getData('news_to_date') || ($currentDate <= $toDate))
        );
    }
}
