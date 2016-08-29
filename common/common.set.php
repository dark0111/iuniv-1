<?
$IU[absolute_path]='/home/hosting_users/dark0111/www';
$g4_path = "./board"; // common.php 의 상대 경로

include_once("./common/common.lib.php");




//////////////////////////////////////////////////////////////
//그누보드 에서 사용하는 부분이 아닌 새로 개발이 되는 부분에서 사용되는 변수를 셋팅한다.
//우선 이곳에 하고 변수양이 늘어나면 파일 include형태로 변경하자.
//$IU변수를 새로 개발이 되는 iuniv의 환경변수 셋팅 하는 용도로 사용하자.
$IU[path]='./';
//$IU[domain]='iuniv.kr';
//$IU[url]='http://iuniv.kr';
$IU[domain]='iuniv.or.kr';
$IU[url]='http://iuniv.or.kr';
$IU[house_path]='/home/hosting_users/dark0111/www/sub2/house';
$IU[sub_url]=$IU[url].'/sub2';
$IU[sub_path]='/home/hosting_users/dark0111/www/sub2';
$IU[home_file]= $IU[path]. "index.php";
$IU[board]='./board';
$IU[restaurant_thum]='/board/data/file/restaurant/thumbOpen/';
$IU[restaurant_thum2]='/board/data/file/restaurant/thumbOpen2/';
//////////////////////////////////////////////////////////////
?>
