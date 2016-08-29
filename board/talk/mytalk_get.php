<?
include('./_common.php');
include('./mytalk_config.php');

// 페이지 번호 초기화
if (empty($page)) $page = 1; else $page = (int)$page;

// 역시 한글 짱
$week_array = array(1=>'월요일',2=>'화요일',3=>'수요일',4=>'목요일',5=>'금요일',6=>'토요일',0=>'일요일'); 
$noon_array = array('am'=>'오전','pm'=>'오후'); 

$page_size = $g4['talk_page_size'];

// 토크 하나만 보여줄 때
if ($id) $sql_id = "and id='{$id}'";

// 토크 보여주는 권한 설정
if ($member['mb_id']==$current['mb_id'])  { // 나 자신일 경우

    $sql_secret = "";

} elseif ($member['mb_id']) { // 로그인한 회원일 경우

    // 접근자의 토크 고유번호 구함
    $res = sql_fetch("select id from {$g4['talk_info_table']} where mb_id='{$member['mb_id']}'");
    $visit_t_id = $res['id'];

    // 접근자의 토크 고유번호로 친구인지 검사
    $res = sql_fetch("select * from {$g4['talk_friends_table']} where t_id='{$current['id']}' and friends_t_id='{$visit_t_id}'");
    if (!empty($res)) 
        $is_my_friends = true;

    // 친구이면 공개/친구공개 토크를 보여줌
    if ($is_my_friends) 
        $sql_secret = " and secret<2 ";

    // 친구가 아니면 공개 토크만 보여줌
    else
        $sql_secret = " and secret=0 ";

} else {

    // 비회원일 경우 공개 토크만 보여줌
    $sql_secret = " and secret=0 ";
}

$total_post = sql_fetch("select count(*) as cnt from {$g4['talk_table']} where t_id='{$t_id}' {$sql_id} {$sql_secret}");
if (empty($total_post)) 
    err_xml('토크 정보를 가져오지 못했습니다');

$total_post = $total_post['cnt'];
$total_page = (int)($total_post/$page_size) + ($total_post%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );

$paging = get_paging(10, $page, $total_page, "mytalk.php?t_id={$t_id}&page="); 

$sql = "select * from {$g4['talk_table']} where t_id='{$t_id}' {$sql_id} {$sql_secret} order by id desc limit {$page_start}, {$page_size}";
$qry = sql_query($sql, false);
if (!$qry) 
    err_xml('토크 정보를 가져오지 못했습니다');

// 수정 or 삭제 권한은 나랑 최고관리자만.. 사귀나?
if ($member['mb_id']==$current['mb_id']||$is_admin) $permission = 1; else $permission = 0;

$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
$xml .= "<channel>\n";
$xml .= "<errnum>0</errnum>\n";
$xml .= "<errmsg><![CDATA[정상]]></errmsg>\n";
$xml .= "<permission>{$permission}</permission>\n";

while ($res = sql_fetch_array($qry)) {

    extract($res);

    $content = get_talk($content); // 말 걸어보세

    $regdate = strtotime($regdate.' '.$regtime); // 아가씨
    $week = $week_array[date('w', $regdate)]; // 주말에 드라이브나?
    $date = date('Y년 n월 d일', $regdate); // 몇일?
    $time = date('g시 i분', $regdate); // 몇시??
    $noon = $noon_array[date('a', $regdate)]; // 오전? 오후??

    switch($secret) {
        case 1: $content .= $g4['talk_secret_1_message']; break;
        case 2: $content .= $g4['talk_secret_2_message']; break;
    }

    $xml .= "<item>\n";
    $xml .= "<id><![CDATA[{$id}]]></id>\n";
    $xml .= "<c_id><![CDATA[{$c_id}]]></c_id>\n";
    $xml .= "<t_id><![CDATA[{$t_id}]]></t_id>\n";
    $xml .= "<name><![CDATA[{$name}]]></name>\n";
    $xml .= "<content><![CDATA[{$content}]]></content>\n";
    $xml .= "<comment_count><![CDATA[{$comment_count}]]></comment_count>\n";
    $xml .= "<vote><![CDATA[{$vote}]]></vote>\n";
    $xml .= "<date><![CDATA[{$date}]]></date>\n";
    $xml .= "<time><![CDATA[{$time}]]></time>\n";
    $xml .= "<noon><![CDATA[{$noon}]]></noon>\n";
    $xml .= "<week><![CDATA[{$week}]]></week>\n";
    $xml .= "<page><![CDATA[{$paging}]]></page>\n";
    $xml .= "</item>\n";
}
$xml .= "</channel>\n";

// 한글은 고조 euckr 로..
if (strtoupper($g4['charset'])!='UTF-8') 
    $xml = convert_charset('CP949','UTF-8',$xml);

header("Content-Type:text/xml;");
echo $xml;
?>