<?php

/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2018 TDFOSS.,LTD. All rights reserved
 * @Createdate Tue, 02 Jan 2018 08:34:29 GMT
 */
if (!defined('NV_MAINFILE')) die('Stop!!!');

$array_province_id_location = array();
$_sql = 'SELECT provinceid,title FROM nv4_location_province';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_province_id_location[$_row['provinceid']] = $_row;
}

$array_district_id_location = array();
$_sql = 'SELECT districtid,title FROM nv4_location_district';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_district_id_location[$_row['districtid']] = $_row;
}

$array_ward_id_location = array();
$_sql = 'SELECT wardid,title FROM nv4_location_ward';
$_query = $db->query($_sql);
while ($_row = $_query->fetch()) {
    $array_ward_id_location[$_row['wardid']] = $_row;
}

$array_cat_id = array(
    0 => $lang_module['catalog0'],
    1 => $lang_module['catalog1']
);

// $array_unit_id = array(
//     0 => $lang_module['unit0'],
//     1 => $lang_module['unit1']
// );

$array_object_id = array(
    0 => $lang_module['object0'],
    1 => $lang_module['object1'],
    2 => $lang_module['object2']
);

function get_district($id){
    global $db;
    $array_district_id_location = array();
    $_sql = 'SELECT districtid,title FROM nv4_location_district where provinceid = ' . $id;
    $_query = $db->query($_sql);
    while ($_row = $_query->fetch()) {
        $array_district_id_location[$_row['districtid']] = $_row;
    }
    
    return $array_district_id_location;
}
function get_ward($id){
    global $db;    
    $array_ward_id_location = array();
    $_sql = 'SELECT wardid,title FROM nv4_location_ward where districtid = ' . $id;
    $_query = $db->query($_sql);
    while ($_row = $_query->fetch()) {
        $array_ward_id_location[$_row['wardid']] = $_row;
    }
    
    return $array_ward_id_location;
}














