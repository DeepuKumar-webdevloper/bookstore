<?php

class Wan_Check_Model_Mysql4_Ward_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct() {
        $this->_init('wan_check/ward');
        parent::_construct();
    }

    public function addRegionFilter($districtId) {
        if (!empty($districtId)) {
            if (is_array($districtId)) {
                $this->addFieldToFilter('main_table.district_id', array('in' => $districtId));
            } else {
                $this->addFieldToFilter('main_table.district_id', $districtId);
            }
        }
        return $this;
    }

}