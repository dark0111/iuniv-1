<?
if (!defined('_GNUBOARD_')) exit;

function popup_multi($skin_dir="", $bo_table, $rows="", $subject_len="", $options="")
{
  global $g4, $is_admin;

  if ($skin_dir)
    $latest_skin_path = "$g4[path]/skin/latest/$skin_dir";
  else
    $latest_skin_path = "$g4[path]/skin/latest/$config[cf_latest_skin]";

  $list = array();

  $sql = " select * from $g4[board_table] where bo_table = '$bo_table'";
  $board = sql_fetch($sql);

  //날짜 범위내, 분류 필드 옵션활용 그룹별 제어, 비밀글제외
  if (!empty($options))
    $options = " and ca_name = '$options' and wr_option not like '%secret%' ";
  else
    $options = "and wr_option not like '%secret%' ";

  $tmp_write_table = $g4['write_prefix'].$bo_table;
  $sql = " select * from $tmp_write_table where ('$g4[time_ymdhis]' between wr_3 and wr_4) ".$options." order by wr_num limit 0, $rows ";
  $result = sql_query($sql);

  $result = sql_query($sql);
  for ($i=0; $row = sql_fetch_array($result); $i++)
  {
    $list[$i] = get_list($row, $board, $latest_skin_path, $subject_len);
  }
  ob_start();
  include "$latest_skin_path/latest.skin.php";
  $content = ob_get_contents();
  ob_end_clean();

  return $content;
}
?>