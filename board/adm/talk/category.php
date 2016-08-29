<?
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");
$g4[title] = "토크 분류관리";

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

include_once("../admin.head.php");

?>
<script language="javascript" src="<?=$g4['path']?>/js/prototype.js"></script>

<table width=600 cellspacing=0 cellspacing=0 align=center>
<form name=form>
<tr><td>

<table border=0 cellpadding=0 cellspacing=0 width=95% align=center>
<tr>
    <td width=320 style="line-height:25px;">
        분류 관리
        <select id=list name=list style="width:300px;" size=15 onclick="select()"></select>
        <table border=0 cellpadding=0 cellspacing=0 width=300>
        <tr>
            <td>
                <input type=button value=△ onclick=category_up()>
                <input type=button value=▽ onclick=category_down()>
            </td>
            <td align=right>
                <input type=button value=삭제 onclick=category_delete()>
            </td>
        </tr>
        </table>
    </td>
    <td valign=top style="line-height:25px;">
        새 분류추가<br/>
        <input type=text size=20 maxlength=20 id="name" name="name" onKeyPress="if(event.keyCode==13) return false;"> <input type=button value=추가 onclick=category_add()>
        <br/>
        <br/>
        분류 수정<br/>
        <input type=text size=20 maxlength=20 id="mod_name" name="mod_name" onKeyPress="if(event.keyCode==13) return false;"> <input type=button value=변경 onclick=category_modify()>
        <br/>
    </td>
</tr>
</table>

</td></tr></form></table>

<script language=javascript>

function category_add() {
    var url     = 'category_update.php';
    var param   = 'mode=new&name=' + encodeURIComponent($F("name"));

    var myAjax = new Ajax.Request( 
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: category_add_complete
    });
}

function category_add_complete(req) {
    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    load();
}

function load(id) {

    $('name').value = '';
    $('mod_name').value = '';

    var url = 'category_get.php';
    var myAjax = new Ajax.Request (
    url, 
    {
        method: 'post', 
        parameters: 'id='+id,
        onComplete: load_complete
    });
}

function load_complete(req) {
    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;
    var id      = channel.getElementsByTagName('id')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    var item = channel.getElementsByTagName('item');
    var len = item.length;

    $("list").options.length = 0;

    for(i=0; i<len; i++) {
        get_id = item[i].getElementsByTagName('id')[0].firstChild.nodeValue;
        get_name = item[i].getElementsByTagName('name')[0].firstChild.nodeValue;
        
        if (id==get_id)
            index = $("list").length;

        $("list").options[$("list").length] = new Option(get_name, get_id);
   }

   if (index>-1)
       $("list").options[index].selected = true;
}

function category_up() {
    var url     = 'category_update.php';
    var param   = 'mode=up&id=' + $F('list');

    var myAjax = new Ajax.Request(
        url, 
        {
            method: 'post', 
            parameters: param,
            onComplete: category_up_complete
        });
}

function category_up_complete(req) {
    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    load(errmsg);
}

function category_down() {
    var url     = 'category_update.php';
    var param   = 'mode=down&id=' + $F('list');

    var myAjax = new Ajax.Request(
        url, 
        {
            method: 'post', 
            parameters: param,
            onComplete: category_down_complete
        });
}

function category_down_complete(req) {
    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    load(errmsg);
}

function select() {
    var index = $("list").selectedIndex;
    if( index > -1 )
        $("mod_name").value = $("list").options[index].text;
}

function category_modify() {
    
    var id      = $("list").value;
    var index   = $("list").selectedIndex;

    if (index>-1) {
        text = $("list").options[index].text;
        mod_name = $F("mod_name");

        msg = '\''+text+'\' 분류를 \''+mod_name+'\' 로 변경 하시겠습니까?';

        url = 'category_update.php';
        param = 'mode=mod&id=' + id + '&mod_name=' + encodeURIComponent(mod_name);

        if( !confirm(msg) ) return false;

        var myAjax = new Ajax.Request(
            url, 
            {
                method: 'post', 
                parameters: param,
                onComplete: category_modify_complete
            });
    } else {
        $("mod_name").value = '';
    }
}
function category_modify_complete(req) {
    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    load();
}

function category_delete() {

    var id      = $("list").value;
    var index   = $("list").selectedIndex;

    if (index<0) return false;

    var text    = $("list").options[index].text;
    var url     = 'category_update.php';
    var param   = 'mode=del&id=' + id;

    if (!confirm('\''+text+'\' 분류를 정말 삭제하시겠습니까?')) return false;

    var myAjax = new Ajax.Request(
        url, 
        {
            method: 'post', 
            parameters: param,
            onComplete: category_delete_complete
        });
}

function category_delete_complete(req) {
    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    load();
}

window.onload = function() {

    load();
}

</script>


<?
include_once("../admin.tail.php");
?>