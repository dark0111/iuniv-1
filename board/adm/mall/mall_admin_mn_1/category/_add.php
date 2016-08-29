<?
session_start();
include_once("../../define_path.php");
//IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) 



// 버튼의 일부 이미지를 반환하는 변수
$Button_MenuValue = explode(",","a,b,c,d");


// 현재 카테고리의 하위카테고리가 존재하는지 파악합니다. <시작>
$SubCategoryQuery = "select count(no) as no from $categorySQL where scn='$no'";
$SubCategorySQL = mysql_query($SubCategoryQuery, $connection) or die("SubCategoryQuery error");
$SubCategoryFetch = mysql_fetch_array($SubCategorySQL);
// 현재 카테고리의 하위카테고리가 존재하는지 파악합니다. <종료>

// 현재 카테고리의 정보를 불러옴 <시작>
$category_QueryLoad = "select scn, cate_name, cate_info, use_yn from $categorySQL where no='$no'";
$category_SQLLoad = mysql_query($category_QueryLoad, $connection) or die("categoryQueryLoad error");
$category_FetchLoad = mysql_fetch_array($category_SQLLoad);
// 현재 카테고리의 정보를 불러옴 <종료>

// cate_info 해당카테고리의 상품수를 뜻합니다.
// $SubCategoryFetch[0] 는 해당카테고리의 하위카테고리의 수를 말합니다.
// cate_info 와 $SubCategoryFetch[0]를 더한값이 0이되어야 현재의 카테고리를 삭제할 수 있습니다.

$dropCategoryCheck = $SubCategoryFetch[0]+$category_FetchLoad[cate_info];


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>카테고리 관리</title>
		<link rel="STYLESHEET" type="text/css" href="<?=$dark_define['site_url']?>/dark_css/style_mall_admin.css">
	
	
	<script language="javascript">
	function category() {
		if(!cateForm.cate_name.value) {
			alert("카테고리 이름을 입력하십시오.      ");
			cateForm.cate_name.focus();
			return false;
		}
		
		cateForm.action = "_result.php";
	}

	function textCheck(txt) {
		if((txt.keyCode > 32 && txt.keyCode < 40) || (txt.keyCode > 57 && txt.keyCode < 65) || (txt.keyCode > 90 && txt.keyCode < 97)) {
			txt.returnValue = false;
			alert("특수문자는 입력할 수 없습니다.     ");
		}
	}
	
	function categoryModification(no, scn, wcn) {
	
		location.href="_modify.php?no="+no+"&scn="+scn+"&wcn="+wcn;
	
	}
	
	<?
	if(!strcmp($dropCategoryCheck,"0")) {
	?>
	
	function categoryDrop(no, wcn) {
	
		if(wcn==1) {
			wcn_name = "대";
		} else if(wcn==2) {
			wcn_name = "중";
		} else if(wcn==3) {
			wcn_name = "소";
		} else if(wcn==4) {
			wcn_name = "상세";
		}

		if(confirm("("+wcn_name+") 분류를 삭제하시겠습니까?      ")) {
			location.href="_result.php?no="+no+"&wcn="+wcn+"&result=drop";
		}
	}

	<?
	}
	?>
	
	function which(no, scn, wcn, order) {
		location.href="_result.php?no="+no+"&scn="+scn+"&wcn="+wcn+"&order="+order+"&result=which";
	}
	
	function focus_input() {
		cateForm.cate_name.focus();
	}
	
	</script>
	
</head>
<body bgcolor="#ffffff" topmargin=0 onload="focus_input()">
<?
// 대분류 이상일 경우에만 표시해줍니다. <시작>
if($wcn>1) {
?>
	
	<?
	// 각각의 이미지를 구분하기 위해서 만든 비교문
	$wcn_temp = $wcn-1;
	
	switch ($wcn_temp) {
		case("1"):
		$c1t = "s";
		break;
	
		case("2"):
		$c2t = "s";
		break;
	
		case("3"):
		$c3t = "s";
		break;
	
		case("4"):
		$c4t = "s";
		break;
	}
	?>

	
	<!-- 타이틀 <시작> -->
	<table border=0 cellpadding=0 cellspacing=0 width=529 height=25 align=center>
	<tr>
	<td class="title">
		선택한 카테고리의 정보
	</td>
	</tr>
	</table>
	<!-- 타이틀 <종료> -->
	
		
	<table width=530 border=1 cellpadding=1 cellspacing=1 bgcolor="#c4c4c4" bordercolordark="#ffffff" bordercolorlight="#eeeeee" align=center>
		<tr height=25>
			<td bgcolor="#eeeeee" width=150 align=center>
			
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
				<td width="20"><img src="../../mall_admin_images/icon/cate_1<?=$c1t?>.gif" width="16" height="16" border="0"></td>
				<td width="20"><img src="../../mall_admin_images/icon/cate_2<?=$c2t?>.gif" width="16" height="16" border="0"></td>
				<td width="20"><img src="../../mall_admin_images/icon/cate_3<?=$c3t?>.gif" width="16" height="16" border="0"></td>
				<td width="32"><img src="../../mall_admin_images/icon/cate_4<?=$c4t?>.gif" width="28" height="16" border="0"></td>
				</tr>
				</table>	
			
			</td>
			<td bgcolor="#ffffff" width=380>
				
				<?=cate_code_to_list($no);?>
				
			</td>
		</tr>
		
		<tr height=25>
			<td bgcolor="#eeeeee" width=150 align=center>
			위치 변경하기
			</td>
			<td bgcolor="#ffffff" width=380>
			<?
			// 먼저 옮길 수 있는지 파악하는 쿼리를 전송합니다.
			// 결과값이 1이상이 나오면 옮길 수 있으며 그렇지 않으면 옮길 수 없습니다.

			$wcn_temp = $wcn-1;
			$which_changeQuery_up = "select count(no) as no from $categorySQL where no<$no and wcn='$wcn_temp' and scn='$category_FetchLoad[scn]' order by no desc limit 0,1";
			$which_changeSQL_up = mysql_query($which_changeQuery_up, $connection) or die("which changeQuery error");
			$which_changeFetch_up = mysql_fetch_array($which_changeSQL_up);

			$which_changeQuery_down = "select count(no) as no from $categorySQL where no>$no and wcn='$wcn_temp' and scn='$category_FetchLoad[scn]' order by no asc limit 0,1";
			$which_changeSQL_down = mysql_query($which_changeQuery_down, $connection) or die("which changeQuery error");
			$which_changeFetch_down = mysql_fetch_array($which_changeSQL_down);
			
			$which_not = $which_changeFetch_up[0]+$which_changeFetch_down[0];
			?>	
			
				<table border=0 cellpadding=0 cellspacing=0>
				<tr>
			
				<?
				if(!strcmp($which_not,0)) {
				?>
				<td style="padding:0 2 0 0"><img src="../../mall_admin_images/more/move_not_image.gif" width="108" height="19" alt=""></td>
				<?
				}
				?>
				

				<?
				if($which_changeFetch_up[0]>0) {
				?>
				<td style="padding:0 2 0 0"><a href="javascript:which('<?=$no?>','<?=$category_FetchLoad[scn]?>','<?=$wcn?>','up')"><img src="../../mall_admin_images/more/move_up_image.gif" width="55" height="19" border="0"></a></td>
				<?
				}
				?>
				
				
				<?
				if($which_changeFetch_down[0]>0) {
				?>
				<td style="padding:0 0 0 2"><a href="javascript:which('<?=$no?>','<?=$category_FetchLoad[scn]?>','<?=$wcn?>','down')"><img src="../../mall_admin_images/more/move_down_image.gif" width="68" height="19" border="0"></a></td>
				<?
				}
				?>
			
			
				</tr>
				</table>
				
			</td>
		</tr>
		
		<tr height=25>
			<td bgcolor="#eeeeee" width=150 align=center>
			상품수
			</td>
			<td bgcolor="#ffffff" width=380>
				<?=$category_FetchLoad[cate_info]?> 개
			</td>
		</tr>
		<tr height=25>
			<td bgcolor="#eeeeee" width=150 align=center>
			사용유무
			</td>
			<td bgcolor="#ffffff" width=380>
				<select name='use_yn'>
					<option value='Y'<? if($category_FetchLoad[use_yn]=='Y'){echo'selected';}?>>Y</option>
					<option value='N'<? if($category_FetchLoad[use_yn]=='N'){echo'selected';}?>>N</option>
				</select>
			</td>
		</tr>
	</table>

	<br>
	<table border=0 cellpadding=0 cellspacing=0 align=center>
	<tr>
	<td><a href="javascript:categoryModification('<?=$no?>','<?=$scn?>','<?=$wcn?>')"><img src="../../mall_admin_images/more/cate_<?=$Button_MenuValue[$wcn-2]?>_modify.gif" width="96" height="21" border="0"></a></td>
	
	<?
	if(!strcmp($dropCategoryCheck,"0")) {
	?>
	
	<td width=5></td>
	<td><a href="javascript:categoryDrop('<?=$no?>', '<?=$wcn-1?>')"><img src="../../mall_admin_images/more/cate_<?=$Button_MenuValue[$wcn-2]?>_drop.gif" width="96" height="21" border="0"></a></td>
	
	<?
	}
	?>
	
	</tr>
	</table>
	
	
	<br>
<?
}
// 대분류 이상일 경우에만 표시해줍니다. <종료>
?>
	
<?
// 상세분류 이하는 만들 수 없게 함. <시작>
if($wcn<5) {
?>

	<?
	switch ($wcn) {
		case("1"):
		$c1 = "s";
		$cValue = "대";
		break;
		
		case("2"):
		$c2 = "s";
		$cValue = "중";
		break;
	
		case("3"):
		$c3 = "s";
		$cValue = "소";
		break;
	
		case("4"):
		$c4 = "s";
		$cValue = "상세";
		break;
	}
	?>

	<!-- 타이틀 <시작> -->
	<table border=0 cellpadding=0 cellspacing=0 width=529 height=25 align=center>
	<tr>
	<td class="title">
		<?=$cValue?>분류 만들기
	</td>
	</tr>
	</table>
	<!-- 타이틀 <종료> -->


	<table width=530 border=1 cellpadding=1 cellspacing=1 bgcolor="#c4c4c4" bordercolordark="#ffffff" bordercolorlight="#eeeeee" align=center>
	<form name="cateForm" method="post" onsubmit="return category()">
	<input type="hidden" name="result" value="save">
	<input type="hidden" name="no" value="<?=$no?>">
	<input type="hidden" name="scn" value="<?=$scn?>">
	<input type="hidden" name="wcn" value="<?=$wcn?>">
	<input type="hidden" name="extend_cate_name" value="<?=cate_code_to_list($no);?>">

	<tr height=25>
	<td bgcolor="#eeeeee" width=150 align=center>

		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td width="20"><img src="../../mall_admin_images/icon/cate_1<?=$c1?>.gif" width="16" height="16" border="0"></td>
		<td width="20"><img src="../../mall_admin_images/icon/cate_2<?=$c2?>.gif" width="16" height="16" border="0"></td>
		<td width="20"><img src="../../mall_admin_images/icon/cate_3<?=$c3?>.gif" width="16" height="16" border="0"></td>
		<td width="32"><img src="../../mall_admin_images/icon/cate_4<?=$c4?>.gif" width="28" height="16" border="0"></td>
		</tr>
		</table>	
	
	</td>
	<td bgcolor="#ffffff" width=380>
	<?=cate_code_to_list($no);?> > <input type="text" size="20" maxlength="50" name="cate_name" onkeypress="textCheck(event)">
	</td>
	</tr>

	</table>

	<br>
	

	<table border=0 cellpadding=0 cellspacing=0 align=center>
	<tr>
	<td><input type="image" src="../../mall_admin_images/more/cate_<?=$Button_MenuValue[$wcn-1]?>_add.gif" width="96" height="21"></td>
	</tr>
	</form>
	</table>
	
<?
}
// 상세분류 이하는 만들 수 없게 함. <종료>
?>
</body>
</html>
<script>
self.resizeTo(document.body.scrollWidth,document.body.scrollHeight); 
</script>

<?
mysql_close($connection);
?>


