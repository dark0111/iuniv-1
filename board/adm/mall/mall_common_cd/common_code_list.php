<?
include_once("../define_path.php");
// 공통코드 상위코드목록
$common_cd_sql = "select com_cd, post_cd, cd_value, cd_value2, cd_exp, use_yn from $_table[common_cd] where post_cd='top'";
$common_cd_ds = mysql_query($common_cd_sql, $connection) or die("공통코드 Query error");

?>
<script language='javascript'>
function onclick_code(post_cd){
	//alert(post_cd);
document.frm_common_cd.post_cd.value=post_cd;
document.frm_common_cd.submit();
}
</script>
상위코드
<table id='common_list' cellpadding='0' cellspacing='1' border='0' width='100%' bgcolor="#e2e2e2">
	<tr height='25' align='center'  bgcolor="#eeeeee">
		<td width='15%'>코드명</td>
		<td width='15%'>상위코드</td>
		<td width='20%'>코드값</td>
		<td width='10%'>코드값[보조]</td>
		<td width='30%'>설명</td>
		<td width='10%'>사용유무</td>
	</tr>
<?
while($common_cd_rows = mysql_fetch_array($common_cd_ds)){
?>
	<tr height='23' align='center'  bgcolor="#ffffff">
		<td><a onclick='javascript:onclick_code("<?=$common_cd_rows[com_cd]?>");' style='cursor:pointer;'><b><?=$common_cd_rows[com_cd]?></b></a></td>
		<td><?=$common_cd_rows[post_cd]?></td>
		<td><?=$common_cd_rows[cd_value]?></td>
		<td><?=$common_cd_rows[cd_value2]?></td>
		<td><?=$common_cd_rows[cd_exp]?></td>
		<td><?=$common_cd_rows[use_yn]?></td>
	</tr>
<?		
}
?>
</table>
<br>
<hr>
<br>
<?
// 공통코드 하위코드목록
$where_str =  "post_cd='$post_cd'";
$common_cd_sql2 = "select com_cd, post_cd, cd_value, cd_value2, cd_exp, use_yn from $_table[common_cd] where $where_str";
//echo $common_cd_sql2;
$common_cd_ds2 = mysql_query($common_cd_sql2, $connection) or die("공통코드-하위 Query error");
//echo count($common_cd_ds2);
?>
하위코드
<table id='common_list' cellpadding='0' cellspacing='1' border='0' width='100%' bgcolor="#e2e2e2">
	<tr height='25' align='center'  bgcolor="#eeeeee">
		<td width='15%'>코드명</td>
		<td width='35%'>코드값</td>
		<td width='10%'>코드값[보조]</td>
		<td width='30%'>설명</td>
		<td width='10%'>사용유무</td>
	</tr>
<?
$i=0;
while($common_cd_rows2 = mysql_fetch_array($common_cd_ds2)){

?>
	<tr height='23' align='center'  bgcolor="#ffffff">
		<td><?=$common_cd_rows2[com_cd]?></td>
		<td><?=$common_cd_rows2[cd_value]?></td>
		<td><?=$common_cd_rows2[cd_value2]?></td>
		<td><?=$common_cd_rows2[cd_exp]?></td>
		<td><?=$common_cd_rows2[use_yn]?></td>
	</tr>
<?
	$i++;
}
?>
</table>
<form name='frm_common_cd' method='post'>
<input type='hidden' name='post_cd'>
</form>