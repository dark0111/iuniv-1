<?
	
	if(isset($_REQUEST['site_path'])) exit;
	if(!isset($site_path)) $site_path='../sub/mall/';
	if(!isset($site_url)) $site_url='../';
	if(!isset($site_path) || preg_match("/:\/\//",$site_path)) $site_path='../sub/mall/';	

	// 메인 라이브러리
	
	include_once($_path['inc'].'validate.php');
	include_once($_path['inc'].'order_class.php');
	



	include_once($_path['inc'].'mysql_class.php');
	$dbcon = new mysql();
	$dbcon->set_debug(0);
	$dbcon->connect('localhost','dark0111','wjswkwjdqh04','dark0111','3306');
	unset($__dbconf);
	$rs=new recordset($dbcon);

 

?>
