<?
// Redirect for ipod touch / iPhone
if(strpos($_SERVER['HTTP_USER_AGENT'],'iPod') || strpos($_SERVER['HTTP_USER_AGENT'],'iPhone') || strpos($_SERVER['HTTP_USER_AGENT'],'Android') || strpos($_SERVER['HTTP_USER_AGENT'],'SymbianOS') || strpos($_SERVER['HTTP_USER_AGENT'],'BlackBerry') || strpos($_SERVER['HTTP_USER_AGENT'],'SonyEricsson') || strpos($_SERVER['HTTP_USER_AGENT'],'IEMobile') || strpos($_SERVER['HTTP_USER_AGENT'],'Mobile') || strpos($_SERVER['HTTP_USER_AGENT'],'lgtelecom') || strpos($_SERVER['HTTP_USER_AGENT'],'PPC')){
   // echo "아이폰 접속 체크";BlackBerry9000,SonyEricsson
?>
	<script language='javascript'>
		location.href="./iphone/";
	</script>
<?
} 
?>
