<?
include_once("$IU[sub_path]/study/file_controle_lib.php");
$g4[title] = "해커즈 토익 파랭이 voca 훈련 프로그램  ";

?>
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
	<td align=right>회원만 이용 가능 합니다.(현재는 준비중 입니다.)</td>
</tr>
<tr>
	<td align=right>숨겨진 부분은 drag 하시면 보입니다.</td>
</tr>
<tr>
	<td align=right>
	<input type=button value='spell 맞추기' onclick="javascript:location.href='./index.php?mode=<?=$mode?>&view_mode=eng'" style='cursor:pointer'>&nbsp;
	<input type=button value='의미 맞추기' onclick="javascript:location.href='./index.php?mode=<?=$mode?>&view_mode=kor'" style='cursor:pointer'>&nbsp;
	
	<input type=button value='프린트하기' onclick="alert('준비중입니다.')" style='cursor:pointer'></td>
</tr>
<tr>
	<td align=right height=30></td>
</tr>


<?
$word_file_name="Day1.lrc";
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
		echo $temp_tr."<br>";
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
$ai=0;
while($row_c = sql_fetch_array($result_c))
{
	$word_result[$ai][eng]=$row_c[word_eng];
	$word_result[$ai][kor]=$row_c[word_kor];
	$ai++;
}

shuffle($word_result);
if(!$view_mode)$view_mode='kor';
?>
<tr><td align=center height=30><?=$word_file_name?></td></tr>
<tr>
	<td>
		<table border="1" cellpadding="0" cellspacing="3" width=100% style='border-collapse:collapse' bordercolor = "#cccccc">
		<tr>
			<td align=center width=200 style='font-weight:bold;color:blue'>english</td>
			
			<td align=center width=200 style='font-weight:bold;color:blue'>korean</td>
			
			<td align=center width=200 style='font-weight:bold;color:blue'>english</td>
		
			<td align=center width=200 style='font-weight:bold;color:blue'>korean</td>
			
		</tr>
		

<?
for($i=0;$i<count($word_result);$i++)
{
	$i_c=$i+1;
	$temp_view_kor=$word_result[$i][kor];
	$temp_view_eng=$word_result[$i][eng];
	
	if($view_mode=='kor')
	{
		echo"
		<td style='padding-left:5px'>$i_c . $temp_view_eng</td>
		
		<td style='padding-right:10px;padding-left:5px;color:#ffffff'>$temp_view_kor</td>
		
		";
	}
	elseif($view_mode=='eng')
	{
		echo"
		<td style='padding-left:5px;color:#ffffff'>$temp_view_eng</td>
		
		<td style='padding-right:10px;padding-left:5px;'>$i_c . $temp_view_kor</td>
		
		";
	}

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