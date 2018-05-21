<?php
/**
 * Created by PhpStorm.
 * User: zhanglei02
 * Date: 2018/3/28
 * Time: 上午10:23
 */
$dev_id = $_GET['id'];
$mysqli = new mysqli("127.0.0.1","root", "root", "zengqinfu");
$sql = "select * from promocode WHERE  `dev_id`='$dev_id'";
$ret = $mysqli->query($sql);
if(!$line = $ret->fetch_assoc()){
    $ret = ["code"=>200, "data" =>["promonum" =>0]];
    echo json_encode($ret);
    exit();
}else{
    $promocode = $line['promocode'];
    $sql = "select count(1) as num from invite WHERE  `invited_promocode`='$promocode'";
    $ret = $mysqli->query($sql);
    $line = $ret->fetch_assoc();
    $num = $line['num'];
    $ret = ["code"=>200, "data" =>["promonum" =>$num]];
    echo json_encode($ret);
    exit();
}