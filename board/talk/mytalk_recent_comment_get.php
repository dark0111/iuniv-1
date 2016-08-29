<?
include('./_common.php');
include('./mytalk_config.php');

// 페이지 번호 초기화
if (!is_numeric($page)) $page = 1; else $page = (int)$page;

$page_size = 10; //$g4['talk_comment_page_size'];

if (isset($my_comment))
    $sql_my_comment = "mb_id='{$current['mb_id']}'";
else
    $sql_my_comment = "t_id='{$t_id}'";

// 댓글 페이징징징징
$total_post = sql_fetch("select count(*) as cnt from {$g4['talk_comment_table']} where {$sql_my_comment}");
$total_post = $total_post['cnt'];
$total_page = (int)($total_post/$page_size) + ($total_post%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );

$paging = get_paging(10, $page, $total_page, "javascript:void(talk_recent_comment(*"); 
if (isset($my_comment))
    $paging = preg_replace("/([^\*]+)\*([0-9]+)/", "$1$2,1));", $paging);
else
    $paging = preg_replace("/([^\*]+)\*([0-9]+)/", "$1$2));", $paging);

$sql = "select * from {$g4['talk_comment_table']} where {$sql_my_comment} order by num desc limit {$page_start}, {$page_size}";
$qry = sql_query($sql, false);
if (!$qry) 
    err_xml('토크 댓글 정보를 가져오지 못했습니다');

// 수줍은 xml
$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
$xml .= "<channel>\n";
$xml .= "<errnum>0</errnum>\n";
$xml .= "<errmsg><![CDATA[정상]]></errmsg>\n";
$xml .= "<paging><![CDATA[{$paging}]]></paging>\n";


// go go go
while ($res = sql_fetch_array($qry)) {

    extract($res);

    $res2 = sql_fetch("select id, mb_id from {$g4['talk_info_table']} where mb_id='{$mb_id}'");
    if (!empty($res2)) {
        $mb_id = $res2['mb_id'];
        $name  = "<a href='mytalk.php?t_id={$res2['id']}' class='talk_comment_name_link'>{$name}</a>";
    }

    $content = get_talk($content);

    if ($secret!=0) {
        if ($member['mb_id']!=$current['mb_id']) {
            if ($mb_id!=$member['mb_id'])
                $content = "비공개 댓글입니다.";
            else
                $content .= $g4['talk_secret_2_message'];
        } else {
            $content .= $g4['talk_secret_2_message'];
        }
    }

    //$regdate = date('Y년 n월 d일 g시 i분', strtotime($regdate));
    $regdate = date('Y-m-d H:i', strtotime($regdate));

    $regdate = "<a href=\"mytalk.php?t_id={$t_id}&id={$id}\">{$regdate}</a>";

    if ($member['mb_id']==$mb_id||$is_admin) $permission = 1; else $permission = 0;

    $image = "{$g4['path']}/data/talk/profile_image/{$mb_id}";
    if (!file_exists($image)){
        if($member[mb_sex]=="F"){//이미지 학교별 세팅
			$image="../../css/img/tools/user_female";
		}elseif($member[mb_sex]=="M"){
			$image="../../css/img/tools/user_male";
		}else{
			$image="../../css/img/tools/user_anymore";
		}
		if($member[mb_1]=="82"){
			$image.="2";
		}
		$image.=".png";
	}
    $image .= "?".time();

    $xml .= "<item>\n";
    $xml .= "<id>{$id}</id>\n";
    $xml .= "<num>{$num}</num>\n";
    $xml .= "<image><![CDATA[{$image}]]></image>\n";
    $xml .= "<name><![CDATA[{$name}]]></name>\n";
    $xml .= "<content><![CDATA[{$content}]]></content>\n";
    $xml .= "<regdate><![CDATA[{$regdate}]]></regdate>\n";
    $xml .= "</item>\n";
}
$xml .= "</channel>\n";

// 알럽~ euckr
if (strtoupper($g4['charset'])!='UTF-8') 
    $xml = convert_charset('CP949','UTF-8',$xml);

header("Content-Type:text/xml;"); // xml 머리
echo $xml;
?>