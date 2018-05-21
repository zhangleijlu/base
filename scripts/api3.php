<?php
/**
 * Created by PhpStorm.
 * User: zhanglei02
 * Date: 2018/3/27
 * Time: 上午10:01
 */
$dev_id = $_GET['id'];
$invited_promocode = $_GET['promonum'];
$mysqli = new mysqli("127.0.0.1","root", "root", "zengqinfu");
$sql = "select * from `invite` where `dev_id`=$dev_id";
$existRet = $mysqli->query($sql);
if($line = $existRet->fetch_assoc()){
    $ret = ["code"=>0, "err" =>"您已经输入过别人的邀请码了"];
    echo json_encode($ret);
    exit();
}

$sql = "select * from `promocode` where `dev_id`=$dev_id and `promocode`=$invited_promocode";
$existRet = $mysqli->query($sql);
if($line = $existRet->fetch_assoc()){
    $ret = ["code"=>0, "err" =>"您不能输入自己的邀请码"];
    echo json_encode($ret);
    exit();
}

$sql = "insert into `invite`(`dev_id`,  `invited_promocode`) VALUES('$dev_id', '$invited_promocode')";
$existRet = $mysqli->query($sql);
if($line = $existRet->fetch_assoc()){
    $ret = ["code"=>200, "err" =>[]];
    echo json_encode($ret);
    exit();
}