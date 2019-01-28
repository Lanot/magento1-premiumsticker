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

class Lanot_PremiumSticker_Block_Adminhtml_Sticker_Edit_Tab_Products
    extends Mage_Core_Block_Abstract
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * @return string
     */
    public function getTabLabel()
    {
        return $this->_getHelper()->__('Associated Products');
    }

    /**
     * @return string
     */
    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return $this->_getAclHelper()->isActionAllowed('manage_sticker/assign');
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return !$this->canShowTab();
    }

    /**
     * @return string
     */
    public function getTabUrl()
    {
        return $this->getUrl('*/*/productsgrid',
            array('sticker_id' => $this->_getSticker()->getId(), '_secure'=>true)
        );
    }

    /**
     * @return string
     */
    public function getTabClass()
    {
        return 'ajax';
    }

    /**
     * @return Lanot_PremiumSticker_Model_Sticker
     */
    protected function _getSticker()
    {
        return Mage::registry('easy.sticker.item');
    }

    /**
     * @return Lanot_PremiumSticker_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('lanot_premiumsticker');
    }

    /**
     * @return Lanot_EasySticker_Helper_Admin
     */
    protected function _getAclHelper()
    {
        return Mage::helper('lanot_easysticker/admin');
    }
}
