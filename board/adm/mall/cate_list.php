<?
//session_start();
/* =====================================================
프로그램명 : dark builder V1
화일명 : cate_list.php (카테고리 상품 분류 관리)
작성일 :
작성자 : 유중현 ( http://gupanjang.net )
작성자 E-Mail : dark0111@dreamwiz.com
최종수정일 :


===================================================== */
include_once("./define_path.php");


?>

<script>

function CallMenu(mn, sn, loc) 
{
	if(sn) 
	{
		snv = "&sn="+sn;
	} 
	else 
	{
		snv = "";
	}
	
	if(loc) 
	{
		locv = "&loc="+loc;
	} 
	else 
	{
		locv = "";
	}
	
	location.href="./cate_list.php?mn=" + mn + snv + locv;
}

</script>

<?
//IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) 
if(1)
{
?>
<table border=0 cellpadding=0 cellspacing=0 width='100%'>
	<tr>
		<td height=20 colspan=17></td>
	</tr>


	<!-- 메뉴의 시작 -->
	<!-- <tr height=45>
		<td width="158"><a href="javascript:CallMenu('1', '1', 'category')"><img src="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/menu/menu1<?if(!STRCMP($mn,1)) { PRINT "s"; }?>.gif" width="158" height="45" border="0"></a></td>
		<td width=1></td>
		
		<td width="80"><a href="javascript:CallMenu('3', '', '')"><img src="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/menu/menu3<?if(!STRCMP($mn,3)) { PRINT "s"; }?>.gif" width="80" height="45" border="0"></a></td>
		<td width=1></td>
		<td width="81"><a href="javascript:CallMenu('4', '', '')"><img src="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/menu/menu4<?if(!STRCMP($mn,4)) { PRINT "s"; }?>.gif" width="81" height="45" border="0"></a></td>
		<td width=1></td>
		<td width="81"><a href="javascript:CallMenu('5', '', '')"><img src="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/menu/menu5<?if(!STRCMP($mn,5)) { PRINT "s"; }?>.gif" width="81" height="45" border="0"></a></td>
		<td width=1></td>
		<td width="81"><a href="javascript:CallMenu('6', '', '')"><img src="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/menu/menu6<?if(!STRCMP($mn,6)) { PRINT "s"; }?>.gif" width="81" height="45" border="0"></a></td>
		<td width=1></td>
		<td width="110"><a href="javascript:CallMenu('7', '', '')"><img src="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/menu/menu7<?if(!STRCMP($mn,7)) { PRINT "s"; }?>.gif" width="110" height="45" border="0"></a></td>
		<td width=1></td>
		<td width="89"><a href="javascript:CallMenu('8', '', '')"><img src="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/menu/menu8<?if(!STRCMP($mn,8)) { PRINT "s"; }?>.gif" width="89" height="45" border="0"></a></td>
		<td width=7></td>
	</tr> -->
	<!-- 메뉴의 종료 -->

	<tr>
		<td height=15 colspan=17></td>
	</tr>

	<tr>
		<td height=1 colspan=17 background="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/background/hr.gif"><img width=0 height=1></td>
	</tr>

	<tr>
		<td height=5 colspan=17></td>
	</tr>

	<tr>
		<td colspan=17 valign=top>
		<!-- 본문의 시작 -->

			<?
			IF($mn) 
			{ // mn의 값이 있을 경우 ../template/leftmenu.php 를 불러옵니다. // 서브 메뉴
				INCLUDE "./mall_template/left_menu.php";
			}
			ELSE 
			{ // mn의 값이 없을 경우 ../template/home.php 를 불러옵니다. // 메인 화면
				//INCLUDE "./mall_template/home.php";
				$mn=1;
				$sn=1;
				$loc="category";
				INCLUDE "./mall_template/left_menu.php";
			}
			?>

		<!-- 본문의 종료 -->
		</td>
	</tr>

	<tr>
		<td height=5 colspan=17></td>
	</tr>

	<tr>
		<td height=1 colspan=17 background="<?=$dark_define['site_url']?>/board/adm/mall/mall_admin_images/background/hr.gif"><img width=0 height=1></td>
	</tr>
</table>

<?
} 
ELSE 
{
?>
	<script language="javascript">
	location.href="/dark_admin/";
	</script>
<?
}
?>

<br>


