<?
$sql_c = " select * from room_common_cd where cd_type='room'";
$result_c = sql_query($sql_c);
$house_v=array();
$owner_stay_type_select_option="";
$add_div_select_option="";
$room_type_select_option="";
for($hc=0;$row_c = sql_fetch_array($result_c);$hc++)
{
	$house_v[$row_c[post_cd]][$row_c[cd]]=$row_c[cd_value];

	$selected='';
	switch($row_c[post_cd])
	{
		
		case 'water_tax_type':
			$water_tax_type_select_option.="<option value='$row_c[cd]'>$row_c[cd_value]</option>";
			break;
		case 'water_control':
			$water_control_select_option.="<option value='$row_c[cd]'>$row_c[cd_value]</option>";
			break;
		case 'elec_tax_type':
			$elec_tax_type_select_option.="<option value='$row_c[cd]'>$row_c[cd_value]</option>";
			break;
		case 'boiler_type':
			$boiler_type_select_option.="<option value='$row_c[cd]'>$row_c[cd_value]</option>";
			break;
		case 'boiler_control':
			$boiler_control_select_option.="<option value='$row_c[cd]'>$row_c[cd_value]</option>";
			break;
		case 'brightness_type':
			$brightness_select_option.="<option value='$row_c[cd]'>$row_c[cd_value]</option>";
			break;
		case 'shower_type':
			$shower_select_option.="<option value='$row_c[cd]'>$row_c[cd_value]</option>";
			break;
		case 'bathroom_type':
			$bathroom_select_option.="<option value='$row_c[cd]'>$row_c[cd_value]</option>";
			break;
		case 'kichen_type':
			$kichen_select_option.="<option value='$row_c[cd]'>$row_c[cd_value]</option>";
			break;
		case 'balcony_type':
			$balcony_select_option.="<option value='$row_c[cd]'>$row_c[cd_value]</option>";
			break;
		default:
			break;
	}

}
$charter_yn_select_option="<option value='Y'>유</option><option value='N'>무</option>";
$c_credit_yn_select_option="<option value='Y'>유</option><option value='N'>무</option>";
$monthly_yn_select_option="<option value='Y'>유</option><option value='N'>무</option>";
$m_credit_yn_select_option="<option value='Y'>유</option><option value='N'>무</option>";
$desk_yn_select_option="<option value='Y'>유</option><option value='N'>무</option>";
$aircon_yn_select_option="<option value='Y'>유</option><option value='N'>무</option>";
$refri_yn_select_option="<option value='Y'>유</option><option value='N'>무</option>";



?>
