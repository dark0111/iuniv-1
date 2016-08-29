<?
include_once("./_common.php");

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.", $g4[path]);

$g4[title] = "토크 업그레이드";

include_once("../admin.head.php");

if (!is_writeable("../../extend")) 
    echo "<p><font color=red><b>extend 디렉토리의 퍼미션을 707로 변경하여 주십시오.<br><br>$> chmod 707 extend <br><br>그 다음 설정을 시도해 주십시오.</b></font></p>";

sql_query("CREATE TABLE `{$g4['talk_table']}` (  `id` int(11) NOT NULL auto_increment,  `c_id` int(11) NOT NULL default '0',  `t_id` int(11) NOT NULL default '0',  `secret` tinyint(4) NOT NULL default '0',  `name` varchar(30) NOT NULL default '',  `content` tinytext NOT NULL,  `comment_count` int(11) NOT NULL default '0',  `vote` int(11) NOT NULL default '0',  `regdate` date NOT NULL default '0000-00-00',  `regtime` time NOT NULL default '00:00:00',  PRIMARY KEY  (`id`),  KEY `t_id` (`t_id`),  KEY `c_id` (`c_id`)) TYPE=MyISAM", false);
sql_query("CREATE TABLE `{$g4['talk_category_table']}` (  `id` int(11) NOT NULL auto_increment,  `name` varchar(255) NOT NULL default '',  `count` int(11) NOT NULL default '0',  `rank` tinyint(4) NOT NULL default '0',  PRIMARY KEY  (`id`),  KEY `name` (`name`),  KEY `rank` (`rank`)) TYPE=MyISAM", false);
sql_query("CREATE TABLE `{$g4['talk_comment_table']}` (  `t_id` int(11) NOT NULL default '0',  `id` int(11) NOT NULL default '0',  `num` int(11) NOT NULL auto_increment,  `mb_id` varchar(30) NOT NULL default '',  `name` varchar(30) NOT NULL default '',  `secret` tinyint(4) NOT NULL default '0',  `content` tinytext NOT NULL,  `regdate` datetime NOT NULL default '0000-00-00 00:00:00',  PRIMARY KEY  (`num`),  KEY `mb_id` (`mb_id`),  KEY `id` (`id`),  KEY `t_id` (`t_id`)) TYPE=MyISAM", false);
sql_query("CREATE TABLE `{$g4['talk_friends_table']}` (  `t_id` int(11) NOT NULL default '0',  `friends_t_id` int(11) NOT NULL default '0',  `last_update` datetime NOT NULL default '0000-00-00 00:00:00',  `regdate` datetime NOT NULL default '0000-00-00 00:00:00',  KEY `t_id` (`t_id`,`last_update`,`friends_t_id`)) TYPE=MyISAM", false);
sql_query("CREATE TABLE `{$g4['talk_info_table']}` (  `id` int(11) NOT NULL auto_increment,  `mb_id` varchar(30) NOT NULL default '',  `talk_about` varchar(255) NOT NULL default '',  `talk_open` tinyint(4) NOT NULL default '1',  `rss_open` tinyint(4) NOT NULL default '1',  `post_count` int(11) NOT NULL default '1',  `comment_count` int(11) NOT NULL default '0',  `friends_count` int(11) NOT NULL default '0',  `friends_to_me_count` int(11) NOT NULL default '0',  `today_count` int(11) NOT NULL default '0',  `total_count` int(11) NOT NULL default '0',  `last_update` datetime NOT NULL default '0000-00-00 00:00:00',  `regdate` datetime NOT NULL default '0000-00-00 00:00:00',  PRIMARY KEY  (`id`),  UNIQUE KEY `mb_id_2` (`mb_id`),  KEY `mb_id` (`mb_id`,`last_update`)) TYPE=MyISAM", false);
sql_query("CREATE TABLE `{$g4['talk_visit_table']}` (  `t_id` int(11) NOT NULL default '0',  `visit_date` date NOT NULL default '0000-00-00',  `visit_time` time NOT NULL default '00:00:00',  `visit_t_id` int(11) NOT NULL default '0',  `visit_name` varchar(255) NOT NULL default '',  KEY `t_id` (`t_id`,`visit_date`,`visit_time`)) TYPE=MyISAM", false);

/*
sql_query("ALTER TABLE `g4_talk` ADD `secret` TINYINT NOT NULL AFTER `t_id`", false);
sql_query("ALTER TABLE `g4_talk_comment` ADD `secret` TINYINT NOT NULL AFTER `name`", false);
sql_query("ALTER TABLE `g4_talk_info` ADD `friends_to_me_count` INT NOT NULL AFTER `friends_count`", false);
sql_query("ALTER TABLE `g4_talk_friends` ADD `regdate` DATETIME NOT NULL", false);
*/

echo "UPGRADE 완료.";

include_once("../admin.tail.php");
?>