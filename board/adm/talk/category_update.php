<?
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");
$g4[title] = "토크 분류관리";

if ($is_admin != "super")
    err_xml("최고관리자만 접근 가능합니다.");

switch( $mode ) { 

    // 분류 순서를 올린다.
    case 'up':

        // 해당 분류가 실제 있는지 조사해본다.
        $res = sql_fetch("select * from {$g4['talk_category_table']} where id = '{$id}'");

        // 없으면 죽어..
        if (empty($res)) err_xml('분류가 존재하지 않습니다.');

        $res = sql_fetch("select id from {$g4['talk_category_table']} where rank<'{$res['rank']}' order by rank desc limit 1 ");
        if ($res) {
            sql_query("update {$g4['talk_category_table']} set rank = rank - 1 where id = '{$id}'");
            sql_query("update {$g4['talk_category_table']} set rank = rank + 1 where id = '{$res['id']}'");
        }

        err_xml($id,0);

    // 분류 순서를 내린다.
    case 'down':

        // 해당 분류가 실제 있는지 조사해본다.
        $res = sql_fetch("select * from {$g4['talk_category_table']} where id = '{$id}'");

        // 없으면 죽어..
        if (empty($res)) err_xml('분류가 존재하지 않습니다.');

        $res = sql_fetch("select id from {$g4['talk_category_table']} where rank>'{$res['rank']}' order by rank limit 1 ");
        if ($res) {
            sql_query("update {$g4['talk_category_table']} set rank = rank + 1 where id = '{$id}'");
            sql_query("update {$g4['talk_category_table']} set rank = rank - 1 where id = '{$res['id']}'");
        }

        err_xml($id,0);

    // 분류를 수정한다.
    case 'mod':

        // 분류 이름은 끌고 온건지 조사해본다. 없으면 죽는다.
        if( !trim($mod_name) ) err_xml('분류 이름을 입력해주세요.');

        $mod_name = rawurldecode($mod_name);
        if (strtoupper($g4['charset']) != 'UTF-8' && is_utf8($mod_name)) {
            $mod_name = convert_charset('UTF-8','CP949',$mod_name);
        }

        // 해당 분류가 실제 있는지 조사해본다.
        $r = sql_fetch("select * from {$g4['talk_category_table']} where id = '{$id}'");

        // 없으면 죽어..
        if (empty($r))  err_xml('분류가 존재하지 않습니다.');

        // 같은 이름이 있는지 조사하면 다 나와
        $r = sql_fetch("select * from {$g4['talk_category_table']} where name = '{$mod_name}'");

        // 없으면 바꿔줘
        if (empty($r)) {

            // 수정 쿼리 날려본다.
            sql_query("update {$g4['talk_category_table']} set name = '{$mod_name}' where id='{$id}'");

            // 성공했다.
             err_xml('ok',0);

        // 같은 이름이 있으면 수정이 안되야
        } else {

            // 죽는거다.
             err_xml('이미 같은 이름이 있습니다.');

        } // end if

    // 분류 삭제
    case 'del':

        // 해당 분류가 실제 있는지 조사해본다.
        $r = sql_fetch("select * from {$g4['talk_category_table']} where id = '{$id}'");

        // 없으면 죽어..
        if (empty($r))  err_xml('분류가 존재하지 않습니다.');

        // 해당 분류의 rank 를 깐다.
        $rank = $r['rank'];

        // 분류 삭제 쿼리 날려본다.
        sql_query("delete from {$g4['talk_category_table']} where id='{$id}'");

        // 삭제된 분류보다 rank 값이 큰걸 모조리 -1 한다
        sql_query("update {$g4['talk_category_table']} set rank = rank - 1 where rank > {$rank}");

        // 대빵이 없어졌으니 새끼들은 전부 길을 잃는거다.
        sql_query("update {$g4['talk_table']} set c_id=0 where c_id='{$id}'");

        // 좋덴다.
        err_xml('ok',0);

    // 분류가 새식구를 맞이 한다.
    case 'new':

        // 분류 이름은 끌고 온건지 조사해본다. 없으면 죽는다.
        if (is_empty($name)) err_xml('분류 이름을 입력해주세요.');

        if (strtoupper($g4['charset'])!='UTF-8'&&is_utf8($name))
            $name = convert_charset('UTF-8','CP949',$name);

        // 같은 이름이 있는지 조사하면 다 나와
        $res = sql_fetch("select * from {$g4['talk_category_table']} where name = '{$name}'");

        // 없으면 받아드려
        if (empty($res)) {

            // 순서를 정해 줘야지..
            $res = sql_fetch("select max(rank) as rank from {$g4['talk_category_table']} ");

            if( !$res['rank'] ) 
                $rank = 1; 
            else 
                $rank = $res['rank'] + 1;

            // 정식으로 입사 시켜준다.
            sql_query("insert into {$g4['talk_category_table']} set name='{$name}', rank='{$rank}'");

            err_xml('등록 완료',0);

        // 같은 이름이 있으면 가입이 안되야
        } else {

            // 죽는거다.
            err_xml('같은 분류이름이 존재합니다.');

        } // end if

} // end select

?>