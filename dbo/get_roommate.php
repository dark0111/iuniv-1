<?
	include_once("../common/dbcon.php");	

$roommate_sql = " SELECT wr_id, wr_comment, ca_name, wr_subject, wr_content, wr_name, mb_id, wr_datetime
				FROM `g4_write_room_mate` 
				WHERE wr_is_comment = '0'
				ORDER BY wr_id DESC 
				LIMIT 0 , 6   ";
$ds_roommate = mysql_Query($roommate_sql, $connection) or die('free_sql error');


$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
$xml .= "<channel>\n";
$xml .= "<errnum>0</errnum>\n";
$xml .= "<errmsg><![CDATA[정상]]></errmsg>\n";
$xml .= "<permission>{$permission}</permission>\n";

for ($i=0; $row = mysql_fetch_array($ds_roommate); $i++) { 
    $xml .= "<item>\n";
    $xml .= "<wr_id><![CDATA[{$row[wr_id]}]]></wr_id>\n";
    $xml .= "<wr_subject><![CDATA[{$row[wr_subject]}]]></wr_subject>\n";
    $xml .= "<wr_content><![CDATA[{$row[wr_content]}]]></wr_content>\n";
    $xml .= "<wr_name><![CDATA[{$row[wr_name]}]]></wr_name>\n";
    $xml .= "</item>\n";
}
$xml .= "</channel>\n";

header("Content-Type:text/xml;charset=utf-8");
echo $xml;
?>