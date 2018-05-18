<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Lê Hồng Quang (quanglh268@gmail.com)
 * @Copyright (C) 2018 Lê Hồng Quang. All rights reserved
 * @Createdate Sat, 12 May 2018 19:03:53 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$module_version = array(
	'name' => 'Phongtro',
	'modfuncs' => 'main,main_test,detail,search,create_rent',
	'change_alias' => 'main,main_test,detail,search,create_rent',
	'submenu' => 'main,main_test,detail,search,create_rent',
	'is_sysmod' => 0,
	'virtual' => 1,
	'version' => '4.3.01',
	'date' => 'Sat, 12 May 2018 19:03:53 GMT',
	'author' => 'Lê Hồng Quang (quanglh268@gmail.com)',
	'uploads_dir' => array($module_name),
	'note' => 'Modules đăng tin phòng trọ'
);