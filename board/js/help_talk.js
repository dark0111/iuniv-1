
if (navigator.appName.indexOf("Microsoft") != -1) IS_IE = true; else IS_IE = false;

function talk_update(id) {
    var param = null;
    var talk_category = '';
    var talk_content = '';
    var talk_name = '';
    var mode = '';
    var talk_secret = '';

    if (id==0) {
        page = 1;
        talk_category = $F('gnutalk_my_input_form_category');
        talk_content = $F('gnutalk_my_input_form_content');
        talk_secret = $F('gnutalk_my_input_form_secret');
        
    } else {
        talk_content = $F('gnutalk_my_modify_form_content');
        mode = 'update';
    }

    var param = 'c_id=' + encodeURIComponent(talk_category);
    param += '&talk_content=' + encodeURIComponent(talk_content);
    param += '&secret=' + talk_secret;
    param += '&mode=' + mode;
    param += '&t_id=' + t_id;
    param += '&id=' + id;

    var url = './board/talk/mytalk_update.php';

    var myAjax = new Ajax.Request(
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: talk_update_complete
    });
}

function talk_update_complete(req) {

    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    if (errnum==0) {
        $('gnutalk_my_input_form_content').value = '';
        talk_get_content(); 
    } else {
        alert(errmsg);
    }
}

function talk_get_content(id) {

    var param = 't_id=' + t_id;
    param += '&page=' + page;
    if (id)
        param += '&id=' + id;

    var url = './board/talk/mytalk_get.php';

    talk_loading();

    var myAjax = new Ajax.Request(
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: talk_get_content_complete
    });
}

function talk_get_content_complete(req) {
    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;
    var permission  = channel.getElementsByTagName('permission')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    var item = channel.getElementsByTagName('item');
    var len = item.length;

    $('mytalk').innerHTML = '';
    var before_date = '';

    for(i=0; i<len; i++) {

        // xml 데이터 파싱
        get_id = item[i].getElementsByTagName('id')[0].firstChild.nodeValue;
        get_c_id = item[i].getElementsByTagName('c_id')[0].firstChild.nodeValue;
        get_t_id = item[i].getElementsByTagName('t_id')[0].firstChild.nodeValue;
        get_name = item[i].getElementsByTagName('name')[0].firstChild.nodeValue;
        get_content = item[i].getElementsByTagName('content')[0].firstChild.nodeValue;
        get_comment_count = item[i].getElementsByTagName('comment_count')[0].firstChild.nodeValue;
        get_vote = item[i].getElementsByTagName('vote')[0].firstChild.nodeValue;
        get_date = item[i].getElementsByTagName('date')[0].firstChild.nodeValue;
        get_time = item[i].getElementsByTagName('time')[0].firstChild.nodeValue;
        get_noon = item[i].getElementsByTagName('noon')[0].firstChild.nodeValue;
        get_week = item[i].getElementsByTagName('week')[0].firstChild.nodeValue;
        get_page = item[i].getElementsByTagName('page')[0].firstChild.nodeValue;

        var talk_group = document.createElement('ul');

        // 아이콘
        var talk_icon = document.createElement('li');
        talk_icon.id = 'talk_icon' + get_id;
        talk_icon.className = 'talk_icon';
        talk_icon.innerHTML = "<img src='"+gnutalk_skin_path+"/img/talk3.gif'>";
        talk_group.appendChild(talk_icon);

        // 내용
        var talk_content = document.createElement('li');
        talk_content.id = 'talk_content' + get_id;
        talk_content.className = 'talk_content';
        talk_content.innerHTML = get_content + '<br/>';
        talk_group.appendChild(talk_content);

        // 댓글
        var talk_comment = document.createElement('span');
        talk_comment.id = 'talk_comment' + get_id;
        talk_comment.className = 'talk_comment';
        talk_comment.innerHTML = '<a href="javascript:void(talk_comment(' + get_id + '));">댓글 (<span id="comment_count' + get_id + '">' + get_comment_count + '</span>)</a>';
        talk_content.appendChild(talk_comment);

        // 등록 시간
        var talk_time = document.createElement('span');
        talk_time.id = 'talk_time' + get_id;
        talk_time.className = 'talk_time';
        talk_time.innerHTML = get_noon + ' ' + get_time;
        talk_content.appendChild(talk_time);

        // 자신의 글일 경우 수정, 삭제버튼 출력
        if (is_member==true && permission==1) {
            var talk_action = document.createElement('span');
            talk_action.id = 'talk_action' + get_id;
            talk_action.className = 'talk_action';
            talk_action.innerHTML = '<a href="javascript:void(talk_modify(' + get_id + '));">수정</a> <a href="javascript:void(talk_delete(' + get_id + '))">삭제</a>';
            talk_content.appendChild(talk_action);
        }

        // 댓글 출력
        var talk_comment_list = document.createElement('li');
        talk_comment_list.id = 'talk_comment_list' + get_id;
        talk_comment_list.className = 'talk_comment_list';
        talk_group.appendChild(talk_comment_list);

        if (before_date==get_date) {

            talk_main.appendChild(talk_group);

        } else {

            var talk_date = document.createElement('p');
            talk_date.id = 'talk_date';
            talk_date.className = 'talk_date';
            talk_date.innerHTML = get_date;

            var talk_main = document.createElement('div');
            talk_main.id = 'talk_main';

            talk_main.appendChild(talk_group);

            $('mytalk').appendChild(talk_date);
            $('mytalk').appendChild(talk_main);

            before_date = get_date;
        }
    }

    var talk_page = document.createElement('p');
    talk_page.id = 'talk_page';
    talk_page.className = 'talk_page';
    talk_page.innerHTML = get_page;

    $('mytalk').appendChild(talk_page);
}

function talk_modify(id) {

    var url = './board/talk/mytalk_update.php';
    var param = 't_id=' + t_id + '&id=' + id + '&mode=permission';

    var myAjax = new Ajax.Request(
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: talk_modify_complete
    });
}

function talk_modify_complete(req) {

    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    var item = channel.getElementsByTagName('item');
    var get_id = item[0].getElementsByTagName('id')[0].firstChild.nodeValue;
    var get_content = item[0].getElementsByTagName('content')[0].firstChild.nodeValue;

    var modify_form = document.createElement('input');
    modify_form.type = 'text';
    modify_form.id = 'gnutalk_my_modify_form_content';
    if (IS_IE)
        modify_form.onkeypress = function() { if (event.keyCode==13) talk_update(get_id); }
    else
        modify_form.onkeypress = function(event) { if (event.keyCode==13) talk_update(get_id);    }

    modify_form.value = get_content;

    var modify_button = document.createElement('input');
    modify_button.type = 'button';
    modify_button.id = 'gnutalk_my_modify_form_button';
    modify_button.value = '저장';
    modify_button.onclick = function() { talk_update(get_id); }

    $('talk_content'+get_id).innerHTML = '';
    $('talk_content'+get_id).appendChild(modify_form);
    $('talk_content'+get_id).appendChild(modify_button);
}

function talk_delete(id) {

    if (!confirm('한번 삭제한 자료는 복구할 수 없습니다.\n\n그래도 삭제하시겠습니까?')) return;

    var url = './board/talk/mytalk_update.php';
    var param = 't_id=' + t_id + '&id=' + id + '&mode=delete';

    var myAjax = new Ajax.Request(
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: talk_delete_complete
    });
}

function talk_delete_complete(req) {

    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    talk_get_content();
}

function talk_comment(id,page,sw) {

    if (sw!=1 && $('talk_comment_list'+id)) {
        if ($('talk_comment_list'+id).style.display == '') {
            $('talk_comment_list'+id).style.display = 'block';
        }else if ($('talk_comment_list'+id).style.display != 'none') {
            $('talk_comment_list'+id).style.display = 'none';
            return;
        } else {
            $('talk_comment_list'+id).style.display = 'block';
        }
    }

    talk_comment_loading(id);

    if (!page) page = 1;

    var url = './board/talk/mytalk_comment_get.php';
    var param = 't_id=' + t_id + '&id=' + id + '&page=' + page;

    var myAjax = new Ajax.Request(
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: talk_comment_complete
    });
}

function talk_comment_complete(req) {

    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;
    var paging  = channel.getElementsByTagName('paging')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); $('talk_comment_list'+get_id).innerHTML = ''; return; }

    var get_id  = channel.getElementsByTagName('id')[0].firstChild.nodeValue;
    var total   = channel.getElementsByTagName('total')[0].firstChild.nodeValue;

    $('comment_count'+get_id).innerHTML = total;

    var item = channel.getElementsByTagName('item');
    var len = item.length;
   
    $('talk_comment_list'+get_id).style.display = 'block';
    $('talk_comment_list'+get_id).innerHTML = '';

    for(i=0; i<len; i++) {
        get_num = item[i].getElementsByTagName('num')[0].firstChild.nodeValue;
        get_name = item[i].getElementsByTagName('name')[0].firstChild.nodeValue;
        get_content = item[i].getElementsByTagName('content')[0].firstChild.nodeValue;
        get_regdate = item[i].getElementsByTagName('regdate')[0].firstChild.nodeValue;
        permission = item[i].getElementsByTagName('permission')[0].firstChild.nodeValue;
        image = item[i].getElementsByTagName('image')[0].firstChild.nodeValue;

        var talk_comment_group = document.createElement('ul');

        var talk_comment_profile = document.createElement('li');
        talk_comment_profile.id = 'talk_comment_profile' + get_num;
        talk_comment_profile.className = 'talk_comment_profile';
        talk_comment_profile.innerHTML = '<img src="' + image + '" class="talk_comment_profile_image">';
        talk_comment_group.appendChild(talk_comment_profile);

        var talk_comment_name = document.createElement('li');
        talk_comment_name.id = 'talk_comment_name' + get_num;
        talk_comment_name.className = 'talk_comment_name';
        talk_comment_name.innerHTML = get_name;
        talk_comment_group.appendChild(talk_comment_name);

        var talk_comment_regdate = document.createElement('li');
        talk_comment_regdate.id = 'talk_comment_regdate' + get_num;
        talk_comment_regdate.className = 'talk_comment_regdate';
        talk_comment_regdate.innerHTML = get_regdate;
        talk_comment_group.appendChild(talk_comment_regdate);

        if (is_member==true && permission==1) {
            var talk_comment_action = document.createElement('li');
            talk_comment_action.id = 'talk_comment_action' + get_num;
            talk_comment_action.className = 'talk_comment_action';
            talk_comment_action.innerHTML = '<a href="javascript:void(talk_comment_delete(' + get_id + ', ' + get_num + '));">삭제</a>';
            talk_comment_group.appendChild(talk_comment_action);
        }

        var talk_comment_content = document.createElement('li');
        talk_comment_content.id = 'talk_comment_content' + get_num;
        talk_comment_content.className = 'talk_comment_content';
        talk_comment_content.innerHTML = get_content;
        talk_comment_group.appendChild(talk_comment_content);

        $('talk_comment_list'+get_id).appendChild(talk_comment_group);
    }

    var talk_comment_page = document.createElement('p');
    talk_comment_page.id = 'talk_comment_page';
    talk_comment_page.className = 'talk_comment_page';
    talk_comment_page.innerHTML = paging;

    if (len>0) $('talk_comment_list'+get_id).appendChild(talk_comment_page);

    if (is_member) {

        var talk_comment_input_form_secret = document.createElement('input');
        talk_comment_input_form_secret.type = 'checkbox';
        talk_comment_input_form_secret.id = 'talk_comment_input_form_secret' + get_id;
        talk_comment_input_form_secret.className = 'talk_comment_input_form_secret';

        var talk_comment_input_form_secret_message = document.createElement('span');
        talk_comment_input_form_secret_message.id = 'talk_comment_input_form_secret_message' + get_id;
        talk_comment_input_form_secret_message.className = 'talk_comment_input_form_secret_message';
        talk_comment_input_form_secret_message.innerHTML = '비공개<br/>';

        var talk_comment_input_form = document.createElement('input');
        talk_comment_input_form.type = 'text';
        talk_comment_input_form.id = 'talk_comment_input_form' + get_id;
        talk_comment_input_form.className = 'talk_comment_input_form';
        if (IS_IE)
            talk_comment_input_form.onkeypress = function() { if (event.keyCode==13) talk_comment_update(get_id); }
        else 
            talk_comment_input_form.onkeypress = function(event) { if (event.keyCode==13) talk_comment_update(get_id); }

        var talk_comment_input_form_button = document.createElement('input');
        talk_comment_input_form_button.type = 'button';
        talk_comment_input_form_button.className = 'talk_comment_input_form_button';
        talk_comment_input_form_button.value = '저장';
        talk_comment_input_form_button.onclick = function() { talk_comment_update(get_id); }


        $('talk_comment_list'+get_id).appendChild(talk_comment_input_form_secret);
        $('talk_comment_list'+get_id).appendChild(talk_comment_input_form_secret_message);
        $('talk_comment_list'+get_id).appendChild(talk_comment_input_form);
        $('talk_comment_list'+get_id).appendChild(talk_comment_input_form_button);
    }
}

function talk_comment_update(id) {

    var content = $F('talk_comment_input_form' + id);
    var secret = $F('talk_comment_input_form_secret' + id);

    talk_comment_loading(id);

    var url = './board/talk/mytalk_comment_update.php';
    var param = 't_id=' + t_id + '&id=' + id;
    param += '&talk_content=' + encodeURIComponent(content);
    param += '&secret=' + secret;

    var myAjax = new Ajax.Request(
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: talk_comment_update_complete
    });
}

function talk_comment_update_complete(req) {

    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    var get_id  = channel.getElementsByTagName('id')[0].firstChild.nodeValue;
    var last_page  = channel.getElementsByTagName('last_page')[0].firstChild.nodeValue;

    talk_comment(get_id,last_page,1);
}

function talk_comment_delete(id, num) {

    if (!confirm('한번 삭제한 자료는 복구할 수 없습니다.\n\n그래도 삭제하시겠습니까?')) return;

    talk_comment_loading(id);

    var url = './board/talk/mytalk_comment_update.php';
    var param = 't_id=' + t_id + '&num=' + num + '&mode=delete';

    var myAjax = new Ajax.Request(
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: talk_comment_delete_complete
    });
}

function talk_comment_delete_complete(req) {

    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    var get_id = channel.getElementsByTagName('id')[0].firstChild.nodeValue;
    var last_page = channel.getElementsByTagName('last_page')[0].firstChild.nodeValue;

    talk_comment(get_id,last_page,1);
}

function talk_visitor(page) {

    if ($('gnutalk_my_input'))
        $('gnutalk_my_input').style.display = 'none';

    talk_loading();

    var url = './board/talk/mytalk_visit_get.php';
    var param = 't_id=' + t_id + '&page=' + page;

    var myAjax = new Ajax.Request(
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: talk_visitor_complete
    });
}

function talk_visitor_complete(req) {

    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    var paging = channel.getElementsByTagName('paging')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    var item = channel.getElementsByTagName('item');
    var len = item.length;

    $('mytalk').innerHTML = '';
    var before_date = '';

    for(i=0; i<len; i++) {

        // xml 데이터 파싱
        get_visit_date  = item[i].getElementsByTagName('visit_date')[0].firstChild.nodeValue;
        get_visit_time  = item[i].getElementsByTagName('visit_time')[0].firstChild.nodeValue;
        get_visit_t_id  = item[i].getElementsByTagName('visit_t_id')[0].firstChild.nodeValue;
        get_visit_name  = item[i].getElementsByTagName('visit_name')[0].firstChild.nodeValue;
        get_visit_image  = item[i].getElementsByTagName('visit_image')[0].firstChild.nodeValue;

        var print = '<table><tr><td class="my_visit_time">' + get_visit_time + '</td>';
        print += '<td class="my_visit_image"><img src="' + get_visit_image + '" width="32" height="32"></td>';
        print += '<td class="my_visit_name"><a href="./board/talk/mytalk.php?t_id=' + get_visit_t_id + '" style="visit_name_link">' + get_visit_name + '</a></td></tr></table>';

        var visit_name = document.createElement('li');
        visit_name.id = 'visit_name';
        visit_name.innerHTML = print;

        if (before_date==get_visit_date) {

            visit_group.appendChild(visit_name);

        } else {

            var visit_group = document.createElement('ul');
            visit_group.appendChild(visit_name);

            var visit_date = document.createElement('p');
            visit_date.id = 'visit_date';
            visit_date.innerHTML = get_visit_date;

            var visit_main = document.createElement('div');
            visit_main.id = 'visit_main';

            visit_main.appendChild(visit_group);

            $('mytalk').appendChild(visit_date);
            $('mytalk').appendChild(visit_main);

            before_date = get_visit_date;
        }
    }

    var visit_page = document.createElement('p');
    visit_page.id = 'visit_page';
    visit_page.innerHTML = paging;

    $('mytalk').appendChild(visit_page);
}


function talk_friends_add(visit_t_id) {

    if (!confirm('친구로 추가하시겠습니까?')) return;

    var url = './board/talk/mytalk_friends_add.php';
    var param = 't_id=' + t_id + '&friends_t_id=' + t_id;

    var myAjax = new Ajax.Request(
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: talk_friends_add_complete
    });
}

function talk_friends_add_complete(req) {

    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    alert('친구로 추가되었습니다.');
}


function talk_friends_get_content(page,to_me) {

    var param = 't_id=' + t_id;
    param += '&page=' + page;
    if (to_me)
        param += '&to_me=' + to_me;

    var url = './board/talk/mytalk_friends_get.php';

    if ($('gnutalk_my_input'))
        $('gnutalk_my_input').style.display = 'none';

    talk_loading();

    var myAjax = new Ajax.Request(
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: talk_friends_get_content_complete
    });
}

function talk_friends_get_content_complete(req) {
    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;
    var paging  = channel.getElementsByTagName('paging')[0].firstChild.nodeValue;
    var permission  = channel.getElementsByTagName('permission')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    var item = channel.getElementsByTagName('item');
    var len = item.length;

    $('mytalk').innerHTML = '';
    var before_date = '';

    for(i=0; i<len; i++) {

        // xml 데이터 파싱
        get_id = item[i].getElementsByTagName('id')[0].firstChild.nodeValue;
        get_c_id = item[i].getElementsByTagName('c_id')[0].firstChild.nodeValue;
        get_t_id = item[i].getElementsByTagName('t_id')[0].firstChild.nodeValue;
        get_name = item[i].getElementsByTagName('name')[0].firstChild.nodeValue;
        get_image = item[i].getElementsByTagName('image')[0].firstChild.nodeValue;
        get_content = item[i].getElementsByTagName('content')[0].firstChild.nodeValue;
        get_comment_count = item[i].getElementsByTagName('comment_count')[0].firstChild.nodeValue;
        get_vote = item[i].getElementsByTagName('vote')[0].firstChild.nodeValue;
        get_date = item[i].getElementsByTagName('date')[0].firstChild.nodeValue;
        get_time = item[i].getElementsByTagName('time')[0].firstChild.nodeValue;
        get_noon = item[i].getElementsByTagName('noon')[0].firstChild.nodeValue;
        get_week = item[i].getElementsByTagName('week')[0].firstChild.nodeValue;

        var talk_group = document.createElement('ul');

        // 아이콘
        var talk_icon = document.createElement('li');
        talk_icon.id = 'talk_friends_profile_image' + get_id;
        talk_icon.className = 'talk_friends_profile_image';
        talk_icon.innerHTML = '<img src="'+get_image+'" width="72" height="72">';
        talk_group.appendChild(talk_icon);

        if (permission==1) {
            // 친구 삭제
            var talk_friends_del = document.createElement('li');
            talk_friends_del.id = 'talk_friends_del' + get_id;
            talk_friends_del.className = 'talk_friends_del';
            talk_friends_del.innerHTML = '<a href="javascript:void(friends_del(' + get_t_id + '))">삭제</a>';
            talk_group.appendChild(talk_friends_del);
        }

        // 이름
        var talk_name = document.createElement('li');
        talk_name.id = 'talk_friends_name' + get_id;
        talk_name.className = 'talk_friends_name';
        talk_name.innerHTML = get_name;
        talk_group.appendChild(talk_name);

        // 내용
        var talk_content = document.createElement('li');
        talk_content.id = 'talk_friends_content' + get_id;
        talk_content.className = 'talk_friends_content';
        talk_content.innerHTML = get_content + '<br/>';
        talk_group.appendChild(talk_content);

        // 댓글
        var talk_comment = document.createElement('span');
        talk_comment.id = 'talk_friends_comment' + get_id;
        talk_comment.className = 'talk_friends_comment';
        talk_comment.innerHTML = '<a href="javascript:void(talk_comment(' + get_id + '));">댓글 (<span id="comment_count' + get_id + '">' + get_comment_count + '</span>)</a>';
        talk_content.appendChild(talk_comment);

        // 등록 시간
        var talk_time = document.createElement('span');
        talk_time.id = 'talk_friends_time' + get_id;
        talk_time.className = 'talk_friends_time';
        talk_time.innerHTML = get_date + ' ' + get_noon + ' ' + get_time;
        talk_content.appendChild(talk_time);

        // 댓글 출력
        var talk_comment_list = document.createElement('li');
        talk_comment_list.id = 'talk_comment_list' + get_id;
        talk_comment_list.className = 'talk_friends_comment_list';
        talk_group.appendChild(talk_comment_list);

        var talk_main = document.createElement('div');
        talk_main.id = 'talk_friends_main';

        talk_main.appendChild(talk_group);

        $('mytalk').appendChild(talk_main);

        before_date = get_date;
    }

    var talk_page = document.createElement('p');
    talk_page.id = 'talk_friends_page';
    talk_page.className = 'talk_friends_page';
    talk_page.innerHTML = paging;

    $('mytalk').appendChild(talk_page);

}

function friends_del(friends_t_id) {

    if (!confirm('친구에서 제외하시겠습니까?')) return;

    var param = 't_id=' + t_id;
    param += '&friends_t_id=' + friends_t_id;

    var url = './board/talk/mytalk_friends_del.php';

    talk_loading();

    var myAjax = new Ajax.Request(
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: friends_del_complete
    });
}

function friends_del_complete(req) {

    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    talk_friends_get_content(1);
}

function talk_loading() {
    $('mytalk').innerHTML = '<img src="' + gnutalk_skin_path + '/img/loading1.gif" style="margin-top:10px;">';
}

function talk_comment_loading(id) {
    if ($('talk_comment_list' + id))
        $('talk_comment_list' + id).innerHTML = '<img src="' + gnutalk_skin_path + '/img/loading1.gif" style="margin-top:5px;">';
}

function talk_configure_get() {

    var param = 't_id=' + t_id;

    var url = './board/talk/mytalk_configure_get.php';

    if ($('gnutalk_my_input'))
        $('gnutalk_my_input').style.display = 'none';

    talk_loading();

    var myAjax = new Ajax.Request(
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: talk_configure_get_complete
    });
}

function talk_configure_get_complete(req) {

    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;
    var talk_about = channel.getElementsByTagName('talk_about')[0].firstChild.nodeValue;
    var image = channel.getElementsByTagName('image')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    $('mytalk').innerHTML = '';

    var form = document.createElement('form');
    form.id = 'talk_info';
    form.name = 'talk_configure';
    form.method = 'post';
    form.encoding = 'multipart/form-data';
    form.action = './board/talk/mytalk_configure_update.php';

    var input_t_id = document.createElement('input');
    input_t_id.type = 'hidden';
    input_t_id.name = 't_id';
    input_t_id.value = t_id;
    form.appendChild(input_t_id);

    var ul = document.createElement('ul');
    
    var li = document.createElement('li');
    li.className = 'talk_info_description';
    li.innerHTML = '- 토크 설명을 입력해주세요.';
    ul.appendChild(li);

    var li = document.createElement('li');
    li.innerHTML = '<input type="text" name="talk_about" class="talk_info_about" value="' + talk_about + '">';
    ul.appendChild(li);

    var li = document.createElement('li');
    li.className = 'talk_info_description';
    li.innerHTML = '- 프로필 이미지를 입력해주세요.';
    ul.appendChild(li);

    var li = document.createElement('li');
    li.innerHTML = '<img src="' + image + '" class="talk_info_image">';
    ul.appendChild(li);

    var li = document.createElement('li');
    li.innerHTML = '<input type="file" name="profile_image" class="talk_info_image_file">';
    ul.appendChild(li);

    var li = document.createElement('li');
    li.innerHTML = '<input type="submit" value="저     장" class="talk_info_form_button">';
    ul.appendChild(li);

    form.appendChild(ul);
    $('mytalk').appendChild(form);
}


function talk_recent_comment(page,my_comment) {
    var param = 't_id=' + t_id;
    param += '&page=' + page;
    if (my_comment)
        param += '&my_comment=' + my_comment;

    var url = './board/talk/mytalk_recent_comment_get.php';

    if ($('gnutalk_my_input'))
        $('gnutalk_my_input').style.display = 'none';

    talk_loading();

    var myAjax = new Ajax.Request(
    url, 
    {
        method: 'post', 
        parameters: param, 
        onComplete: talk_recent_comment_complete
    });
}

function talk_recent_comment_complete(req) {

    var channel = req.responseXML.getElementsByTagName('channel')[0];
    var errnum  = channel.getElementsByTagName('errnum')[0].firstChild.nodeValue;
    var errmsg  = channel.getElementsByTagName('errmsg')[0].firstChild.nodeValue;

    if (errnum!=0) { alert(errmsg); return; }

    var paging  = channel.getElementsByTagName('paging')[0].firstChild.nodeValue;
    var item = channel.getElementsByTagName('item');
    var len = item.length;

    $('mytalk').innerHTML = '';

    for(i=0; i<len; i++) {
        // xml 데이터 파싱
        get_id      = item[i].getElementsByTagName('id')[0].firstChild.nodeValue;
        get_name    = item[i].getElementsByTagName('name')[0].firstChild.nodeValue;
        get_regdate = item[i].getElementsByTagName('regdate')[0].firstChild.nodeValue;
        get_content = item[i].getElementsByTagName('content')[0].firstChild.nodeValue;
        get_image   = item[i].getElementsByTagName('image')[0].firstChild.nodeValue;

        var print = '<table><tr>';
        print += '<td class="recent_comment_regdate">' + get_regdate + '</td>';
        print += '<td class="recent_comment_image"><img src="' + get_image + '" width="32" height="32"></td>';
        print += '<td class="recent_comment_name">' + get_name + '</td>';
        print += '<td class="recent_comment_content">' + get_content + '</td>';
        print += '</tr></table>';

        var recent_comment_group = document.createElement("div");
        recent_comment_group.id  = 'recent_comment_group';
        recent_comment_group.innerHTML = print;

        $('mytalk').appendChild(recent_comment_group);
    }

    var talk_comment_page = document.createElement('p');
    talk_comment_page.id = 'talk_comment_page';
    talk_comment_page.className = 'talk_comment_page';
    talk_comment_page.innerHTML = paging;

    $('mytalk').appendChild(talk_comment_page);
}


