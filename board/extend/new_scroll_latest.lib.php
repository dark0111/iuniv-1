<?
function latest_scroll($skin_dir="",$rows, $subject_len,$options="")
{
    global $config;
    global $g4;

    if ($skin_dir)
        $latest_skin_path = "$g4[path]/skin/latest/$skin_dir";
    else
        $latest_skin_path = "$g4[path]/skin/latest/$config[cf_latest_skin]";

    $list = array();


    $sql = " select a.*, b.bo_subject, c.gr_subject, c.gr_id
        from $g4[board_new_table] a, $g4[board_table] b,  $g4[group_table] c
        where a.bo_table = b.bo_table and b.gr_id = c.gr_id and b.bo_use_search = '1' and  a.wr_id = a.wr_parent
        order by a.bn_id desc limit 0,$rows";


    $result = sql_query($sql);

    for ($i=0; $row = sql_fetch_array($result); $i++)
    {
        $tmp_write_table = $g4[write_prefix].$row[bo_table];

        $row2 = sql_fetch(" select * from $tmp_write_table where wr_id = '$row[wr_id]' ");
        $list[$i] = $row2;
        $list[$i][bo_table] = $row[bo_table];
        $list[$i][bo_subject] = $row[bo_subject];
        $list[$i][gr_subject] = $row[gr_subject];
        $list[$i][href] = "$g4[bbs_path]/board.php?bo_table=$row[bo_table]&wr_id=$row2[wr_id]";
        $list[$i][wr_subject] = cut_str($row2[wr_subject], $subject_len, "…");
        $list[$i][comment_cnt] = "";
        if ($row2[wr_comment])
           $list[$i][comment_cnt] = "($row2[wr_comment])";
     }

        ob_start();
        include "$latest_skin_path/latest.skin.php";
        $content = ob_get_contents();
        ob_end_clean();

    return $content;
}
?>
