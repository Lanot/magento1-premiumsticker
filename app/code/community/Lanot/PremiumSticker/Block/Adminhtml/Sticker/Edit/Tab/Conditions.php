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

class Lanot_PremiumSticker_Block_Adminhtml_Sticker_Edit_Tab_Conditions
    extends Lanot_Rule_Block_Adminhtml_Catalog_Edit_Tab_Conditions
{
    protected $_condUrl = 'lanot_premiumsticker/adminhtml_sticker/newConditionHtml/form/rule_conditions_fieldset';

    /**
     * Prepare content for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return $this->_getHelper()->__('Auto Conditions');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->_getHelper()->__('Auto Conditions');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_getAclHelper()->isActionAllowed('manage_sticker/assign');
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

    /**
     * @return Lanot_EasySticker_Model_Sticker
     */
    protected function _getItem()
    {
        return $this->_getHelper()->getStickerItemInstance();
    }

    /**
     * @return Lanot_Rule_Model_Rule
     */
    protected function _getRule()
    {
        return $this->_getItem()->getRule();
    }
}
