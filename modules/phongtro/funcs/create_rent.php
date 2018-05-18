<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 13 May 2018 08:36:13 GMT
 */
if (!defined('NV_IS_MOD_PHONGTRO')) die('Stop!!!');

if ($nv_Request->isset_request('get_alias_title', 'post')) {
    $alias = $nv_Request->get_title('get_alias_title', 'post', '');
    $alias = change_alias($alias);
    die($alias);
}

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int('id', 'post,get', 0);
if ($nv_Request->isset_request('submit', 'post')) {
    $row['title'] = $nv_Request->get_title('title', 'post', '');
    $row['alias'] = $nv_Request->get_title('alias', 'post', '');
    $row['alias'] = (empty($row['alias'])) ? change_alias($row['title']) : change_alias($row['alias']);
    $row['cat_id'] = $nv_Request->get_int('cat_id', 'post', 0);
    $row['phone'] = $nv_Request->get_title('phone', 'post', '');
    $row['landlord'] = $nv_Request->get_title('landlord', 'post', '');
    $row['price'] = $nv_Request->get_title('price', 'post', '');
    $row['area'] = $nv_Request->get_int('area', 'post', 0);
    $row['object_id'] = $nv_Request->get_int('object_id', 'post', 0);
    $row['province_id'] = $nv_Request->get_int('province_id', 'post', 0);
    $row['district_id'] = $nv_Request->get_int('district_id', 'post', 0);
    $row['ward_id'] = $nv_Request->get_int('ward_id', 'post', 0);
    $row['address'] = $nv_Request->get_title('address', 'post', '');
    $row['note'] = $nv_Request->get_string('note', 'post', '');
    $row['img'] = $nv_Request->get_title('img', 'post', '');
    $row['img_alt'] = $nv_Request->get_title('img_alt', 'post', '');
    
    $row['files'] = '';
    if (isset($_FILES['upload_fileupload']) and is_uploaded_file($_FILES['upload_fileupload']['tmp_name'])) {
        $upload = new NukeViet\Files\Upload($global_config['file_allowed_ext'], $global_config['forbid_extensions'], $global_config['forbid_mimes'], $global_config['nv_max_size'], NV_MAX_WIDTH, NV_MAX_HEIGHT);
        $upload_info = $upload->save_file($_FILES['upload_fileupload'], NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload, false);
        @unlink($_FILES['upload_fileupload']['tmp_name']);
        if (empty($upload_info['error'])) {
            $row['files'] = $upload_info['name'];
            @chmod($row['files'], 0644);
            $row['files'] = str_replace(NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/', '', $row['files']);
        } else {
            $error[] = $upload_info['error'];
        }
        unset($upload, $upload_info);
    }
    
    if (empty($row['title'])) {
        $error[] = $lang_module['error_required_title'];
    } elseif (empty($row['phone'])) {
        $error[] = $lang_module['error_required_phone'];
    } elseif (empty($row['landlord'])) {
        $error[] = $lang_module['error_required_landlord'];
    } elseif (empty($row['price'])) {
        $error[] = $lang_module['error_required_price'];
    } elseif (empty($row['area'])) {
        $error[] = $lang_module['error_required_area'];
    } elseif (empty($row['province_id'])) {
        $error[] = $lang_module['error_required_province_id'];
    } elseif (empty($row['district_id'])) {
        $error[] = $lang_module['error_required_district_id'];
    } elseif (empty($row['ward_id'])) {
        $error[] = $lang_module['error_required_ward_id'];
    } elseif (empty($row['address'])) {
        $error[] = $lang_module['error_required_address'];
    } elseif (empty($row['note'])) {
        $error[] = $lang_module['error_required_note'];
    }
    
    if (empty($error)) {
        try {
            if (empty($row['id'])) {
                
                $row['country_id'] = 0;
                $row['weight'] = 0;
                $row['active'] = 0;
                $row['addtime'] = NV_CURRENTTIME;
                
                $stmt = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_create (title, alias, cat_id, phone, landlord, price, area, object_id, country_id, province_id, district_id, ward_id, address, note, img, img_alt, addtime, weight, active) VALUES (:title, :alias, :cat_id, :phone, :landlord, :price, :area, :object_id, :country_id, :province_id, :district_id, :ward_id, :address, :note, :img, :img_alt, :addtime, :weight, :active)');
                
                $stmt->bindParam(':addtime', $row['addtime'], PDO::PARAM_INT);
                $stmt->bindParam(':country_id', $row['country_id'], PDO::PARAM_INT);
                $stmt->bindParam(':weight', $row['weight'], PDO::PARAM_INT);
                $stmt->bindParam(':active', $row['active'], PDO::PARAM_INT);
            } else {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_create SET title = :title, alias = :alias, cat_id = :cat_id, phone = :phone, landlord = :landlord, price = :price, area = :area, object_id = :object_id, province_id = :province_id, district_id = :district_id, ward_id = :ward_id, address = :address, note = :note, img = :img, img_alt = :img_alt WHERE id=' . $row['id']);
            }
            $stmt->bindParam(':title', $row['title'], PDO::PARAM_STR);
            $stmt->bindParam(':alias', $row['alias'], PDO::PARAM_STR);
            $stmt->bindParam(':cat_id', $row['cat_id'], PDO::PARAM_INT);
            $stmt->bindParam(':phone', $row['phone'], PDO::PARAM_STR);
            $stmt->bindParam(':landlord', $row['landlord'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $row['price'], PDO::PARAM_STR);
            $stmt->bindParam(':area', $row['area'], PDO::PARAM_INT);
            $stmt->bindParam(':object_id', $row['object_id'], PDO::PARAM_INT);
            $stmt->bindParam(':province_id', $row['province_id'], PDO::PARAM_INT);
            $stmt->bindParam(':district_id', $row['district_id'], PDO::PARAM_INT);
            $stmt->bindParam(':ward_id', $row['ward_id'], PDO::PARAM_INT);
            $stmt->bindParam(':address', $row['address'], PDO::PARAM_STR);
            $stmt->bindParam(':note', $row['note'], PDO::PARAM_STR, strlen($row['note']));
            $stmt->bindParam(':img', $row['files'], PDO::PARAM_STR);
            $stmt->bindParam(':img_alt', $row['img_alt'], PDO::PARAM_STR);
            
            $exc = $stmt->execute();
            if ($exc) {
                $nv_Cache->delMod($module_name);
                Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
                die();
            }
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
            die($e->getMessage()); //Remove this line after checks finished
        }
    }
} elseif ($row['id'] > 0) {
    $row = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_create WHERE id=' . $row['id'])->fetch();
    if (empty($row)) {
        Header('Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op);
        die();
    }
} else {
    $row['id'] = 0;
    $row['title'] = '';
    $row['alias'] = '';
    $row['cat_id'] = 0;
    $row['phone'] = '';
    $row['landlord'] = '';
    $row['price'] = '';
    $row['area'] = '';
    $row['object_id'] = 0;
    $row['province_id'] = 0;
    $row['district_id'] = 0;
    $row['ward_id'] = 0;
    $row['address'] = '';
    $row['note'] = '';
    $row['img'] = '';
    $row['img_alt'] = '';
}

if (!empty($row['img']) and is_file(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $row['img'])) {
    $row['img'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['img'];
}

$xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('MODULE_UPLOAD', $module_upload);
$xtpl->assign('OP', $op);
$xtpl->assign('ROW', $row);

foreach ($array_province_id_location as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['provinceid'],
        'title' => $value['title'],
        'selected' => ($value['provinceid'] == $row['province_id']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_province_id');
}
foreach ($array_district_id_location as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['districtid'],
        'title' => $value['title'],
        'selected' => ($value['districtid'] == $row['district_id']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_district_id');
}
foreach ($array_ward_id_location as $value) {
    $xtpl->assign('OPTION', array(
        'key' => $value['wardid'],
        'title' => $value['title'],
        'selected' => ($value['wardid'] == $row['ward_id']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_ward_id');
}

foreach ($array_cat_id as $key => $title) {
    $xtpl->assign('OPTION', array(
        'key' => $key,
        'title' => $title,
        'selected' => ($key == $row['cat_id']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_cat_id');
}

foreach ($array_object_id as $key => $title) {
    $xtpl->assign('OPTION', array(
        'key' => $key,
        'title' => $title,
        'selected' => ($key == $row['object_id']) ? ' selected="selected"' : ''
    ));
    $xtpl->parse('main.select_object_id');
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}
if (empty($row['id'])) {
    $xtpl->parse('main.auto_get_alias');
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

$page_title = $lang_module['main'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';