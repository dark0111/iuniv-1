<?
// 게시글에 첨부된 파일을 얻는다. (배열로 반환)
function get_house_file($class_id,$wr_id)
{
    global $g4, $qstr;

    $file["count"] = 0;
    $sql = " select * from  room_imageinfo where I_classify = '$class_id' and I_classify_id = '$wr_id'";
    $result = sql_query($sql);
    while ($row = sql_fetch_array($result))
    {
        $no = $row[I_id];
      
        // 4.00.11 - 파일 path 추가
        $file[$no][path] = "$g4[path]/data/file/$bo_table";
        //$file[$no][size] = get_filesize("{$file[$no][path]}/$row[bf_file]");
        $file[$no][size] = get_filesize($row[bf_filesize]);
        //$file[$no][datetime] = date("Y-m-d H:i:s", @filemtime("$g4[path]/data/file/$bo_table/$row[bf_file]"));
        $file[$no][datetime] = $row[bf_datetime];
        $file[$no][source] = $row[bf_source];
        $file[$no][bf_content] = $row[bf_content];
        $file[$no][content] = get_text($row[bf_content]);
        //$file[$no][view] = view_file_link($row[bf_file], $file[$no][content]);
        $file[$no][view] = view_file_link($row[I_filename], $row[bf_width], $row[bf_height], $file[$no][content]);
        $file[$no][file] = $row[I_filename];
        // prosper 님 제안
        //$file[$no][imgsize] = @getimagesize("{$file[$no][path]}/$row[bf_file]");
        $file[$no][image_width] = $row[bf_width] ? $row[bf_width] : 640;
        $file[$no][image_height] = $row[bf_height] ? $row[bf_height] : 480;
        $file[$no][image_type] = $row[bf_type];
        $file["count"]++;
    }

    return $file;
}
/*
$uquery1="select fit,fit_time,h_cd from room_room group by h_cd";
$uresult1=sql_query($uquery1);
$uc=mysql_num_rows($uresult1);
for($i=0;$i<$uc;$i++)
{
	$urow1=sql_fetch_array($uresult1);

	$uquery2="update room_house set fit='$urow1[fit]',fit_time=$urow1[fit_time] where h_cd='$urow1[h_cd]'";
	sql_query($uquery2);
}

*/
?>