<?php
/**
 * Created by PhpStorm.
 * User: zhanglei02
 * Date: 2018/4/29
 * Time: 上午11:27
 */
$old_mysqli = new mysqli("localhost","root","root", "content_ori");
$old_mysqli->query("set names utf8");
$sql = "select * from `content_ori_201804_newlife101` WHERE  `slug` = 0";
$ret = $old_mysqli->query($sql);
while ($arr = $ret->fetch_assoc()){
    $old_table_name = "content_ori_201804_newlife101";
    $ori_url = $arr['ori_url'];
    $sql = "insert mirr_ori_new_art(`old_table_name`, `ori_url`)"
    ." values('$old_table_name','$ori_url')";
    $old_mysqli->query($sql);
}