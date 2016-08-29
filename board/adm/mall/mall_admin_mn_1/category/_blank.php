<?

include_once("../../define_path.php");
//IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) 
if(1)
{

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>카테고리 관리</title>
	<link rel="STYLESHEET" type="text/css" href="<?=$dark_define['site_url']?>/dark_css/style_mall_admin.css">
	<script language="JavaScript" type="text/javascript">
	<?
	for($i=1;$i<5;$i++) {
	?>
	
	function go<?=$i?>(){
		if (document.selecter<?=$i?>.select<?=$i?>.options[document.selecter<?=$i?>.select<?=$i?>.selectedIndex].value != "none") {
			location = document.selecter<?=$i?>.select<?=$i?>.options[document.selecter<?=$i?>.select<?=$i?>.selectedIndex].value
		}
	}
	
	<?
	}
	?>
	
	function adds(no, scn, wcn) {
		location.href="_add.php?no="+no+"&scn="+scn+"&wcn="+wcn;
		
		wcn_temp = eval(wcn)+1;
		parent.category.location.href="category.php?no="+no+"&wcn="+wcn_temp;
	}

	</script>	

</head>
<body bgcolor="#ffffff">

<table border=0 cellpadding=0 cellspacing=0 width=550 height=400>
<tr>
<td valign=top bgcolor="#ffffff" style="padding:2 5 5 5;line-height:22px">
<span class="none">카테고리 속성</span>

	<table width=530 border=1 cellpadding=1 cellspacing=1 bgcolor="#c4c4c4" bordercolordark="#ffffff" bordercolorlight="#eeeeee" align=center>

	<tr height=40>
	<td bgcolor="#eeeeee" width=100 align=center class="none">
	
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td><img src="../../mall_admin_images/icon/cate_1s.gif" width="16" height="16" border="0"></td>
		<td style="padding:3 0 0 6">분류</td>
		</tr>
		</table>
		
	</td>
	
	<?
	$tC="a";
	$tN=1;
	$tV="";
	?>
	
		<form name="selecter<?=$tN?>">
	<td bgcolor="#ffffff" width=430 style="padding:0 0 0 10">
		<?
		${"cateResultQuery".$tC} = "select count(no) as no from $categorySQL where wcn='$tN'";
		${"cateResultSQL_".$tC} = mysql_query(${"cateResultQuery".$tC}, $connection) or die("cateResultQuery_a error");
		${"cateResultFetch_".$tC} = mysql_fetch_array(${"cateResultSQL_".$tC});
		?>
		<select name="select<?=$tN?>" size=1 onchange="go<?=$tN?>()" class="selected">
		<option value=none><?=$tV?> <?=${"cateResultFetch_".$tC}[0]?> 건 등록
		<option value=none>--------------------
		
		<?

		${"real_selectQuery".$tC} = "select no, scn, wcn from $categorySQL where wcn='$tN' order by no asc";
		${"real_selectSQL_".$tC} = mysql_query(${"real_selectQuery".$tC}, $connection) or die("real selectQuery error");
		for(${$tC}=0;${$tC}<${"cateResultFetch_".$tC}[0];${$tC}++) {
		${"real_selectFetch_".$tC} = mysql_fetch_array(${"real_selectSQL_".$tC});
		?>
		
		<option value="javascript:adds('<?=${"real_selectFetch_".$tC}[no]?>','<?=${"real_selectFetch_".$tC}[scn]?>','<?=${"real_selectFetch_".$tC}[wcn]?>')"><?=cate_code_to_list(${"real_selectFetch_".$tC}[no])?>
		
		<?
		}
		?>
		
		</select>
	</td>
	</tr>
		</form>
	
	<tr height=40>
	<td bgcolor="#eeeeee" align=center class="none">
	
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td><img src="../../mall_admin_images/icon/cate_2s.gif" width="16" height="16" border="0"></td>
		<td style="padding:3 0 0 6">분류</td>
		</tr>
		</table>
		
	</td>
	
	<?
	$tC="b";
	$tN=2;
	$tV="";
	?>
	
		<form name="selecter<?=$tN?>">
	<td bgcolor="#ffffff" style="padding:0 0 0 10">
		<?
		${"cateResultQuery".$tC} = "select count(no) as no from $categorySQL where wcn='$tN'";
		${"cateResultSQL_".$tC} = mysql_query(${"cateResultQuery".$tC}, $connection) or die("cateResultQuery_a error");
		${"cateResultFetch_".$tC} = mysql_fetch_array(${"cateResultSQL_".$tC});
		?>
		<select name="select<?=$tN?>" size=1 onchange="go<?=$tN?>()" class="selected">
		<option value=none><?=$tV?> <?=${"cateResultFetch_".$tC}[0]?> 건 등록
		<option value=none>--------------------
		
		<?

		${"real_selectQuery".$tC} = "select no, scn, wcn from $categorySQL where wcn='$tN' order by no asc";
		${"real_selectSQL_".$tC} = mysql_query(${"real_selectQuery".$tC}, $connection) or die("real selectQuery error");
		for(${$tC}=0;${$tC}<${"cateResultFetch_".$tC}[0];${$tC}++) {
		${"real_selectFetch_".$tC} = mysql_fetch_array(${"real_selectSQL_".$tC});
		?>
		
		<option value="javascript:adds('<?=${"real_selectFetch_".$tC}[no]?>','<?=${"real_selectFetch_".$tC}[scn]?>','<?=${"real_selectFetch_".$tC}[wcn]?>')"><?=cate_code_to_list(${"real_selectFetch_".$tC}[no])?>
		
		<?
		}
		?>
		
		</select>
	</td>
	</tr>
		</form>
	
	<tr height=40>
	<td bgcolor="#eeeeee" align=center class="none">
	
		<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		<td><img src="../../mall_admin_images/icon/cate_3s.gif" width="16" height="16" border="0"></td>
		<td style="padding:3 0 0 6">분류</td>
		</tr>
		</table>
		
	</td>
	
	<?
	$tC="c";
	$tN=3;
	$tV="";
	?>
	
		<form name="selecter<?=$tN?>">
	<td bgcolor="#ffffff" style="padding:0 0 0 10">
		<?
		${"cateResultQuery".$tC} = "select count(no) as no from $categorySQL where wcn='$tN'";
		${"cateResultSQL_".$tC} = mysql_query(${"cateResultQuery".$tC}, $connection) or die("cateResultQuery_a error");
		${"cateResultFetch_".$tC} = mysql_fetch_array(${"cateResultSQL_".$tC});
		?>
		<select name="select<?=$tN?>" size=1 onchange="go<?=$tN?>()" class="selected">
		<option value=none><?=$tV?> <?=${"cateResultFetch_".$tC}[0]?> 건 등록
		<option value=none>--------------------
		
		<?

		${"real_selectQuery".$tC} = "select no, scn, wcn from $categorySQL where wcn='$tN' order by no asc";
		${"real_selectSQL_".$tC} = mysql_query(${"real_selectQuery".$tC}, $connection) or die("real selectQuery error");
		for(${$tC}=0;${$tC}<${"cateResultFetch_".$tC}[0];${$tC}++) {
		${"real_selectFetch_".$tC} = mysql_fetch_array(${"real_selectSQL_".$tC});
		?>
		
		<option value="javascript:adds('<?=${"real_selectFetch_".$tC}[no]?>','<?=${"real_selectFetch_".$tC}[scn]?>','<?=${"real_selectFetch_".$tC}[wcn]?>')"><?=cate_code_to_list(${"real_selectFetch_".$tC}[no])?>
		
		<?
		}
		?>
		
		</select>
	</td>
	</tr>
		</form>
	
	
	</table>

</td>
</tr>
</table>

</body>
</html>
<script>
self.resizeTo(document.body.scrollWidth,document.body.scrollHeight+50); 
</script>


<?
} 
ELSE 
{
?>
	<script language="javascript">
	alert('error');
	</script>
<?
}
?>
<?
mysql_close($connection);
?>
