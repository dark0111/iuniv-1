<?
$h_cd = $_REQUEST["h_cd"];

	$dan_num1=5;
	$dan_num2=5;


$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
$xml .= "<datas>\n";
for ($i=1;$i<=$dan_num2;$i++){
	$gugudan_str = $dan_num1." * ".$i." = ".$a;
	//$xml .= "<item>\n";
	//$xml .= "<result>$gugudan_str</result>\n";
	//$xml .= "</item>\n";
	$xml .= "<item>http://iuniv.kr/sub2/information/image/club/6.jpg</item>\n";
}
$xml .= "</datas>\n";
header("Content-Type:text/xml;charset=utf-8");
echo $xml;
?>
