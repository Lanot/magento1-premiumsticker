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
 * Products collection
 *
 * @author Lanot
 */
class Lanot_PremiumSticker_Model_Mysql4_Product_Collection
    extends Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection
{
    /**
     * Return all attribute values as array in form:
     * array(
     *   [entity_id_1] => array(
     *          [store_id_1] => store_value_1,
     *          [store_id_2] => store_value_2,
     *          ...
     *          [store_id_n] => store_value_n
     *   ),
     *   ...
     * )
     *
     * @param string $attribute attribute code
     * @return array
     */
    public function getAllAttributeValues($attribute)
    {
        /** @var $select Varien_Db_Select */
        $select    = clone $this->getSelect();
        $attribute = $this->getEntity()->getAttribute($attribute);

        $select->reset()
            ->from(array('e' => $attribute->getBackend()->getTable()), array('entity_id', 'store_id', 'value'))
            ->where('attribute_id = ?', (int)$attribute->getId());

        $where = $this->getSelect()->getPart(Zend_Db_Select::WHERE);

        //----------------------------------------------------------------//
        //@todo: quick fix for  performance issue with loading all EAV data
        if (isset($where[0]) && strpos($where[0], 'entity_id') !==false) {
            $select->where($where[0]);
        }
        //----------------------------------------------------------------//

        $data = $this->getConnection()->fetchAll($select);
        $res  = array();

        foreach ($data as $row) {
            $res[$row['entity_id']][$row['store_id']] = $row['value'];
        }

        return $res;
    }
}
