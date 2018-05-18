<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Lê Hồng Quang (quanglh268@gmail.com)
 * @Copyright (C) 2018 Lê Hồng Quang. All rights reserved
 * @Createdate Sat, 12 May 2018 19:03:53 GMT
 */

if ( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) ) die( 'Stop!!!' );

define( 'NV_IS_FILE_ADMIN', true );
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';

$allow_func = array( 'main', 'config');