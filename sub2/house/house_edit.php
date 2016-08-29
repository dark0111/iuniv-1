<?
$sql_c = " select * from room_common_cd ";
$result_c = sql_query($sql_c);
$house_v=array();
for($hc=0;$row_c = sql_fetch_array($result_c);$hc++)
{
	$house_v[$row_c[post_cd]][$row_c[cd]]=$row_c[cd_value];
}
?>
