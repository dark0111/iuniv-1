<?

$g4[title] = "해커즈 토익 파랭이 voca 훈련 프로그램  ";
if(!$file_name)
{
	$word_file_name="Day1.lrc";
}
else
{
	$word_file_name=$file_name;
}
$sql2 = " select w_id from english_study where word_file_name = '$word_file_name' limit 1";
$row2 = sql_fetch($sql2);
//파일이 아직 DB화 되지 않았다면 DB처리

$word_type=array("vt","n","a","ad","phr","adv","vt");
$word_eng=array();
$workd_kor=array();
if (!$row2[w_id])
{
	
	$file=new mh_files;
	$cont=$file->fr($IU[path]."english_study_word/$word_file_name");
	$cont=iconv("euc-kr","utf-8",$cont);
	$ex_cont=explode("\n",$cont);
	$arr_index=0;
	
	foreach($ex_cont as $key=>$value)
	{
		
		$ex_cont2=explode("]",$value);
		
		$temp_tr=trim($ex_cont2[1]);
	
		if($temp_tr)
		{
			$temp_word_eng='';
			$temp_word_kor='';
			$ex_cont3=explode("  ",$temp_tr);
			$temp_word_eng=$ex_cont3[0];
			$ex_cont3[0]="";
			$temp_word_kor=join("  ",$ex_cont3);
			$arr_index++;
			$temp_word_eng=str_replace("'","`",$temp_word_eng);
			$temp_word_kor=str_replace("'","`",$temp_word_kor);
			$sql3 = "insert into english_study set
			word_eng='$temp_word_eng',
			word_kor='$temp_word_kor',
			word_file_name='$word_file_name'
			";
			sql_query($sql3);
		}
	}

}



$sql2 = " select * from english_study where word_file_name = '$word_file_name'";
$result_c = sql_query($sql2);
$total=mysql_num_rows($result_c);
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
</script>

<table border="0" cellpadding="0" cellspacing="0" width=100%>
<tr>
	<td>
		<table border="0" cellpadding="0" cellspacing="0" width=100%>
		<tr>
			<td><img src="<?=$g4['path']?>/main/image/tit_edge01.gif" border="0"></td>
			<td  background="<?=$g4['path']?>/main/image/tit_bg.gif" width=200>파랭이 영어 보카 연습</td>
			<td  background="<?=$g4['path']?>/main/image/tit_bg.gif" width="600" align="right"><img src="<?=$g4['path']?>/main/image/tit_icon.gif" border="0" align="absmiddle">&nbsp;Home > 영어공부 > <b>해커즈 파랭이 보카 훈련</b></td>
			<td align=right><img src="<?=$g4['path']?>/main/image/tit_edge02.gif" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td align=right>이 자료는 저작권이 해커즈에 있답니다. 책 보시면서 연습 필요 하실때 이용하세요. </td>
</tr>
<tr>
	<td align=right>숨겨진 3종류의 보기 버튼을 적절히 이용해 확인 가능 합니다.</td>
</tr>
<tr>
	<td align=right>단어는 랜덤으로 출력 됩니다.(페이지 갱신(refresh))</td>
</tr>
<tr>
	<td align=right style='color:red;font-weight:bold;font-size:11pt'>필요에 따라 조금씩 업데이트 해 나가겠 습니다.허접 하지만 이해해 주세요.</td>
</tr> 
<!-- <tr>
	<td align=right style='color:red;font-weight:bold;font-size:13pt'>작업중....죄송합니다. 30분뒤 오픈...</td>
</tr> -->
<tr>
	<td align=right>
	<!-- <input type=button value='모두 보기' onclick="javascript:location.href='./index.php?mode=<?=$mode?>&view_mode=all_view&file_name=<?=$file_name?>'" style='cursor:pointer'>&nbsp;
	<input type=button value='spell 맞추기' onclick="javascript:location.href='./index.php?mode=<?=$mode?>&view_mode=eng&file_name=<?=$file_name?>'" style='cursor:pointer'>&nbsp;
	<input type=button value='의미 맞추기' onclick="javascript:location.href='./index.php?mode=<?=$mode?>&view_mode=kor&file_name=<?=$file_name?>'" style='cursor:pointer'>&nbsp;
	-->
	<input type=button value='순서대로 보기' onclick="javascript:location.href='./index.php?mode=<?=$mode?>&view_mode=order&file_name=<?=$file_name?>'" style='cursor:pointer'>&nbsp;
	<input type=button value='섞어 보기' onclick="javascript:location.href='./index.php?mode=<?=$mode?>&view_mode=rand&file_name=<?=$file_name?>'" style='cursor:pointer'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type=button value='모두 보기' onclick="view_controle('all')" style='cursor:pointer'>&nbsp;
	<input type=button value='영어 만 보기' onclick="view_controle('eng')" style='cursor:pointer'>&nbsp;
	<input type=button value='한글 만 보기' onclick="view_controle('kor')" style='cursor:pointer'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
	<input type=button value='프린트하기' onclick="printArea()" style='cursor:pointer'></td>
</tr>
<tr>
	<td align=right height=30></td>
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
			$ai++;
		}
		if(!$view_mode)$view_mode='rand';
		if($view_mode!='order')shuffle($word_result);

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
			$i_c=$i+1;
			$temp_view_kor=$word_result[$i][kor];
			$temp_view_eng=$word_result[$i][eng];
			$eng_id="eng_td_".$i;
			$kor_id="kor_td_".$i;
			
			echo"
			<td style='padding-left:5px;'  >$i_c </td>
			<td style='padding-left:5px;' ><span id=$eng_id style='display:'> $temp_view_eng</span></td>
			
			<td style='padding-right:10px;padding-left:5px;'><span id=$kor_id style='display:none'>$temp_view_kor</span></td> 
			
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