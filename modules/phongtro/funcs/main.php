<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 13 May 2018 14:55:13 GMT
 */
if (!defined('NV_IS_MOD_PHONGTRO')) die('Stop!!!');
$provinceid = $nv_Request->get_int('provinceid', 'post,get', 0);
$districtid = $nv_Request->get_int('districtid', 'post,get', 0);
if ($nv_Request->isset_request('load_district', 'post')) {
    $provinceid = $nv_Request->get_int('provinceid', 'post,get', 0);
    $district_option = array();
    $order_id = $db->query('SELECT * FROM nv4_location_district WHERE status = 1 AND provinceid=' . $provinceid);
    while ($order = $order_id->fetch()) {
        $district_option[] = $order;
    }
    nv_jsonOutput($district_option);
}

if ($nv_Request->isset_request('load_ward', 'post')) {
    $districtid = $nv_Request->get_int('districtid', 'post,get', 0);
    $ward_option = array();
    $order_id = $db->query('SELECT * FROM nv4_location_ward WHERE districtid=' . $districtid);
    while ($order = $order_id->fetch()) {
        $ward_option[] = $order;
    }
    nv_jsonOutput($ward_option);
}

if ($nv_Request->isset_request('delete_id', 'get') and $nv_Request->isset_request('delete_checkss', 'get')) {
    $id = $nv_Request->get_int('delete_id', 'get');
    $delete_checkss = $nv_Request->get_string('delete_checkss', 'get');
    if ($id > 0 and $delete_checkss == md5($id . NV_CACHE_PREFIX . $client_info['session_id'])) {
        $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_create  WHERE id = ' . $db->quote($id));
        $nv_Cache->delMod($module_name);
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
}

$row = array();
$error = array();
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$where = '';
$array_search = array(
    'q' => $nv_Request->get_title('q', 'post,get'),
    'provinceid' => $nv_Request->get_int('provinceid', 'get', 0),
    'districtid' => $nv_Request->get_int('districtid', 'get', 0),
    'wardid' => $nv_Request->get_int('wardid', 'get', 0)
);

if (!empty($array_search['q'])) {
    $base_url .= '&q=' . $array_search['q'];
    $where .= ' AND (title LIKE "%' . $array_search['q'] . '%"
        OR landlord LIKE "%' . $array_search['q'] . '%"
        OR phone LIKE "%' . $array_search['q'] . '%"
        OR price LIKE "%' . $array_search['q'] . '%"
        OR area LIKE "%' . $array_search['q'] . '%"
        OR address LIKE "%' . $array_search['q'] . '%"
        OR note LIKE "%' . $array_search['q'] . '%"
    )';
}

if (!empty($array_search['provinceid'])) {
    $base_url .= '&provinceid=' . $array_search['provinceid'];
    $where .= ' AND province_id=' . $array_search['provinceid'];
}

if (!empty($array_search['districtid'])) {
    $base_url .= '&districtid=' . $array_search['districtid'];
    $where .= ' AND district_id=' . $array_search['districtid'];
}

if (!empty($array_search['wardid'])) {
    $base_url .= '&wardid=' . $array_search['wardid'];
    $where .= ' AND ward_id=' . $array_search['wardid'];
}

// Fetch Limit
$show_view = false;
if (!$nv_Request->isset_request('id', 'post,get')) {
    $show_view = true;
    $per_page = 20;
    $page = $nv_Request->get_int('page', 'post,get', 1);
    $db->sqlreset()
        ->select('COUNT(*)')
        ->from('' . NV_PREFIXLANG . '_' . $module_data . '_create')
        ->where('1=1' . $where);
    
    $sth = $db->prepare($db->sql());
    
    $sth->execute();
    
    $num_items = $sth->fetchColumn();
    
    $db->select('*')
        ->order('weight ASC')
        ->limit($per_page)
        ->offset(($page - 1) * $per_page);
    $sth = $db->prepare($db->sql());
    
    $sth->execute();
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);
$xtpl->assign('Q', $array_search['q']);
$input = $location->buildInput();
$xtpl->assign('LOCATION', $input);

foreach ($array_province_id_location as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['provinceid'],
        'title' => $value['title'],
        'selected' => ($value['provinceid'] == $provinceid) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.view.provinceid');
}
if ($show_view) {
    $base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
    if (!empty($q)) {
        $base_url .= '&q=' . $q;
    }
    $generate_page = nv_generate_page($base_url, $num_items, $per_page, $page);
    if (!empty($generate_page)) {
        $xtpl->assign('NV_GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.view.generate_page');
    }
    $number = $page > 1 ? ($per_page * ($page - 1)) + 1 : 1;
    while ($view = $sth->fetch()) {
        
        /*  if (!empty($view['img']) && file_exists(NV_ROOTDIR . '/' . NV_ASSETS_DIR . '/' . $module_upload . '/' . $view['img'])) {
         $view['img'] = NV_BASE_SITEURL . NV_ASSETS_DIR . '/' . $module_upload . '/' . $view['img'];
         } elseif (!empty($view['img']) && file_exists(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $view['img'])) {
         $view['img'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $view['img'];
         } else {
         $view['img'] = '';
         } */
        if (!empty($view['img'])) {
            $view['img'] = nv_resize_crop_images(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $view['img'], 200, 200);
        } else {
            $view['img'] = 'http://is4.mzstatic.com/image/pf/us/r30/Purple3/v4/f7/10/9b/f7109b56-4d23-0838-eb82-bb0a4c8c9318/pr_source.jpg';
        }
        $view['price'] = number_format($view['price']);
        $view['area'] = number_format($view['area']);
        $view['province_id'] = !empty($array_province_id_location[$view['province_id']]) ? $array_province_id_location[$view['province_id']]['title'] : '';
        $view['district_id'] = $array_district_id_location[$view['district_id']]['title'];
        $view['ward_id'] = $array_ward_id_location[$view['ward_id']]['title'];
        $view['locations'] = $view['district_id'] . ', ' . $view['province_id'];
        $view['cat_id'] = $array_cat_id[$view['cat_id']];
        $view['object_id'] = $array_object_id[$view['object_id']];
        $view['link_detail'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $view['id'];
        $view['link_edit'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $view['id'];
        $view['link_delete'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5($view['id'] . NV_CACHE_PREFIX . $client_info['session_id']);
        $xtpl->assign('VIEW', $view);
        $xtpl->parse('main.view.loop');
    }
    $xtpl->parse('main.view');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['main'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';