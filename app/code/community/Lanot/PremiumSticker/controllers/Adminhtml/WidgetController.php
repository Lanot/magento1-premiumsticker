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

require_once('Mage/Adminhtml/controllers/Promo/WidgetController.php');

class Lanot_PremiumSticker_Adminhtml_WidgetController
    extends Mage_Adminhtml_Promo_WidgetController
{
    /**
     * @return Lanot_EasySticker_Helper_Admin
     */
    protected function _getAclHelper()
    {
        return Mage::helper('lanot_easysticker/admin');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_getAclHelper()->isActionAllowed('manage_sticker/save');
    }
}