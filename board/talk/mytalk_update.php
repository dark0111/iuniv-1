<?
include('./_common.php');
include('./mytalk_config.php');

if ($g4['talk_limit_level']>$member['mb_level']) err_xml('회원등급이 낮아 토크를 작성할 수 없습니다.');

switch($mode) {

    // 권한 검사아
    case 'permission':

        // 본인이거나 최고관리자일 경우 권한 줘버려
        if ($current['mb_id']==$member['mb_id']||$is_admin) {
            $errnum = 0;
            $errmsg = '수정/삭제 권한이 있습니다.';
        } else {
            $errnum = 1;
            $errmsg = '수정/삭제 권한이 없습니다.';
        }

        // 토크 존재여부 검사
        $res = sql_fetch("select content from {$g4['talk_table']} where id='{$id}'");

        if (empty($res)) err_xml('토크가 존재하지 않습니다.');

        $content = $res['content'];

        // 원본 데이터를 xml 로 땡교..
        header("Content-Type:text/xml;");
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
        $xml .= "<channel>\n";
        $xml .= "<errnum>{$errnum}</errnum>\n";
        $xml .= "<errmsg><![CDATA[{$errmsg}]]></errmsg>\n";
        $xml .= "<item>\n";
        $xml .= "<id><![CDATA[{$id}]]></id>\n";
        $xml .= "<content><![CDATA[{$content}]]></content>\n";
        $xml .= "</item>\n";
        $xml .= "</channel>\n";

        // eucKR 짱!!
        if (strtoupper($g4['charset'])!='UTF-8') 
            $xml = convert_charset('CP949','UTF-8',$xml);

        echo $xml; // 수줍;
        break;

    // 이미 엎은 물은 주어담을 수 없지만 토크는 주어담나? 삭제
    case 'delete':

        // 본인이 아니거나 최고관리자도 아닌데 왜 삭제하려고 하니?
        if ($member['mb_id']!=$current['mb_id']&&!$is_admin) err_xml('본인만 삭제할 수 있습니다.');

        // 토크 삭제
        $qry = sql_query("delete from {$g4['talk_table']} where id='{$id}'", false);
        if (!$qry)
            err_xml('토크를 삭제하지 못했습니다.');

        // 토크에 딸린 댓글 갯수 
        $res = sql_fetch("select count(num) as cnt  from {$g4['talk_comment_table']} where id='{$id}'");
        $cnt = $res['cnt'];

        // 토크에 딸린 댓글 다 지워
        $qry = sql_query("select * from {$g4['talk_comment_table']} where id='{$id}'", false);
        while ($res = sql_fetch_array($qry)) {
            insert_point($res['mb_id'], -1*$g4['talk_comment_point'], '토크 댓글 삭제');
        }
        $qry = sql_query("delete from {$g4['talk_comment_table']} where id='{$id}'", false);
        if (!$qry)
            err_xml('토크의 댓글을 삭제하지 못했습니다.');

        // 토크 정보 테이블에 토크 갯수랑 댓글 갯수 차감
        $qry = sql_query("update {$g4['talk_info_table']} set post_count=post_count-1, comment_count=comment_count-{$cnt}, last_update='{$g4['time_ymdhis']}' where id='{$current['id']}'");
        if (!$qry)
            err_xml('토크 정보를 업데이트하지 못했습니다.');

        sql_query("update {$g4['talk_friends_table']} set last_update='{$g4['time_ymdhis']}' where friends_t_id='{$current['id']}' ");

        // 포인트 부여
        insert_point($member['mb_id'], -1*$g4['talk_point'], '토크 삭제');

        // ㅇㅋ
        err_xml('토크를 삭제했습니다.',0);

    // 말 바꾸기는 ㅡㅡ;;
    case 'update':

        // 본인이 아니거나 최고관리자도 아닌데 왜 삭제하려고 하니?
        if ($member['mb_id']!=$current['mb_id']&&!$is_admin) err_xml('본인만 수정할 수 있습니다.');

        // 수정하려면 내용은 입력 해야될꺼 아냐..
        if (is_empty($talk_content)) err_xml('내용을 입력해주세요.');

        // eucKR 짱!! 근데 ajax 는 utf-8 로 넘기잖아..
        $talk_content = rawurldecode($talk_content);
        if (strtoupper($g4['charset'])!='UTF-8'&&is_utf8($talk_content))
            $talk_content = convert_charset('UTF-8','CP949',$talk_content);

        //if (strlen($talk_content)<5) err_xml('5자 이상 입력해주세요.');
        if (strlen($talk_content)>255) err_xml('255자 까지만 입력하실 수 있습니다.');

        $talk_content = htmlspecialchars($talk_content);

        // 수정 내용 저장 삑~!
        $sql = "update {$g4['talk_table']} set name='{$current['talk_name']}', content='{$talk_content}' where id='{$id}'";
        $qry = sql_query($sql, false);
        if (!$qry)
            err_xml('토크를 수정하지 못했습니다.');

        // 토크 정보 테이블에 마지막 업뎃 갱신
        $qry = sql_query("update {$g4['talk_info_table']} set last_update='{$g4['time_ymdhis']}'  where id='{$current['id']}'");
        if (!$qry)
            err_xml('토크 정보를 업데이트하지 못했습니다.');

        sql_query("update {$g4['talk_friends_table']} set last_update='{$g4['time_ymdhis']}' where friends_t_id='{$current['id']}' ");

        // ㅇㅋ ^.^
        err_xml('토크를 수정했습니다.',0);
        break;

    default: 

        // 내 토크는 나만 올려야지.. 으흥으흥
        if ($member['mb_id']!=$current['mb_id']) err_xml('본인만 등록할 수 있습니다.');

        // 토크는 말하라고 있는거야..
        if (is_empty($talk_content)) err_xml('내용을 입력해주세요.');

        // 역시 eucKR ♥
        $talk_content = rawurldecode($talk_content);
        if (strtoupper($g4['charset'])!='UTF-8'&&is_utf8($talk_content))
            $talk_content = convert_charset('UTF-8','CP949',$talk_content);

        //if (strlen($talk_content)<5) err_xml('5자 이상 입력해주세요.');
        if (strlen($talk_content)>255) err_xml('255자 까지만 입력하실 수 있습니다.');

        $talk_content = htmlspecialchars($talk_content);

        $res = sql_fetch("select * from {$g4['talk_table']} where t_id='{$current['id']}' and content='{$talk_content}'");
        if (!empty($res))
            err_xml('이미 같은 글이 등록되어 있습니다.');
    
        // 말말말~ 말하세여~
        $sql = "insert into {$g4['talk_table']} set c_id='{$c_id}', t_id='{$current['id']}', secret='{$secret}', name='{$current['talk_name']}', content='{$talk_content}', regdate='{$g4['time_ymd']}', regtime='{$g4['time_his']}'";
        $qry = sql_query($sql, false);
        if (!$qry)
            err_xml('토크를 등록하지 못했습니다.');

        // 토크 정보 갱신 중.. 삐릭
        $qry = sql_query("update {$g4['talk_info_table']} set post_count=post_count+1, last_update='{$g4['time_ymdhis']}'  where id='{$current['id']}'");
        if (!$qry)
            err_xml('토크 정보를 업데이트하지 못했습니다.');

        sql_query("update {$g4['talk_friends_table']} set last_update='{$g4['time_ymdhis']}' where friends_t_id='{$current['id']}' ");

        // 포인트 부여
        insert_point($member['mb_id'], $g4['talk_point'], '토크 작성');

        // ㅇㅋ ^_^
        err_xml('토크를 등록했습니다.',0);
}

?>