<?
if(!isset($g4_path)) $g4_path = ".";
include_once ("$g4_path/common.php");
session_start();
header ("Content-Type: text/html; charset=UTF-8");
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

//if (!$member[mb_id]) 
 //   alert_close("회원만 이용하실 수 있습니다.");
if($member[mb_nick]){
	$usenick = $member[mb_nick];
} else {
	$usenick = "손님".rand(1,999);
}

if($_POST[usenick] && $_POST[text]) {
if(!$_SESSION[name] || $_SESSION[name] != $_POST[usenick]) {
$_POST[usenick] = str_replace('<', '&lt;', str_replace('　', '', stripslashes(trim($_POST[usenick]))));
$_POST[usenick] = preg_replace("` [\s]`i", "", $_POST[usenick]);
$_POST[usenick] = preg_replace("`[\x1b\x18\x7f\t]`", "", $_POST[usenick]);
$nickc = "";
if($_SESSION[name]) $nickc = "--\x1b<font class=mc><font class=mm>".$_SESSION[name]."</font> → <font class=mm>".$_POST[usenick]."</font>로 닉변경함</font>\n";
session_unregister("name");
$name = $_POST[usenick];
session_register("name");
}
if($_POST[usenick] && $_POST[text]) {
$_POST[text] = preg_replace("`[\x1b\x18\x7f<]`", "", stripslashes($_POST[text]));
$fp = fopen("$g4[path]/skin/chat/data/_text", "a");
fputs($fp, $nickc.$_POST[usenick]."\x1b".$_POST[text]."\n");
fclose($fp);
if(filesize("$g4[path]/skin/chat/data/_text") > 2048) {
$fp = fopen("$g4[path]/skin/chat/data/_text", "r");
fread($fp, 1536);
fgets($fp);
while(!feof($fp)) $fpo .= fgets($fp);
fclose($fp);
$fp = fopen("$g4[path]/skin/chat/data/_text", "w");
fputs($fp, $fpo);
fclose($fp);
}
}
exit;
}
if($_GET[tex]) {
if(file_exists("$g4[path]/skin/chat/data/_text")){
if($_GET[tex] == -1) $_GET[tex] = 0;
$fze = filesize("$g4[path]/skin/chat/data/_text");
if($fze != $_GET[tex]) {
echo $fze."\x7f";
$fp = fopen("$g4[path]/skin/chat/data/_text", "r");
while(!feof($fp)) {
if($_GET[tex] && $fze > $_GET[tex]) fread($fp, $_GET[tex]);
if($fpo = trim(fgets($fp))) echo $fpo."\x7f";
}
fclose($fp);
}
}
exit;
}
if($_GET[delete] == "text" && $is_admin) {
//if($_GET[delete] == "text") {
$fp = fopen("$g4[path]/skin/chat/data/_text", "w");
fclose($fp);
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>채팅방</title>
<script>
function go() {
var url = '?tex=' + document.getElementsByName('ntim')[0].value;
   if(window.ActiveXObject) {
       var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
   } 
   else if(window.XMLHttpRequest) {
       var xmlHttp = new XMLHttpRequest();
   }
xmlHttp.onreadystatechange = function(){
if(xmlHttp.readyState==4 && xmlHttp.status==200) {
var str = xmlHttp.responseText;
if(str) {
var vew = str.split("\x7f");
allc = vew.length -1;
if(allc > 1) {
document.getElementsByName('ntim')[0].value = vew[0];
if(document.getElementById('AA').innerHTML == '') str = "<table border=0 cellspacing=0 cellpadding=0 width=100% style='margin-bottom:20;table-layout:fixed'>";
else str = "";
for(i = 1;i < allc;i++){
var nam = vew[i].split("\x1b");
str += "<tr class=trh><td class=name>"+ nam[0] +"</td><td width=10>:</td><td class=memo>"+ nam[1] +"</td></tr>";
str += "<tr><td colspan=3 bgcolor=#E6E6E6 height=1><img height=1></td></tr>";
}
str += "</table>";
document.getElementById('AA').innerHTML = document.getElementById('AA').innerHTML.substring(0,document.getElementById('AA').innerHTML.length-8)  + str;
document.getElementById('AA').scrollTop = 10000000;
}
} else window.status = '새 글이 없습니다.';
setTimeout('go()', 1000);
delete xmlHttp;
}
}
xmlHttp.open("GET", url, true);
xmlHttp.send(null);
}

function wte(){
   if(window.ActiveXObject) {
       var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
   } 
   else if(window.XMLHttpRequest) {
       var xmlHttp = new XMLHttpRequest();
   }
var param = '?&usenick='+ document.getElementsByName("usenick")[0].value.replace(/[&'"]/gi,"") +'&text='+ document.getElementsByName("text")[0].value.replace("&","%26");
xmlHttp.open("POST", param, false);
xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
xmlHttp.setRequestHeader("Content-length", param.length);
xmlHttp.setRequestHeader("Connection", "close");
xmlHttp.send(param);
document.getElementsByName('text')[0].value = '';
document.getElementsByName('text')[0].focus();
return false;
}
window.onload = function(){setTimeout("document.getElementsByName('ntim')[0].value='-1';", 50);}
setTimeout('go()', 100);
</script>
<center>
<table border=0 cellspacing=0 cellpadding=5 width=330 style='border:1px solid black'>
<tr height=270><td colspan=3><div id=AA style='width:320;height:250'></div></td></tr>
<tr height=30><td colspan=3><input type=text name='usenick' maxlength=10 style='width:65' readonly value='<?=$usenick?>'>
<input type='text' name='text' style='width:200;'>
<input type='submit' value='쓰기' onclick="wte()" class='button'>
<input type='hidden' name='ntim' value='-1'>
</td>
</tr>
<? if ($member[mb_level] > 8) { ?><tr height=20 align=right><td colspan=3><a href='?delete=text'>본문초기화(관리자만 가능) </a></td></tr><? } ?>
</table>
</center>
<style>
body {font-size:9pt;font-family:gulim;word-break:break-all;}
td {word-break:break-all;font-size:9pt;}
.mm {color:#D7D7D7;font-weight:bold;font-family:gulim;text-align:center;padding-top:5}
.mc {color:#D7D7D7;font-family:gulim;text-align:center;padding-top:5}
.button {background-color:#D7D7D7;border:0;border:1px solid black;margin-right:4px;margin-left:4px;width:35px}
.name {width:50;padding-left:5;font-weight:bold;}
.memo {padding:5px 0px 5px 5px;width:210;}
.trh {padding:6px 0px 6px 0px;}
#AA {overflow-x: hidden; overflow-y: auto;background-color:#FFFFFF;border:1px solid black; }
</style>
