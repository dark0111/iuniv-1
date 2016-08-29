<?
//////////////////////////////////////////////////////////////////////////////////////////////////////
if($_SESSION[ss_mb_id]=='admin'||$_SESSION[ss_mb_id]=='parkng5'||$_SESSION[ss_mb_id]=='dark0111'){
//개발동안 관리자만 보이게 묵기	/////////////////////////////////////////////////////////////////////

			
if(!$page)
{
	$page=1;
}
if(!isset($rs_list))
{
	$rs_list = new recordset($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table[product]);
	$rs_list->add_where("no={$cate_no}");
}
$gque = "select * from $_table[product] where ccn='$cate_no'";
$gres = mysql_Query($gque, $connection) or die('gque error');
//echo $gque;

$categoryLoadQuery = "select no, scn, wcn, cate_name, cate_info from $categorySQL where no='$cate_no' and use_yn='Y'";
$categoryLoadSQL = mysql_query($categoryLoadQuery, $connection) or die("categoryLoadQuery error");
$categoryLoadFetch = mysql_fetch_array($categoryLoadSQL);
$category_Value = $categoryLoadFetch[extend_cate_name];

$PNO = $cate_no;

if($categoryLoadFetch[wcn]>2) {
	$no = $categoryLoadFetch[scn];
}

if($sno) {

	$sCateQuery = "select no, scn, wcn, cate_name, cate_info from $categorySQL where no='$sno' and use_yn='Y'";
	$sCateSQL = mysql_query($sCateQuery, $connection) or die("sCateQuery error");
	$sCateFetch = mysql_fetch_array($sCateSQL);
	$category_Value = $sCateFetch[extend_cate_name];
	$PNO = $sno;

}

?>
<table border=0 cellpadding=0 cellspacing=1 width=100%>
	<tr>
		<td><a href='/' class='user_category_value'>홈</a> > 장터 > <?=cate_code_to_list($cate_no)?></td>
	</tr>
<tr>
<?

for($g=0;$grow=mysql_fetch_array($gres);$g++){	
?>
	<td width=50% align=center>
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
			<td align=center><a href='<?=$dark_define[site_url]?>/board/index.php?mode=mall_goods_show&goods_no=<?=$grow[product_code]?>&cate_no=<?=$cate_no?>'><img src='<?=$dark_define[site_url]?>/sub/mall/dark_mall_prt_img/280/<?=$grow[product_code]?>_1.jpg' width='180' height='180' border='0' onerror="this.src='<?=$dark_define[site_url]?>/sub/mall/dark_mall_prt_img/none/280.gif';" style='border:1 solid;border-color:#c4c4c4;'></a></td>
		</tr>
		<tr>
			<td align=center><?=$grow[product_name]?></td>
		</tr>
		<tr>
			<td align=center><?=$grow[second_product_name]?></td>
		</tr>
		<tr>
			<td align=center><?=number_format($grow[price])?>"원</td>
		</tr>
		</table>
	</td>
<?
	if($g%2==0 && $g!=0)
	{
?>
</tr>
<tr><td height=15></td></tr>
<tr>
<?
	}
	
}

?>

	
</tr>
	<tr>
		<td align="center" colspan=9>
			<?
			$page_info=$rs_list->select_list($page,20,10);			
			$paging=rg_navi_display($page_info,"mode=$mode&cate_no=$cate_no"); 
			echo"$paging";
			?>
		</td>
	</tr>
</table>
<?
////////////////////////////////////////////////////////////////////////////////////개발단계 봉인
}else{
	echo "<img src='$site_url/image/update_ready.JPG' border=0>";
}
/////////////////////////////////////////////////////////////////////////////////////
?>