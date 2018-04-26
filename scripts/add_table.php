<?php
/**
 * Created by PhpStorm.
 * User: zhanglei02
 * Date: 2018/4/12
 * Time: 下午4:04
 */
$mysqli = new mysqli("127.0.0.1", "root", "root", "yascmf_base", "3306");
$mysqli ->query("set names utf8");
/**
for($i =0;$i<100;$i++){
$sql = " drop table `yascmf_articles_". $i."`";
$mysqli ->query($sql);
$sql = "CREATE TABLE `yascmf_articles_".$i."` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`title` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '标题',
`flag` varchar(50) CHARACTER SET utf8 DEFAULT '' COMMENT '推荐位',
`slug` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '网址缩略名，文章、单页与碎片模型有缩略名',
`cid` int(10) unsigned DEFAULT '0' COMMENT '分类id：文章分类id不为0，单页与碎片分类id默认为0',
`sub_cid` int(10) unsigned DEFAULT '0' COMMENT '二级分类id：文章分类id不为0，单页与碎片分类id默认为0',
`in_cid` int(10) unsigned DEFAULT '0' COMMENT '此分博客分类id：文章分类id不为0，单页与碎片分类id默认为0',
`in_sub_cid` int(10) unsigned DEFAULT '0' COMMENT '此分博客二级分类id：文章分类id不为0，单页与碎片分类id默认为0',
`description` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '内容摘要',
`content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '文章正文',
`created_at` datetime DEFAULT CURRENT_TIMESTAMP,
`updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
`uid` bigint(20) unsigned NOT NULL DEFAULT '0',
`author_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `content_slug_unique` (`slug`),
KEY `title` (`title`),
KEY `flag` (`flag`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

echo $sql;
$ret = $mysqli ->query($sql);
var_dump($ret);
}
**/




for($i =0;$i<10;$i++){
    $sql = " drop table `yascmf_articles_user_". $i."`";
    $mysqli ->query($sql);
    $sql = "CREATE TABLE `yascmf_articles_user_".$i."` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`uid` bigint(20) unsigned NOT NULL DEFAULT '0',
`cid` int(10) unsigned DEFAULT '0' COMMENT '分类id：文章分类id不为0，单页与碎片分类id默认为0',
`slug` int(10) unsigned DEFAULT '0' COMMENT '文章slug',
`description` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '内容摘要',
`created_at` datetime DEFAULT CURRENT_TIMESTAMP,
`updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

    echo $sql;
    $ret = $mysqli ->query($sql);
    var_dump($ret);
}


/**    $sql = " drop table `yascmf_articles_201804";
    $mysqli ->query($sql);
    $sql = "CREATE TABLE `yascmf_articles_201804`(
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`uid` bigint(20) unsigned NOT NULL DEFAULT '0',
`slug` int(10) unsigned DEFAULT '0' COMMENT '文章slug',
`description` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '内容摘要',
`created_at` datetime DEFAULT CURRENT_TIMESTAMP,
`updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

    echo $sql;
    $ret = $mysqli ->query($sql);
    var_dump($ret); ***/

/***$sql = "select * from ap_user_medal limit 100";
$ret = $mysqli->query($sql);
$uid = 88894938;
while ($arr = $ret->fetch_assoc()){
    $target_id = $arr['uid'];
    $medal_id =  $arr['id'];
    $sql = "insert into `ap_user_deleted_medal_8`(`uid`,`target_id`,`medal_id`,`mirr_level`)
           values($uid, $target_id, $medal_id, 10)";
    $ret1 = $mysqli ->query($sql);
    var_dump($ret1);
} ***/
/**for($i =0;$i<100;$i++){
$sql = " alter table `ap_user_medal_intimacy_log_".$i."` add column `description` varchar(45) DEFAULT '' COMMENT '亲密增加详细情况'";
echo $sql;
$ret = $mysqli ->query($sql);
var_dump($ret);
} **/
