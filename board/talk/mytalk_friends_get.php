<?
include('./_common.php');
include('./mytalk_config.php');

// 페이지 번호 초기화
if (!is_numeric($page)) $page = 1; else $page = (int)$page;

// 역시 한글 짱
$week_array = array(1=>'월요일',2=>'화요일',3=>'수요일',4=>'목요일',5=>'금요일',6=>'토요일',0=>'일요일'); 
$noon_array = array('am'=>'오전','pm'=>'오후'); 

$page_size = 10;//$g4['talk_page_size'];

if (isset($to_me))
    $sql_to_me = "friends_t_id";
else
    $sql_to_me = "t_id";

$total_post = sql_fetch("select count(*) as cnt from {$g4['talk_friends_table']} where {$sql_to_me}='{$t_id}'");
if (empty($total_post)) 
    err_xml('친구 정보를 가져오지 못했습니다');

$total_post = $total_post['cnt'];
$total_page = (int)($total_post/$page_size) + ($total_post%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );

$paging = get_paging(10, $page, $total_page, "javascript:void(talk_friends_get_content(*"); 
if (isset($to_me))
    $paging = preg_replace("/([^\*]+)\*([0-9]+)/", "$1$2,1));", $paging);
else
    $paging = preg_replace("/([^\*]+)\*([0-9]+)/", "$1$2));", $paging);

if (isset($to_me))
    $sql = "select * from {$g4['talk_friends_table']} where {$sql_to_me}='{$t_id}' order by regdate desc limit {$page_start}, {$page_size}";
else
    $sql = "select * from {$g4['talk_friends_table']} where {$sql_to_me}='{$t_id}' order by last_update desc limit {$page_start}, {$page_size}";
$qry = sql_query($sql, false);
if (!$qry) 
    err_xml('친구 정보를 가져오지 못했습니다');

if ($member['mb_id']==$current['mb_id']||$is_admin) $permission = 1; else $permission = 0;

$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
$xml .= "<channel>\n";
$xml .= "<errnum>0</errnum>\n";
$xml .= "<errmsg><![CDATA[정상]]></errmsg>\n";
$xml .= "<paging><![CDATA[{$paging}]]></paging>\n";
$xml .= "<permission>{$permission}</permission>\n";

while ($res = sql_fetch_array($qry)) {

    $res2 = sql_fetch("select mb_id from {$g4['talk_info_table']} where id='{$res['friends_t_id']}'");

    if ($member['mb_id']==$res2['mb_id'])
        $sql_secret = " and secret < 2 ";
    else
        $sql_secret = " and secret = 0 ";

    if (isset($to_me))
        $res2 = sql_fetch("select * from {$g4['talk_table']} where t_id='{$res['t_id']}' {$sql_secret} order by id desc limit 1");
    else
        $res2 = sql_fetch("select * from {$g4['talk_table']} where t_id='{$res['friends_t_id']}' {$sql_secret} order by id desc limit 1");

    if (is_array($res2))
        @extract($res2);

    $res3 = sql_fetch("select mb_id from {$g4['talk_info_table']} where id='{$t_id}'");
    $mb_id = $res3['mb_id'];

    $res3 = sql_fetch("select mb_nick from {$g4['member_table']} where mb_id='{$mb_id}'");
    $name = $res3['mb_nick'];

    $name = "<a href='mytalk.php?t_id={$t_id}' class='talk_comment_name_link'>{$name}</a>";

    $image = "{$g4['path']}/data/talk/profile_image/{$mb_id}";
    if (!file_exists($image)) 
        $image = "{$gnutalk_skin_path}/img/profile.gif";
    $image .= "?".time();

    $content = get_talk($content); // 말 걸어보세

    $regdate = strtotime($regdate.' '.$regtime); // 아가씨
    $week = $week_array[date('w', $regdate)]; // 주말에 드라이브나?
    $date = date('Y년 n월 d일', $regdate); // 몇일?
    $time = date('g시 i분', $regdate); // 몇시??
    $noon = $noon_array[date('a', $regdate)]; // 오전? 오후??

    $xml .= "<item>\n";
    $xml .= "<id><![CDATA[{$id}]]></id>\n";
    $xml .= "<c_id><![CDATA[{$c_id}]]></c_id>\n";
    $xml .= "<t_id><![CDATA[{$t_id}]]></t_id>\n";
    $xml .= "<mb_id><![CDATA[{$mb_id}]]></mb_id>\n";
    $xml .= "<name><![CDATA[{$name}]]></name>\n";
    $xml .= "<image><![CDATA[{$image}]]></image>\n";
    $xml .= "<content><![CDATA[{$content}]]></content>\n";
    $xml .= "<comment_count><![CDATA[{$comment_count}]]></comment_count>\n";
    $xml .= "<vote><![CDATA[{$vote}]]></vote>\n";
    $xml .= "<date><![CDATA[{$date}]]></date>\n";
    $xml .= "<time><![CDATA[{$time}]]></time>\n";
    $xml .= "<noon><![CDATA[{$noon}]]></noon>\n";
    $xml .= "<week><![CDATA[{$week}]]></week>\n";
    $xml .= "</item>\n";
}
$xml .= "</channel>\n";

// 한글은 고조 euckr 로..
if (strtoupper($g4['charset'])!='UTF-8') 
    $xml = convert_charset('CP949','UTF-8',$xml);

header("Content-Type:text/xml;");
echo $xml;
?>