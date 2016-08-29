<?
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");
$g4[title] = "토크 회원관리";

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

include_once("../admin.head.php");

$colspan = 9;
$page_size = 15;

// 페이지 번호 초기화
if( empty($page) )
    $page = 1;
else
    $page = (int)$page;

$total_blog = sql_fetch("select count(*) as cnt from {$g4['talk_info_table']}");
$total_blog = $total_blog['cnt'];
$total_page = (int)($total_blog/$page_size) + ($total_blog%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );


// 페이징 가져오기
$paging = get_paging($page_size, $page, $total_page, "?page=");


$qry = sql_query("select * from {$g4['talk_info_table']} order by id desc limit {$page_start}, {$page_size}");
?>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<form name=form method=post action='javascript:fconfigform_submit(document.fconfigform);'>
<tr>
    <td align=left><?=subtitle("토크 회원관리")?></td>
</tr>
</table>



<table border=0 cellpadding=0 cellspacing=1 width=100% align=center>
<tbody align=center>
<tr><td colspan='<?=$colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td width=80> 아이디 </td>
    <td width=120> 별명 </td>
    <td> 토크 설명 </td>
    <td width=50> 글수 </td>
    <td width=50> 댓글수 </td>
    <td width=60> 친구수 </td>
    <td width=80> 업데이트 </td>
    <td width=80> 생성날짜 </td>
    <td width=30> - </td>
</tr>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>

<?
for($i=0; $res = sql_fetch_array($qry); $i++) {
    $talk_url = "{$g4['path']}/talk/mytalk.php?t_id={$res['id']}";
    $list = $i%2;
    $res['talk_name'] = cut_str($res['talk_name'],30);

    $res2 = sql_fetch("select * from {$g4['member_table']} where mb_id='{$res['mb_id']}'");
?>

<tr class='list<?=$list?> col1 ht center'>
    <td> <?=$res['mb_id']?> </td>
    <td> <?=get_sideview($res['mb_id'], $res2['mb_nick'])?> </td>
    <td align="left"> <a href="<?=$talk_url?>" target="_blank"><?=cut_str($res['talk_about'],20)?></a> </td>
    <td> <?=$res['post_count']?> </td>
    <td> <?=$res['comment_count']?> </td>
    <td> <?=$res['friends_count']?> </td>
    <td> <?=substr($res['last_update'],0,10)?> </td>
    <td> <?=substr($res['regdate'],0,10)?> </td>
    <td> <a href="javascript:del('talk_update.php?mode=delete&t_id=<?=$res['id']?>')"><img src="../img/icon_delete.gif" border=0></a> </td>

<?
}
?>
<tr><td colspan='<?=$colspan?>' class='line2'></td></tr>
</table>

<p align=center>
<?=$paging?>
</p>

<?
include_once("../admin.tail.php");
?>