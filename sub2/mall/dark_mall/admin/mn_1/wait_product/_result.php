<?
session_start();
include "../../../include/dbcon.php";
IF($HTTP_SESSION_VARS[OLD_NO] AND $HTTP_SESSION_VARS[OLD_ID] AND $HTTP_SESSION_VARS[OLD_NAME]) {

# 설정대기된 상품의 상태를 변경합니다.
	IF(!STRCMP($result, "openmarket_modify")) {

		$updateQuery = "update $productSQL set ";
		$updateQuery .= " user_type='$user_type' ";
		$updateQuery .= " where product_code='$product_code'";
		mysql_query($updateQuery, $connection) or die("updateQuery error");
		?>
		<script language="javascript">
		location.href="_pdt_view.php?product_code=<?=$product_code?>&page=<?=$page?>&limit=<?=$limit?>&q=<?=$q?>";
		</script>
		<?
	}
	?>

<?
} ELSE {
?>
	<script language="javascript">
	location.href="/admin/";
	</script>
<?
}
?>

<?
mysql_close($connection);
?>
