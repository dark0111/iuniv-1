<?
include('./_common.php');
include('./config.php');

// 페이지 번호 초기화
if (!is_numeric($page)) $page = 1; else $page = (int)$page;

// 역시 한글 짱
$week_array = array(1=>'월요일',2=>'화요일',3=>'수요일',4=>'목요일',5=>'금요일',6=>'토요일',0=>'일요일'); 
$noon_array = array('am'=>'오전','pm'=>'오후'); 

$page_size = 10;//$g4['talk_page_size'];

// 다녀간 사람들 페이징징징징
$total_post = sql_fetch("select count(*) as cnt from {$g4['talk_visit_table']} where t_id='{$t_id}'");
$total_post = $total_post['cnt'];
$total_page = (int)($total_post/$page_size) + ($total_post%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );

$paging = get_paging(10, $page, $total_page, "javascript:void(talk_visitor(*"); 
$paging = preg_replace("/([^\*]+)\*([0-9]+)/", "$1$2));", $paging);

$sql = "select * from {$g4['talk_visit_table']} where t_id='{$t_id}' order by visit_date desc, visit_time desc limit {$page_start}, {$page_size}";
$qry = sql_query($sql, false);
if (!$qry) 
    err_xml('토크 다녀간 사람들 정보를 가져오지 못했습니다');

// 수줍은 xml
$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
$xml .= "<channel>\n";
$xml .= "<errnum>0</errnum>\n";
$xml .= "<errmsg><![CDATA[정상]]></errmsg>\n";
$xml .= "<total>{$total_post}</total>\n";
$xml .= "<paging><![CDATA[{$paging}]]></paging>\n";

// go go go
while ($res = sql_fetch_array($qry)) {

    extract($res);

    $res2 = sql_fetch("select id, mb_id from {$g4['talk_info_table']} where id='{$visit_t_id}'");

    $image = "{$g4['path']}/data/talk/profile_image/{$res2['mb_id']}";
    if (!file_exists($image))
        $image = "{$gnutalk_skin_path}/img/profile.gif";

    $regdate = strtotime($visit_date.' '.$visit_time); // 아가씨
    $week = $week_array[date('w', $regdate)]; // 주말에 드라이브나?
    $date = date('Y년 n월 d일', $regdate); // 몇일?
    $time = date('g시 i분', $regdate); // 몇시??
    $noon = $noon_array[date('a', $regdate)]; // 오전? 오후??

    if ($member['mb_id']==$mb_id||$is_admin) $permission = 1; else $permission = 0;

    $xml .= "<item>\n";
    $xml .= "<visit_date><![CDATA[{$date}, {$week}]]></visit_date>\n";
    $xml .= "<visit_time><![CDATA[{$noon} {$time}]]></visit_time>\n";
    $xml .= "<visit_t_id><![CDATA[{$visit_t_id}]]></visit_t_id>\n";
    $xml .= "<visit_name><![CDATA[{$visit_name}]]></visit_name>\n";
    $xml .= "<visit_image><![CDATA[{$image}]]></visit_image>\n";
    $xml .= "</item>\n";
}
$xml .= "</channel>\n";

// 알럽~ euckr
if (strtoupper($g4['charset'])!='UTF-8') 
    $xml = convert_charset('CP949','UTF-8',$xml);

header("Content-Type:text/xml;"); // xml 머리
echo $xml;
?>