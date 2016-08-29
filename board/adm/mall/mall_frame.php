<?
$g4_path = "../.."; // common.php 의 상대 경로

include_once ("$g4_path/common.php");
include_once("$g4[admin_path]/admin.lib.php");
$sub_menu = "400100";

auth_check($auth[$sub_menu], "r");

$token = get_token();
include_once("../admin.head.php");
if($loc=='order')
{
?>
<table border=0 cellpadding=0 cellspacing=0  width=1000>
	<tr>
		<td>
		<iframe name='mall_frame' width='100%' height='900' src='./order_list.php' frameborder=0 ></iframe>
		</td>
	</tr>
</table>
<?
}elseif($loc=='common_cd'){
?>
<table border=0 cellpadding=0 cellspacing=0  width=1000>
	<tr>
		<td>
		<iframe name='mall_frame' width='100%' height='900' src='./mall_common_cd/common_code_list.php' frameborder=0 ></iframe>
		</td>
	</tr>
</table>
<?
}else
{
?>
<table border=0 cellpadding=0 cellspacing=0  width=1000>
	<tr>
		<td>
		<iframe name='mall_frame' width='100%' height='900' src='./cate_list.php?mn=<?=$mn?>&sn=<?=$sn?>&loc=<?=$loc?>' frameborder=0  ></iframe>
		</td>
	</tr>
</table>
<?
}
?>