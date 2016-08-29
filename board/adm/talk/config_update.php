<?
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

// extend 디렉토리에 파일 생성 가능한지 검사.
if (!is_writeable("../../extend")) 
    alert("extend 디렉토리의 퍼미션을 707로 변경하여 주십시오.\\n\\n$> chmod 707 extend \\n\\n그 다음 설정을 시도해 주십시오.");

if (!is_numeric($talk_page_size)) alert('한 페이지의 글 갯수를 숫자로 입력해주세요.');
if (!is_numeric($talk_comment_page_size)) alert('한 토크의 댓글 갯수를 숫자로 입력해주세요.');
if (!is_numeric($talk_limit_level)) alert('토크 접근 권한을 선택해주세요');
if (!is_numeric($talk_input_limit_level)) alert('토크 입력 권한을 선택해주세요');
if (!is_numeric($talk_open_rss)) alert('RSS 지원 여부를 선택해주세요.');

if ($talk_limit_level>$talk_input_limit_level) 
    alert("권한설정 오류!!\\n\\n접근권한보다 입력권한이 같거나 더 커야 합니다.");

$talk_open_message = str_replace("\"", "'", $talk_open_message);

$contents ='<?
$g4[\'plaza_page_size\']            = '.$plaza_page_size.';
$g4[\'talk_page_size\']             = '.$talk_page_size.';
$g4[\'talk_comment_page_size\']     = '.$talk_comment_page_size.';
$g4[\'talk_limit_level\']           = '.$talk_limit_level.';
$g4[\'talk_input_limit_level\']     = '.$talk_input_limit_level.';
$g4[\'talk_open_rss\']              = '.$talk_open_rss.';
$g4[\'talk_head_file\']             = "'.$talk_head_file.'";
$g4[\'talk_tail_file\']             = "'.$talk_tail_file.'";
$g4[\'talk_open_message\']          = "'.$talk_open_message.'";
$g4[\'talk_profile_image_limit\']   = "'.$talk_profile_image_limit.'";
$g4[\'talk_point\']                 = "'.$talk_point.'";
$g4[\'talk_comment_point\']         = "'.$talk_comment_point.'";
?>';

$fp = fopen($talk_config_file,'w');
fwrite($fp, $contents);
@chmod($talk_config_file,0707);
fclose($fp);

goto_url("./config.php");

?>