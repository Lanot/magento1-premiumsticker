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
 * Dynamic Sticker admin edit form container
 *
 * @author Lanot
 */
class Lanot_PremiumSticker_Block_Adminhtml_Sticker_Dynamic_Edit
    extends Lanot_EasySticker_Block_Adminhtml_Sticker_Edit
{
    /**
     * Initialize edit form container
     *
     */
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'lanot_premiumsticker';
        $this->_controller = 'adminhtml_sticker_dynamic';

        parent::__construct();

        $this->_removeButton('delete');
    }

    public function getHeaderText()
    {
        $model = Mage::helper('lanot_premiumsticker')->getStickerItemInstance();
        if ($model->getId()) {
            $title = $this->escapeHtml($model->getTitle());
            $header = Mage::helper('lanot_premiumsticker')->__("Edit Dynamic Sticker Item '%s'", $title);
        } else {
            throw new Exception('Could not edit dynamic sticker item');
        }
        return $header;
    }
}
