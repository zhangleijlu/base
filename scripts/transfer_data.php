<?php
/**
 * Created by PhpStorm.
 * User: zhanglei02
 * Date: 2018/4/26
 * Time: 下午4:01
 */
$old_mysqli = new mysqli("localhost","root","root", "content_ori");



function img_upload($old_url = ''){
    $ch = curl_init();
    $data = array('title' => 'Foo', 'file' => '@/mnt/hgfs/data_app/base/a.png');
    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
    $header = ['Authorization' => "Bearer e00f5d86eccb699855b8307ae383666fc622f1dd"];
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_POST, $data);
//CURLOPT_SAFE_UPLOAD defaulted to true in 5.6.0
//So next line is required as of php >= 5.6.0
    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_exec($ch);
    curl_close($ch);
}

img_upload();


?>