<?
include_once("./_common.php");
include_once("./mytalk_config.php");

// 특수문자 변환
function specialchars_replace($str, $len=0) {
    if ($len) 
        $str = substr($str, 0, $len);

    $str = preg_replace("/&/", "&amp;", $str);
    $str = preg_replace("/</", "&lt;", $str);
    $str = preg_replace("/>/", "&gt;", $str);
    return $str;
}

if (!$g4['rss_open']) 
    alert('RSS가 공개되지 않았습니다.');

header("Content-Type:text/xml;");
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache");   

echo "<?xml version=\"1.0\" encoding=\"{$g4['charset']}\"?>\n";
echo "<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">\n";
echo "<channel>\n";
echo "<title>".specialchars_replace($current['talk_name'])."</title>\n";
echo "<link>".specialchars_replace($current['talk_full_url'])."</link>\n";
echo "<description>".specialchars_replace($current['talk_about'])."</description>\n";
echo "<language>ko</language>\n";

if (file_exists($current['profile_image_path'])) 
{
    $size = getImageSize($current['profile_image_path']);
    echo "<image>\n";
    echo "<title><![CDATA[".specialchars_replace($current['blog_name'])."]]></title>\n";
    echo "<url><![CDATA[".specialchars_replace($current['profile_image_full_path'])."]]></url>\n";
    echo "<link><![CDATA[".specialchars_replace($current['talk_full_url'])."]]></link>\n";
    echo "<width>{$size[0]}</width>\n";
    echo "<height>{$size[1]}</height>\n";
    echo "<description><![CDATA[".specialchars_replace($current['talk_about'])."]]></description>\n";
    echo "</image>\n";
}

$qry = sql_query("select * from {$g4['talk_table']} where t_id='{$current['id']}' order by id desc limit 10");

for ($i=0; $res=sql_fetch_array($qry); $i++) {

    $regdate    = date('r', strtotime($res['regdate'].' '.$res['regtime']));
    $title      = date('Y년 m월 d일 H시 i분', strtotime($date));
    $link       = "{$current['talk_full_url']}&id={$res['id']}";
    $content    = get_talk($res['content']);
    $category   = sql_fetch("select name from {$g4['talk_category_table']} where id='{$res['c_id']}'");

    echo "<item>\n";
    echo "<title><![CDATA[".specialchars_replace($title)."]]></title>\n";
    echo "<link><![CDATA[".specialchars_replace($link)."]]></link>\n";
    echo "<description><![CDATA[{$content}]]></description>\n";
    echo "<category><![CDATA[".specialchars_replace($category['name'])."]]></category>\n";
    echo "<author><![CDATA[".specialchars_replace($current['talk_name'])."]]></author>\n";
    echo "<pubDate><![CDATA[{$regdate}]]></pubDate>\n";
    echo "</item>\n";
}

echo "</channel>\n";
echo "</rss>\n";
?>