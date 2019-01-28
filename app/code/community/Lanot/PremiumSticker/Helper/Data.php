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

class Lanot_PremiumSticker_Helper_Data extends Lanot_EasySticker_Helper_Data
{
    /**
     * @return int
     */
    public function getWebsiteId()
    {
        return Mage::app()->getWebsite()->getId();
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return Mage::app()->getStore()->getId();
    }

    /**
     * @return int
     */
    public function getCustomerGroupId()
    {
        return Mage::getSingleton('customer/session')->getCustomerGroupId();
    }

    /**
     * @param $file
     * @param $width
     * @param string $height
     * @return string
     */
    public function resizeImg($file, $width, $height = '')
    {
        $folderURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
        $imageURL = $folderURL . $file;

        $newFilename = '/cache/' . "{$width}x{$height}" . '/' . $file;
        $basePath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . '/' . $file;
        $newPath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $newFilename;

        //if width empty then return original size image's URL
        if ($width != '') {
            //if image has already resized then just return URL
            if (file_exists($basePath) && is_file($basePath) && !file_exists($newPath)) {
                $imageObj = new Lanot_EasySticker_Model_Image($basePath);
                $imageObj->constrainOnly(true);
                $imageObj->keepAspectRatio(false);
                $imageObj->keepFrame(false);
                $imageObj->keepTransparency(true);
                $imageObj->resize($width, $height);
                $imageObj->save($newPath);
            }
            $resizedURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $newFilename;
        } else {
            $resizedURL = $imageURL;
        }
        return $resizedURL;
    }
}
