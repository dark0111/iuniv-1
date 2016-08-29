<?
include_once("../../common/dbcon.php");	//db 커넥션
include_once("../lib/common.function.php");	//공통 함수
include_once("../lib/common.vars.php");	//공통 변수


$h_cd = str_replace("\'","",$_REQUEST['h_cd']);

//주거검색
$house_sql = " SELECT h_cd, add_div, owner_cd, h_nm, add1, add2, zipcode, build_year, owner_stay_type, exp, html, content, phone, mphone, owner_stay_exp, room_type, gx, gy, recommend, quiet_point, hasuk_yn
FROM room_house
WHERE ";
if($h_cd){
	$house_sql .= " h_cd = '".$h_cd."' ";
}
$house_sql .=		" ORDER BY h_nm ASC ";

$ds_house = mysql_Query($house_sql, $connection) or die('restaurant_sql error');
$row = mysql_fetch_array($ds_house);
		$house_img_sql = " select I_id, I_classify, I_classify_id, I_filename from room_imageinfo where I_classify ='H' and I_classify_id='$row[h_cd]' order by priority desc ,I_id  limit 1";
		$ds_house_img = mysql_Query($house_img_sql, $connection) or die('house_img_sql error');
		$row_house_img = mysql_fetch_array($ds_house_img);
		$house_img_name=str_replace("gif","jpg",$row_house_img[I_filename]);
?>

<div  id="house_detail_info">
    <div class="toolbar">
        <h1><?=cut_str($row[h_nm],22,'..')?></h1>
        <a href="#" class="button back">Back</a>
    </div>
	<ul class="rounded">
		<li class="food_list">
		<table cellpadding=0 cellspacing=5 border=0 width=100%>
			<tr>
				<td width=80><a href="./zflow/zflow_house.php?h_cd='<?=$h_cd?>'"><img src="<?=$img_path_house.$house_img_name?>"></a></td>
				<td width="*"><b><?=$row[h_nm]?></b></td>
				<td align=center width=60 background="./img/telephoneButton.png" style="background-repeat:no-repeat;"><a href="tel:<?=trim($row[phone]);?><?if($row[phone]==""){echo trim($row[mphone]);}?>" target="_blank"><br><br><br>전화걸기</a></td>
			</tr>
			<?if($row[phone]!=""||$row[mphone]!=""){?>
			<tr>
				<td colspan='3'>연락처 : <?=$row[phone]?><?if($row[mphone]!=""&&$row[mphone]!=""){echo", ";}?><?=$row[mphone]?></td>
			</tr>
			<?}?>
			<?if($row[build_year]!=""){?>
			<tr>
				<td colspan='3'>건축년도 : <?=$row[build_year]?></td>
			</tr>
			<?}?>
			<?if($row[add1]!=""){?>
			<tr>
				<td colspan='3'>주 소 : <?=$row[add1]?></td>
			</tr>
			<?}?>
			<?if($row[content]!=""){?>
			<tr>
				<td colspan='3'>세부사항 : <?=$row[content]?></td>
			</tr>
			<?}?>
		</table>
		</li>
	</ul>
	<ul class="rounded">
		<li class="arrow"><a href="./lib/zflow_house.php?h_cd=<?=$row[h_cd]?>&h_nm=<?=$row[h_nm]?>" target="_webapp">원룸 사진 보기</a></li>
	</ul>
</div>