<?
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");
$g4[title] = "토크 기본설정";

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

include_once("../admin.head.php");

if (!is_writeable("../../extend")) 
    echo "<p><font color=red><b>extend 디렉토리의 퍼미션을 707로 변경하여 주십시오.<br><br>$> chmod 707 extend <br><br>그 다음 설정을 시도해 주십시오.</b></font></p>";

if (is_empty($g4['plaza_page_size']))           $g4['plaza_page_size'] = 20;
if (is_empty($g4['talk_page_size']))            $g4['talk_page_size'] = 10;
if (is_empty($g4['talk_comment_page_size']))    $g4['talk_comment_page_size'] = 10;
if (is_empty($g4['talk_limit_level']))          $g4['talk_limit_level'] = 1;
if (is_empty($g4['talk_input_limit_level']))    $g4['talk_input_limit_level'] = 2;
if (is_empty($g4['talk_open_rss']))             $g4['talk_open_rss'] = 1;
if (is_empty($g4['talk_open_message']))         $g4['talk_open_message'] = "<span class='new-talk-message'>[name] 님이 토크를 오픈했습니다.^^</span>";
if (is_empty($g4['talk_profile_image_limit']))  $g4['talk_profile_image_limit'] = 1024*100;
if (is_empty($g4['talk_point']))                $g4['talk_point'] = 100;
if (is_empty($g4['talk_comment_point']))        $g4['talk_comment_point'] = 50;

$g4['talk_open_message'] = str_replace("\"", "'", $g4['talk_open_message']);
$g4['talk_open_message'] = str_replace("[", "\\[", $g4['talk_open_message']);
$g4['talk_open_message'] = str_replace("]", "\\]", $g4['talk_open_message']);
?>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<form name=form method=post action='config_update.php'>
<tr class='ht'>
    <td align=left><?=subtitle("토크 기본설정")?></td>
</tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 width=100%>
    <tr class='ht'>
        <td width=200 height=40>
            광장토크의 한 페이지 글 갯수
        </td>
        <td>
            <input type="text" size="3" maxlength="3" name="plaza_page_size" value="<?=$g4['plaza_page_size']?>" itemname='광장토크의 한 페이지 글 갯수' required numeric> 개
        </td>
    </tr>
    <tr><td height=1 colspan=2 bgcolor=#efefef></td></tr>
    <tr class='ht'>
        <td width=200 height=40>
            토크의 한 페이지 글 갯수
        </td>
        <td>
            <input type="text" size="3" maxlength="3" name="talk_page_size" value="<?=$g4['talk_page_size']?>" itemname='토크의 한 페이지 글 갯수' required numeric> 개
        </td>
    </tr>
    <tr><td height=1 colspan=2 bgcolor=#efefef></td></tr>
    <tr class='ht'>
        <td width=200 height=40>
            한 토크의 댓글 갯수
        </td>
        <td>
            <input type="text" size="3" maxlength="3" name="talk_comment_page_size" value="<?=$g4['talk_comment_page_size']?>" itemname='한 토크의 댓글 갯수' required numeric> 개
        </td>
    </tr>
    <tr><td height=1 colspan=2 bgcolor=#efefef></td></tr>
    <tr class='ht'>
        <td width=200 height=40>
            토크 접근 권한
        </td>
        <td>
            <select name="talk_limit_level">
            <?for($i=1; $i<=10; $i++){?>
            <option value="<?=$i?>"<?if($i==$g4['talk_limit_level']) echo ' selected'?>><?=$i?></option>
            <?}?>
            </select>
            이상
        </td>
    </tr>
    <tr><td height=1 colspan=2 bgcolor=#efefef></td></tr>
    <tr class='ht'>
        <td width=200 height=40>
            토크 입력 권한
        </td>
        <td>
            <select name="talk_input_limit_level">
            <?for($i=2; $i<=10; $i++){?>
            <option value="<?=$i?>"<?if($i==$g4['talk_input_limit_level']) echo ' selected'?>><?=$i?></option>
            <?}?>
            </select>
            이상
        </td>
    </tr>
    <tr><td height=1 colspan=2 bgcolor=#efefef></td></tr>
    <tr class='ht'>
        <td width=200 height=40>
            RSS 지원 여부
        </td>
        <td>
            <input type="radio" name="talk_open_rss" value="1"<?if($g4['talk_open_rss']==1) echo ' checked'?>> 사용함
            <input type="radio" name="talk_open_rss" value="0"<?if($g4['talk_open_rss']==0) echo ' checked'?>> 사용안함
        </td>
    </tr>
    <tr><td height=1 colspan=2 bgcolor=#efefef></td></tr>
    <tr class='ht'>
        <td width=200 height=40>
            상단 파일 경로
        </td>
        <td>
            <input type="text" size="50" name="talk_head_file" value="<?=$g4['talk_head_file']?>">
        </td>
    </tr>
    <tr><td height=1 colspan=2 bgcolor=#efefef></td></tr>
    <tr class='ht'>
        <td width=200 height=40>
            하단 파일 경로
        </td>
        <td>
            <input type="text" size="50" name="talk_tail_file" value="<?=$g4['talk_tail_file']?>">
        </td>
    </tr>
    <tr><td height=1 colspan=2 bgcolor=#efefef></td></tr>
    <tr class='ht'>
        <td width=200 height=40>
            토그 개설 메시지
        </td>
        <td>
            <input type="text" style="width:90%" name="talk_open_message" id="talk_open_message" value="">
        </td>
    </tr>
    <tr><td height=1 colspan=2 bgcolor=#efefef></td></tr>
    <tr class='ht'>
        <td width=200 height=40>
            프로필 이미지 용량 제한
        </td>
        <td>
            <input type="text" size="10" name="talk_profile_image_limit" value="<?=$g4['talk_profile_image_limit']?>"> byte
        </td>
    </tr>
    <tr><td height=1 colspan=2 bgcolor=#efefef></td></tr>
    <tr class='ht'>
        <td width=200 height=40>
            토크 작성 포인트
        </td>
        <td>
            <input type="text" size="10" name="talk_point" value="<?=$g4['talk_point']?>"> 점
        </td>
    </tr>
    <tr><td height=1 colspan=2 bgcolor=#efefef></td></tr>
    <tr class='ht'>
        <td width=200 height=40>
            댓글 작성 포인트
        </td>
        <td>
            <input type="text" size="10" name="talk_comment_point" value="<?=$g4['talk_comment_point']?>"> 점
        </td>
    </tr>
    <tr><td height=1 colspan=2 bgcolor=#efefef></td></tr>
</table>

<p style="margin-left:200px;">
    <input type=submit class=btn1 accesskey='s' value='  확  인  '>
</p>
</form>

<script language=javascript>
document.getElementById('talk_open_message').value = "<?=$g4['talk_open_message']?>";
</script>

<?
include_once("../admin.tail.php");
?>