<?
session_start();
include "../include/dbcon.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>우편번호 검색</title>
	<link rel="STYLESHEET" type="text/css" href="../../style/style.css">
	<script language="javascript">
	function openerZIPResult(add_1, add_2, zip_1, zip_2) {
		opener.<?=$FormName?>.add_1.value=add_1;
		opener.<?=$FormName?>.add_2.value=add_2;
		opener.<?=$FormName?>.zip_1.value=zip_1;
		opener.<?=$FormName?>.zip_2.value=zip_2;
		opener.<?=$FormName?>.add_2.focus();

		this.close();
	}
	function zipSearchScript() {

		if(!zipSearchForm.q.value) {
			alert("'구' 또는 '동' 을 입력하여 찾으십시오.       ");
			zipSearchForm.q.focus();
			return false;
		}

		zipSearchForm.action = "__zipsearch.php";

	}

	function zipFormClose() {
		this.close();
	}

	function textCheck(txt) {
		if((txt.keyCode > 32 && txt.keyCode < 48) || (txt.keyCode > 57 && txt.keyCode < 65) || (txt.keyCode > 90 && txt.keyCode < 97)) {
			txt.returnValue = false;
			alert("특수문자는 입력할 수 없습니다.     ");
		}
	}
		
	</script>

</head>
<body bgcolor="#ffffff">
<table border=0 cellpadding=0 cellspacing=0 width=457 align=center>
<tr><td class="hr_text">우편번호 검색</td></tr>
<tr><td><hr size=1 color="#c4c4c4"></td></tr>
<tr><td height=100 align=center>

<table border=0 cellpadding=2 cellspacing=0>
<tr>
<td colspan=3 class="ZipSearch"><strong>'구'</strong> 또는 <strong>'동'</strong> 을 입력하여 찾으십시오.</td>
</tr>
<tr>
<form name="zipSearchForm" method="get" onsubmit="return zipSearchScript()">
<input type="hidden" name="FormName" value="<?=$FormName?>">
<td class="ZipSearch">우편번호 검색 <input type="text" name="q" size="20" maxlength="15" class="TextBox" value="<?=$q?>" onkeypress="textCheck(event)"></td>
<td><input type="image" src="../image/membership/bt7.gif" width="96" height="21"></td>
</form>
<td><a href="javascript:zipFormClose()"><img src="../image/membership/bt8.gif" width="62" height="21" border="0"></a></td>
</tr>
</table>

<?
if($q) {

	$Query = "select count(no) as no from $zipcodeSQL where gogun like '$q%' or dong like '$q%'";
	$QuerySQL = mysql_query($Query, $connection) or die("ZIP Faile");
	$QueryFetch = mysql_fetch_array($QuerySQL);
	$QueryFetchCount = $QueryFetch[0];
	if($QueryFetchCount>0) {
	?>
		<hr size=1 color="#eeeeee">
		<table border=0 cellpadding=2 cellspacing=0 width=100%>

		<tr>
		<td class="ZipSearch">
		검색하신 <strong>'<?=$q?>'</strong> 의 주소가 <strong><?=number_format($QueryFetchCount)?></strong> 개 검색되었습니다.
		</td>
		</tr>

		<tr>
		<td>
		<hr size=1 color="#eeeeee">
		</td>
		</tr>

		<tr>
		<td style="line-height:18px">
			<?
			$QueryZip = "select zipcode, sido, gogun, dong, bunji from $zipcodeSQL where gogun like '$q%' or dong like '$q%'";
			$QuerySQLZip = mysql_query($QueryZip, $connection) or die("ZIP Faile");
			for($zip=0;$zip<$QueryFetchCount;$zip++) {
				$QueryFetchZip = mysql_fetch_array($QuerySQLZip);
			?>
			<?
			$ZipExplode = explode("-",$QueryFetchZip[zipcode]);
			?>
			
			<a href="javascript:openerZIPResult('<?=$QueryFetchZip[sido]?> <?=$QueryFetchZip[gogun]?> <?=$QueryFetchZip[dong]?>', '<?=$QueryFetchZip[bunji]?>', '<?=$ZipExplode[0]?>', '<?=$ZipExplode[1]?>')" class="second_product_title">
			(<?=$QueryFetchZip[zipcode]?>)
			 <?=$QueryFetchZip[sido]?>
			 <?=$QueryFetchZip[gogun]?>
			 <?=$QueryFetchZip[dong]?>
			 <?=$QueryFetchZip[bunji]?>
			 </a>
			<br>
			<?
			}
			?>
		</td>
		</tr>
		</table>

		<hr size=1 color="#eeeeee">
		<table border=0 cellpadding=2 cellspacing=0>
		<tr>
		<td colspan=3 class="ZipSearch"><strong>'구'</strong> 또는 <strong>'동'</strong> 을 입력하여 찾으십시오.</td>
		</tr>
		<tr>
		<form name="zipSearchForm" method="get" onsubmit="return zipSearchScript()">
		<input type="hidden" name="FormName" value="<?=$FormName?>">
		<td class="ZipSearch">우편번호 검색 <input type="text" name="q" size="20" maxlength="15" class="TextBox" value="<?=$q?>" onkeypress="textCheck(event)"></td>
		<td><input type="image" src="../image/membership/bt7.gif" width="96" height="21"></td>
		</form>
		<td><a href="javascript:zipFormClose()"><img src="../image/membership/bt8.gif" width="62" height="21" border="0"></a></td>
		</tr>
		</table>
	
	<?
	} else {
	?>

		<hr size=1 color="#eeeeee">
		<table border=0 cellpadding=2 cellspacing=0>
		<tr>
		<td class="ZipSearch">
		검색하신 '<?=$q?>'에 해당하는 '구' 또는 '동'이 없습니다.<br>
		다시 한번 검색하여 주십시오.
		</td>
		</tr>
		</table>
	
	<?
	}
	?>







<?
}
?>

</td></tr>
<tr><td><hr size=1 color="#c4c4c4"></td></tr>
</table>

</body>
</html>
<?
mysql_close($connection);
?>
