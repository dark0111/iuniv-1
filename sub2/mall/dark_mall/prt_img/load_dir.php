<?

	// 실제 디렉토리를 자동으로 구합니다.
	$thisfilename = basename(__FILE__); 
	$temp_filename = realpath(__FILE__); 
	IF(!$temp_filename) $temp_filename = __FILE__; 
	$LOAD_DIRECTORY = eregi_replace($thisfilename,"",$temp_filename);

?>
