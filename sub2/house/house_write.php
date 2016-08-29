<?
/*
$update_href="$IU[house_path]/house_edit.php";
$write_href="$IU[house_path]/house_write.php";
$delete_href="$IU[house_path]/house_delete.php";
*/


$write_min=10;
$write_max=1000;
$width="100%";
$is_dhtml_editor=true;
$is_file=true;
$title_msg="주거정보 등록";
if ($is_dhtml_editor) {
    include_once("$g4[path]/lib/cheditor4.lib.php");
    echo "<script src='$g4[cheditor4_path]/cheditor.js'></script>";
    echo cheditor1('wr_content', '100%', '250');
}
//--------------------------------------------------------------------------
// 가변 파일
$file_script = "";
$file_length = -1;
$room_script = "";
$room_length = -1;
// 수정의 경우 파일업로드 필드가 가변적으로 늘어나야 하고 삭제 표시도 해주어야 합니다.
if ($w == "u") 
{
	$write_house=sql_fetch("select * from room_house where h_cd='$h_cd'");

	$sql_c= " select I_filename,I_id from room_imageinfo where I_classify = 'H' and I_classify_id = '$h_cd' ";
	$result_c = sql_query($sql_c);
	$cc=mysql_num_rows($result_c);
    for ($i=0; $i<$cc; $i++) 
    {
      //  $row = sql_fetch(" select I_filename,I_id from room_imageinfo where I_classify = 'H' and I_classify_id = '$wr_id' ");
		$row=sql_fetch_array($result_c);
        if ($row[I_filename])
        {
            $file_script .= "add_file(\"<input type='checkbox' name='bf_file_del[$i]' value='$row[I_id]'><a href='./imageData/$row[I_filename]'>{$row[I_filename]}</a> 파일 삭제";
            $file_script .= "\");\n";
        }
        else
            $file_script .= "add_file('');\n";
    }

	

    $file_length = $cc - 1;
}

if ($file_length < 0) 
{
    $file_script .= "add_file('');\n";
    $file_length = 0;
}

#######################################################################################################

//w=u수정 모드일 경우 select 선택을 위해 write_house 밑에 있어야 함
include_once("$IU[house_path]/house_config.php");

if($write_house[open]=='yes')
{
	$open_check1="checked";
	$open_check2="";
}
else
{
	$open_check2="checked";
	$open_check1="";
}
$qstr = "search_str=$search_str&house_ym_type=$house_ym_type&room_type=$room_type&room_size=$room_size&price_1=$price_1&price_2=$price_2&page=$page&order=$order";
?>
<div style="height:14px; line-height:1px; font-size:1px;">&nbsp;</div>

<style type="text/css">
.write_head { height:30px; text-align:center; color:#8492A0; }
.field { border:1px solid #ccc; }
</style>

<script language="javascript">
var char_min = parseInt(<?=$write_min?>); 
var char_max = parseInt(<?=$write_max?>); 
</script>

<form name="fwrite" method="post" onsubmit="return fwrite_submita(this);" enctype="multipart/form-data" style="margin:0px;">
<input type=hidden name=null> 
<input type=hidden name=w        value="<?=$w?>">
<input type=hidden name=wr_id    value="<?=$h_cd?>">
<input type=hidden name=sca      value="<?=$sca?>">
<input type=hidden name=sfl      value="<?=$sfl?>">
<input type=hidden name=stx      value="<?=$stx?>">
<input type=hidden name=spt      value="<?=$spt?>">
<input type=hidden name=sst      value="<?=$sst?>">
<input type=hidden name=sod      value="<?=$sod?>">
<input type=hidden name=page     value="<?=$page?>">
<input type=hidden name=order     value="<?=$order?>">
<input type=hidden name=qstr     value="<?=$qstr?>">
<table width="<?=$width?>" align=center cellpadding=0 cellspacing=0>
<tr>
	<td>
		<div style="border:1px solid #ddd; height:34px; background:url(<?=$IU[url]?>/sub/house/img/title_bg.gif) repeat-x;">
		<div style="font-weight:bold; font-size:14px; margin:7px 0 0 10px;">:: <?=$title_msg?> ::</div>
		</div>
		<div style="height:3px; background:url(<?=$IU[url]?>/sub/house/img/title_shadow.gif) repeat-x; line-height:1px; font-size:1px;"></div>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
<colgroup width=90>
<colgroup width=''>
<tr><td colspan="2" style="background:url(<?=$IU[url]?>/sub/house/img/title_bg.gif) repeat-x; height:3px;"></td></tr>

<tr>
	<td class=write_head>제 목</td>
	<td><input class='ed' style="width:100%;" name=h_nm id="h_nm" itemname="제목" required value="<?=$write_house[h_nm]?>"></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>조회수</td>
	<td><input class='ed' style="width:80px;" name=h_visit id="h_visit" itemname="조회수" required value="<?=$write_house[h_visit]?>"></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>오픈</td>
	<td>
		<input type=radio name=open value='yes' <?=$open_check1?>>open &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type=radio name=open value='no' <?=$open_check2?>>close &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>주인거주형태</td>
	<td>
		<select name=owner_stay_type>
		<?=$owner_stay_type_select_option?>
		</select>
	</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>주인</td>
	<td>
		<select name=owner_cd>
		<option value=''>선택하세요</option>
		<?=$owner_cd_select_option?>
		</select>
	</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>주인거주참고</td>
	<td><input class='ed' style="width:500;" name=owner_stay_exp id="owner_stay_exp" value="<?=$write_house[owner_stay_exp]?>"></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>연락처</td>
	<td><input class='ed' style="width:200;" name=phone id="phone" value="<?=$write_house[phone]?>">ex)041-123-4567</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>핸드폰</td>
	<td><input class='ed' style="width:200;" name=mphone id="mphone" value="<?=$write_house[mphone]?>">ex)011-111-2222</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>건축년도</td>
	<td><input class='ed' style="width:200;" name=build_year id="build_year" value="<?=$write_house[build_year]?>">ex)2004</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>주의사항</td>
	<td><input class='ed' style="width:500;" name=exp id="exp" value="<?=$write_house[exp]?>"></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>우편번호</td>
	<td><input class='ed' style="width:200;" name=zipcode id="zipcode" value="<?=$write_house[zipcode]?>">ex)123-123</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>방종류</td>
	<td>
		<select name=room_type>
		<?=$room_type_select_option?>
		</select>
	</td>
</tr>

<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>지역</td>
	<td>
		<select name=add_div>
		<?=$add_div_select_option?>
		</select>
	</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>거리(고대기준)</td>
	<td>
		<select name=fit>
		<?=$fit_select_option?>
		</select>
	</td>
</tr>

<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
	<td class=write_head>주소</td>
	<td><input class='ed' style="width:300;" name=add1 id="add1" value="<?=$write_house[add1]?>">&nbsp;상세:<input class='ed' style="width:200;" name=add2 id="add2" value="<?=$write_house[add2]?>"></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<tr>
    <td class=write_head style='padding-left:20px;'>내용</td>
    <td style='padding:5 0 5 0;'>
        <? if ($is_dhtml_editor) { ?>
            <?=cheditor2('wr_content', $write_house[content]);?>
        <? } else { ?>
        <table width=100% cellpadding=0 cellspacing=0>
        <tr>
            <td width=50% align=left valign=bottom>
                <span style="cursor: pointer;" onclick="textarea_decrease('wr_content', 10);"><img src="<?=$IU[url]?>/sub/house/img/up.gif"></span>
                <span style="cursor: pointer;" onclick="textarea_original('wr_content', 10);"><img src="<?=$IU[url]?>/sub/house/img/start.gif"></span>
                <span style="cursor: pointer;" onclick="textarea_increase('wr_content', 10);"><img src="<?=$IU[url]?>/sub/house/img/down.gif"></span></td>
            <td width=50% align=right><? if ($write_min || $write_max) { ?><span id=char_count></span>글자<?}?></td>
        </tr>
        </table>
        <textarea id="wr_content" name="wr_content" class=tx style='width:100%; word-break:break-all;' rows=10 itemname="내용" required 
        <? if ($write_min || $write_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?}?>><?=$write_house[content]?></textarea>
        <? if ($write_min || $write_max) { ?><script language="javascript"> check_byte('wr_content', 'char_count'); </script><?}?>
        <? } ?>
    </td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#dddddd></td></tr>
<tr>
	<td></td>
	<td  height=1 >
	*파일 업로드시 주의 사항<br>
	1)파일 수정이라는 개념이 없다. 수정을 원할경우 필요없는 이미지 삭제 체크후 새파일 추가 하면 된다.<br>
	2)삭제가 오른쪽에 있더라도 그 칸 사용가능.(=찾아보기 옆에 파일 명이 있어도 그 찾아보기 사용가능)
	
	</td>
</tr>
<? if ($is_file) { ?>
<tr>
	<td class=write_head>
		<table cellpadding=0 cellspacing=0>
		<tr>
			<td class=write_head style="padding-top:10px; line-height:20px;">
				파일첨부<br> 
				<span onclick="add_file();" style="cursor:pointer;"><img src="<?=$IU[url]?>/sub/house/img/btn_file_add.gif"></span> 
				<span onclick="del_file();" style="cursor:pointer;"><img src="<?=$IU[url]?>/sub/house/img/btn_file_minus.gif"></span>
			</td>
		</tr>
		</table>
	</td>
	<td style='padding:5 0 5 0;'><table id="variableFiles" cellpadding=0 cellspacing=0></table><?// print_r2($file); ?>
		<script language="JavaScript">
		var flen = 0;
		function add_file(delete_code)
		{
			var upload_count = <?=(int)$board[bo_upload_count]?>;
			if (upload_count && flen >= upload_count)
			{
				alert("이 게시판은 "+upload_count+"개 까지만 파일 업로드가 가능합니다.");
				return;
			}

			var objTbl;
			var objRow;
			var objCell;
			if (document.getElementById)
				objTbl = document.getElementById("variableFiles");
			else
				objTbl = document.all["variableFiles"];

			objRow = objTbl.insertRow(objTbl.rows.length);
			objCell = objRow.insertCell(0);

			objCell.innerHTML = "<input type='file' class='ed' name='bf_file[]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'>";
			if (delete_code)
				objCell.innerHTML += delete_code;
			
			flen++;
		}
		
		<?=$file_script; //수정시에 필요한 스크립트?>

		function del_file()
		{
			// file_length 이하로는 필드가 삭제되지 않아야 합니다.
			var file_length = <?=(int)$file_length?>;
			var objTbl = document.getElementById("variableFiles");
			if (objTbl.rows.length - 1 > file_length)
			{
				objTbl.deleteRow(objTbl.rows.length - 1);
				flen--;
			}
		}
		function room_image_checkbox(num,r_im)
		{
			
			num_image=num*13;
			if(document.getElementById('room_del_'+num).checked)
			{
				for(var i=0;i<r_im;i++)
				{
					document.getElementsByName('rm_file_del_'+num+'[]')[i].checked=true;
				}
			}
			else
			{
				for(var i=0;i<r_im;i++)
				{
					document.getElementsByName('rm_file_del_'+num+'[]')[i].checked=false;
				}
			}
		}
		</script></td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

<tr>
	<td class=write_head>
		<table cellpadding=0 cellspacing=0>
		<tr>
			<td class=write_head style="padding-top:10px; line-height:20px;">
				방정보<br> 
				<span onclick="add_room();" style="cursor:pointer;"><img src="<?=$IU[url]?>/sub/house/img/btn_file_add.gif"></span> 
				<span onclick="del_room();" style="cursor:pointer;"><img src="<?=$IU[url]?>/sub/house/img/btn_file_minus.gif"></span>
			</td>
		</tr>
		</table>
	</td>
	<!-- objCell.innerHTML = "<table border=0 cellpadding=0 cellspacing=0><tr><td></td><td></td></tr>";
			objCell.innerHTML += "<tr><td>방이름:</td><td><input type='text' class='ed' name='r_nm[]'></td></tr>";
			objCell.innerHTML += "<tr><td>방타입:</td><td><select name=type[]><?=$room_type_select_option?></select></td></tr>";
			objCell.innerHTML += "<tr><td>전세:</td><td><select name=charter_yn[]><?=$charter_yn_select_option?></select></td></tr>";
			objCell.innerHTML += "<tr><td>전세가격:</td><td><input type='text' class='ed' name='charter_price[]'></td></tr>";
			objCell.innerHTML += "<tr><td>전세보증금:</td><td><select name=c_credit_yn[]><?=$c_credit_yn_select_option?></select></td></tr>";
			objCell.innerHTML += "<tr><td>전세보증금:</td><td><input type='text' class='ed' name='c_credit_price[]'></td></tr>";
			objCell.innerHTML += "<tr><td>월세:</td><td><select name=monthly_yn[]><?=$monthly_yn_select_option?></select></td></tr>";
			objCell.innerHTML += "<tr><td>월세가격:</td><td><input type='text' class='ed' name='monthly_price[]'></td></tr>";
			objCell.innerHTML += "<tr><td>월세보증금:</td><td><select name=c_credit_yn[]><?=$m_credit_yn_select_option?></select></td></tr>";
			objCell.innerHTML += "<tr><td>월세보증금:</td><td><input type='text' class='ed' name='m_credit_price[]'></td></tr>"; -->
	<td style='padding:5 0 5 0;'><table id="variableRooms" cellpadding=2 cellspacing=0 border=1 style='border:1px solid # 666666;border-collapse:collapse-all'></table><?// print_r2($file); ?>
	<?
	if($w=='u')
	{
		
		
		$sql_c= " select * from room_room where h_cd = '$h_cd' ";
		$result_c = sql_query($sql_c);
		$cc=mysql_num_rows($result_c);
		if(!$cc)$room_length =0;
		
		$room_length = $cc;
	
		for($i=0,$index_r=0; $i<$cc; $i++,$index_r=$index_r+13)
		{
		
			$row=sql_fetch_array($result_c);
			$room_image_del=array();
			//if($row[reserch_date] > '2004')
		
			$sql_R= " select I_filename,I_id from room_imageinfo where I_classify = 'R' and I_classify_id = '$h_cd' and I_room_id='$row[r_cd]'";
			
			$result_R = sql_query($sql_R);
			$r_im=mysql_num_rows($result_R);
			$row_room_image_yes=array();
			for ($i2=0; $row_room=sql_fetch_array($result_R); $i2++) 
			{					
				$room_image_del[]="<input type='checkbox' name='rm_file_del_".$i."[]' value='$row_room[I_id]'><a href='./imageData/$row_room[I_filename]' target='_blank'>{$row_room[I_filename]}</a>삭제";
			}
			$room_del_id="room_del_".$i;
			$row[option_info]=htmlspecialchars(trim($row[option_info]));
			//$row[option_info]=trim(str_replace("<br />",'#',nl2br($row[option_info])));
			//$ex_T=explode("\n",$row[option_info]);
			//$row[option_info]=$ex_T[0];
			#############################################################################################
			$row[option_info] = preg_replace("/\s+/",",",$row[option_info]); 
			#############################################################################################
			//$row[option_info]=str_replace("\n",",",$row[option_info]);
			//$row[option_info]=str_replace("<br />",",",$row[option_info]);
			//$row[option_info]=str_replace("<br/>",",",$row[option_info]);
			//$row[option_info]=str_replace("<br>",",",$row[option_info]);
			//$row[option_info]=str_replace("\n",",",$row[option_info]);
			?>
			<script>
			var objTbl;
			var objRow;
			var objCell;
			if (document.getElementById)
				objTbl = document.getElementById("variableRooms");
			else
				objTbl = document.all["variableRooms"];

			objRow = objTbl.insertRow(objTbl.rows.length);
			objRow2 = objTbl.insertRow(objTbl.rows.length);
			objRow3 = objTbl.insertRow(objTbl.rows.length);
			objRow4 = objTbl.insertRow(objTbl.rows.length);
			objRow5 = objTbl.insertRow(objTbl.rows.length);
			objRow6 = objTbl.insertRow(objTbl.rows.length);
			objRow7 = objTbl.insertRow(objTbl.rows.length);
			objRow8 = objTbl.insertRow(objTbl.rows.length);
			objRow9 = objTbl.insertRow(objTbl.rows.length);
			objRow10 = objTbl.insertRow(objTbl.rows.length);
			objRow11 = objTbl.insertRow(objTbl.rows.length);
			objRow12 = objTbl.insertRow(objTbl.rows.length);

			Row1_cell0 = objRow.insertCell(0);
			Row1_cell1 = objRow.insertCell(1);
			Row2_cell0 = objRow2.insertCell(0);
			Row2_cell1 = objRow2.insertCell(1);
			Row3_cell0 = objRow3.insertCell(0);
			Row3_cell1 = objRow3.insertCell(1);
			Row4_cell0 = objRow4.insertCell(0);
			Row4_cell1 = objRow4.insertCell(1);
			Row5_cell0 = objRow5.insertCell(0);
			Row5_cell1 = objRow5.insertCell(1);
			Row6_cell0 = objRow6.insertCell(0);
			Row6_cell1 = objRow6.insertCell(1);
			Row7_cell0 = objRow7.insertCell(0);
			Row7_cell1 = objRow7.insertCell(1);			
			Row8_cell0 = objRow8.insertCell(0);
			Row8_cell1 = objRow8.insertCell(1);
			Row9_cell0 = objRow9.insertCell(0);
			Row9_cell1 = objRow9.insertCell(1);
			Row10_cell0 = objRow10.insertCell(0);
			Row10_cell1 = objRow10.insertCell(1);
			
			

			Row1_cell0.innerHTML = "방이름:<input type='text' class='ed' name='r_nm[<?=$i?>]'><input type='hidden'  name='r_cd[<?=$i?>]' value='<?=$row[r_cd]?>'> 삭제:<input type='checkbox' id=<?=$room_del_id?> name=room_del[<?=$i?>] value='<?=$row[r_cd]?>' onclick='room_image_checkbox(<?=$i?>,<?=$r_im?>)'>";
			Row1_cell1.innerHTML += "방타입:<select name=type[<?=$i?>]><?=$room_type_select_option?></select>";
			
			Row2_cell0.innerHTML += "전세:<select name=charter_yn[<?=$i?>]><?=$charter_yn_select_option?></select>&nbsp;&nbsp;&nbsp;&nbsp;";
			Row2_cell0.innerHTML += "전세가격:<input type='text' class='ed' name='charter_price[<?=$i?>]' size=10 value='<?=$row[charter_price]?>'>";
			Row2_cell1.innerHTML += "전기세:<select name=elec_tax_type[<?=$i?>]><?=$elec_tax_type_select_option?></select>&nbsp;&nbsp;발코니:<select name=balcony[<?=$i?>]><?=$balcony_select_option?></select>";
			
			Row3_cell0.innerHTML += "전세보증금:<select name=c_credit_yn[<?=$i?>] ><?=$c_credit_yn_select_option?></select>&nbsp;&nbsp;' ";
			Row3_cell0.innerHTML += "전세보증금:<input type='text' class='ed' name='c_credit_price[<?=$i?>]' size=10 value='<?=$row[c_credit_price]?>'>";
			Row3_cell1.innerHTML += "보일러:<select name=boiler_type[<?=$i?>]><?=$boiler_type_select_option?></select>";
			Row4_cell0.innerHTML += "월세:<select name=monthly_yn[<?=$i?>]><?=$monthly_yn_select_option?></select>";
			Row4_cell0.innerHTML += "월세가격:<input type='text' class='ed' name='monthly_price[<?=$i?>]' size=10 value='<?=$row[monthly_price]?>'>";
			Row4_cell1.innerHTML += "보일러컨트롤:<select name=boiler_control[<?=$i?>]><?=$boiler_control_select_option?></select>";
			Row5_cell0.innerHTML += "월세보증금:<select name=m_credit_yn[<?=$i?>]><?=$m_credit_yn_select_option?></select>&nbsp;&nbsp;";
			Row5_cell0.innerHTML += "월세보증금:<input type='text' class='ed' name='m_credit_price[<?=$i?>]' size=0 value='<?=$row[m_credit_price]?>'>";
			Row5_cell1.innerHTML += "밝기:<select name=brightness[<?=$i?>]><?=$brightness_select_option?></select>&nbsp;&nbsp;샤워:<select name=shower[<?=$i?>]><?=$shower_select_option?></select>";
			Row6_cell0.innerHTML += "가격정보:<input type='text' class='ed' name='price_ext[<?=$i?>]' size=30  value='<?=$row[price_ext]?>'>";
			Row6_cell1.innerHTML += "수도세:<select name=water_tax_type[<?=$i?>]><?=$water_tax_type_select_option?></select>&nbsp;수도컨트롤:<select name=water_control[<?=$i?>]><?=$water_control_select_option?></select>";
			Row7_cell0.innerHTML += "책상:<select name=desk_yn[<?=$i?>]><?=$desk_yn_select_option?></select>&nbsp;&nbsp;";
			Row7_cell0.innerHTML += "에어콘:<select name=aircon_yn[<?=$i?>]><?=$aircon_yn_select_option?></select>&nbsp;&nbsp;";
			Row7_cell0.innerHTML += "냉장고:<select name=refri_yn[<?=$i?>]><?=$refri_yn_select_option?></select>";
			Row7_cell1.innerHTML += "화장실:<select name=bathroom[<?=$i?>]><?=$bathroom_select_option?></select>";			
			Row7_cell1.innerHTML += "부엌:<select name=kichen[<?=$i?>]><?=$kichen_select_option?></select>";
			Row8_cell0.innerHTML += "방가로Cm:<input type='text' class='ed' name='col_size[<?=$i?>]' size=10 value='<?=$row[col_size]?>'>&nbsp;&nbsp;";
			Row8_cell0.innerHTML += "방세로Cm:<input type='text' class='ed' name='row_size[<?=$i?>]' size=10 value='<?=$row[row_size]?>'>";
			Row8_cell1.innerHTML += "평수:<input type='text' class='ed' name='size1[<?=$i?>]' size=10 value='<?=$row[size1]?>'>&nbsp;&nbsp;";
			Row8_cell1.innerHTML += "평방미터:<input type='text' class='ed' name='size2[<?=$i?>]' size=10 value='<?=$row[size2]?>'>";
			
			Row9_cell0.innerHTML += "기타옵션:<textarea name=option_info[<?=$i?>] cols=60 rows=3><?=$row[option_info]?></textarea>";
		
			Row10_cell0.innerHTML += "<br>방이미지1:<input type='file' class='ed' name='rm_file[0][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$room_image_del[0]?>";
			Row10_cell0.innerHTML += "<br>방이미지2:<input type='file' class='ed' name='rm_file[1][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$room_image_del[1]?>";
			Row10_cell0.innerHTML += "<br>방이미지3:<input type='file' class='ed' name='rm_file[2][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$room_image_del[2]?>";
			Row10_cell0.innerHTML += "<br>방이미지4:<input type='file' class='ed' name='rm_file[3][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$room_image_del[3]?>";
			Row10_cell0.innerHTML += "<br>방이미지5:<input type='file' class='ed' name='rm_file[4][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$room_image_del[4]?>";
			Row10_cell0.innerHTML += "<br>방이미지6:<input type='file' class='ed' name='rm_file[5][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$room_image_del[5]?>";	
			Row10_cell0.innerHTML += "<br>방이미지7:<input type='file' class='ed' name='rm_file[6][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$room_image_del[6]?>";	
			Row10_cell0.innerHTML += "<br>방이미지8:<input type='file' class='ed' name='rm_file[7][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$room_image_del[7]?>";	
			Row10_cell0.innerHTML += "<br>방이미지9:<input type='file' class='ed' name='rm_file[8][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$room_image_del[8]?>";	
			Row10_cell0.innerHTML += "<br>방이미지10:<input type='file' class='ed' name='rm_file[9][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$room_image_del[9]?>";	
			Row10_cell0.innerHTML += "<br>방이미지11:<input type='file' class='ed' name='rm_file[10][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$room_image_del[10]?>";	
			Row10_cell0.innerHTML += "<br>방이미지12:<input type='file' class='ed' name='rm_file[11][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$room_image_del[11]?>";	
			Row10_cell0.innerHTML += "<br>방이미지13:<input type='file' class='ed' name='rm_file[12][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$room_image_del[12]?>";	
			Row10_cell0.innerHTML += "<br><br>";
			
			document.getElementsByName('r_nm[<?=$i?>]')[0].value='<?=$row[r_nm]?>';
			document.getElementsByName('type[<?=$i?>]')[0].value='<?=$row[type]?>';
			document.getElementsByName('charter_yn[<?=$i?>]')[0].value='<?=$row[charter_yn]?>';
			document.getElementsByName('elec_tax_type[<?=$i?>]')[0].value='<?=$row[elec_tax_type]?>';
			document.getElementsByName('c_credit_yn[<?=$i?>]')[0].value='<?=$row[c_credit_yn]?>';
			document.getElementsByName('boiler_type[<?=$i?>]')[0].value='<?=$row[boiler_type]?>';
			document.getElementsByName('monthly_yn[<?=$i?>]')[0].value='<?=$row[monthly_yn]?>';
			document.getElementsByName('boiler_control[<?=$i?>]')[0].value='<?=$row[boiler_control]?>';
			document.getElementsByName('m_credit_yn[<?=$i?>]')[0].value='<?=$row[m_credit_yn]?>';
			document.getElementsByName('brightness[<?=$i?>]')[0].value='<?=$row[brightness]?>';
			document.getElementsByName('shower[<?=$i?>]')[0].value='<?=$row[shower]?>';
			document.getElementsByName('desk_yn[<?=$i?>]')[0].value='<?=$row[desk_yn]?>';
			document.getElementsByName('aircon_yn[<?=$i?>]')[0].value='<?=$row[aircon_yn]?>';
			document.getElementsByName('refri_yn[<?=$i?>]')[0].value='<?=$row[refri_yn]?>';
			document.getElementsByName('bathroom[<?=$i?>]')[0].value='<?=$row[bathroom]?>';
			document.getElementsByName('kichen[<?=$i?>]')[0].value='<?=$row[kichen]?>';
			document.getElementsByName('balcony[<?=$i?>]')[0].value='<?=$row[balcony]?>';
			document.getElementsByName('water_control[<?=$i?>]')[0].value='<?=$row[water_control]?>';
			document.getElementsByName('water_tax_type[<?=$i?>]')[0].value='<?=$row[water_tax_type]?>';
			
			objTbl.rows(objTbl.rows.length-3).cells(0).colSpan='2'; 
			objTbl.rows(objTbl.rows.length-4).cells(0).colSpan='2'; 
			</script>
			<?
		}
	}
	?>
		<script language="JavaScript">
		var flen = 0;
		function add_room(delete_code)
		{
			var upload_count = 10;
			if (upload_count && flen >= upload_count)
			{
				alert("이 게시판은 "+upload_count+"개 까지만 파일 업로드가 가능합니다.");
				return;
			}

			var objTbl;
			var objRow;
			var objCell;
			if (document.getElementById)
				objTbl = document.getElementById("variableRooms");
			else
				objTbl = document.all["variableRooms"];

			objRow = objTbl.insertRow(objTbl.rows.length);
			objRow2 = objTbl.insertRow(objTbl.rows.length);
			objRow3 = objTbl.insertRow(objTbl.rows.length);
			objRow4 = objTbl.insertRow(objTbl.rows.length);
			objRow5 = objTbl.insertRow(objTbl.rows.length);
			objRow6 = objTbl.insertRow(objTbl.rows.length);
			objRow7 = objTbl.insertRow(objTbl.rows.length);
			objRow8 = objTbl.insertRow(objTbl.rows.length);
			objRow9 = objTbl.insertRow(objTbl.rows.length);
			objRow10 = objTbl.insertRow(objTbl.rows.length);
			objRow11 = objTbl.insertRow(objTbl.rows.length);
			objRow12 = objTbl.insertRow(objTbl.rows.length);

			Row1_cell0 = objRow.insertCell(0);
			Row1_cell1 = objRow.insertCell(1);
			Row2_cell0 = objRow2.insertCell(0);
			Row2_cell1 = objRow2.insertCell(1);
			Row3_cell0 = objRow3.insertCell(0);
			Row3_cell1 = objRow3.insertCell(1);
			Row4_cell0 = objRow4.insertCell(0);
			Row4_cell1 = objRow4.insertCell(1);
			Row5_cell0 = objRow5.insertCell(0);
			Row5_cell1 = objRow5.insertCell(1);
			Row6_cell0 = objRow6.insertCell(0);
			Row6_cell1 = objRow6.insertCell(1);
			Row7_cell0 = objRow7.insertCell(0);
			Row7_cell1 = objRow7.insertCell(1);			
			Row8_cell0 = objRow8.insertCell(0);
			Row8_cell1 = objRow8.insertCell(1);
			Row9_cell0 = objRow9.insertCell(0);
			Row9_cell1 = objRow9.insertCell(1);
			Row10_cell0 = objRow10.insertCell(0);
			Row10_cell1 = objRow10.insertCell(1);

			objTbl.rows(objTbl.rows.length-3).cells(0).colSpan='2'; 
			objTbl.rows(objTbl.rows.length-4).cells(0).colSpan='2';

			Row1_cell0.innerHTML = "방이름:<input type='text' class='ed' name='r_nm[]'><input type='hidden'  name='r_cd[]' value=''>";
			Row1_cell1.innerHTML += "방타입:<select name=type[]><?=$room_type_select_option?></select>";
			
			Row2_cell0.innerHTML += "전세:<select name=charter_yn[]><?=$charter_yn_select_option?></select>&nbsp;&nbsp;&nbsp;&nbsp;";
			Row2_cell0.innerHTML += "전세가격:<input type='text' class='ed' name='charter_price[]' size=10 value='<?=$row[charter_price]?>'>";
			Row2_cell1.innerHTML += "전기세:<select name=elec_tax_type[]><?=$elec_tax_type_select_option?></select>&nbsp;&nbsp;발코니:<select name=balcony[]><?=$balcony_select_option?></select>";
			
			Row3_cell0.innerHTML += "전세보증금:<select name=c_credit_yn[] ><?=$c_credit_yn_select_option?></select>&nbsp;&nbsp;' ";
			Row3_cell0.innerHTML += "전세보증금:<input type='text' class='ed' name='c_credit_price[]' size=10 value='<?=$row[c_credit_price]?>'>";
			Row3_cell1.innerHTML += "보일러:<select name=boiler_type[]><?=$boiler_type_select_option?></select>";
			Row4_cell0.innerHTML += "월세:<select name=monthly_yn[]><?=$monthly_yn_select_option?></select>";
			Row4_cell0.innerHTML += "월세가격:<input type='text' class='ed' name='monthly_price[]' size=10 value='<?=$row[monthly_price]?>'>";
			Row4_cell1.innerHTML += "보일러컨트롤:<select name=boiler_control[]><?=$boiler_control_select_option?></select>";
			Row5_cell0.innerHTML += "월세보증금:<select name=m_credit_yn[]><?=$m_credit_yn_select_option?></select>&nbsp;&nbsp;";
			Row5_cell0.innerHTML += "월세보증금:<input type='text' class='ed' name='m_credit_price[]' size=5 value='<?=$row[m_credit_price]?>'>";
			Row5_cell1.innerHTML += "밝기:<select name=brightness[]><?=$brightness_select_option?></select>&nbsp;&nbsp;샤워:<select name=shower[]><?=$shower_select_option?></select>";
			Row6_cell0.innerHTML += "가격정보:<input type='text' class='ed' name='price_ext[]' size=30  value='<?=$row[price_ext]?>'>";
			Row6_cell1.innerHTML += "수도세:<select name=water_tax_type[]><?=$water_tax_type_select_option?></select>&nbsp;수도컨트롤:<select name=water_control[]><?=$water_control_select_option?></select>";
			Row7_cell0.innerHTML += "책상:<select name=desk_yn[]><?=$desk_yn_select_option?></select>&nbsp;&nbsp;";
			Row7_cell0.innerHTML += "에어콘:<select name=aircon_yn[]><?=$aircon_yn_select_option?></select>&nbsp;&nbsp;";
			Row7_cell0.innerHTML += "냉장고:<select name=refri_yn[]><?=$refri_yn_select_option?></select>";
			Row7_cell1.innerHTML += "화장실:<select name=bathroom[]><?=$bathroom_select_option?></select>";			
			Row7_cell1.innerHTML += "부엌:<select name=kichen[]><?=$kichen_select_option?></select>";
			Row8_cell0.innerHTML += "가로Cm:<input type='text' class='ed' name='col_size[<?=$i?>]' size=10 value='<?=$row[col_size]?>'>&nbsp;&nbsp;";
			Row8_cell0.innerHTML += "세로Cm:<input type='text' class='ed' name='row_size[<?=$i?>]' size=10 value='<?=$row[row_size]?>'>";
			Row8_cell1.innerHTML += "평수:<input type='text' class='ed' name='size1[<?=$i?>]' size=10 value='<?=$row[size1]?>'>&nbsp;&nbsp;";
			Row8_cell1.innerHTML += "평방미터:<input type='text' class='ed' name='size2[<?=$i?>]' size=10 value='<?=$row[size2]?>'>";
			Row9_cell0.innerHTML += "기타옵션:<textarea name=option_info[] cols=60 rows=3><?=$row[option_info]?></textarea>";
			
			Row10_cell0.innerHTML += "<br>방이미지1:<input type='file' class='ed' name='rm_file[0][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$row_room_image[$index_r]?>";
			Row10_cell0.innerHTML += "<br>방이미지2:<input type='file' class='ed' name='rm_file[1][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$row_room_image[$index_r+1]?>";
			Row10_cell0.innerHTML += "<br>방이미지3:<input type='file' class='ed' name='rm_file[2][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$row_room_image[$index_r+2]?>";
			Row10_cell0.innerHTML += "<br>방이미지4:<input type='file' class='ed' name='rm_file[3][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$row_room_image[$index_r+3]?>";
			Row10_cell0.innerHTML += "<br>방이미지5:<input type='file' class='ed' name='rm_file[4][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$row_room_image[$index_r+4]?>";
			Row10_cell0.innerHTML += "<br>방이미지6:<input type='file' class='ed' name='rm_file[5][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$row_room_image[$index_r+5]?>";	
			Row10_cell0.innerHTML += "<br>방이미지7:<input type='file' class='ed' name='rm_file[6][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$row_room_image[$index_r+6]?>";	
			Row10_cell0.innerHTML += "<br>방이미지8:<input type='file' class='ed' name='rm_file[7][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$row_room_image[$index_r+7]?>";	
			Row10_cell0.innerHTML += "<br>방이미지9:<input type='file' class='ed' name='rm_file[8][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$row_room_image[$index_r+8]?>";	
			Row10_cell0.innerHTML += "<br>방이미지10:<input type='file' class='ed' name='rm_file[9][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$row_room_image[$index_r+9]?>";	
			Row10_cell0.innerHTML += "<br>방이미지11:<input type='file' class='ed' name='rm_file[10][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$row_room_image[$index_r+10]?>";	
			Row10_cell0.innerHTML += "<br>방이미지12:<input type='file' class='ed' name='rm_file[11][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$row_room_image[$index_r+11]?>";	
			Row10_cell0.innerHTML += "<br>방이미지13:<input type='file' class='ed' name='rm_file[12][]' title='파일 용량 <?=$upload_max_filesize?> 이하만 업로드 가능'><?=$row_room_image[$index_r+12]?>";	
			Row10_cell0.innerHTML += "<br><br>";
			
			
		

			flen++;
		}
		

		function del_room()
		{
			// room_length 이하로는 필드가 삭제되지 않아야 합니다.
			
			var room_length = <?=(int)$room_length?>;
			var objTbl = document.getElementById("variableRooms");
			var total_d_row=12;//한 룸당 row 길이
			var check_room_length=0;
			check_room_length=room_length*total_d_row;
			if (objTbl.rows.length> check_room_length)//(36-12 > 36)
			{
				for( var io = 0; io < total_d_row; io++) {
					 objTbl.deleteRow(objTbl.rows.length - 1);
				}
				flen--;
			}
		}
		
		</script>
		
	</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>


<? if ($is_guest) { ?>
<tr>
    <td class=write_head><img id='kcaptcha_image' border='0' width=120 height=60 onclick="imageClick();" style="cursor:pointer;" title="글자가 잘안보이는 경우 클릭하시면 새로운 글자가 나옵니다."></td>
    <td><input class='ed' type=input size=10 name=wr_key itemname="자동등록방지" required>&nbsp;&nbsp;왼쪽의 글자를 입력하세요.</td>
</tr>
<tr><td colspan=2 height=1 bgcolor=#e7e7e7></td></tr>
<? } ?>

</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="100%" align="center" valign="top" style="padding-top:30px;">
        <input type=image id="btn_submit" src="<?=$IU[url]?>/sub/house/img/btn_write.gif" border=0 accesskey='s'>&nbsp;
        <a href="<?=$IU[home_file]?>?mode=house_list&$qstr"><img id="btn_list" src="<?=$IU[url]?>/sub/house/img/btn_list.gif" border=0></a></td>
</tr>
</table>

</td></tr></table>
</form>
<?
// 필터
echo "<script language='javascript'> var g4_cf_filter = '$config[cf_filter]'; </script>\n";
echo "<script language='javascript' src='$g4[path]/js/filter.js'></script>\n";
?>
<script type="text/javascript"> var md5_norobot_key = ''; </script>
<script type="text/javascript" src="<?="$g4[path]/js/prototype.js"?>"></script>
<script type="text/javascript">
function imageClick() {
    var url = "<?=$g4[bbs_path]?>/kcaptcha_session.php";
    var para = "";
    var myAjax = new Ajax.Request(
        url, 
        {
            method: 'post', 
            asynchronous: true,
            parameters: para, 
            onComplete: imageClickResult
        });
}

function imageClickResult(req) { 
    var result = req.responseText;
    var img = document.createElement("IMG");
    img.setAttribute("src", "<?=$g4[bbs_path]?>/kcaptcha_image.php?t=" + (new Date).getTime());
    document.getElementById('kcaptcha_image').src = img.getAttribute('src');

    md5_norobot_key = result;
}

<? if (!$is_member) { ?>Event.observe(window, "load", imageClick);<? } ?>

<?
// 관리자라면 분류 선택에 '공지' 옵션을 추가함
if ($is_admin) 
{
    ?>
    if (typeof(document.fwrite.ca_name) != 'undefined')
    {
        document.fwrite.ca_name.options.length += 1;
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].value = '공지';
        document.fwrite.ca_name.options[document.fwrite.ca_name.options.length-1].text = '공지';
    }
	<?
} 
?>


function html_auto_br(obj) 
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submita(f) 
{


	if (document.getElementById('char_count')) {
		if (char_min > 0 || char_max > 0) {
			var cnt = parseInt(document.getElementById('char_count').innerHTML);
			if (char_min > 0 && char_min > cnt) {
				alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
				return false;
			} 
			else if (char_max > 0 && char_max < cnt) {
				alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
				return false;
			}
		}
	}

	<?
	if ($is_dhtml_editor) echo cheditor3('wr_content');
	?>

	if (document.getElementById('tx_wr_content')) {
		if (!ed_wr_content.outputBodyText()) { 
			alert('내용을 입력하십시오.'); 
			ed_wr_content.returnFalse();
			return false;
		}
	}

	if (typeof(f.wr_key) != 'undefined') {
		if (hex_md5(f.wr_key.value) != md5_norobot_key) {
			alert('자동등록방지용 글자가 제대로 입력되지 않았습니다.');
			f.wr_key.select();
			f.wr_key.focus();
			return false;
		}
	}

	document.getElementById('btn_submit').disabled = true;
	document.getElementById('btn_list').disabled = true;
	f.action = '<?=$IU[url]?>/sub2/house/house_write_update.php';

	return true;
}
</script>
<script language='javascript' src="<?=$g4[path]?>/js/md5.js"></script>
<script language="JavaScript" src="<?="$g4[path]/js/board.js"?>"></script>
<script language="JavaScript"> window.onload=function() { drawFont(); } </script>
<?
include_once("$g4_path/_tail.php");
?>