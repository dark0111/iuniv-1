<?
session_start();
include "../../../include/dbcon.php";
IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) {

if(!$page) { $page=1; }
if(!$limit) { $limit=50;}
if(!$row_list) { $row_list=10;}
$first = $limit*($page-1);
$last = $limit*$page;
$no = $total_record - $first;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<title>회원(고객)관리</title>
	<link rel="STYLESHEET" type="text/css" href="../../../style/style.css">

	<script language="javascript">
	function page(_phpself, page, limit) {
		location.href=_phpself+"?page="+page+"&limit="+limit+"&q=<?=$q?>";
	}
	
	function Addmember() {
		location.href="_member_add.php?page=<?=$page?>&limit=<?=$limit?>";
	}
	
	function SearchResult() {
		if(!SearchForm.q.value) {
		alert("검색어를 입력하십시오.        ");
		SearchForm.q.focus();
		return false;
		}
		SearchForm.action="_list.php?page=<?=$page?>&limit=<?=$limit?>";
	}

	function member_view(no) {
		location.href="_member_view.php?no="+no+"&page=<?=$page?>&limit=<?=$limit?>&q=<?=$q?>";
	}

	</script>
</head>

<body>

<table border=0 cellpadding=0 cellspacing=1 bgcolor="#ffffff" width=790>
<tr bgcolor="#eeeeee" height=25 align=center>
<td width=70 class="pg_title">번호</td>
<td width=80 class="pg_title">이름</td>
<td width=300 class="pg_title">주소</td>
<td width=140 class="pg_title">이메일</td>
<td width=100 class="pg_title">휴대폰</td>
<td width=100 class="pg_title">등록일</td>
</tr>

<tr>
<td colspan=6 align=center height=1 bgcolor="#c4c4c4"><img width=0 height=1></td>
</tr>

<?

if($q) {
	$qExtendQuery = " where name like '%$q%' or email like '%$q%' or add_1 like '%$q%'";
} else {
	$qExtendQuery = "";
}

$CountQuery = "select count(no) as no from $memberSQL".$qExtendQuery;
$CountSQL = mysql_query($CountQuery, $connection) or die("CountQuery error");
$CountFetch = mysql_fetch_array($CountSQL);
$ResultNumRowsTotal = $CountFetch[0];

if(!strcmp($ResultNumRowsTotal,"0")) {
?>

<tr height=30>
<td align=center colspan=6>현재 등록된 회원이 없습니다</td>
</tr>
<tr>
<td colspan=6 align=center height=1 bgcolor="#c4c4c4"><img width=0 height=1></td>
</tr>

<?
}
$LoadQuery = "select * from $memberSQL ".$qExtendQuery." order by no asc limit $first, $limit ";
$LoadSQL = mysql_query($LoadQuery, $connection) or die("ProductLoadQuery error");

if ($page>1) { $NumPrint = $ResultNumRowsTotal - $first; } else { $NumPrint = $ResultNumRowsTotal; } $NumPrint = $NumPrint + 1;
for($i=0;$i<$limit;$i++) {
	$NumPrint = $NumPrint - 1;	
	$LoadFetch = mysql_fetch_array($LoadSQL);
	if($LoadFetch[0]) {
	?>

		<tr height=22>
		<td align=center><?=$NumPrint?></td>
		<td align=center><a href="javascript:member_view('<?=$LoadFetch[no]?>')"><?=str_replace($q,"<strong>".$q."</strong>",$LoadFetch[name])?></a></td>
		<td align=left><?=str_replace($q,"<strong>".$q."</strong>",$LoadFetch[add_1])?> <?=str_replace($q,"<strong>".$q."</strong>",$LoadFetch[add_2])?></td>
		<td class="email_value" align=center><?=str_replace($q,"<strong>".$q."</strong>",$LoadFetch[email])?></td>
		<td align=center class="callphone_value"><?="0".$LoadFetch[hp]?></td>
		<td align=center>
		<span class="date_value"><?=substr($LoadFetch[date],0,10)?></span>
		<br>
		<span class="ip_value"><?=$LoadFetch[ip]?></span>
		</td>
		</tr>
		<tr>
		<td colspan=6 align=center height=1 bgcolor="#c4c4c4"><img width=0 height=1></td>
		</tr>

	<?
	}
}
?>
</table>


<!-- 쪽번호의 시작 -->
<table border=0 cellpadding=0 cellspacing=0 align=center>
<tr>
<?
$total_page = ceil($ResultNumRowsTotal/$limit);
$total_block = ceil($total_page/$row_list);
$block = ceil($page/$row_list);
$first_page=($block-1)*$row_list;

$last_page=$block*$row_list;

$prev = $first_page;
$next = $last_page+1;
$go_page = $first_page+1;
if($total_block <= $block) {$last_page=$total_page;}
?>

<?if($block > 1) {?>
<td style="padding:10 6 0 6"><a href="javascript:page('<?=$PHP_SELF?>', '1', '<?=$limit?>')" class="normal_page">처음페이지</a> ... </td>
<td style="padding:10 5 0 0"><a href="javascript:page('<?=$PHP_SELF?>', '<?=$prev?>', '<?=$limit?>')" class="normal_page">이전10개</a></td>
<?}?>
<?for($go_page; $go_page <= $last_page; $go_page++){  ?>

	<?if($page == $go_page) {?>
	<td style="padding:10 6 0 6"><span class="select_page_number"><?=$go_page?></span></td>
	<?} else  {?>
	<td style="padding:10 6 0 6"><a href="javascript:page('<?=$PHP_SELF?>', '<?=$go_page?>', '<?=$limit?>')" class="page_number"><?=$go_page?></a></td>
	<?}?>
<?}?>

<?if($block < $total_block){?>
<td style="padding:10 0 0 5"><a href="javascript:page('<?=$PHP_SELF?>', '<?=$next?>', '<?=$limit?>')" class="normal_page">다음10개</a></td>
<td style="padding:10 6 0 6"> ... <a href="javascript:page('<?=$PHP_SELF?>', '<?=$total_page?>', '<?=$limit?>')" class="normal_page">마지막페이지</a> </td>
<?}?>

</tr>
</table>
<!--/ 쪽번호의 끝 -->

<hr size=1 color="#ffffff">

<table border=0 cellpadding=0 cellspacing=0 width=790>
<tr><td align=right>
	<table border=0 cellpadding=2 cellspacing=0>
	<tr>
	<form name="SearchForm" method="post" onsubmit="return SearchResult()">
	<input type="hidden" name="page" value="<?=$page?>">
	<input type="hidden" name="limit" value="<?=$limit?>">
	<td><input type="text" name="q" size=30 maxlength=20 value="<?=$q?>"></td>
	<td><input type="image" src="../../image/more/member_search.gif" width="75" height="21" border="0"></td>
	</form>
	
	<?
	if($q) {
	?>
	
	<td><a href="_list.php"><img src="../../image/more/search_end.gif" width="75" height="21" border="0"></a></td>
	
	<?
	}
	?>
	
	<td><a href="javascript:Addmember()"><img src="../../image/more/member_add.gif" width="96" height="21" border="0"></a></td>
	</tr>
	</table>
</td></tr>
</table>
</body>
</html>
<script>
self.resizeTo(document.body.scrollWidth,document.body.scrollHeight); 
</script>

<?
} ELSE {
?>
	<script language="javascript">
	location.href="/admin/";
	</script>
<?
}
?>

<?
mysql_close($connection);
?>
