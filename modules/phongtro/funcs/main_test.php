<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Thu, 17 May 2018 00:43:04 GMT
 */

if( ! defined( 'NV_IS_MOD_PHONGTRO' ) ) die( 'Stop!!!' );

if ( $nv_Request->isset_request( 'get_alias_title', 'post' ) )
{
	$alias = $nv_Request->get_title( 'get_alias_title', 'post', '' );
	$alias = change_alias( $alias );
	die( $alias );
}

if ( $nv_Request->isset_request( 'delete_id', 'get' ) and $nv_Request->isset_request( 'delete_checkss', 'get' ))
{
	$id = $nv_Request->get_int( 'delete_id', 'get' );
	$delete_checkss = $nv_Request->get_string( 'delete_checkss', 'get' );
	if( $id > 0 and $delete_checkss == md5( $id . NV_CACHE_PREFIX . $client_info['session_id'] ) )
	{
		$db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_create  WHERE id = ' . $db->quote( $id ) );
		$nv_Cache->delMod( $module_name );
		Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}
}

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int( 'id', 'post,get', 0 );
if ( $nv_Request->isset_request( 'submit', 'post' ) )
{
	$row['title'] = $nv_Request->get_title( 'title', 'post', '' );
	$row['unit_id'] = $nv_Request->get_int( 'unit_id', 'post', 0 );

	if( empty( $error ) )
	{
		try
		{
			if( empty( $row['id'] ) )
			{

				$row['user_id'] = 0;
				$row['alias'] = '';
				$row['cat_id'] = 0;
				$row['landlord'] = '';
				$row['phone'] = '';
				$row['price'] = '';
				$row['area'] = 0;
				$row['object_id'] = 0;
				$row['country_id'] = 0;
				$row['province_id'] = 0;
				$row['district_id'] = 0;
				$row['ward_id'] = 0;
				$row['address'] = '';
				$row['note'] = '';
				$row['img'] = '';
				$row['img_alt'] = '';
				$row['addtime'] = 0;
				$row['weight'] = 0;
				$row['active'] = 0;

				$stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_create (user_id, title, alias, cat_id, landlord, phone, price, unit_id, area, object_id, country_id, province_id, district_id, ward_id, address, note, img, img_alt, addtime, weight, active) VALUES (:user_id, :title, :alias, :cat_id, :landlord, :phone, :price, :unit_id, :area, :object_id, :country_id, :province_id, :district_id, :ward_id, :address, :note, :img, :img_alt, :addtime, :weight, :active)' );

				$stmt->bindParam( ':user_id', $row['user_id'], PDO::PARAM_INT );
				$stmt->bindParam( ':alias', $row['alias'], PDO::PARAM_STR );
				$stmt->bindParam( ':cat_id', $row['cat_id'], PDO::PARAM_INT );
				$stmt->bindParam( ':landlord', $row['landlord'], PDO::PARAM_STR );
				$stmt->bindParam( ':phone', $row['phone'], PDO::PARAM_STR );
				$stmt->bindParam( ':price', $row['price'], PDO::PARAM_STR );
				$stmt->bindParam( ':area', $row['area'], PDO::PARAM_INT );
				$stmt->bindParam( ':object_id', $row['object_id'], PDO::PARAM_INT );
				$stmt->bindParam( ':country_id', $row['country_id'], PDO::PARAM_INT );
				$stmt->bindParam( ':province_id', $row['province_id'], PDO::PARAM_INT );
				$stmt->bindParam( ':district_id', $row['district_id'], PDO::PARAM_INT );
				$stmt->bindParam( ':ward_id', $row['ward_id'], PDO::PARAM_INT );
				$stmt->bindParam( ':address', $row['address'], PDO::PARAM_STR );
				$stmt->bindParam( ':note', $row['note'], PDO::PARAM_STR );
				$stmt->bindParam( ':img', $row['img'], PDO::PARAM_STR );
				$stmt->bindParam( ':img_alt', $row['img_alt'], PDO::PARAM_STR );
				$stmt->bindParam( ':addtime', $row['addtime'], PDO::PARAM_INT );
				$stmt->bindParam( ':weight', $row['weight'], PDO::PARAM_INT );
				$stmt->bindParam( ':active', $row['active'], PDO::PARAM_INT );

			}
			else
			{
				$stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_create SET title = :title, unit_id = :unit_id WHERE id=' . $row['id'] );
			}
			$stmt->bindParam( ':title', $row['title'], PDO::PARAM_STR );
			$stmt->bindParam( ':unit_id', $row['unit_id'], PDO::PARAM_INT );

			$exc = $stmt->execute();
			if( $exc )
			{
				$nv_Cache->delMod( $module_name );
				Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
				die();
			}
		}
		catch( PDOException $e )
		{
			trigger_error( $e->getMessage() );
			die( $e->getMessage() ); //Remove this line after checks finished
		}
	}
}
elseif( $row['id'] > 0 )
{
	$row = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_create WHERE id=' . $row['id'] )->fetch();
	if( empty( $row ) )
	{
		Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}
}
else
{
	$row['id'] = 0;
	$row['title'] = '';
	$row['unit_id'] = 0;
}

$array_unit_id = array();
$array_unit_id[1] = 'A';
$array_unit_id[2] = 'B';
$array_unit_id[3] = 'C';

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'MODULE_UPLOAD', $module_upload );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );


foreach( $array_unit_id as $key => $title )
{
	$xtpl->assign( 'OPTION', array(
		'key' => $key,
		'title' => $title,
		'selected' => ($key == $row['unit_id']) ? ' selected="selected"' : ''
	) );
	$xtpl->parse( 'main.select_unit_id' );
}

if( ! empty( $error ) )
{
	$xtpl->assign( 'ERROR', implode( '<br />', $error ) );
	$xtpl->parse( 'main.error' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['main_test'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';