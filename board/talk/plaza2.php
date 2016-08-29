<?
include('./_common.php');
include('./config.php');

// ī�װ�
$category = array();
$qry = sql_query("select * from {$g4['talk_category_table']} order by rank"); 
while ($res = sql_fetch_array($qry)) array_push($category, $res);

// ������ ��ȣ �ʱ�ȭ
if (empty($page)) $page = 1; else $page = (int)$page;

// ���� �ѱ� ¯
$week_array = array(1=>'������',2=>'ȭ����',3=>'������',4=>'�����',5=>'�ݿ���',6=>'�����',0=>'�Ͽ���'); 
$noon_array = array('am'=>'����','pm'=>'����'); 

$page_size = $g4['plaza_page_size'];

if ($c_id)
    $sql_category = " and c_id='{$c_id}'";

if($p_year){ 
	$d_date = $p_year;
    $sql_ymd = " and regdate like '%$d_date%'";
}

if($p_month){ 
	
	if($p_month < "10") 
		$d_month = "0".$p_month; 
	else 
		$d_month = $p_month;
	
	$d_date = $year."-".$d_month;
    $sql_ymd = " and regdate like '%$d_date%'";
}



if($nday) {
	if($nday < "10") 
		$d_nday = "0".$nday; 
	else 
		$d_nday = $nday;
	
	$d_date = $year."-".$d_month."-".$d_nday;
    $sql_ymd = " and regdate = '$d_date'";
}

if($y_year && $m_month){
	if($m_month < "10") 
		$d_month = "0".$m_month; 
	else 
		$d_month = $m_month;

	$d_date = $year."-".$d_month;
    $sql_ymd = " and regdate like '%$d_date%'";
}

$total_post = sql_fetch("select count(Distinct(regdate)) as cnt from {$g4['talk_table']} where 1 {$sql_ymd} {$sql_category} and secret=0 ");
$total_post = $total_post['cnt'];
$total_page = (int)($total_post/$page_size) + ($total_post%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );

$paging = get_paging(10, $page, $total_page, "plaza.php?t_id={$t_id}&page="); 

$sql = "select Distinct(regdate) from {$g4['talk_table']} where 1 {$sql_ymd} {$sql_category} and secret=0 order by id desc limit {$page_start}, {$page_size}";
$qry = sql_query($sql);

$plaza = array();

while ($res = sql_fetch_array($qry)) {

    $res2 = sql_fetch("select mb_id from {$g4['talk_info_table']} where id='{$res['t_id']}'");
    if (!empty($res2)) {
        $res['image'] = "{$g4['path']}/data/talk/profile_image/{$res2['mb_id']}";
        if (!file_exists($res['image']))
            $res['image'] = "{$gnutalk_skin_path}/img/profile.gif";
    }

    $res['content'] = get_talk($res['content']);

    $regdate = strtotime($res['regdate'].' '.$res['regtime']);
    $res['week'] = $week_array[date('w', $regdate)]; 
    $res['date'] = date('m-d', $regdate); 
    $res['time'] = date('H:i', $regdate); 
    $res['noon'] = $noon_array[date('a', $regdate)];
    $res['regdate2'] = $res['regdate'];
    
	if ($res['regdate']==date('Y-m-d')){
        $res['regdate'] = $res['time'];
    } else {
        $res['regdate'] = $res['date'];
	}

    array_push($plaza, $res);    
}


// ��� ���� include
if (file_exists($g4['talk_head_file']))
    @include_once($g4['talk_head_file']);
else
    @include_once("{$g4['path']}/head.sub.php");

include_once("{$gnutalk_skin_path}/head.skin.php");
include_once("{$gnutalk_skin_path}/plaza.skin.php");
include_once("{$gnutalk_skin_path}/tail.skin.php");

// �ϴ� ���� include
if (file_exists($g4['talk_tail_file']))
    @include_once($g4['talk_tail_file']);
else
    @include_once("{$g4['path']}/tail.sub.php");

?>