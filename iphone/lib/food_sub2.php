<?
include_once("../../common/dbcon.php");	//db 커넥션
include_once("../lib/common.function.php");	//공통 함수
include_once("../lib/common.vars.php");	//공통 변수


$r_cd = $_REQUEST['r_cd'];


//식당검색
$restaurant_sql = " SELECT a.wr_id, a.ca_name, a.wr_subject, a.wr_content, a.wr_hit, a.wr_good, a.wr_nogood, a.wr_2, a.wr_4, a.wr_5, a.wr_7, a.wr_8, a.wr_9, a.wr_10, b.bf_file
					FROM g4_write_restaurant AS a, g4_board_file AS b
					WHERE a.wr_id like '%$r_cd%'
					AND a.wr_is_comment = '0' 
					AND a.wr_id = b.wr_id
					AND b.bf_no =0
					AND b.bo_table = 'restaurant'
					ORDER BY a.wr_hit DESC ";

$ds_restaurant = mysql_Query($restaurant_sql, $connection) or die('restaurant_sql2 error');
for ($i=0; $row = mysql_fetch_array($ds_restaurant); $i++) { 
	$arr_wr_8 = explode("|",$row[wr_8]); //주소	
	$arr_wr_2 = explode("|",$row[wr_2]); //휴무,영업시간,배달지역
	$arr_wr_7 = explode("|",$row[wr_7]); //메뉴명
	$arr_wr_9 = explode("|",$row[wr_9]);	//메뉴가격
?>
<div>
	<div class="toolbar">
		<h1><?=$row[wr_subject]?></h1>
		<a href="#" class="back">Back</a>
	</div>
	<ul class="edgetoedge" style=" margin: 15px 10px 10px 10px;">
		<li class="food_list">
			<table cellpadding=0 cellspacing=5 border=0 width=100%>
				<tr>
					<td width=80><img src="<?=$img_path_restaurant.$row[bf_file]?>"></td>
					<td width="*"><?=$row[wr_subject]?></td>
					<td align=center width=60 background="./img/telephoneButton.png" style="background-repeat:no-repeat;"><a href="tel:<?=trim($row[wr_4])?>" target="_blank"><br><br><br>전화걸기</a></td>
				</tr>
				<?if($row[wr_4]!=""){?>
				<tr>
					<td colspan='3'>전화번호 : <?=$row[wr_4]?></td>
				</tr>
				<?}?>
				<?if($arr_wr_2[8]!=""){?>
				<tr>
					<td colspan='3'>배달지역 : <?=$arr_wr_2[8]?></td>
				</tr>
				<?}?>
				<?if($arr_wr_2[10]!=""){?>
				<tr>
					<td colspan='3'>영업시간 : <?=$arr_wr_2[10]?></td>
				</tr>
				<?}?>
				<?if($row[wr_5]!=""){?>
				<tr>
					<td colspan='3'>휴 무 : <?=$row[wr_5]?></td>
				</tr>
				<?}?>
				<?if($arr_wr_8[2]!=""){?>
				<tr>
					<td colspan='3'>주 소 : (<?=$arr_wr_8[0];?>-<?=$arr_wr_8[1];?>)<?=$arr_wr_8[2];?> <?=$arr_wr_8[3];?></td>
				</tr>
				<?}?>
				<?if($row[wr_content]!=""){?>
				<tr>
					<td colspan='3'>소 개 : <?=$row[wr_content]?></td>
				</tr>
				<?}?>
			</table>
		</li>		
	</ul>

	<ul class="edgetoedge" style=" margin: 10px 10px 10px 10px;">
	<?
	$menu_num=0;
	for($j=0;$j<count($arr_wr_7);$j++){
		if($arr_wr_7[$j]!=""){
			$menu_num++;
	?>
		<li class="food_list"><?=$arr_wr_7[$j]?> <small><?=$arr_wr_9[$j]?>원</small></li>
	<?
		}
	}
		if($menu_num==0){echo "<li class='food_list'>등록된 메뉴항목이 없습니다.</li>";}
	?>
	</ul>
</div>
<?}?>