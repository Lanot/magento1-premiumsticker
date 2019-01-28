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

require_once('Lanot/PremiumSticker/controllers/Adminhtml/StickerController.php');

class Lanot_PremiumSticker_Adminhtml_Sticker_DynamicController
	extends Lanot_PremiumSticker_Adminhtml_StickerController
{
    protected $_msgTitle = 'Dynamic Stickers';
    protected $_aclSection = 'dynamic_sticker';
}
