<?php


$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();


/**
 * Create table 'region_district'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('wan_check/district'))
    ->addColumn('district_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'District Id')
    ->addColumn('region_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        ), 'Region Id')
    ->addColumn('code', Varien_Db_Ddl_Table::TYPE_TEXT, 32, array(
        'nullable'  => true,
        'default'   => null,
        ), 'District code')
    ->addColumn('default_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'District Name')
    ->addIndex($installer->getIdxName('wan_check/district', array('region_id')),
        array('region_id'))
    ->setComment('Region District');
$installer->getConnection()->createTable($table);

/**
 * Create table 'district_ward'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('wan_check/ward'))
    ->addColumn('ward_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'District Id')
    ->addColumn('district_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        ), 'Region Id')
    ->addColumn('code', Varien_Db_Ddl_Table::TYPE_TEXT, 32, array(
        'nullable'  => true,
        'default'   => null,
        ), 'District code')
    ->addColumn('default_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'District Name')
    ->addIndex($installer->getIdxName('wan_check/ward', array('district_id')),
        array('district_id'))
    ->setComment('District Ward');
$installer->getConnection()->createTable($table);

$installer->endSetup();