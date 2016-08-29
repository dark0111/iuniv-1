<?
if (!defined('_GNUBOARD_')) exit;
//======일정관리 메인추출========= 
function latest_schedule($skin_dir='', $bo_table) 
{ 
    global $config; 
    global $g4; 
    global $year, $month; 

    // 스킨디렉토리값이 넘어왔다면 
    if ($skin_dir) { 
        $latest_skin_path = "./$g4[path]/skin/latest/$skin_dir"; 
    } 

    $write_table = $g4[write_prefix] . $bo_table; 
  
    ob_start(); 
    include "$latest_skin_path/latest.skin.php"; 
    $content = ob_get_contents(); 
    ob_end_clean(); 

    return $content; 
} 
?>
