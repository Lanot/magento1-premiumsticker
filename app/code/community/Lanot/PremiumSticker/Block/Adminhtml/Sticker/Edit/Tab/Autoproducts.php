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

class Lanot_PremiumSticker_Block_Adminhtml_Sticker_Edit_Tab_Autoproducts
    extends Lanot_PremiumSticker_Block_Adminhtml_Sticker_Edit_Tab_Products
{
    /**
     * @return string
     */
    public function getTabLabel()
    {
        return $this->_getHelper()->__('Auto Products');
    }

    /**
     * @return string
     */
    public function getTabUrl()
    {
        return $this->getUrl('*/*/autoproductsgrid',
            array('sticker_id' => $this->_getSticker()->getId(), '_secure'=>true)
        );
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return $this->_getAclHelper()->isActionAllowed('manage_sticker/assign') &&
            (bool) $this->_getSticker()->getId();
    }

    /**
     * @return Lanot_PremiumSticker_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('lanot_premiumsticker');
    }
}
