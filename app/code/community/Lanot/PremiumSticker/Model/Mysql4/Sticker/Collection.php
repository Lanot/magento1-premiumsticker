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

/**
 * Stickers collection
 *
 * @author Lanot
 */
class Lanot_PremiumSticker_Model_Mysql4_Sticker_Collection
extends Lanot_EasySticker_Model_Mysql4_Sticker_Collection
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('lanot_premiumsticker/sticker');
    }

    /**
     * @return string
     */
    protected function _getLinkTable()
    {
        return $this->getTable('lanot_premiumsticker/sticker_product');
    }

    /**
     * @return string
     */
    protected function _getStoreImageTable()
    {
        return $this->getTable('lanot_premiumsticker/sticker_image');
    }

    /**
     * @param $productIds
     * @param $websiteId
     * @param $customerGroupId
     * @param $time
     * @return Lanot_PremiumSticker_Model_Mysql4_Sticker_Collection
     */
    public function addFilters($productIds, $websiteId, $customerGroupId, $time)
    {
        if (!is_array($productIds)) {
            $productIds = array((int) $productIds);
        }

        $cond = array();
        $cond[] = 'main_table.sticker_id=ps.sticker_id';
        $cond[] = $this->getConnection()->quoteInto('ps.product_id IN (?)', $productIds);
        $cond[] = $this->getConnection()->quoteInto('ps.website_id = ?', $websiteId);
        $cond[] = $this->getConnection()->quoteInto('ps.customer_group_id = ?', $customerGroupId);
        $cond[] = $this->getConnection()->quoteInto('(ps.from_time <= ? OR ps.from_time = 0)', $time);
        $cond[] = $this->getConnection()->quoteInto('(ps.to_time >= ? OR ps.to_time = 0)', $time);

        $cols = array('product_id', 'website_id', 'customer_group_id', 'from_time', 'to_time');
        $this->getSelect()->join(array('ps' => $this->_getLinkTable()), implode(' AND ', $cond), $cols);

        return $this;
    }

    /**
     * @param $storeId
     * @return Lanot_PremiumSticker_Model_Mysql4_Sticker_Collection
     */
    public function addStoreImage($storeId)
    {

        $cond = array();
        $cond[] = 'main_table.sticker_id=store_tbl.sticker_id';
        $cond[] = $this->getConnection()->quoteInto('store_tbl.store_id = ?', $storeId);

        $cols = array('store_image' => 'store_tbl.image');
        $this->getSelect()->joinLeft(array('store_tbl' => $this->_getStoreImageTable()), implode(' AND ',$cond), $cols);

        return $this;
    }
}
