<?
include('./_common.php');
include('./mytalk_config.php');

$res = sql_fetch("select * from {$g4['talk_info_table']} where id='{$t_id}'", false);
if (!$res) 
    err_xml('토크환경정보를 가져오지 못했습니다');

$talk_about = $res['talk_about'];

$image = "{$g4['path']}/data/talk/profile_image/{$current['mb_id']}";
if (!file_exists($image)){
	if($member[mb_sex]=="F"){//이미지 학교별 세팅
		$image="../../css/img/tools/user_female";
	}elseif($member[mb_sex]=="M"){
		$image="../../css/img/tools/user_male";
	}else{
		$image="../../css/img/tools/user_anymore";
	}
	if($member[mb_1]=="82"){
		$image.="2";
	}
	$image.=".png";
}
$image .= "?".time();

$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
$xml .= "<channel>\n";
$xml .= "<errnum>0</errnum>\n";
$xml .= "<errmsg><![CDATA[정상]]></errmsg>\n";
$xml .= "<talk_about><![CDATA[{$talk_about}]]></talk_about>\n";
$xml .= "<image><![CDATA[{$image}]]></image>\n";
$xml .= "</channel>\n";

// 한글은 고조 euckr 로..
if (strtoupper($g4['charset'])!='UTF-8') 
    $xml = convert_charset('CP949','UTF-8',$xml);

header("Content-Type:text/xml;");
echo $xml;
?>