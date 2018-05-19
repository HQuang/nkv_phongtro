<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 13 May 2018 14:55:13 GMT
 */
if (!defined('NV_IS_MOD_PHONGTRO')) die('Stop!!!');

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

$q = $nv_Request->get_title('q', 'post,get');

// Fetch Limit
$show_view = false;
if ( ! $nv_Request->isset_request( 'id', 'post,get' ) )
{
    $show_view = true;
    $per_page = 20;
    $page = $nv_Request->get_int( 'page', 'post,get', 1 );
    $db->sqlreset()
    ->select( 'COUNT(*)' )
    ->from( '' . NV_PREFIXLANG . '_' . $module_data . '_create' );
    
    if( ! empty( $q ) )
    {
        $db->where( 'user_id LIKE :q_user_id OR title LIKE :q_title OR cat_id LIKE :q_cat_id OR landlord LIKE :q_landlord OR phone LIKE :q_phone OR price LIKE :q_price OR area LIKE :q_area OR object_id LIKE :q_object_id OR country_id LIKE :q_country_id OR province_id LIKE :q_province_id OR district_id LIKE :q_district_id OR ward_id LIKE :q_ward_id OR address LIKE :q_address OR note LIKE :q_note OR img LIKE :q_img OR img_alt LIKE :q_img_alt OR addtime LIKE :q_addtime' );
    }
    $sth = $db->prepare( $db->sql() );
    
    if( ! empty( $q ) )
    {
        $sth->bindValue( ':q_user_id', '%' . $q . '%' );
        $sth->bindValue( ':q_title', '%' . $q . '%' );
        $sth->bindValue( ':q_cat_id', '%' . $q . '%' );
        $sth->bindValue( ':q_landlord', '%' . $q . '%' );
        $sth->bindValue( ':q_phone', '%' . $q . '%' );
        $sth->bindValue( ':q_price', '%' . $q . '%' );
        $sth->bindValue( ':q_area', '%' . $q . '%' );
        $sth->bindValue( ':q_object_id', '%' . $q . '%' );
        $sth->bindValue( ':q_country_id', '%' . $q . '%' );
        $sth->bindValue( ':q_province_id', '%' . $q . '%' );
        $sth->bindValue( ':q_district_id', '%' . $q . '%' );
        $sth->bindValue( ':q_ward_id', '%' . $q . '%' );
        $sth->bindValue( ':q_address', '%' . $q . '%' );
        $sth->bindValue( ':q_note', '%' . $q . '%' );
        $sth->bindValue( ':q_img', '%' . $q . '%' );
        $sth->bindValue( ':q_img_alt', '%' . $q . '%' );
        $sth->bindValue( ':q_addtime', '%' . $q . '%' );
    }
    $sth->execute();
    $num_items = $sth->fetchColumn();
    
    $db->select( '*' )
    ->order( 'weight ASC' )
    ->limit( $per_page )
    ->offset( ( $page - 1 ) * $per_page );
    $sth = $db->prepare( $db->sql() );
    
    if( ! empty( $q ) )
    {
        $sth->bindValue( ':q_user_id', '%' . $q . '%' );
        $sth->bindValue( ':q_title', '%' . $q . '%' );
        $sth->bindValue( ':q_cat_id', '%' . $q . '%' );
        $sth->bindValue( ':q_landlord', '%' . $q . '%' );
        $sth->bindValue( ':q_phone', '%' . $q . '%' );
        $sth->bindValue( ':q_price', '%' . $q . '%' );
        $sth->bindValue( ':q_area', '%' . $q . '%' );
        $sth->bindValue( ':q_object_id', '%' . $q . '%' );
        $sth->bindValue( ':q_country_id', '%' . $q . '%' );
        $sth->bindValue( ':q_province_id', '%' . $q . '%' );
        $sth->bindValue( ':q_district_id', '%' . $q . '%' );
        $sth->bindValue( ':q_ward_id', '%' . $q . '%' );
        $sth->bindValue( ':q_address', '%' . $q . '%' );
        $sth->bindValue( ':q_note', '%' . $q . '%' );
        $sth->bindValue( ':q_img', '%' . $q . '%' );
        $sth->bindValue( ':q_img_alt', '%' . $q . '%' );
        $sth->bindValue( ':q_addtime', '%' . $q . '%' );
    }
    $sth->execute();
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

$xtpl->assign('Q', $q);

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
        if (!empty($view['img'])){
        $view['img'] = nv_resize_crop_images(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $view['img'], 200, 200);
        }else{
            $view['img'] = 'http://is4.mzstatic.com/image/pf/us/r30/Purple3/v4/f7/10/9b/f7109b56-4d23-0838-eb82-bb0a4c8c9318/pr_source.jpg';
        }
        $view['price'] = number_format($view['price']);
        $view['area'] = number_format($view['area']);
        $view['province_id'] = $array_province_id_location[$view['province_id']]['title'];
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