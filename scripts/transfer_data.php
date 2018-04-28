<?php
/**
 * Created by PhpStorm.
 * User: zhanglei02
 * Date: 2018/4/26
 * Time: 下午4:01
 */
$old_mysqli = new mysqli("localhost","root","root", "content_ori");
$old_mysqli->query("set names utf8");
$sql = "select * from `content_ori_201804_newlife101` WHERE  `transfer_status` = 0";

$ret = $old_mysqli->query($sql);
while ($arr = $ret->fetch_assoc()){
    $ori_content = $arr['content'];
    file_put_contents("./tmp1.txt", $ori_content);
   // shell_exec("echo 123");
    exec(" opencc -i ./tmp1.txt  -o ./tmp2.txt -c zht2zhs.ini", $output );
    //var_dump($output);
    $cn_content = file_get_contents("./tmp2.txt");
    $no_img_content = img_transfer($cn_content);
}

function img_transfer($cn_content){
    $pattern="/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
    $order='ALL';
    preg_match_all($pattern,$cn_content,$match);
    if(isset($match[1])&&!empty($match[1])){
        if($order==='ALL'){
            $img_urls = $match[1];
        }
    }
    foreach ($img_urls as $img_url){
        $new_url = img_upload($img_url);
    }
 //   var_dump($img_urls); die();

}

function img_upload($old_url = ''){
    $path_parts = pathinfo($old_url);
    $ext = $path_parts['extension'];
    $img = './image_tmp/flower.'.$ext;
    file_put_contents($img, file_get_contents($old_url));
    $title = "test";
    $shell = "curl --compressed  -fsSL --stderr - -F 'title=${title}' -F 'image=@\"./a.png\"'  -H \"Authorization: Bearer 20a353aa591e9029e92ca7d49515e81fce3677fb\" https://api.imgur.com/3/image";
    echo $shell;
    $ret = shell_exec($shell); var_dump($ret);
    //exec();
  /**  $ch = curl_init();
    $data = array('title' => 'Foo', 'file' => '@/mnt/hgfs/data_app/base/a.png');
    curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
    $header = ['Authorization' => "Bearer e00f5d86eccb699855b8307ae383666fc622f1dd"];
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_POST, $data);
//CURLOPT_SAFE_UPLOAD defaulted to true in 5.6.0
//So next line is required as of php >= 5.6.0
    //curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_exec($ch);
    curl_close($ch);
   * ***/
}

/**
 * curl --compressed  -fsSL --stderr - -F "title=${title}" -F "image=@\"/root/base/a.png\""  -H "Authorization: Bearer 20a353aa591e9029e92ca7d49515e81fce3677fb" https://api.imgur.com/3/image
 */
//img_upload();


?>