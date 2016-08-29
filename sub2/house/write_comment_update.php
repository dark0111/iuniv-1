<?
$g4_path='../../board';
include_once("$g4_path/common.php");
$g4[title] = $wr_subject . "코멘트입력";

$w = $_POST["w"];
$wr_name  = strip_tags($_POST["wr_name"]);
$wr_email = strip_tags($_POST["wr_email"]);

// 비회원의 경우 이름이 누락되는 경우가 있음
if (!$is_member)
{
    if (!trim($wr_name))
        alert("이름은 필히 입력하셔야 합니다.");
}

if ($w == "c" || $w == "cu") 
{
   
} 
else
    alert("w 값이 제대로 넘어오지 않았습니다."); 

// 세션의 시간 검사
// 4.00.15 - 코멘트 수정시 연속 게시물 등록 메시지로 인한 오류 수정
if ($w == "c" && $_SESSION["ss_datetime"] >= ($g4[server_time] - $config[cf_delay_sec]) && !$is_admin) 
    alert("너무 빠른 시간내에 게시물을 연속해서 올릴 수 없습니다.");

set_session("ss_datetime", $g4[server_time]);



// 자동등록방지 검사
//include_once ("./norobot_check.inc.php");

if (!$is_member) {
    if ($w=='' || $w=='c') {
        $key = get_session("captcha_keystring");
        session_unregister("captcha_keystring");
        if (!($key && $key == $_POST[wr_key])) {
            alert("정상적인 접근이 아닌것 같습니다. $key");
        }
    }
}


// "인터넷옵션 > 보안 > 사용자정의수준 > 스크립팅 > Action 스크립팅 > 사용 안 함" 일 경우의 오류 처리
// 이 옵션을 사용 안 함으로 설정할 경우 어떤 스크립트도 실행 되지 않습니다.
//if (!trim($_POST["wr_content"])) die ("내용을 입력하여 주십시오.");

if ($member[mb_id]) 
{
    $mb_id = $member[mb_id];
    // 4.00.13 - 실명 사용일때 코멘트에 별명으로 입력되던 오류를 수정
    $wr_name = $board[bo_use_name] ? $member[mb_name] : $member[mb_nick];
    $wr_password = $member[mb_password];
    $wr_email = $member[mb_email];
    $wr_homepage = $member[mb_homepage];
} 
else 
{
    $mb_id = "";
    $wr_password = sql_password($wr_password);
}

if ($w == "c") // 코멘트 입력
{
	// 코멘트 답변
    if ($comment_id) 
    {
        $sql = " select * from h_comment
                  where id = '$comment_id' ";
        $reply_array = sql_fetch($sql);
        if (!$reply_array[id])
            alert("답변할 코멘트가 없습니다.\\n\\n답변하는 동안 코멘트가 삭제되었을 수 있습니다.");

        $tmp_comment = $reply_array[reply_count];//부모 코멘트글의 reply_count값

        if (strlen($reply_array[comment_reply]) == 5)
            alert("더 이상 답변하실 수 없습니다.\\n\\n답변은 5단계 까지만 가능합니다.");

        $reply_len = strlen($reply_array[comment_reply]) + 1;
        if (1) {//나중에 단 답변 아래로 넣게 하는 소스 bo_reply_order 의 역활
            $begin_reply_char = "A";
            $end_reply_char = "Z";
            $reply_number = +1;
            $sql = " select MAX(SUBSTRING(comment_reply, $reply_len, 1)) as reply 
                       from h_comment
                      where h_id = '$h_cd' 
                        and reply_count = '$tmp_comment'
                        and SUBSTRING(comment_reply, $reply_len, 1) <> '' ";
        } 
        else //나중에 단 답변이 위로 출력되게 하는 소스
        {
            $begin_reply_char = "Z";
            $end_reply_char = "A";
            $reply_number = -1;
            $sql = " select MIN(SUBSTRING(comment_reply, $reply_len, 1)) as reply 
                       from h_comment 
                      where h_id = '$h_cd'
                        and reply_count = '$tmp_comment'
                       and SUBSTRING(comment_reply, $reply_len, 1) <> '' ";
        }
        if ($reply_array[comment_reply]) 
            $sql .= " and comment_reply like '$reply_array[comment_reply]%' ";
        $row = sql_fetch($sql);

        if (!$row[reply])
            $reply_char = $begin_reply_char;
        else if ($row[reply] == $end_reply_char) // A~Z은 26 입니다.
            alert("더 이상 답변하실 수 없습니다.\\n\\n답변은 26개 까지만 가능합니다.");
        else
            $reply_char = chr(ord($row[reply]) + $reply_number);

        $tmp_comment_reply = $reply_array[comment_reply] . $reply_char;
    }
    else 
    {
        $sql = " select max(reply_count) as max_comment from h_comment where h_id = '$h_cd'";
        $row = sql_fetch($sql);
        //$row[max_comment] -= 1;
        $row[max_comment] += 1;
        $tmp_comment = $row[max_comment];
        $tmp_comment_reply = "";
    }
	$w_ip=$REMOTE_ADDR;
    $sql = " insert into h_comment
                set name = '$wr_name',
                    h_option = '$wr_secret',
                    h_id = '$h_cd',
					w_ip='$w_ip',
					reply_count='$tmp_comment',
                    comment = '$wr_content',
                    mb_id = '$mb_id',
                    passwd = '$wr_password',
					comment_reply = '$tmp_comment_reply',
					parent_id='$comment_id',
					wdate=now(),
					udate=now()";
    sql_query($sql);


    $comment_id = mysql_insert_id();

} 
else if ($w == "cu") // 코멘트 수정
{ 
    $sql = " select mb_id, comment from h_comment
              where id = '$comment_id' ";
    $comment = $reply_array = sql_fetch($sql);

	$sql = " select * from h_comment
              where id = '$comment_id' ";
    $comment = $reply_array = sql_fetch($sql);
    $tmp_comment = $reply_array[reply_count];

    $len = strlen($reply_array[comment_reply]);
    if ($len < 0) $len = 0; 
    $comment_reply = substr($reply_array[comment_reply], 0, $len);



    if ($is_admin == "super") // 최고관리자 통과 
        ; 
    else if ($member[mb_id]) { 
        if ($member[mb_id] != $comment[mb_id]) 
            alert("자신의 글이 아니므로 수정할 수 없습니다."); 
    } 
	$sql = " select count(*) as cnt from h_comment
		  where comment_reply like '$comment_reply%'
			and id <> '$comment_id'
			and h_id = '$h_cd'
			and reply_count = '$tmp_comment' ";
	$row = sql_fetch($sql);
		
    if ($row[cnt] && !$is_admin)
        alert("이 코멘트와 관련된 답변코멘트가 존재하므로 수정 할 수 없습니다.");

   

    $sql_ip = "";
    if (!$is_admin)
        $sql_ip = " , ip = '$_SERVER[REMOTE_ADDR]' ";

    $sql_secret = "";
    if ($wr_secret)
        $sql_secret = " , h_option = '$wr_secret' ";

    $sql = " update h_comment
                set 
                    comment = '$wr_content',
					udate=now()
                    $sql_ip
                    $sql_secret
              where id = '$comment_id' ";
    sql_query($sql);
}

// 사용자 코드 실행
@include_once("$g4[house_path]/write_comment_update.skin.php");
@include_once("$g4[house_path]/write_comment_update.tail.skin.php");

goto_url("../../index.php?mode=house_view&h_cd=$h_cd" . $qstr . "&cwin=$cwin#c_{$comment_id}");
?>
