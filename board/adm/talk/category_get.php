<?
include('./_common.php');

if ($is_admin != "super")
    err_xml("최고관리자만 접근 가능합니다.");

$qry = sql_query("select * from {$g4['talk_category_table']} order by rank", false);
if (!$qry) 
    err_xml('분류 정보를 가져오지 못했습니다');

$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
$xml .= "<channel>\n";
$xml .= "<errnum>0</errnum>\n";
$xml .= "<errmsg>yes</errmsg>\n";
$xml .= "<id>{$id}</id>\n";

while ($res = sql_fetch_array($qry)) {

    extract($res);

    $xml .= "<item>\n";
    $xml .= "<id>{$id}</id>\n";
    $xml .= "<name><![CDATA[{$name}]]></name>\n";
    $xml .= "<rank>{$rank}</rank>\n";
    $xml .= "</item>\n";
}
$xml .= "</channel>\n";

if (strtoupper($g4['charset'])!='UTF-8') 
    $xml = convert_charset('CP949','UTF-8',$xml);

header("Content-Type:text/xml;");
echo $xml;
?>