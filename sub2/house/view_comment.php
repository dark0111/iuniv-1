<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 자동등록방지
include_once ("$g4[bbs_path]/norobot.inc.php");

$list = array();

$is_comment_write = false;
if ($member[mb_level] >= $board[bo_comment_level]) 
    $is_comment_write = true;

// 코멘트 출력
$sql = " select * from h_comment where h_id = '$h_cd' order by reply_count,comment_reply";
//echo"$sql";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) 
{
    $list[$i] = $row;
    $tmp_name = get_text(cut_str($row[name], $config[cf_cut_name])); // 설정된 자리수 만큼만 이름 출력

    $list[$i][name] = "<span class='".($row[id]?'member':'guest')."'>$tmp_name</span>";


    
    // 공백없이 연속 입력한 문자 자르기 (way 보드 참고. way.co.kr)
    //$list[$i][content] = eregi_replace("[^ \n<>]{130}", "\\0\n", $row[wr_content]);

    $list[$i][content] = $list[$i][content1]= "비밀글 입니다.";
    if (!strstr($row[h_option], "secret") ||$is_admin || ($row[id]==$member[mb_id] && $member[mb_id])) 
	//if (!strstr($row[h_option], "secret") ||$is_admin || ($write[mb_id]==$member[mb_id] && $member[mb_id]) || ($row[mb_id]==$member[mb_id] && $member[mb_id]))
	{
		$list[$i][content1] = $row[comment];
		$list[$i][content] = conv_content($row[comment], 0, 'wr_content');
		$list[$i][content] = search_font($stx, $list[$i][content]);
	}

    $list[$i][datetime] = substr($row[wdate],2,14);

    // 관리자가 아니라면 중간 IP 주소를 감춘후 보여줍니다.
    $list[$i][ip] = $row[ip];
    if (!$is_admin)
        $list[$i][ip] = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", "\\1.♡.\\3.\\4", $row[ip]);

    $list[$i][is_reply] = true;
    $list[$i][is_edit] = false;
    $list[$i][is_del]  = false;
    if ($is_comment_write || $is_admin) 
    {
        if ($member[mb_id]) 
        {
            if ($row[mb_id] == $member[mb_id] || $is_admin) 
            {
                $list[$i][del_link]  = "$IU[url]/sub2/house/delete_comment.php?comment_id=$row[id]&h_cd=$h_cd&page=$page".$qstr;
                $list[$i][is_edit]   = true;
                $list[$i][is_del]    = true;
            }
        } 
        else 
        {
            if (!$row[mb_id]) {
                //$list[$i][del_link] = "$g4[house_path]/password.php?w=x&comment_id=$row[id]&h_cd=$h_cd&page=$page".$qstr;
				$list[$i][del_link] = "$IU[home_file]?mode=house_password&w=x&comment_id=$row[id]&h_cd=$h_cd&page=$page".$qstr;
                $list[$i][is_del]   = true;
				
            }

        }
    }


}

//  코멘트수 제한 설정값
if ($is_admin)
{
    $comment_min = $comment_max = 0;
}
else
{
    $comment_min = (int)$board[bo_comment_min];
    $comment_max = (int)$board[bo_comment_max];
}

include_once("view_comment.skin.php");

// 필터
echo "<script language='javascript'> var g4_cf_filter = '$config[cf_filter]'; </script>\n";
echo "<script language='javascript' src='$g4[path]/js/filter.js'></script>\n";

if (!$member[mb_id]) // 비회원일 경우에만
    echo "<script language='javascript' src='$g4[path]/js/md5.js'></script>\n";

?>
