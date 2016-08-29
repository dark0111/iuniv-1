<?
include_once('./_common.php');
include_once("./mytalk_config.php");

if ($member['mb_id']!=$current['mb_id']) alert('본인 정보만 수정이 가능합니다.');

if ($g4['talk_limit_level']>$member['mb_level']) err_xml('회원등급이 낮아 접근할 수 없습니다.');

// POST 로 넘어온 변수 유효성 검사
if( is_empty($talk_about) )
    alert('토크 설명을 입력해주세요.');

// 프로필 이미지 삭제
$profile_image_path = "{$g4['path']}/data/talk/profile_image/{$member['mb_id']}";
if( file_exists($profile_image_path) && $profile_image_del ) {
    unlink($profile_image_path);
}

// 프로필 이미지 체크
$profile_image      = $_FILES['profile_image']['tmp_name'];
$profile_image_size = $_FILES['profile_image']['size'];

if( $profile_image_size ) {

    $file_size_limit = $g4['talk_profile_image_limit'];

    // 이미지 가로, 세로 및 mime 정보 로드
    $get_image_size = getimagesize($profile_image);

    // 정보가 없을 경우 이미지가 아님
    if( empty($get_image_size) )
        alert("이미지 파일만 업로드 가능합니다.");

    // MINE 값을 검사하여 PNG, GIF, JPG 만 업로드 가능하게 함
    $image_type = array('image/png', 'image/jpeg', 'image/gif');

    if( !in_array($get_image_size['mime'], $image_type) )
        alert("프로필 이미지는 jpg, gif, png 형식만 업로드 가능합니다.".$get_image_size['mime']);

    if( $file_size_limit != 0 && $profile_image_size > $file_size_limit )
        alert("프로필 이미지의 용량이 ".number_format($file_size_limit)." byte 보다 큽니다.");

    $dir_arr = array ("{$g4['path']}/data/talk", "{$g4['path']}/data/talk/profile_image");
    for ($i=0; $i<count($dir_arr); $i++) 
    {
        @mkdir($dir_arr[$i], 0707);
        @chmod($dir_arr[$i], 0707);

        // 디렉토리에 있는 파일의 목록을 보이지 않게 한다.
        $file = $dir_arr[$i] . "/index.php";
        $f = @fopen($file, "w");
        @fwrite($f, "");
        @fclose($f);
        @chmod($file, 0606);
    }
    $profile_image_path = "{$g4['path']}/data/talk/profile_image";
    if (!is_dir($profile_image_path)) 
        alert('디렉토리가 존재하지 않습니다.');

    $profile_image_file = "{$profile_image_path}/{$member['mb_id']}";

    // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
    $error_code = move_uploaded_file($profile_image, $profile_image_file) or die($_FILES['profile_image']['error']);

    // 올라간 파일의 퍼미션을 변경합니다.
    chmod($profile_image_file, 0606);

}

$qry = sql_query("update {$g4['talk_info_table']} set talk_about = '{$talk_about}' where id = '{$t_id}'");
if (!$qry)
    alert ('토크정보를 업데이트 하지 못했습니다.');

alert ('토크 정보를 업데이트 했습니다.', 'mytalk.php?t_id='.$t_id);
?>