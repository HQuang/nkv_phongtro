<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2018 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 13 May 2018 12:33:37 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

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
		Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}
}

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int( 'id', 'post,get', 0 );
if ( $nv_Request->isset_request( 'submit', 'post' ) )
{
	$row['title'] = $nv_Request->get_title( 'title', 'post', '' );
	$row['alias'] = $nv_Request->get_title( 'alias', 'post', '' );
	$row['alias'] = ( empty($row['alias'] ))? change_alias( $row['title'] ) : change_alias( $row['alias'] );
	$row['cat_id'] = $nv_Request->get_int( 'cat_id', 'post', 0 );
	$row['phone'] = $nv_Request->get_title( 'phone', 'post', '' );
	$row['price'] = $nv_Request->get_title( 'price', 'post', '' );
	$row['unit_id'] = $nv_Request->get_int( 'unit_id', 'post', 0 );
	$row['area'] = $nv_Request->get_int( 'area', 'post', 0 );
	$row['object_id'] = $nv_Request->get_int( 'object_id', 'post', 0 );
	$row['country_id'] = $nv_Request->get_int( 'country_id', 'post', 0 );
	$row['province_id'] = $nv_Request->get_int( 'province_id', 'post', 0 );
	$row['district_id'] = $nv_Request->get_int( 'district_id', 'post', 0 );
	$row['ward_id'] = $nv_Request->get_int( 'ward_id', 'post', 0 );
	$row['address'] = $nv_Request->get_title( 'address', 'post', '' );
	$row['note'] = $nv_Request->get_string( 'note', 'post', '' );
	$row['img'] = $nv_Request->get_title( 'img', 'post', '' );
	if( is_file( NV_DOCUMENT_ROOT . $row['img'] ) )
	{
		$row['img'] = substr( $row['img'], strlen( NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' ) );
	}
	else
	{
		$row['img'] = '';
	}
	$row['active'] = $nv_Request->get_int( 'active', 'post', 0 );

	if( empty( $error ) )
	{
		try
		{
			if( empty( $row['id'] ) )
			{

				$row['weight'] = 0;

				$stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_create (title, alias, cat_id, phone, price, unit_id, area, object_id, country_id, province_id, district_id, ward_id, address, note, img, weight, active) VALUES (:title, :alias, :cat_id, :phone, :price, :unit_id, :area, :object_id, :country_id, :province_id, :district_id, :ward_id, :address, :note, :img, :weight, :active)' );

				$stmt->bindParam( ':weight', $row['weight'], PDO::PARAM_INT );

			}
			else
			{
				$stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_create SET title = :title, alias = :alias, cat_id = :cat_id, phone = :phone, price = :price, unit_id = :unit_id, area = :area, object_id = :object_id, country_id = :country_id, province_id = :province_id, district_id = :district_id, ward_id = :ward_id, address = :address, note = :note, img = :img, active = :active WHERE id=' . $row['id'] );
			}
			$stmt->bindParam( ':title', $row['title'], PDO::PARAM_STR );
			$stmt->bindParam( ':alias', $row['alias'], PDO::PARAM_STR );
			$stmt->bindParam( ':cat_id', $row['cat_id'], PDO::PARAM_INT );
			$stmt->bindParam( ':phone', $row['phone'], PDO::PARAM_STR );
			$stmt->bindParam( ':price', $row['price'], PDO::PARAM_STR );
			$stmt->bindParam( ':unit_id', $row['unit_id'], PDO::PARAM_INT );
			$stmt->bindParam( ':area', $row['area'], PDO::PARAM_INT );
			$stmt->bindParam( ':object_id', $row['object_id'], PDO::PARAM_INT );
			$stmt->bindParam( ':country_id', $row['country_id'], PDO::PARAM_INT );
			$stmt->bindParam( ':province_id', $row['province_id'], PDO::PARAM_INT );
			$stmt->bindParam( ':district_id', $row['district_id'], PDO::PARAM_INT );
			$stmt->bindParam( ':ward_id', $row['ward_id'], PDO::PARAM_INT );
			$stmt->bindParam( ':address', $row['address'], PDO::PARAM_STR );
			$stmt->bindParam( ':note', $row['note'], PDO::PARAM_STR, strlen($row['note']) );
			$stmt->bindParam( ':img', $row['img'], PDO::PARAM_STR );
			$stmt->bindParam( ':active', $row['active'], PDO::PARAM_INT );

			$exc = $stmt->execute();
			if( $exc )
			{
				$nv_Cache->delMod( $module_name );
				Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
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
		Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}
}
else
{
	$row['id'] = 0;
	$row['title'] = '';
	$row['alias'] = '';
	$row['cat_id'] = 0;
	$row['phone'] = '';
	$row['price'] = '';
	$row['unit_id'] = 0;
	$row['area'] = 0;
	$row['object_id'] = 0;
	$row['country_id'] = 0;
	$row['province_id'] = 0;
	$row['district_id'] = 0;
	$row['ward_id'] = 0;
	$row['address'] = '';
	$row['note'] = '';
	$row['img'] = '';
	$row['active'] = 0;
}
if( ! empty( $row['img'] ) and is_file( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $row['img'] ) )
{
	$row['img'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['img'];
}

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'MODULE_UPLOAD', $module_upload );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );


if( ! empty( $error ) )
{
	$xtpl->assign( 'ERROR', implode( '<br />', $error ) );
	$xtpl->parse( 'main.error' );
}
if( empty( $row['id'] ) )
{
	$xtpl->parse( 'main.auto_get_alias' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['main'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';