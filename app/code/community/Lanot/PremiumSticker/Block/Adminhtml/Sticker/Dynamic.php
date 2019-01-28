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
 * Dynamic Stickers List admin grid container
 *
 * @author Lanot
 */
class Lanot_PremiumSticker_Block_Adminhtml_Sticker_Dynamic
	extends Lanot_EasySticker_Block_Adminhtml_Sticker
{
    /**
     * Block constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->_blockGroup = 'lanot_premiumsticker';
        $this->_controller = 'adminhtml_sticker_dynamic';
        $this->_headerText = Mage::helper('lanot_premiumsticker')->__('Manage Dynamic Stickers');

        $this->_removeButton('add');
    }
}

