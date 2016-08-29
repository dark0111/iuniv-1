<?
include('./_common.php');
include('./mytalk_config.php');

if ($g4['talk_limit_level']>$member['mb_level']) err_xml('회원등급이 낮아 토크를 작성할 수 없습니다.');

switch($mode) {

    // 댓글 삭제, 치사 빤스~
    case 'delete':
        
        // 없는 댓글은 삭제도 못하지
        $res = sql_fetch("select id, mb_id from {$g4['talk_comment_table']} where num='{$num}'",false);
        if (empty($res))
            err_xml('댓글이 존재하지 않습니다.');

        // 내가 쓴 댓글은 삭제 할 수 있다. 최고관리자는 다 할 수 있다. you god?
        if ($member['mb_id']!=$res['mb_id']&&!$is_admin) err_xml('댓글의 본인만 삭제할 수 있습니다.');

        // 삭제가 안되네..ㅎㅎ
        $qry = sql_query("delete from {$g4['talk_comment_table']} where id='{$res['id']}' and num='{$num}'", false);
        if (!$qry)
            err_xml('댓글을 삭제하지 못했습니다.');

        // 정보는 항상 정확해야 하는데..
        $qry = sql_query("update {$g4['talk_table']} set comment_count = comment_count - 1 where id='{$res['id']}'", false);
        if (!$qry)
            err_xml('댓글 갯수를 차감하지 못했습니다.');

        // 그렇지?
        $qry = sql_query("update {$g4['talk_info_table']} set comment_count = comment_count - 1 where id='{$current['id']}'");
        if (!$qry)
            err_xml('댓글 갯수를 차감하지 못했습니다.');

        // 등록마지막 페이지
        $res2 = sql_fetch("select count(*) as cnt from {$g4['talk_comment_table']} where id='{$res['id']}'");
        $last_page = (int)($res2['cnt']/$g4['talk_comment_page_size']) + ($res2['cnt']%$g4['talk_comment_page_size']==0 ? 0 : 1);

        // 포인트 부여
        insert_point($member['mb_id'], -1*$g4['talk_comment_point'], '토크 댓글 작성');

        header("Content-Type:text/xml;");
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
        $xml .= "<channel>\n";
        $xml .= "<errnum>0</errnum>\n";
        $xml .= "<errmsg><![CDATA[{댓글을 삭제했습니다.}]]></errmsg>\n";
        $xml .= "<id>{$res['id']}</id>\n";
        $xml .= "<last_page><![CDATA[{$last_page}]]></last_page>\n";
        $xml .= "</channel>\n";

        // 달려라 euckr
        if (strtoupper($g4['charset'])!='UTF-8') 
            $xml = convert_charset('CP949','UTF-8',$xml);

        echo $xml;
        break;

    // 대끌~ 대끌~ 등록, 져아?
    default: 

        if ($secret=='on') $secret = 2; else $secret = 0;

        // 댓글도 회원만 허락하겠소.
        if (empty($member['mb_id'])) err_xml('회원만 등록할 수 있습니다. 로그인해 주세요.');

        // 말은 제대로 해야할 것 아니오?
        if (is_empty($talk_content)) err_xml('내용을 입력해주세요.');

        // euckr 로 하시오..
        if (strtoupper($g4['charset'])!='UTF-8'&&is_utf8($talk_content))
            $talk_content = convert_charset('UTF-8','CP949',$talk_content);

        //if (strlen($talk_content)<2) err_xml('2자 이상 입력해주세요.');
        if (strlen($talk_content)>255) err_xml('255자 까지만 입력하실 수 있습니다.');

        $talk_content = htmlspecialchars($talk_content);

        // t_id 구함, 친구목록에서 댓글을 등록 경우  t_id 문제
        $res = sql_fetch("select t_id from {$g4['talk_table']} where id='{$id}'");
        if (empty($res))
            err_xml('존재하지 않는 토크입니다.');
        else
            $t_id = $res['t_id'];

        // 댓글은 희망        
        $sql = "insert into {$g4['talk_comment_table']} set t_id='{$t_id}', id='{$id}', mb_id='{$member['mb_id']}', name='{$member['mb_nick']}', secret='{$secret}', content='{$talk_content}', regdate='{$g4['time_ymdhis']}'";
        $qry = sql_query($sql, false);
        if (!$qry)
            err_xml('댓글을 등록하지 못했습니다.');
        
        // 정보의 정확성 확보해야 한다는 이 순위권
        $qry = sql_query("update {$g4['talk_table']} set comment_count = comment_count + 1 where id='{$id}'",false);
        if (!$qry)
            err_xml('댓글 갯수를 증감하지 못했습니다.');

        // 정보의 정확성 확보해야 한다는 이 2
        $qry = sql_query("update {$g4['talk_info_table']} set comment_count = comment_count + 1 where id='{$current['id']}'");
        if (!$qry)
            err_xml('댓글 갯수를 증감하지 못했습니다.');

        // 등록마지막 페이지
        $res = sql_fetch("select count(*) as cnt from {$g4['talk_comment_table']} where id='{$id}'");
        $last_page = (int)($res['cnt']/$g4['talk_comment_page_size']) + ($res['cnt']%$g4['talk_comment_page_size']==0 ? 0 : 1);

        // 포인트 부여
        insert_point($member['mb_id'], $g4['talk_comment_point'], '토크 댓글 작성');

        // 가자!!
        header("Content-Type:text/xml;");
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
        $xml .= "<channel>\n";
        $xml .= "<errnum>0</errnum>\n";
        $xml .= "<errmsg><![CDATA[{댓글을 등록했습니다.}]]></errmsg>\n";
        $xml .= "<id><![CDATA[{$id}]]></id>\n";
        $xml .= "<last_page><![CDATA[{$last_page}]]></last_page>\n";
        $xml .= "</channel>\n";
        if (strtoupper($g4['charset'])!='UTF-8') 
            $xml = convert_charset('CP949','UTF-8',$xml);

        echo $xml;
}

?>