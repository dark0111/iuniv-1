<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<script language="JavaScript">
// 글자수 제한
var char_min = parseInt(<?=$comment_min?>); // 최소
var char_max = parseInt(<?=$comment_max?>); // 최대
</script>

<? if ($cwin==1) { ?><table width=100% cellpadding=10 align=center><tr><td><?}?>

<!-- 코멘트 리스트 -->
<div id="commentContents">
<?
for ($i=0; $i<count($list); $i++) {
    $comment_id = $list[$i][id];
?>
<a name="c_<?=$comment_id?>"></a>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
    <td><? for ($k=0; $k<strlen($list[$i][comment_reply]); $k++) echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='$IU[url]/sub/house/img/icon_comment_04.gif'>"; ?></td>
    <td width='100%'>

        <table border=0 cellpadding=0 cellspacing=0 width=100%>
       
        
		<tr>
            <td height=1 colspan=3 bgcolor="#dddddd"><td>
        </tr>
        <tr>
            <td height=1 colspan=3></td>
        </tr>
		<tr>
			<td valign=top>
				<div style="height:28px; background:url(<?=$IU[url]?>/sub/house/img/co_title_bg.gif); clear:both; line-height:28px;">
					<div style="float:left; margin:2px 0 0 2px;">
					<strong><?=$list[$i][name]?></strong>
					<span style="color:#888888; font-size:11px;"><?=$list[$i][datetime]?></span>
					</div>
					<div style="float:right; margin-top:5px;">
					<? if ($is_ip_view) { echo "&nbsp;<span style=\"color:#B2B2B2; font-size:11px;\">{$list[$i][ip]}</span>"; } ?>
					<? if ($list[$i][is_reply]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'c');\"><img src='$IU[url]/sub/house/img/co_btn_reply.gif' border=0 align=absmiddle alt='답변'></a> "; } ?>
					<? if ($list[$i][is_edit]) { echo "<a href=\"javascript:comment_box('{$comment_id}', 'cu');\"><img src='$IU[url]/sub/house/img/co_btn_modify.gif' border=0 align=absmiddle alt='수정'></a> "; } ?>
					<? if ($list[$i][is_del])  { echo "<a href=\"javascript:comment_delete('{$list[$i][del_link]}');\"><img src='$IU[url]/sub/house/img/co_btn_delete.gif' border=0 align=absmiddle alt='삭제'></a> "; } ?>
					&nbsp;
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td align=left style='line-height:20px; padding:7px; word-break:break-all; overflow:hidden; clear:both; '>
				<!-- 코멘트 출력 -->
				
				<?
				$str = $list[$i][content];

				$comment_content=$str;
				$r_total=count(explode('!--',$comment_content))-1;
			
				for($ic=0;$ic<$r_total;$ic++)
				{
					$r_string=array();
					$hidden_start=strpos($comment_content,'&lt;!--');
					$hidden_end=strpos($comment_content,'--&gt;');
					$r_string[0]=substr($comment_content,0,$hidden_start);
					$r_string[1]=substr($comment_content,$hidden_end+6);
					$comment_content=implode(" ",$r_string);
				}
				$str=$comment_content;
				if (strstr($list[$i][h_option], "secret")) echo "<span style='color:#ff6600;'>*</span> ";
				if (strstr($list[$i][h_option], "secret"))
					$str = "<span class='small' style='color:#ff6600;'>$str</span>";

				$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $str);
				$str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(swf)\".*\<\/a\>\]/i", "<script>doc_write(flash_movie('$1://$2.$3'));</script>", $str);
				$str = preg_replace("/\[\<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp)\"\s*[^\>]*\>[^\s]*\<\/a\>\]/i", "<img src='$1://$2.$3' id='target_resize_image[]' onclick='image_window(this);' border='0'>", $str);
				echo $str;
					
				
				//echo "<br>####".$hidden_start."###########<br><br>".implode(" ",$r_string);

				?>
			
				<? if ($list[$i][trackback]) { echo "<p>".$list[$i][trackback]."</p>"; } ?>
				<span id='edit_<?=$comment_id?>' style='display:none;'></span><!-- 수정 -->
				<span id='reply_<?=$comment_id?>' style='display:none;'></span><!-- 답변 -->
				
				<input type=hidden id='secret_comment_<?=$comment_id?>' value="<?=strstr($list[$i][h_option],"secret")?>">
				<textarea id='save_comment_<?=$comment_id?>' style='display:none;'><?=get_text($list[$i][content1], 0)?></textarea>
			</td>
		</tr>
		<tr>
			<td height=5 colspan=3></td>
		</tr>
		</table>

    </td>
</tr>
</table>
<? } ?>
</div>
<!-- 코멘트 리스트 -->

<? if ($is_comment_write) { ?>
<!-- 코멘트 입력 -->
<div id=comment_write style="display:none;">
<table width=100% border=0 cellpadding=1 cellspacing=0 bgcolor="#dddddd"><tr><td>
<form name="fviewcomment" method="post" action="<?=$IU[url]?>/sub2/house/write_comment_update.php" onsubmit="return fviewcomment_submit(this);" autocomplete="off" style="margin:0px;">
<input type=hidden name=w           id=w value='c'>
<input type=hidden name=h_cd       value='<?=$h_cd?>'>
<input type=hidden name=comment_id  id='comment_id' value=''>
<input type=hidden name=sca         value='<?=$sca?>' >
<input type=hidden name=sfl         value='<?=$sfl?>' >
<input type=hidden name=stx         value='<?=$stx?>'>
<input type=hidden name=spt         value='<?=$spt?>'>
<input type=hidden name=page        value='<?=$page?>'>
<input type=hidden name=cwin        value='<?=$cwin?>'>
<input type=hidden name=is_good     value=''>

<table width=100% cellpadding=3 height=156 cellspacing=0 bgcolor="#ffffff" style="border:1px solid #fff; background:url(<?=$IU[url]?>/sub2/house/img/co_bg.gif) x-repeat;">
<tr>
    <td colspan="2" style="padding:5px 0 0 5px;" align=left>
        <span style="cursor: pointer;" onclick="textarea_decrease('wr_content', 8);"><img src="<?=$IU[url]?>/sub2/house/img/co_btn_up.gif" border='0'></span>
        <span style="cursor: pointer;" onclick="textarea_original('wr_content', 8);"><img src="<?=$IU[url]?>/sub2/house/img/co_btn_init.gif" border='0'></span>
        <span style="cursor: pointer;" onclick="textarea_increase('wr_content', 8);"><img src="<?=$IU[url]?>/sub2/house/img/co_btn_down.gif" border='0'></span>
        <? if ($is_guest) { ?>
            이름 <INPUT type=text maxLength=20 size=10 name="wr_name" itemname="이름" required class=ed>
            패스워드 <INPUT type=password maxLength=20 size=10 name="wr_password" itemname="패스워드" required class=ed>
            <? if ($is_guest) { ?>
            <img id='kcaptcha_image' border='0' width=120 height=60 onclick="imageClick();" style="cursor:pointer;" title="글자가 잘안보이는 경우 클릭하시면 새로운 글자가 나옵니다.">
            <input title="왼쪽의 글자를 입력하세요." type="input" name="wr_key" size="10" itemname="자동등록방지" required class=ed>
            <?}?>
        <? } ?>
        <input type=checkbox id="wr_secret" name="wr_secret" value="secret">비밀글
        <? if ($comment_min || $comment_max) { ?><span id=char_count></span>글자<?}?>
    </td>
</tr>
<tr>
    <td width=95%>
        <textarea id="wr_content" name="wr_content" rows=8 itemname="내용" required
        <? if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?}?> style='width:100%; word-break:break-all;' class=tx></textarea>
        <? if ($comment_min || $comment_max) { ?><script language="javascript"> check_byte('wr_content', 'char_count'); </script><?}?>
    </td>
    <td width=85 align=center>
        <div><input type="image" src="<?=$IU[url]?>/sub2/house/img/co_btn_write.gif" border=0 accesskey='s'></div>
    </td>
</tr>
</table>
</form>
</td></tr></table>
</div>

<script type="text/javascript"> var md5_norobot_key = ''; </script>

<script type="text/javascript">
function imageClick() {
		 var para = "";
		is_loding = true;
		$.ajax({
			url:'<?=$g4[bbs_path]?>/kcaptcha_session.php',
			type: 'post',
			data: '',
			asynchronous: true,
			 parameters: para, 
			success:   imageClickResult
		});


}

function imageClickResult(req) { 
	
    var result = req;
    var img = document.createElement("IMG");
    img.setAttribute("src", "<?=$g4[bbs_path]?>/kcaptcha_image.php?t=" + (new Date).getTime());
    document.getElementById('kcaptcha_image').src = img.getAttribute('src');

    md5_norobot_key = result;
}


var save_before = '';
var save_html = document.getElementById('comment_write').innerHTML;

function good_and_write()
{
    var f = document.fviewcomment;
    if (fviewcomment_submit(f)) {
        f.is_good.value = 1;
        f.submit();
    } else {
        f.is_good.value = 0;
    }
}

function fviewcomment_submit(f)
{
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

    f.is_good.value = 0;

    var s;
    if (s = word_filter_check(document.getElementById('wr_content').value))
    {
        alert("내용에 금지단어('"+s+"')가 포함되어있습니다");
        document.getElementById('wr_content').focus();
        return false;
    }

    // 양쪽 공백 없애기
    var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
    document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
    if (char_min > 0 || char_max > 0)
    {
        check_byte('wr_content', 'char_count');
        var cnt = parseInt(document.getElementById('char_count').innerHTML);
        if (char_min > 0 && char_min > cnt)
        {
            alert("코멘트는 "+char_min+"글자 이상 쓰셔야 합니다.");
            return false;
        } else if (char_max > 0 && char_max < cnt)
        {
            alert("코멘트는 "+char_max+"글자 이하로 쓰셔야 합니다.");
            return false;
        }
    }
    else if (!document.getElementById('wr_content').value)
    {
        alert("코멘트를 입력하여 주십시오.");
        return false;
    }

    if (typeof(f.wr_name) != 'undefined')
    {
        f.wr_name.value = f.wr_name.value.replace(pattern, "");
        if (f.wr_name.value == '')
        {
            alert('이름이 입력되지 않았습니다.');
            f.wr_name.focus();
            return false;
        }
    }

    if (typeof(f.wr_password) != 'undefined')
    {
        f.wr_password.value = f.wr_password.value.replace(pattern, "");
        if (f.wr_password.value == '')
        {
            alert('패스워드가 입력되지 않았습니다.');
            f.wr_password.focus();
            return false;
        }
    }

    if (typeof(f.wr_key) != 'undefined')
    {
        if (hex_md5(f.wr_key.value) != md5_norobot_key)
        {
            alert('자동등록방지용 글자가 순서대로 입력되지 않았습니다.'+md5_norobot_key);
            f.wr_key.select();
            f.wr_key.focus();
            return false;
        }
    }

    return true;
}

function comment_box(comment_id, work)
{
    var el_id;
    // 코멘트 아이디가 넘어오면 답변, 수정
    if (comment_id)
    {
        if (work == 'c')
            el_id = 'reply_' + comment_id;
        else
            el_id = 'edit_' + comment_id;
    }
    else
        el_id = 'comment_write';

    if (save_before != el_id)
    {
        if (save_before)
        {
            document.getElementById(save_before).style.display = 'none';
            document.getElementById(save_before).innerHTML = '';
        }

        document.getElementById(el_id).style.display = '';
        document.getElementById(el_id).innerHTML = save_html;
        // 코멘트 수정
        if (work == 'cu')
        {
            document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
            if (typeof char_count != 'undefined')
                check_byte('wr_content', 'char_count');
            if (document.getElementById('secret_comment_'+comment_id).value)
                document.getElementById('wr_secret').checked = true;
            else
                document.getElementById('wr_secret').checked = false;
        }

        document.getElementById('comment_id').value = comment_id;
        document.getElementById('w').value = work;

        save_before = el_id;
    }

    if (work == 'c') {
	
        <? if (!$is_member) { ?>	imageClick();<? } ?>
    }
}

function comment_delete(url)
{
    if (confirm("이 코멘트를 삭제하시겠습니까?")) location.href = url;
}

comment_box('', 'c'); // 코멘트 입력폼이 보이도록 처리하기위해서 추가 (root님)
</script>
<? } ?>

<? if($cwin==1) { ?></td><tr></table><p align=center><a href="javascript:window.close();"><img src="<?=$IU[url]?>/sub/house/img/btn_close.gif" border="0"></a><br><br><?}?>
