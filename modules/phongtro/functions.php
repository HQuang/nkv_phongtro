<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Lê Hồng Quang (quanglh268@gmail.com)
 * @Copyright (C) 2018 Lê Hồng Quang. All rights reserved
 * @Createdate Sat, 12 May 2018 19:03:53 GMT
 */
if (!defined('NV_SYSTEM')) die('Stop!!!');

define('NV_IS_MOD_PHONGTRO', true);
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';

function nv_resize_crop_images($img_path, $width, $height, $module_name = '', $id = 0)
{
    $new_img_path = str_replace(NV_ROOTDIR, '', $img_path);
    if (file_exists($img_path)) {
        $imginfo = nv_is_image($img_path);
        $basename = basename($img_path);
        $basename = preg_replace('/^\W+|\W+$/', '', $basename);
        $basename = preg_replace('/[ ]+/', '_', $basename);
        $basename = strtolower(preg_replace('/\W-/', '', $basename));
        if ($imginfo['width'] > $width or $imginfo['height'] > $height) {
            $basename = preg_replace('/(.*)(\.[a-zA-Z]+)$/', $module_name . '_' . $id . '_\1_' . $width . '-' . $height . '\2', $basename);
            if (file_exists(NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $basename)) {
                $new_img_path = NV_BASE_SITEURL . NV_TEMP_DIR . '/' . $basename;
            } else {
                $img_path = new NukeViet\Files\Image($img_path, NV_MAX_WIDTH, NV_MAX_HEIGHT);
                
                $thumb_width = $width;
                $thumb_height = $height;
                $maxwh = max($thumb_width, $thumb_height);
                if ($img_path->fileinfo['width'] > $img_path->fileinfo['height']) {
                    $width = 0;
                    $height = $maxwh;
                } else {
                    $width = $maxwh;
                    $height = 0;
                }
                
                $img_path->resizeXY($width, $height);
                $img_path->cropFromCenter($thumb_width, $thumb_height);
                $img_path->save(NV_ROOTDIR . '/' . NV_TEMP_DIR, $basename);
                if (file_exists(NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $basename)) {
                    $new_img_path = NV_BASE_SITEURL . NV_TEMP_DIR . '/' . $basename;
                }
            }
        }
    }
    return $new_img_path;
}