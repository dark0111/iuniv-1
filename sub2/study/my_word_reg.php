<?

$g4[title] = "해커즈 토익 파랭이 voca 훈련 프로그램  ";


if(!$member[mb_id])$mb_id='guest';
$sql2t = " select w_id from english_study where member_id = '$mb_id'";
$result_ct = sql_query($sql2t);
$totalt=mysql_num_rows($result_ct);

$page_rows=50;
$total_page  = ceil($totalt / $page_rows);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함
$write_pages = get_paging($config[cf_write_pages], $page, $total_page, "$IU[home_file]?mode=my_word_reg&".$qstr."&page=");

$sql2 = " select * from english_study where member_id = '$mb_id' order by w_id ";
$sql2 = $sql2." limit $from_record,$page_rows ";
$result_c = sql_query($sql2);


$list_href = '';
$prev_part_href = '';
$next_part_href = '';
if ($sca || $stx)  
{
    $list_href = "$IU[home_file]?mode=my_word_reg";

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
	function view_controle(tm)
	{
		if(tm=='all')
		{
			for(var i=0;i<<?=$total?>;i++)
			{
				document.getElementById('eng_td_'+i).style.display='';
				document.getElementById('kor_td_'+i).style.display='';
			}
		}
		else if(tm=='kor')
		{
			for(var i=0;i<<?=$total?>;i++)
			{
				document.getElementById('eng_td_'+i).style.display='none';
				document.getElementById('kor_td_'+i).style.display='';
			}
		}
		else if(tm=='eng')
		{
			for(var i=0;i<<?=$total?>;i++)
			{
				document.getElementById('eng_td_'+i).style.display='';
				document.getElementById('kor_td_'+i).style.display='none';
			}
		}
	}
	function my_word_del(w_id)
	{
		action_frame.location.href='<?=$IU[sub_url]?>/study/my_word_action.php?action_mode=delete&w_id='+w_id;
	}
</script>
<iframe name=action_frame width=0 height=0></iframe>
<table border="0" cellpadding="0" cellspacing="0" width=100%>
<tr>
	<td>
		<table border="0" cellpadding="0" cellspacing="0" width=100%>
		<tr>
			<td><img src="<?=$g4['path']?>/main/image/tit_edge01.gif" border="0"></td>
			<td  background="<?=$g4['path']?>/main/image/tit_bg.gif" width=200>내가 만드는 단어장</td>
			<td  background="<?=$g4['path']?>/main/image/tit_bg.gif" width="600" align="right"><img src="<?=$g4['path']?>/main/image/tit_icon.gif" border="0" align="absmiddle">&nbsp;Home > 영어공부 > <b>나의 단어장</b></td>
			<td align=right><img src="<?=$g4['path']?>/main/image/tit_edge02.gif" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td align=right style='color:red;font-weight:bold;font-size:11pt'>필요에 따라 조금씩 업데이트 해 나가겠 습니다.허접 하지만 이해해 주세요.</td>
</tr> 
<tr>
	<td>
		<form name=reg_form action='<?=$IU[sub_url]?>/study/my_word_action.php' method=post target='action_frame'>
		<input type=hidden name=action_mode value='reg'>
		<table border="0" cellpadding="0" cellspacing="5" style='border:1px solid #000000'>
		<tr>
			<td>
				
				<table border="0" cellpadding="0" cellspacing="0" >
				<tr>
					<td>
						<select name=word_type  tabindex=1 size=8 style='border:1px solid #cccccc'>
						<option value='n'>n (명사)</option>
						<option value='v'>v (동사)</option>
						<option value='adj'>adj (형용사)</option>
						<option value='prep'>prep (전치사)</option>
						<option value='vt'>vt (타동사)</option>
						<option value='phr'>phr (문장)</option>
						<option value='adv'>adv (부사)</option>
						<option value='etc' selected>etc (기타)</option>
						</select>
					</td>
					<td width=20></td>
					<td>
						<table border="0" cellpadding="0" cellspacing="0" >
						<tr>
							<td>영문</td>
						</tr>
						<tr>
							<td><input type=text size=30 tabindex=2 id=ta name=word_eng style='border:1px solid #cccccc;ime-mode:inactive '></td>
						</tr>
						<tr>
							<td height=10></td>
						</tr>
						<tr>
							<td>한글</td>
						</tr>
						<tr>
							
							<td><input type=text size=30 tabindex=3 name=word_kor style='border:1px solid #cccccc;ime-mode:active '  ></td>
						</tr>
						</table>
					</td>
					<td width=20></td>
					<td>
						<table border="0" cellpadding="0" cellspacing="0" >
						<tr>
							<td>예문(enter 로 구분)</td>
						</tr>
						
						<tr>
							<td ><textarea name=word_ex tabindex=3 cols=70 rows=5 style='border:1px solid #cccccc'></textarea></td>
						</tr>
						</table>
					</td>
					
				</tr>
				</table>
				
			</td>
			<td width=20></td>
			<td>
				<input type=submit style='width:50px;height:100px' value='등록'>
			</td>
		</tr>
		</table>
		</form>
	</td>
</tr>
<!-- <tr>
	<td align=right style='color:red;font-weight:bold;font-size:13pt'>작업중....죄송합니다. 30분뒤 오픈...</td>
</tr> -->
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
			$word_result[$ai][eng]=$row_c[word_eng];
			$word_result[$ai][kor]=$row_c[word_kor];
			$word_result[$ai][w_id]=$row_c[w_id];
			$ai++;
		}
		if(!$view_mode)$view_mode='rand';
		if($view_mode!='rand')@shuffle($word_result);

		?>
		<tr><td align=center height=30><b><?=$word_file_name?></b></td></tr>
		<tr>
			<td>
				<table border="1" cellpadding="0" cellspacing="3" width=100% style='border-collapse:collapse' bordercolor = "#cccccc">
				<tr>
					<td align=center width=40 style='font-weight:bold;color:blue'>번호</td>
					<td align=center width=200 style='font-weight:bold;color:blue'>english</td>
					
					<td align=center width=200 style='font-weight:bold;color:blue'>korean</td>
					<td align=center width=40 style='font-weight:bold;color:blue'>번호</td>
					<td align=center width=200 style='font-weight:bold;color:blue'>english</td>
				
					<td align=center width=200 style='font-weight:bold;color:blue'>korean</td>
					
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
			
			if($is_admin)
			{
				$del_op="<a style='cursor:pointer' onclick='my_word_del($temp_view_w_id);'>삭제</a>";
			}
			echo"
			<td style='padding-left:5px;'  >$i_c <br>$del_op</td>
			<td style='padding-left:5px;' ><span id=$eng_id style='display:'> $temp_view_eng</span></td>
			
			<td style='padding-right:10px;padding-left:5px;'><span id=$kor_id style='display:'>$temp_view_kor</span></td> 
			
			";
			
			

			if($i_c%2==0)
			{
				echo"
				</tr>
				
				<tr>
				";
			}
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


window.onload = function() {document.getElementById('ta').focus();} 

-->
</script>