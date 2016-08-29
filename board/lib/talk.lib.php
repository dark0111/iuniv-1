<?
function join_talk_q() {

    ?>
    <script language="javascript">
    if (confirm('토크를 개설하시겠습니까?'))
        location.href = 'mytalk_open.php';
    else
        history.back();
    </script>
    <?
    exit;
}

// 링크 사용법: [http://sir.co.kr 그누보드] → 그누보드
function get_talk($content) {
    $content = preg_replace("/(\[([^\s]+)\s+([^\]]+)\])/", "<a href='$2' target='_blank'>$3</a>", $content);
    return $content;
}

// 비어있나 검사. 꼴통?
function is_empty($str) {
    if (strlen(trim($str))>0) 
        return false;
    else
        return true;
}

// 이젠 에러 메시지도 xml 로 보내세요! 
function err_xml($msg, $errnum=1) {
    global $g4;
    header("Content-Type:text/xml;");
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; 
    $xml .= "<channel>\n";
    $xml .= "<errnum>{$errnum}</errnum>\n";
    $xml .= "<errmsg><![CDATA[{$msg}]]></errmsg>\n";
    $xml .= "</channel>\n";
    if (strtoupper($g4['charset'])!='UTF-8') 
        $xml = convert_charset('CP949','UTF-8',$xml);

    echo $xml;
    exit;
}
/*
-----------------------------------------------------------
    Charset 을 변환하는 함수
-----------------------------------------------------------
iconv 함수가 있으면 iconv 로 변환하고
없으면 mb_convert_encoding 함수를 사용한다.
둘다 없으면 사용할 수 없다.
*/
function convert_charset($from_charset, $to_charset, $str) {
    if( function_exists('iconv') )
        return iconv($from_charset, $to_charset, $str);
    elseif( function_exists('mb_convert_encoding') )
        return mb_convert_encoding($str, $to_charset, $from_charset);
    else
        die("Not found 'iconv' or 'mbstring' library in server.");
}

/*
-----------------------------------------------------------
    텍스트가 utf-8 인지 검사하는 함수
-----------------------------------------------------------
*/
function is_utf8($string) {
 
  // From http://w3.org/International/questions/qa-forms-utf-8.html
  return preg_match('%^(?:
        [\x09\x0A\x0D\x20-\x7E]            # ASCII
      | [\xC2-\xDF][\x80-\xBF]            # non-overlong 2-byte
      |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
      | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
      |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
      |  \xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
      | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
      |  \xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
  )*$%xs', $string);
 
} // function is_utf8


?>