<?php

class Wan_Check_Model_Mysql4_District_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct() {
        $this->_init('wan_check/district');
        parent::_construct();
    }

    public function addRegionFilter($regionId) {
        if (!empty($regionId)) {
            if (is_array($regionId)) {
                $this->addFieldToFilter('main_table.region_id', array('in' => $regionId));
            } else {
                $this->addFieldToFilter('main_table.region_id', $regionId);
            }
        }
        return $this;
    }

}
