<?

$g4_path='../../board';

include_once("$g4_path/common.php");

if(!$member[mb_id])$mb_id='guest';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?
if($action_mode=='reg')
{
	$sql="
	insert into english_nexus set
	word_eng='$_POST[word_eng]',
	word_kor='$_POST[word_kor]',
	key_sentence_id='0',
	word_type='$_POST[word_type]',
	member_id='$mb_id'
	";
	sql_query($sql);
	$key_sentence_id = mysql_insert_id();
	for($i=0;$i<count($word_eng_ex);$i++)
	{
		$eng_ex=$word_eng_ex[$i];
		$kor_ex=$word_kor_ex[$i];
		if(!$eng_ex)continue;
		$sql1="
		insert into english_nexus set
		word_eng_ex='$eng_ex',
		word_kor_ex='$kor_ex',
		key_sentence_id='$key_sentence_id',
		word_type='$_POST[word_type]',
		member_id='$mb_id'
		";
		sql_query($sql1);
	}
	?>

	<script type="text/javascript">
	<!--
	alert('등록완료');
	parent.location.reload();
	-->
	</script>
	<?
}	
elseif($action_mode=='delete')
{
	if(!$w_id || $w_id==0)exit;
	$sql="delete from english_nexus where w_id='$w_id' or key_sentence_id='$w_id'";
	sql_query($sql);
	?>

	<script type="text/javascript">
	<!--
	alert('삭제 완료');
	parent.location.reload();
	-->
	</script>
	<?
}	
elseif($action_mode=='update' && $wr_id)
{

	$sql="
	update english_nexus set
	word_eng_ex='$_POST[update_eng]',
	word_kor_ex='$_POST[update_kor]'
	where wr_id=$wr_id
	";
	sql_query($sql);
	?>

	<script type="text/javascript">
	<!--
	alert('수정 완료');
	parent.location.reload();
	-->
	</script>
	<?
}
elseif($action_mode=='key_update' && $wr_id)
{

	$sql="
	update english_nexus set
	word_eng='$_POST[update_eng]',
	word_kor='$_POST[update_kor]'
	where wr_id=$wr_id
	";
	sql_query($sql);
	?>

	<script type="text/javascript">
	<!--
	alert('수정 완료');
	parent.location.reload();
	-->
	</script>
	<?
}
	?>