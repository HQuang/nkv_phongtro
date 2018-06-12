<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 13 May 2018 12:32:30 GMT
 */

if( ! defined( 'NV_IS_MOD_PHONGTRO' ) ) die( 'Stop!!!' );

$detailid = $nv_Request->get_int('id', 'post,get', 0);
$rows = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_create WHERE id=' . $detailid)->fetch();


$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'MODULE_UPLOAD', $module_upload );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );



$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['detail'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';