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
    $ori_title = $arr['title'];
    $cn_title = transfer_cn($ori_title);
    $cn_content = transfer_cn($ori_content);
    $no_img_content = img_transfer($cn_content);
    $three_step_content = inner_url_transfer($no_img_content);
    $four_step_content = outer_url_transfer($three_step_content);
    $final_data = [];
    $final_data['title'] = $cn_title;
    $final_data['content'] = $four_step_content;

}

function img_transfer($cn_content){
    $pattern="/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
    $order='ALL';
    preg_match_all($pattern, $cn_content,$match);
    if(isset($match[1])&&!empty($match[1])){
        if($order==='ALL'){
            $img_urls = $match[1];
        }
    }
    foreach ($img_urls as $img_url){
        $new_url = img_upload($img_url);
        $cn_content = str_replace($img_url, $new_url, $cn_content);
    }

    return $cn_content;
}

function transfer_cn($text){
    file_put_contents("./tmp1.txt", $text);
    // shell_exec("echo 123");
    exec(" opencc -i ./tmp1.txt  -o ./tmp2.txt -c zht2zhs.ini", $output );
    //var_dump($output);
    $cn_text = file_get_contents("./tmp2.txt");
    return $cn_text;
}

function inner_url_transfer($content){
    $pattern="/<a.*?href=[\'|\"](.*?lm_news_view.php\?.*?cid=(\d+).*?)[\'|\"].*?\?>/";
    preg_match_all($pattern, $content,$match, PREG_SET_ORDER);
    foreach ($match as $k=>$v){
        $ori_art_cid = $v[2];
        $sql = "select * from mirr_ori_new_art WHERE  `ori_art_cid`=$ori_art_cid";
        global $old_mysqli;
        $ret = $old_mysqli->query($sql);
        $slug=$ret->fetch_assoc()['id'];
        $new = "http://www.zhiwen.com/1/$slug";
        $content = str_replace($new, $v[1], $content);
    }
    return $content;
}

function outer_url_transfer($content){
    $pattern="/<a.*?href=[\'|\"].*?[^lm_news_view.php][\'|\"].*?\?>/";
    preg_match_all($pattern, $content,$match, PREG_SET_ORDER);
    foreach ($match as $k=>$v){
        $ori_art_cid = $v[0];

        $content = str_replace("", $v[0], $content);
    }
    return $content;
}


function img_upload($old_url = ''){
    $path_parts = pathinfo($old_url);
    $ext = $path_parts['extension'];
    $img = './image_tmp/flower.'.$ext;
    unlink($img);
    file_put_contents($img, file_get_contents($old_url));
    $title = "test";
    $shell = "curl --compressed  -fsSL --stderr - -F 'title=${title}' -F 'image=@\"$img\"'  -H \"Authorization: Bearer 20a353aa591e9029e92ca7d49515e81fce3677fb\" https://api.imgur.com/3/image";
  //  echo $shell;
    $ret = shell_exec($shell); var_dump($ret);
    $ret_arr = json_decode($ret);
    $new_url = $ret_arr['data']['link'];
    return $new_url;
}

/**
 * curl --compressed  -fsSL --stderr - -F "title=${title}" -F "image=@\"/root/base/a.png\""  -H "Authorization: Bearer 20a353aa591e9029e92ca7d49515e81fce3677fb" https://api.imgur.com/3/image
 */
//img_upload();


?>