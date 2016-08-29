<?
// 이 상수가 정의되지 않으면 각각의 개별 페이지는 별도로 실행될 수 없음
define("_GNUBOARD_", TRUE);

$g4['talk'] = "talk";

$g4['talk_info_table']      = $g4['table_prefix'] . "talk_info";          // 관리권한 설정 테이블
$g4['talk_category_table']  = $g4['table_prefix'] . "talk_category";        // 기본환경 설정 테이블
$g4['talk_table']           = $g4['table_prefix'] . "talk";         // 게시판 그룹 테이블
$g4['talk_comment_table']   = $g4['table_prefix'] . "talk_comment";  // 게시판 그룹+회원 테이블
$g4['talk_visit_table']     = $g4['table_prefix'] . "talk_visit";         // 게시판 설정 테이블
$g4['talk_friends_table']   = $g4['table_prefix'] . "talk_friends";    // 게시판 첨부파일 테이블

$g4['talk_secret_1_message'] = "<span class=\"secret-1\">(친구에게만 공개)</span>";
$g4['talk_secret_2_message'] = "<span class=\"secret-2\">(비공개)</span>";

?>