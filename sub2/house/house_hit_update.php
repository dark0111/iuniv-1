<?
$g4_path='../../board';
include_once("$g4_path/common.php");
$sql = " select * from room_house where h_cd=$h_cd";
$result=sql_query($sql);
$row = sql_fetch_array($result);

if($mode=='down')
{
	$sql2 = " select * from room_house where h_visit < $row[h_visit]  order by h_visit desc limit 1";
	$result2=sql_query($sql2);
	$row2 = sql_fetch_array($result2);
	
	$new_h_visit=$row2[h_visit]-10;
	$sql3 = " update room_house set h_visit=$new_h_visit where h_cd=$h_cd";

	$result3=sql_query($sql3);
}
elseif($mode=='up')
{
	$sql2 = " select * from room_house where h_visit > $row[h_visit]  order by h_visit asc  limit 1";
	$result2=sql_query($sql2);
	$row2 = sql_fetch_array($result2);
	
	$new_h_visit=$row2[h_visit]+10;
	$sql3 = " update room_house set h_visit=$new_h_visit where h_cd=$h_cd";
	$result3=sql_query($sql3);
}

?>
<script>
	parent.location.reload();
</script>