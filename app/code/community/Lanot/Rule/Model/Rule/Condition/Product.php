<?php
/**
 * Private Entrepreneur Anatolii Lehkyi (aka Lanot)
 *
 * @category    Lanot
 * @package     Lanot_Rule
 * @copyright   Copyright (c) 2010 Anatolii Lehkyi
 * @license     http://opensource.org/licenses/osl-3.0.php
 * @link        http://www.lanot.biz/
 */

class Lanot_Rule_Model_Rule_Condition_Product
    extends Mage_CatalogRule_Model_Rule_Condition_Product
{
    /**
     * Retrieve value element chooser URL
     *
     * @return string
     */
    public function getValueElementChooserUrl()
    {
        $url = false;
        switch ($this->getAttribute()) {
            case 'sku':
            case 'category_ids':
            $url = '*/adminhtml_widget/chooser/attribute/'.$this->getAttribute();
            if ($this->getJsFormObject()) {
                $url .= '/form/'.$this->getJsFormObject();
            }
            break;
        }
        return $url!==false ? Mage::helper('adminhtml')->getUrl($url) : '';
    }

    /**
     * Load attribute options
     *
     * @return Mage_CatalogRule_Model_Rule_Condition_Product
     */
    public function loadAttributeOptions()
    {
        $productAttributes = Mage::getResourceSingleton('catalog/product')
            ->loadAllAttributes()
            ->getAttributesByCode();

        $attributes = array();
        /* @var $attribute Mage_Catalog_Model_Resource_Eav_Attribute */
        foreach ($productAttributes as $attribute) {
            //@todo: removed all conditions
            $attributes[$attribute->getAttributeCode()] = $attribute->getFrontendLabel() ? $attribute->getFrontendLabel() : ucfirst($attribute->getAttributeCode());
        }

        $this->_addSpecialAttributes($attributes);

        asort($attributes);
        $this->setAttributeOption($attributes);

        return $this;
    }

    /**
     * fix for comparing 0 and not existing value (or NULL)
     * Case and type insensitive comparison of values
     *
     * @param  string|int|float $validatedValue
     * @param  string|int|float $value
     * @return bool
     */
    protected function _compareValues($validatedValue, $value, $strict = true)
    {
        if (is_null($validatedValue)) {
            $validatedValue = 0;
        }
        return parent::_compareValues($validatedValue, $value, $strict);
    }
}
