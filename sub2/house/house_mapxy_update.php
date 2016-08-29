<?
$g4_path='../../board';
include_once("$g4_path/common.php");
$g4['title'] = "";
include_once("$g4_path/_head.php");

$gx		= $_REQUEST["gx"];
$gy		= $_REQUEST["gy"];
$h_cd	= $_REQUEST["h_cd"];
if($h_cd)
{
	$sql = " update room_house set			
		gx='$gx',
		gy='$gy'
	   where h_cd = '$h_cd' ";
	 sql_query($sql);
}
?>
<script>
parent.location.reload();
//window.close();
</script>