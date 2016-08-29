<?

$g4[title] = "넥서스 연습 ";


if(!$member[mb_id])$mb_id='guest';
$sql2t = " select w_id from english_nexus where key_sentence_id=0";
$result_ct = sql_query($sql2t);
$totalt=mysql_num_rows($result_ct);

$page_rows=20;
$total_page  = ceil($totalt / $page_rows);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함
$write_pages = get_paging($config[cf_write_pages], $page, $total_page, "$IU[home_file]?mode=nexus_word_reg&".$qstr."&page=");

if($search_word_eng)
{
	$sql2 = " select * from english_nexus where word_eng_ex like '%$search_word_eng%' or word_eng like '%$search_word_eng%'";
}
else
{
	$sql2 = " select * from english_nexus where word_kor_ex like '%$search_word_kor%' or word_kor like '%$search_word_kor%'";
}
$sql2 = $sql2." limit $from_record,$page_rows ";
$result_c = sql_query($sql2);


$list_href = '';
$prev_part_href = '';
$next_part_href = '';
if ($sca || $stx)  
{
    $list_href = "$IU[home_file]?mode=nexus_word_search";

    //if ($prev_spt >= $min_spt) 
    $prev_spt = $spt - $config[cf_search_part];
    if (isset($min_spt) && $prev_spt >= $min_spt)
        $prev_part_href = $list_href.$qstr."&spt=$prev_spt";

    $next_spt = $spt + $config[cf_search_part];
    if ($next_spt < 0) 
        $next_part_href =$list_href.$qstr."&spt=$next_spt";
}
?>
<script>
	
	function my_word_del(w_id)
	{
		action_frame.location.href='<?=$IU[sub_url]?>/study/nexus_word_action.php?action_mode=delete&w_id='+w_id;
	}
	function change_view(tr_c)
	{
		
		if(document.getElementById('key_update_tr_'+tr_c).style.display=='')
		{
			document.getElementById('key_update_tr_'+tr_c).style.display='none';
			for(var i=0;i<document.getElementsByName('update_tr_'+tr_c).length;i++)
			{
				document.getElementsByName('update_tr_'+tr_c)[i].style.display='none';
			}
		}
		else
		{
			
			document.getElementById('key_update_tr_'+tr_c).style.display='';
			for(var i=0;i<5;i++)
			{
				if(!document.getElementById('update_tr_'+tr_c+'_'+i))break;
					
				document.getElementById('update_tr_'+tr_c+'_'+i).style.display='';
			}
		}
	}
</script>
<iframe name=action_frame width=600 height=0></iframe>
<table border="0" cellpadding="0" cellspacing="0" width=100%>
<tr>
	<td>
		<table border="0" cellpadding="0" cellspacing="0" width=100%>
		<tr>
			<td><img src="<?=$g4['path']?>/main/image/tit_edge01.gif" border="0"></td>
			<td  background="<?=$g4['path']?>/main/image/tit_bg.gif" width=200>넥서스 연습</td>
			<td  background="<?=$g4['path']?>/main/image/tit_bg.gif" width="600" align="right"><img src="<?=$g4['path']?>/main/image/tit_icon.gif" border="0" align="absmiddle">&nbsp;Home > 영어공부 > <b>넥서스 단어장 (search)</b></td>
			<td align=right><img src="<?=$g4['path']?>/main/image/tit_edge02.gif" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan=4>
		<form action='<?=$IU[home_file]?>' method=post >
		<input type='hidden' name='mode' value='nexus_word_search'>
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
			<td>영어:<input type=text name='search_word_eng' size=35></td>
			<td><input type=submit value='search'></td>
		</tr>
		</table>
		</form>
	</td>
</tr>
<tr>
	<td colspan=4>
		<form action='<?=$IU[home_file]?>' method=post >
		<input type='hidden' name='mode' value='nexus_word_search'>
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
			<td>한글:<input type=text name='search_word_kor' size=35></td>
			<td><input type=submit value='search'></td>
		</tr>
		</table>
		</form>
	</td>
</tr>

<tr>
	<td align=right height=30></td>
</tr>
<tr>
	<td align=right>

	<input type=button value='순서대로 보기' onclick="javascript:location.href='./index.php?mode=<?=$mode?>&view_mode=order&file_name=<?=$file_name?>'" style='cursor:pointer'>&nbsp;
	<input type=button value='섞어 보기' onclick="javascript:location.href='./index.php?mode=<?=$mode?>&view_mode=rand&file_name=<?=$file_name?>'" style='cursor:pointer'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type=button value='모두 보기' onclick="view_controle('all')" style='cursor:pointer'>&nbsp;
	<input type=button value='영어 만 보기' onclick="view_controle('eng')" style='cursor:pointer'>&nbsp;
	<input type=button value='한글 만 보기' onclick="view_controle('kor')" style='cursor:pointer'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
	<input type=button value='프린트하기' onclick="printArea()" style='cursor:pointer'></td>
</tr>


<tr>
	<td align=center>
		<div id="box">
		<table border=0 cellpadding=0 cellspacing=0 width=100%>

		<?

		$ai=0;
		while($row_c = sql_fetch_array($result_c))
		{
			$word_result[$ai][eng]=$row_c[word_eng_ex];
			$word_result[$ai][kor]=$row_c[word_kor_ex];
			$word_result[$ai][w_id]=$row_c[w_id];
			$ai++;
		}
		if(!$view_mode)$view_mode='rand';
		if($view_mode!='rand')@shuffle($word_result);

		?>
		<tr><td align=center height=30><b><?=$word_file_name?></b></td></tr>
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="1"  style='border-collapse:collapse' bordercolor = "#cccccc">
				<tr>
					<td align=center width=40 style='font-weight:bold;color:blue'>번호</td>
					<td align=center width=340 style='font-weight:bold;color:blue;padding-left:5px;'>영문표현</td>
					<td align=center width=340 style='font-weight:bold;color:blue;padding-right:10px;padding-left:5px;'>한글표현</td>
				</tr>
				

		<?
		for($i=0;$i<count($word_result);$i++)
		{
			$i_c=$page_rows*$page+$i+1-$page_rows;
			$temp_view_kor=$word_result[$i][kor];
			$temp_view_eng=$word_result[$i][eng];
			$temp_view_w_id=$word_result[$i][w_id];
			$eng_id="eng_td_".$i;
			$kor_id="kor_td_".$i;
			$tr_id1="key_update_tr_".$i;
			
			$form_name1='key_update_form'.$i;
			echo"
		
					<tr>
						<td width=1>1</td>
						<td  align=left width=340 style='padding-left:5px;font-weight:600'><span id=$eng_id style='display:;' >".nl2br($temp_view_eng)."</span></td>
						
						<td  align=left width=340 style='padding-right:10px;padding-left:5px;;font-weight:600'><span id=$kor_id style='display:;'>".nl2br($temp_view_kor)."</span></td> 
					</tr>
					<tr id=$tr_id1 style='display:none'>
						<form name=$form_name1 action='$IU[sub_url]/study/nexus_word_action.php' method=post target='action_frame'>
						<input type=hidden name='mode' value='key_update'>
						<input type=hidden name='wr_id' value='$temp_view_w_id'>
						<td  align=left width=340 style='padding-left:5px;font-weight:600'><textarea name=update_eng cols=60 rows=3>$temp_view_eng</textarea></td>
						
						<td  align=left width=340 style='padding-right:10px;padding-left:5px;;font-weight:600'><textarea name=update_kor cols=50 rows=3>$temp_view_kor</textarea>&nbsp;<input type=submit value='수정'></td> 
						</form>
					</tr>
					
					<tr><td colspan=3 height=1 bgcolor=cccccc></td></tr>
					
			";
			
			
		}
		?>
				</table>
			</td>
		</tr>
		</table>
		</div>
	</td>
</tr>
<tr>
	<td align=center>
		<!-- 페이지 -->
		<table width="100%" cellspacing="0" cellpadding="0">
		<tr> 
			<td width="100%" align="center" height=30 valign=bottom>
				<? if ($prev_part_href) { echo "<a href='$prev_part_href'><img src='$g4[path]/img/btn_search_prev.gif' border=0 align=absmiddle title='이전검색'></a>"; } ?>
				<?
				// 기본으로 넘어오는 페이지를 아래와 같이 변환하여 이미지로도 출력할 수 있습니다.
				//echo $write_pages;
				$write_pages = str_replace("처음", "<img src='{$IU[board]}/img/page_begin.gif' border='0' title='처음'>", $write_pages);
				$write_pages = str_replace("이전", "<img src='{$IU[board]}/img/page_prev.gif' border='0' title='이전'>", $write_pages);
				$write_pages = str_replace("다음", "<img src='{$IU[board]}/img/page_next.gif' border='0' title='다음'>", $write_pages);
				$write_pages = str_replace("맨끝", "<img src='{$IU[board]}/img/page_end.gif' border='0' title='맨끝'>", $write_pages);
				$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "<b><font class=\"s11 color_gray1\">$1</font></b>", $write_pages);
				$write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<b><font class=\"s11 color_pink1\">$1</font></b>", $write_pages);
				?>
				<?=$write_pages?>
				<? if ($next_part_href) { echo "<a href='$next_part_href'><img src='$g4[path]/img/btn_search_next.gif' border=0 align=absmiddle title='다음검색'></a>"; } ?>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>

<script type="text/javascript">
<!--
var initBody;

function beforePrint() {
 boxes = document.body.innerHTML;
 document.body.innerHTML = box.innerHTML;
}
function afterPrint() { 
 document.body.innerHTML = boxes;
}
function printArea() {
 window.print();
}

window.onbeforeprint = beforePrint;
window.onafterprint = afterPrint;



-->
</script>