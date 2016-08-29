<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 토크 번호가 존재 할 경우 해당 토크정보를 가져온다.
if ($t_id) {

    // 토크 정보 가져오기
    $current = sql_fetch("select * from {$g4['talk_info_table']} where id='{$t_id}'");

    // 토크 정보가 없을경우
    if (empty($current)) {

        // 로그인 한 경우 자신의 토크로 이동
        if (!empty($member['mb_id'])) {

            // 토크 정보 가져오기
            $current = sql_fetch("select * from {$g4['talk_info_table']} where mb_id='{$member['mb_id']}'");

            // 토크 정보가 있으면 자신의 토크로 이동
            if (!empty($current)) goto_url('mytalk.php?t_id='.$current['id']);

            // 토크 정보가 없으면 토크 기본정보 등록
            join_talk_q();

            // 토크 기본정보 등록 후 자신의 토크로 이동
            goto_url('mytalk.php?t_id='.$current['id']);

        // 비회원이 존재하지 않는 토크에 접근 한경우 뒤로 이동
        } else {
            if (empty($current)) alert('로그인 해주세요.');
        }
    }

} else {

    // 로그인 한 경우 자신의 토크로 이동
    if (!empty($member['mb_id'])) {

        // 토크 정보 가져오기
        $current = sql_fetch("select * from {$g4['talk_info_table']} where mb_id='{$member['mb_id']}'");

        // 토크 정보가 있으면 자신의 토크로 이동
        if (!empty($current)) goto_url('mytalk.php?t_id='.$current['id']);

        // 토크 정보가 없으면 토크 기본정보 등록
        join_talk_q();

    } else {
        
        alert('로그인 해주세요.');
    }
}

include_once('./config.php');

// 토크 이름
$res = sql_fetch("select mb_nick from {$g4['member_table']} where mb_id='{$current['mb_id']}'");
$current['talk_name'] = $res['mb_nick'];

// 토크 주소
$current['talk_full_url']   = "{$g4['url']}/{$g4['talk']}/mytalk.php?t_id={$current['id']}";
$current['talk_url']        = "{$g4['path']}/{$g4['talk']}/mytalk.php?t_id={$current['id']}";
$current['talk_rss_url']    = "{$g4['path']}/{$g4['talk']}/rss.php?t_id={$current['id']}";

// 프로필 경로
$current['profile_image_full_path'] = "{$g4['url']}/data/talk/profile_image/{$current['mb_id']}";
$current['profile_image_path']      = "{$g4['path']}/data/talk/profile_image/{$current['mb_id']}";
if (!file_exists($current['profile_image_path'])) {
   if($member[mb_sex]=="F"){//이미지 학교별 세팅
			$current['profile_image_path']="../../css/img/tools/user_female";
			$current['profile_image_full_path']="../../css/img/tools/user_female";
	}elseif($member[mb_sex]=="M"){
		$current['profile_image_path']="../../css/img/tools/user_male";
		$current['profile_image_full_path']="../../css/img/tools/user_male";
	}else{
		$current['profile_image_path']="../../css/img/tools/user_anymore";
		$current['profile_image_full_path']="../../css/img/tools/user_anymore";
	}
	if($member[mb_1]=="82"){
		$current['profile_image_path'].="2";
		$current['profile_image_full_path'].="2";
	}
	$current['profile_image_path'].=".png";
	$current['profile_image_full_path'].=".png";
}

?>