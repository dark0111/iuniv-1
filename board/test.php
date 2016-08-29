<?
include_once("./_common.php");
$g4['title'] = "";
$sql_c = " select* from g4_write_restaurant";
$result_c = sql_query($sql_c);

$total_count = mysql_num_rows($result_c);
for($i=0;$i<$total_count;$i++)
{
	$row_c = sql_fetch_array($result_c);
	$p_seven = explode("|",$row_c[wr_7]);
	$seven01 = $p_seven[0];
	$seven02 = $p_seven[1];
	$seven03 = $p_seven[2];
	$seven04 = $p_seven[3];
	$seven05 = $p_seven[4];
	$seven06 = $p_seven[5];
	$seven07 = $p_seven[6];
	$seven08 = $p_seven[7];
	$seven09 = $p_seven[8];
	$seven10 = $p_seven[9];
	$seven11 = $p_seven[10];
	$seven12 = $p_seven[11];
	$seven13 = $p_seven[12];
	$seven14 = $p_seven[13];
	$seven15 = $p_seven[14];
	$seven16 = $p_seven[15];
	$seven17 = $p_seven[16];
	$seven18 = $p_seven[17];
	$seven19 = $p_seven[18];
	$seven20 = $p_seven[19];
	$seven21 = $p_seven[20];
	$seven22 = $p_seven[21];
	$seven23 = $p_seven[22];
	$seven24 = $p_seven[23];
	$seven25 = $p_seven[24];
	$seven26 = $p_seven[25];
	$seven27 = $p_seven[26];
	$seven28 = $p_seven[27];
	$seven29 = $p_seven[28];
	$seven30 = $p_seven[29];

	$p_nine = explode("|",$row_c[wr_9]);
	$nine01 = $p_nine[0];
	$nine02 = $p_nine[1];
	$nine03 = $p_nine[2];
	$nine04 = $p_nine[3];
	$nine05 = $p_nine[4];
	$nine06 = $p_nine[5];
	$nine07 = $p_nine[6];
	$nine08 = $p_nine[7];
	$nine09 = $p_nine[8];
	$nine10 = $p_nine[9];
	$nine11 = $p_nine[10];
	$nine12 = $p_nine[11];
	$nine13 = $p_nine[12];
	$nine14 = $p_nine[13];
	$nine15 = $p_nine[14];
	$nine16 = $p_nine[15];
	$nine17 = $p_nine[16];
	$nine18 = $p_nine[17];
	$nine19 = $p_nine[18];
	$nine20 = $p_nine[19];
	$nine21 = $p_nine[20];
	$nine22 = $p_nine[21];
	$nine23 = $p_nine[22];
	$nine24 = $p_nine[23];
	$nine25 = $p_nine[24];
	$nine26 = $p_nine[25];
	$nine27 = $p_nine[26];
	$nine28 = $p_nine[27];
	$nine29 = $p_nine[28];
	$nine30 = $p_nine[29];
	
	$re_wr_7=$seven01."|".$seven03."|".$seven05."|".$seven07."|".$seven09."|".$seven11."|".$seven13."|".$seven15."|".$seven17."|".$seven19."|".$seven21."|".$seven23."|".$seven25."|".$seven27."|".$seve29;//메뉴
	$re_wr_9=$seven02."|".$seven04."|".$seven06."|".$seven08."|".$seven010."|".$seven12."|".$seven14."|".$seven16."|".$seven18."|".$seven20."|".$seven22."|".$seven24."|".$seven26."|".$seven28."|".$seven30;//가격
	
	$re_wr_7.=$nine01."|".$nine03."|".$nine05."|".$nine07."|".$nine09."|".$nine11."|".$nine13."|".$nine15."|".$nine17."|".$nine19."|".$nine21."|".$nine23."|".$nine25."|".$nine27."|".$seve29;//메뉴
	$re_wr_9.=$nine02."|".$nine04."|".$nine06."|".$nine08."|".$nine010."|".$nine12."|".$nine14."|".$nine16."|".$nine18."|".$nine20."|".$nine22."|".$nine24."|".$nine26."|".$nine28."|".$nine30;//가격
	$re_que="update g4_write_restaurant set wr_9='$re_wr_9',wr_7='$re_wr_7' where wr_id='$row_c[wr_id]'";
	$result_cc = sql_query($re_que);
}

?>
완료