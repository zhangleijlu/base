<?php
/**
 * Created by PhpStorm.
 * User: zhanglei02
 * Date: 2018/3/27
 * Time: 上午10:01
 */
$dev_id = $_GET['id'];
$dev_model = $_GET['model'];
$mysqli = new mysqli("127.0.0.1","root", "root", "zengqinfu");
$sql = "insert into promocode('dev_id', 'dev_model') VALUES ('$dev_id', '$dev_model')";
$code = $mysqli->query($sql);
if($code){
    $ret = ["code"=>200, "data" =>["promocode" =>$code]];
    echo json_encode($ret);
}