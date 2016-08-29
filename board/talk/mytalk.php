<?
include('./_common.php');
include('./mytalk_config.php');

// 카테고리
$category = array();
$qry = sql_query("select * from {$g4['talk_category_table']} order by rank"); 
while ($res = sql_fetch_array($qry)) array_push($category, $res);

// 오늘 방문자 없으면 방문자 카운트 0 으로 초기화.. 안습;
$res = sql_fetch("select * from {$g4['talk_visit_table']} where t_id='{$current['id']}' and visit_date='{$g4['time_ymd']}'");
if (empty($res)) {
    $qry = sql_query("update {$g4['talk_info_table']} set today_count=0 where id='{$current['id']}'");
    $current['today_count'] = 0;
}

// 다녀간 사람들 및 카운터 작동
// 로그인 해야 하고 내가 아니어야 한다.
if (!empty($member['mb_id'])&&$member['mb_id']!=$current['mb_id']) {

    $res = sql_fetch("select id from {$g4['talk_info_table']} where mb_id='{$member['mb_id']}'");
    $visit_t_id = $res['id'];
    $visit_name = $member['mb_nick'];

    if ($visit_t_id) {

        // 오늘 방문한 흔적이 없으면 추가
        $res = sql_fetch("select * from {$g4['talk_visit_table']} where t_id='{$current['id']}' and visit_date='{$g4['time_ymd']}' and visit_t_id='{$visit_t_id}'");
        if (empty($res)) {

            // 다녀간 사람들 추가
            sql_query("insert into {$g4['talk_visit_table']} set t_id='{$current['id']}', visit_date='{$g4['time_ymd']}', visit_time='{$g4['time_his']}', visit_t_id='{$visit_t_id}', visit_name='{$visit_name}'");

            // 카운터 증가
            sql_query("update {$g4['talk_info_table']} set today_count=today_count+1, total_count=total_count+1 where id='{$current['id']}'");

            $current['today_count']++;
            $current['total_count']++;
        }

        // 현재 토크가 내 친구인지 검사
        $res = sql_fetch("select * from {$g4['talk_friends_table']} where t_id='{$visit_t_id}' and friends_t_id='{$current['id']}'");
        if (!empty($res)) 
            $is_my_friends = true;

        // 로그인 했고, 내가 아니며, 내 친구도 아닐 경우 친구추가 버튼 ok
        if($member['mb_id']&&$member['mb_id']!=$current['mb_id']&&!$is_my_friends)  $friends_approval = true;
    }
}

// 상단 파일 include
if (file_exists($g4['talk_head_file']))
    @include_once($g4['talk_head_file']);
else
    @include_once("{$g4['path']}/head.sub.php");

include_once("{$gnutalk_skin_path}/head.skin.php");
include_once("{$gnutalk_skin_path}/mytalk.skin.php");
include_once("{$gnutalk_skin_path}/tail.skin.php");

// 하단 파일 include
if (file_exists($g4['talk_tail_file']))
    @include_once($g4['talk_tail_file']);
else
    @include_once("{$g4['path']}/tail.sub.php");

?>