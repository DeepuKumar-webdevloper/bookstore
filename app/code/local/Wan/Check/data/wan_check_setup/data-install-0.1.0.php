<?php
$installer = $this;
$data = array(
    array('485', 'TT', 'Thuong Tin'), array('485', 'PX', 'Phu Xuyen')
);

foreach ($data as $row) {
    $bind = array(
        'region_id'    => $row[0],
        'code'          => $row[1],
        'default_name'  => $row[2],
    );
    $installer->getConnection()->insert($installer->getTable('wan_check/district'), $bind);
    $districtId = $installer->getConnection()->lastInsertId($installer->getTable('wan_check/district'));
}

