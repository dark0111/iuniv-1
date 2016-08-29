<?
$g4_path='../../board';
include_once("$g4_path/common.php");

$write = sql_fetch(" select * from h_comment where  id = '$comment_id'");

if (!$write[id] || !$write[comment])
    alert("등록된 코멘트가 없거나 코멘트 글이 아닙니다.");

if ($is_admin == "super") // 최고관리자 통과
    ;
else if ($member[mb_id]) {
    if ($member[mb_id] != $write[mb_id])
        alert("자신의 글이 아니므로 삭제할 수 없습니다.");
} else {
    if (sql_password($wr_password) != $write[passwd])
        alert("패스워드가 틀립니다.");
}

$len = strlen($write[comment_reply]);
if ($len < 0) $len = 0; 
$comment_reply = substr($write[comment_reply], 0, $len);

$sql = " select count(*) as cnt from h_comment
          where comment_reply like '$comment_reply%'
            and id <> '$comment_id'
			and h_id='$write[h_id]'
            and reply_count = '$write[reply_count]'";
$row = sql_fetch($sql);

if ($row[cnt] && !$is_admin)
    alert("이 코멘트와 관련된 답변코멘트가 존재하므로 삭제 할 수 없습니다.");
elseif($row[cnt] && $is_admin)
{
	if($len >0)
	{
		$sql = " delete from h_comment where h_id = '$write[h_id]' and reply_count='$write[reply_count]' and comment_reply like '$comment_reply%'";
		sql_query($sql);
	}
	else
	{
		$sql = " delete from h_comment where h_id = '$write[h_id]' and reply_count='$write[reply_count]'";
		sql_query($sql);
	}
}
else
{
	$sql = " delete from h_comment where id = '$comment_id' ";
	sql_query($sql);
}

goto_url("../../index.php?mode=house_view&h_cd=$write[h_id]" . $qstr . "&cwin=$cwin#c_{$comment_id}");





?>
