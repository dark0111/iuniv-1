<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

$g4[title] = '토크';

if ($g4['talk_limit_level']>1 && $g4['talk_limit_level']>$member['mb_level']) alert('회원등급이 낮아 토크에 접근할 수 없습니다.');

// 스킨이 지정되어있지 않을 경우 basic 을 기본으로 한다.
if (!$gnutalk_skin) $gnutalk_skin = 'helptalk';

// 스킨 경로
$gnutalk_skin_path = "{$g4['path']}/skin/talk/{$gnutalk_skin}";

?>