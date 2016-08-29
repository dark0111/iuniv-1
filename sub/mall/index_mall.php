

<TABLE cellSpacing=0 cellPadding="0" width="100%" border=0 style="margin-top:10px; margin-bottom:10px;" align="center">
<TR>
	<TD vAlign="top" align=middle>
		<table cellspacing="0" cellpadding="0"  border=0 width=100%>
		
		<tr>
			<td>
			<?
			if($_SESSION[ss_mb_id]=='admin'||$_SESSION[ss_mb_id]=='parkng5'||$_SESSION[ss_mb_id]=='dark0111'||$_SESSION[ss_mb_id]=='professor'){
				include_once('./sub/mall/mall_goods_module.php'); 
			}else{
				echo "<img src='$site_url/image/update_ready.JPG' border=0>";
			}
			?>
			</td>
		</tr>
		
		
		</table>
	<td>
	
</tr>

</table>
			

