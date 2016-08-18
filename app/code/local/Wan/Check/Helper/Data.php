<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Wan_Check_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getRegionCollection() {

        return Mage::getModel('directory/region')->getResourceCollection();
    }

    public function getDistrictCollection() {
        return Mage::getModel('wan_check/district')->getResourceCollection();
    }

    public function getDistrictJson() {
        Varien_Profiler::start('TEST: ' . __METHOD__);

        $districts = $this->getDistrict();
        $helper = Mage::getModel('core/factory')->getHelper('core');
        $json = $helper->jsonEncode($districts);

        Varien_Profiler::stop('TEST: ' . __METHOD__);
        return $json;
    }

    public function getWardJson() {
        Varien_Profiler::start('TEST: ' . __METHOD__);

        $wards = $this->getWard();
        $helper = Mage::getModel('core/factory')->getHelper('core');
        $json = $helper->jsonEncode($wards);

        Varien_Profiler::stop('TEST: ' . __METHOD__);
        return $json;
    }

    public function getRegion() {
        $regionIds = array();
        $regionCollection = $this->getRegionCollection();
        foreach ($regionCollection as $region) {
            $regionIds[] = $region->getRegionId();
        }
        return $regionIds;
    }

    public function getDistrictid() {
        $districtIds = array();
        $districtCollection = $this->getDistrictCollection();
        foreach ($districtCollection as $district) {
            $districtIds[] = $district->getDistrictId();
        }
        return $districtIds;
    }

    public function getDistrict() {
        $regionIds = array();
        $regionCollection = $this->getRegionCollection();
        foreach ($regionCollection as $region) {
            $regionIds[] = $region->getRegionId();
        }

        $collection = Mage::getModel('wan_check/district')->getResourceCollection()
                ->addRegionFilter($regionIds)
                ->load();
        $districts = array('config' => array(
                'show_all_regions' => 'true',
                'regions_required' => $this->getRegion()
            )
        );
        foreach ($collection as $district) {
            $districts[$district->getRegionId()][$district->getDistrictId()] = array(
                'code' => $district->getCode(),
                'name' => $district->getName()
            );
        }

        return $districts;
    }

    public function getWard() {
        $districtIds = array();
        $districtCollection = $this->getDistrictCollection();
        foreach ($districtCollection as $district) {
            $districtIds[] = $district->getDistrictId();
        }

        $collection = Mage::getModel('wan_check/ward')->getResourceCollection()
                ->addRegionFilter($districtIds)
                ->load();
        $wards = array('config' => array(
                'show_all_regions' => 'true',
                'regions_required' => $this->getDistrictid()
            )
        );
        foreach ($collection as $ward) {
            $wards[$ward->getDistrictId()][$ward->getWardId()] = array(
                'code' => $ward->getCode(),
                'name' => $ward->getName()
            );
        }

        return $wards;
    }

}
