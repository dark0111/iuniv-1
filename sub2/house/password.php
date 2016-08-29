<?
if ($w == "u")
    $action = "../sub/house/house_write.php";
else if ($w == "d")
    $action = "../sub/house/house_delete.php";
else if ($w == "x")
    $action = "../sub/house/delete_comment.php";
else
    alert("w 값이 제대로 넘어오지 않았습니다.");

$g4[title] = "패스워드 입력";
include_once("$g4[path]/head.sub.php");


$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";

include_once("$member_skin_path/password.skin.php");



include_once("$g4[path]/tail.sub.php");
?>
